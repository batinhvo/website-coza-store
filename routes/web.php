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

//---------------------------------HOME-----------------------------------------// 
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/home','App\Http\Controllers\HomeController@index');


//---------------------------------ADMIN-----------------------------------------// 
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

//-LOGIN-//
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');
Route::get('/admin-logout','App\Http\Controllers\AdminController@logout');


//-------------------------------CATEGORY-PRODUCT-------------------------------//
Route::get('/add-category-product','App\Http\Controllers\CategoryController@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryController@all_category_product');