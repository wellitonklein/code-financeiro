<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('can:access-admin');

Auth::routes();

Route::get('/home', function (){
    return redirect()->route('admin.home');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'can:access-admin',
    'as' => 'admin.'
],function (){
    Route::get('/home', 'HomeController@index')->name('home');
});