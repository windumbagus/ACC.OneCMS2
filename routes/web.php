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

// Route::get('/', function () {
//     return view('welcome');
// });


//Home Admin LTE
Route::get('/','AdminController@index');

Route::get('/rejected','RejectedController@index');
Route::get('/rejected/show','RejectedController@show');

Route::get('/approve','ApproveController@index');
Route::get('/approve/show','ApproveController@show');

Route::get('/pendinglist','PendinglistController@index');
Route::get('/pendinglist/update','PendinglistController@update');

<<<<<<< HEAD
=======
Route::get('/customer','CustomerController@index');

// coba coba

>>>>>>> f7b0bcebc3bb4ed037188b918ed0afd2bfb67d00
