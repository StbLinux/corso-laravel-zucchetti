<?php

Route::get('/', 'PostsController@index')->name('posts.index');
Route::resource('posts', 'PostsController')->except('index');

Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

Route::view('tokens', 'tokens')->middleware('auth');

Auth::routes();

// Route::get('/', 'PostsController@index')->name('posts.index');
// Route::get('posts/create', 'PostsController@create')->name('posts.create');
// Route::post('posts', 'PostsController@store')->name('posts.store');
// Route::get('posts/{post}', 'PostsController@show')->name('posts.show');
// Route::get('posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
// Route::patch('posts/{post}', 'PostsController@update')->name('posts.update');
// Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');

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
