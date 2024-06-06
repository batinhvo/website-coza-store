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

//---------------------------------ABOUT-----------------------------------------// 
Route::get('/about','App\Http\Controllers\HomeController@about');

//---------------------------------CONTACT-----------------------------------------// 
Route::get('/contact','App\Http\Controllers\HomeController@contact');

//---------------------------------BLOG-----------------------------------------// 
Route::get('/blog','App\Http\Controllers\HomeController@blog');


//---------------------------------ADMIN-----------------------------------------// 
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

//-LOGIN-//
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');
Route::get('/admin-logout','App\Http\Controllers\AdminController@logout');


//-------------------------------CATEGORY-PRODUCT-------------------------------//
Route::get('/add-category-product','App\Http\Controllers\CategoryController@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryController@all_category_product');
Route::post('/save-category-product','App\Http\Controllers\CategoryController@save_category_product');
Route::get('/edit-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@edit_category_product');
Route::post('/update-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@update_category_product');
Route::get('/delete-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@delete_category_product');

Route::get('/active-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@active_category_product');
Route::get('/unactive-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@unactive_category_product');

//-------------------------------PRODUCT-------------------------------//
Route::get('/add-product','App\Http\Controllers\ProductController@add_products');
Route::get('/all-product','App\Http\Controllers\ProductController@all_products');