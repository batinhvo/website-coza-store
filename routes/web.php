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
Route::middleware(['authLogin'])->group(function () {
    Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
    Route::get('/add-category-product','App\Http\Controllers\CategoryController@add_category_product');
    Route::get('/all-category-product','App\Http\Controllers\CategoryController@all_category_product');
    Route::get('/all-color-product','App\Http\Controllers\CategoryController@all_color_product');
    Route::get('/add-product','App\Http\Controllers\ProductController@add_products');
    Route::get('/all-product','App\Http\Controllers\ProductController@all_products');
});
//-LOGIN-//
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');
Route::get('/admin-logout','App\Http\Controllers\AdminController@logout');

//-------------------------------CATEGORY-PRODUCT-------------------------------//
Route::post('/save-category-product','App\Http\Controllers\CategoryController@save_category_product');
Route::get('/edit-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@edit_category_product');
Route::post('/update-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@update_category_product');
Route::get('/delete-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@delete_category_product');
Route::get('/active-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@active_category_product');
Route::get('/unactive-category-product/{cate_pro_id}','App\Http\Controllers\CategoryController@unactive_category_product');

//-------------------------------SIZE-PRODUCT-------------------------------//
Route::get('/active-size-product/{size_pro_id}','App\Http\Controllers\CategoryController@active_size_product');
Route::get('/unactive-size-product/{size_pro_id}','App\Http\Controllers\CategoryController@unactive_size_product');

//-------------------------------COLOR-PRODUCT-------------------------------//
Route::post('/save-color-product','App\Http\Controllers\CategoryController@save_color_product');
Route::get('/active-color-product/{color_pro_id}','App\Http\Controllers\CategoryController@active_color_product');
Route::get('/unactive-color-product/{color_pro_id}','App\Http\Controllers\CategoryController@unactive_color_product');


//-------------------------------PRODUCT-------------------------------//
Route::post('/save-product','App\Http\Controllers\ProductController@save_products');
Route::get('/edit-product/{pro_id}','App\Http\Controllers\ProductController@edit_products');
Route::post('/update-product/{pro_id}','App\Http\Controllers\ProductController@update_products');
Route::get('/delete-product/{pro_id}','App\Http\Controllers\ProductController@delete_products');

Route::get('/active-product/{pro_id}','App\Http\Controllers\ProductController@active_products');
Route::get('/unactive-product/{pro_id}','App\Http\Controllers\ProductController@unactive_products');