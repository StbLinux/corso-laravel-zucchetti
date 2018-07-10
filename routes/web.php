<?php

Route::get('/', 'TasksController@index');

Route::get('tasks/{task}', 'TasksController@show');
