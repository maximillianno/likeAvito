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




//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');

Route::post('/register1', 'RegisterController@register');
Route::get('/register1', 'RegisterController@showForm')->name('register');
Route::get('/login1', 'LoginController@showLoginForm')->name('login');
Route::post('/login1', 'LoginController@login');
Route::get('/verify/{token}', 'RegisterController@verify')->name('register.verify');
Route::POST('/logout', 'Auth\LoginController@logout')->name('logout');
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'can:admin-panel']
    ], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/users/verify/{user}', 'UsersController@verify')->name('users.verify');
    Route::resource('users', 'UsersController');
});