<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add_category_product() {
        return view('admin/categoryProduct/addCategory');

    }

    public function all_category_product() {
        return view('admin/categoryProduct/allCategory');
    }
}
