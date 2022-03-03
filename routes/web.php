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

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('admin')->prefix('/users/')->group(function () {
    Route::get('edit/{id}', 'UserController@edit')->name('users/edit');
});

Route::middleware('admin')->prefix('/positions/')->group(function () {
    Route::get('index', 'PositionController@index')->name('positions/index');
    Route::get('create', 'PositionController@create')->name('positions/create');
    Route::post('store', 'PositionController@store')->name('positions/store');
    Route::get('edit/{id}', 'PositionController@edit')->name('positions/edit');
    Route::post('update', 'PositionController@update')->name('positions/update');
});

Route::middleware('admin')->prefix('/skills/')->group(function () {
    Route::get('index', 'SkillController@index')->name('skills/index');
    Route::get('create', 'SkillController@create')->name('skills/create');
    Route::post('store', 'SkillController@store')->name('skills/store');
    Route::get('edit/{id}', 'SkillController@edit')->name('skills/edit');
    Route::post('update', 'SkillController@update')->name('skills/update');
});

