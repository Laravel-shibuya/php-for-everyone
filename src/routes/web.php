<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', 'PostController@index')->name('top');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/{user}', 'UserController@show')->name('users.show');

Route::prefix('posts')
    ->name('posts.')
    ->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', 'PostController@create')->name('create');
        Route::post('', 'PostController@store')->name('store');

        Route::get('{post}/edit', 'PostController@edit')
            ->name('edit')
            ->middleware('can:update,post');

        Route::put('{post}', 'PostController@update')
            ->name('update')
            ->middleware('can:update,post');

        Route::patch('{post}', 'PostController@update')
            ->middleware('can:update,post');

        Route::delete('{post}', 'PostController@destroy')
            ->name('destroy')
            ->middleware('can:destroy,post');
    });

    Route::get('', 'PostController@index')->name('index');
    Route::get('{post}', 'PostController@show')->name('show');
});
