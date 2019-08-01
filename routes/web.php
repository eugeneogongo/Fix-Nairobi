<?php
/**
 * Developed by Eugene Ogongo on 8/1/19 2:07 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 8/1/19 2:07 PM
 * Copyright (c) 2019 . All rights reserved
 */

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
Route::get('/about', 'HomeController@showAbout')->name('about');
Route::post('/reportproblem', 'ReportController@reportIssue')->name('reportproblem');
Route::get('/admin', 'AdminController@admin')->middleware('admin')->name('admin');
Route::get('/admin/newIssue','IssueController@show')->middleware('admin')->name('newissue');
Route::post('/admin/createIssue','IssueController@createIssue')->middleware('admin')->name('createissue');
Route::get('/viewissue/{id}', "ViewProblemController@ViewIssue");
Route::get('/broadcast', "BroadCastController@show")->middleware('admin')->name('broadcast');
Route::post('/broadcast', "BroadCastController@send")->middleware('admin')->name('broadcast');

Route::get('/file-a-complain', function () {
    return view('pages.complainform')->withTitle('File Complain');
})->name('complain');
Route::post('/file-a-complain', 'ReportController@reportfeed')->name('complain');

Route::get('/feedbacks', 'AdminController@feedbacks')->middleware('admin')->name('feedbacks');

Route::post('/fix','ViewProblemController@issueFixed')->middleware('admin')->name('fix');

Route::post('/update', "ViewProblemController@update")->name('update');

Route::get('/report/update/{id}', "ViewProblemController@success")->name('success');

Route::get('/addadmin', 'AdminController@adminpage')->name('adminpage');
Route::post('/addadmin', 'AdminController@createadmin')->name('createadmin');
