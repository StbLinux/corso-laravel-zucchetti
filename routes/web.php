<?php

// app riceve richiesta
// viene interpretata nel router
// controller - > view

Route::get('/', function () {
    // $tasks = [
    //     'impara laravel',
    //     'usa laravel',
    //     'ripeti',
    // ];
    //resources/views/welcome.blade.php

    $tasks = DB::table('tasks')->get();

    // return $tasks;

    return view('welcome', compact('tasks'));

    // $utente = 'Sid';

    // return view('welcome', compact('utente'));
    // return view('welcome')->withUtente($utente);
    // return view('welcome')->with(['utente' => $utente]);
    // return view('welcome', ['utente' => $utente]);
});
