<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\categoryController;

/*
|--------------------------------------------------------------------------
|------------------------- USER VIEWS -------------------------------------
|--------------------------------------------------------------------------
*/

Route::get('/', [homeController::class, 'showHome']);
Route::get('/home', [homeController::class, 'showHome']);


/*
|--------------------------------------------------------------------------
|------------------------- ADMIN VIEWS ------------------------------------
|--------------------------------------------------------------------------
*/

// ------------------------- DASHBOARD ------------------------------------
Route::get('dashboard', [adminController::class, 'show_dashboard']);

// ------------------------- DASHBOARD ------------------------------------
Route::get('all-category-products', [categoryController::class, 'show_category_products']);