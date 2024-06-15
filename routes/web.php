<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/view-product/{pro_id}', [HomeController::class, 'quick_view_products']);

//---------------------------------ABOUT-----------------------------------------// 
Route::get('/about', [HomeController::class, 'about']);

//---------------------------------PRODUCT-----------------------------------------// 
Route::get('/product', [HomeController::class, 'products']);
Route::get('/product-detail', [HomeController::class, 'product_details']);
//---------------------------------CONTACT-----------------------------------------// 
Route::get('/contact', [HomeController::class, 'contact']);

//---------------------------------BLOG-----------------------------------------// 
Route::get('/blog', [HomeController::class, 'blog']);












//---------------------------------ADMIN-----------------------------------------// 
Route::middleware(['authLogin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
    Route::get('/add-category-product', [CategoryController::class, 'add_category_product']);
    Route::get('/all-category-product', [CategoryController::class, 'all_category_product']);
    Route::get('/all-color-product', [CategoryController::class, 'all_color_product']);
    Route::get('/all-size-product', [CategoryController::class, 'all_size_product']);
    Route::get('/add-product', [ProductController::class, 'add_products']);
    Route::get('/all-product', [ProductController::class, 'all_products']);
});
//-LOGIN-//
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin-logout', [AdminController::class, 'logout']);

//-------------------------------CATEGORY-PRODUCT-------------------------------//
Route::post('/save-category-product',[CategoryController::class, 'save_category_product']);
Route::get('/edit-category-product/{cate_pro_id}',[CategoryController::class, 'edit_category_product']);
Route::post('/update-category-product/{cate_pro_id}',[CategoryController::class, 'update_category_product']);
Route::get('/delete-category-product/{cate_pro_id}',[CategoryController::class, 'delete_category_product']);
Route::get('/active-category-product/{cate_pro_id}',[CategoryController::class, 'active_category_product']);
Route::get('/unactive-category-product/{cate_pro_id}',[CategoryController::class, 'unactive_category_product']);

//-------------------------------SIZE-PRODUCT-------------------------------//
Route::get('/active-size-product/{size_pro_id}',[CategoryController::class, 'active_size_product']);
Route::get('/unactive-size-product/{size_pro_id}',[CategoryController::class, 'unactive_size_product']);

//-------------------------------COLOR-PRODUCT-------------------------------//
Route::post('/save-color-product',[CategoryController::class, 'save_color_product']);
Route::get('/active-color-product/{color_pro_id}',[CategoryController::class, 'active_color_product']);
Route::get('/unactive-color-product/{color_pro_id}',[CategoryController::class, 'unactive_color_product']);


//-------------------------------PRODUCT-------------------------------//
Route::post('/save-product', [ProductController::class, 'save_products']);
Route::get('/edit-product/{pro_id}', [ProductController::class, 'edit_products']);
Route::post('/update-product/{pro_id}', [ProductController::class, 'update_products']);
Route::get('/delete-product/{pro_id}', [ProductController::class, 'delete_products']);
Route::get('/active-product/{pro_id}', [ProductController::class, 'active_products']);
Route::get('/unactive-product/{pro_id}', [ProductController::class, 'unactive_products']);
