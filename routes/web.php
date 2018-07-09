<?php


Route::get('/', function () {
    $tasks = DB::table('tasks')->get();
    return view('welcome', compact('tasks'));
});

Route::get('tasks/{id}', function ($id) {
    $task = DB::table('tasks')->find($id);

    return json_decode(json_encode($task), true);
});
