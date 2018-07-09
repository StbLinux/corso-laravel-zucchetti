<?php

use App\Task;

Route::get('/', function () {
    // $tasks = Task::where('completed', 1)->get(); // completed: where completed = '1'
    $tasks = Task::completed()->get(); // completed: where completed = '1'
    // $tasks = Task::incomplete()->get(); // completed: where completed = '1'
    return view('welcome', compact('tasks'));
});

Route::get('tasks/{id}', function ($id) {
    return Task::find($id);
});
