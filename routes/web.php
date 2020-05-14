<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});
Route::get('new' , 'TestController@index');
Route::post('/addTag' , 'AdminController@addTag');
Route::get('/getAllTags' , 'AdminController@getAllTags');
Route::any('{slug}' , function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
