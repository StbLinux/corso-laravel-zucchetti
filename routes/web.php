<?php

// app riceve richiesta
// viene interpretata nel router

Route::get('/', function () {
    return view('welcome');
});
