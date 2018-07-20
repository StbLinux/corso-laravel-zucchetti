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

// Route::get('passport-test/user', function () {
//     return request()->user();
// })->middleware('auth:api');


/*
 * Laravel Passport Client Routes Implementation
 */


// use Illuminate\Http\Request;

// Route::get('/redirect', function () {
//     $query = http_build_query([
//         'client_id' => 3,
//         'redirect_uri' => 'https://corso-laravel-oauth2-client.dev/callback',
//         'response_type' => 'code',
//         // 'scope' => '',
//     ]);

//     return redirect('https://corso-laravel.dev/oauth/authorize?'.$query);
// });


// Route::get('/callback', function (Request $request) {
//     // composer require guzzlehttp/guzzle -vvv
//     $http = new GuzzleHttp\Client;

//     $response = $http->post('https://corso-laravel.dev/oauth/token', [
//         'form_params' => [
//             'grant_type' => 'authorization_code',
//             'client_id' => 3,
//             'client_secret' => 'Jh6rsGExmk06jT8lTWX82sCIA0a7A7CK0bMiVn4q',
//             'redirect_uri' => 'https://corso-laravel-oauth2-client.dev/callback',
//             'code' => $request->code,
//         ],
//     ]);

//     return json_decode((string) $response->getBody(), true);
// });


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
