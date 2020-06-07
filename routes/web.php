<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});
Route::get('new' , 'TestController@index');
Route::post('/addTag' , 'AdminController@addTag');
Route::post('/updateTag' , 'AdminController@updateTag');
Route::post('/uploadImage' , 'AdminController@uploadImage');
Route::post('/deleteImage' , 'AdminController@deleteImage');
Route::delete('/deleteTag/{id}' , 'AdminController@deleteTag');
Route::get('/getAllTags' , 'AdminController@getAllTags');

/* Category */
Route::post('/insertCategory' , 'AdminController@insertCategory');
Route::get('/getAllCategories' , 'AdminController@getAllCategories');
Route::delete('/deleteCategory/{id}' , 'AdminController@deleteCategory');
Route::post('/updateCategory' , 'AdminController@updateCategory');

/* User */
Route::post('/addUser' , 'AdminController@addUser');
Route::get('/getAllUsers' , 'AdminController@getAllUsers');
Route::delete('/deleteUser/{id}' , 'AdminController@deleteUser');
Route::post('/updateUser' , 'AdminController@updateUser');

/* Login */
Route::post('/loginUser' , 'AdminController@loginUser');


Route::any('{slug}' , function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
