<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_category_product;

class homeController extends Controller
{
    public function showHome()
    {
        // Show category product
        $show_cate = tbl_category_product::showCategoryProduct();

        // Xử lý dữ liệu và trả về view
        return view('pages/home', compact('show_cate'));
    }
}
