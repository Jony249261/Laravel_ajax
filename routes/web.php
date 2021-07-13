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




Route::get('/', 'TeacherController@index');
Route::get('/teacher/all', 'TeacherController@allData');
Route::post('/teacher/store/', 'teacherController@store');
Route::get('/teacher/edit/{id}', 'teacherController@Edit');
Route::get('/teacher/destroy/{id}', 'teacherController@delete');
Route::post('/teacher/update/{id}', 'teacherController@Update');
