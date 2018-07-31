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
use Illuminate\Support\Facades\Gate;

Route::get('/', function () {
    if (Gate::allows('access-admin')){
        echo "Usuário com permissão de admin";
    }else{
        echo "Usuário sem permissão de admin";
    }
//    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
