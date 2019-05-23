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

use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/reportproblem', 'ReportController@Show')->name('reportproblem');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/reportissue','HomeController@reportIssue')->name('reportissue');
Route::get('/admin', 'HomeController@admin')->middleware('admin');
