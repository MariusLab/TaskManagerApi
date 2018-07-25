<html>
    <title>Task Manager</title>
    <body>
        @foreach ($tasks as $task)
            <p>
                Task: {{ $task->title }}
                @if ($task->description !== null)
                    <br/>
                    Description: {{ $task->description }}
                @endif
                @if ($task->due_date !== null)
                    <br/>
                    Due date: {{ $task->due_date }}
                @endif
                @if ($task->completed_date !== null)
                    <br/>
                    Completed: {{ $task->completed_date }}
                @endif
            </p>
        @endforeach

    </body>
</html>