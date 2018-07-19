<?php

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
    Route::post('login', 'LoginController@login')->name('login');

    Route::resource('posts', 'PostsController')->except('create', 'edit');

    Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
    Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me', 'MeController@me')->name('me');
    });
});



// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// JWT - JasonWebTokens - Token - Header - iOs/Droid - sharedPreferences/LocalStorage - web - LocalStorage
// OAuth2 - Passport
    // - Access Token Grant - appID - appSecret - redirect + callback // comunicare credenziali APP
    // - Password Grant - appID - appSecret - auth in locale - user e pass

// Route::get('posts', function () {
//     return App\Post::first();
// })->name('api.posts');
