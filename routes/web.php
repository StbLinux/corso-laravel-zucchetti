<?php

Route::get('/', 'PostsController@index')->name('posts.index'); //posts

Route::get('posts/create', 'PostsController@create')->name('posts.create');
Route::post('posts', 'PostsController@store')->name('posts.store');

Route::get('posts/{post}', 'PostsController@show')->name('posts.show');

// Route::get('posts/{post}', 'PostsController@show')->name('posts.show')->where('post', '[0-9]');


// REST
// Create, Read, Update, Delete - CRUD
// GET, POST, PATCH|PUT, DELETE

// index    - GET       - /posts                - PostsController@index     - lista tutti i Post
// show     - GET       - /posts/{post}         - PostsController@show      - visualizza singolo Post
// create   - GET       - /posts/create         - PostsController@create    - visualizza form creazione Post
// store    - POST      - /posts                - PostsController@store     - salva nuovo Post
// edit     - GET       - /posts/{post}/edit    - PostsController@edit      - visualizza form modifica Post
// update   - PATCH     - /posts/{post}         - PostsController@update    - aggiorna Post in db
// destroy  - DELETE    - /posts/{post}         - PostsController@destroy   - rimuovi Post da db

Auth::routes();
