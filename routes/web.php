<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\AssignmentController@index');
Route::post('/save','App\Http\Controllers\AssignmentController@store')->name('save.assignment');
Route::post('/right/selected','App\Http\Controllers\AssignmentController@rightSelected')->name('right.selected');
Route::post('/left/selected','App\Http\Controllers\AssignmentController@leftSelected')->name('left.selected');