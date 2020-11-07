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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

Route::get('/route1', function () {
    return 'masuk';
})->middleware(['auth', 'email_verified']);

Route::get('/route2', function () {
    return 'masuk';
})->middleware(['auth', 'email_verified', 'admin']);
