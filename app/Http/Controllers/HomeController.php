<?php

namespace MariusLab\Http\Controllers;

use MariusLab\Task;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'tasks' => Task::all()
        ]);
    }
}
