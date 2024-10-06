<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_category_product;

class categoryController extends Controller
{
    public function show_category_products() {
        // Show category product
        $show_cate = tbl_category_product::showAllCategoryProduct();

        // Xử lý dữ liệu và trả về view
        return view('admin/products/allCategories', compact('show_cate'));
    }
}
