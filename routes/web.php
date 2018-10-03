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
});

Route::group(['prefix' => '/', 'as' => 'site.'], function (){
    Route::get('/', function (){
        return view('site.home');
    })->name('home');

    Route::get('register', 'Site\Auth\RegisterController@create')->name('auth.register.create');
    Route::post('register', 'Site\Auth\RegisterController@store')->name('auth.register.store');

    Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function (){
        Route::get('create', 'Site\SubscriptionsController@create')->name('create')->middleware('auth');
        Route::post('store', 'Site\SubscriptionsController@store')->name('store')->middleware('auth');
        Route::get('successfully','Site\SubscriptionsController@successfully')->name('successfully');
    });

    Route::group(['prefix' => 'my-financial', 'as' => 'my_financial'], function (){
        Route::get('/', function (){
            echo "teste";
        })->middleware('auth.from_token');
    });

    Route::get('login', 'Site\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Site\Auth\LoginController@login');
    Route::post('logout', 'Site\Auth\LoginController@logout');
});

Route::get('/home', function (){
    return redirect()->route('admin.home');
});

Route::get('/app', function (){
    return view('layouts.spa');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function (){
    Auth::routes();

    Route::group(['middleware' => 'can:access-admin'], function (){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('banks', 'Admin\BanksController', ['except' => 'show']);
    });
});