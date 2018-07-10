<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        return Task::completed()->get();
    }

    public function show(Task $task)
    {
        return $task;
    }
}
