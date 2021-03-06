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


Auth::routes();
// home pubblica
Route::get('/', 'HomeController@index')->name('home');
Route::get('/show/{slug}', 'HomeController@show')->name('show');

// dashboard - rotte protette da password
Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function () {
   Route::get('/', 'HomeController@index')->name('home');
   Route::resource('posts', 'PostController');
});
