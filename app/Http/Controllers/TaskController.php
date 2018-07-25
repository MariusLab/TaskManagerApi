<?php

namespace MariusLab\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MariusLab\Http\Resources\TaskCollection;
use MariusLab\Http\Resources\TaskResource;
use MariusLab\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:tasksapi');
    }

    /**
     * Return resource collection.
     *
     * @return TaskCollection
     */
    public function index()
    {
        /** @var TaskCollection $taskCollection */
        $taskCollection = TaskResource::collection(Task::all());
        return $taskCollection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TaskResource|JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'description' => 'string',
            'due_date' => 'date',
            'completed_date' => 'date',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['Invalid request' => $validator->errors()], 400);
        }

        $task = Task::create([
            'owner_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date
        ]);

        return new TaskResource($task);
    }

    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return TaskResource|JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        if ($request->user()->id !== $task->owner_id) {
            return new JsonResponse(['error' => 'You are not authorized to edit this resource.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['bad request' => $validator->errors()], 400);
        }

        $task->update($request->only(['title', 'description', 'due_date', 'completed_date']));

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|JsonResponse
     */
    public function destroy(Request $request, Task $task)
    {
        if ($request->user()->id !== $task->owner_id) {
            return new JsonResponse(['error' => 'You are not authorized to delete this resource.'], 403);
        }

        try {
            $task->delete();
        } catch (\Exception $e) {
            return new JsonResponse(null, 500);
        }

        return new JsonResponse(null, 204);
    }
}
