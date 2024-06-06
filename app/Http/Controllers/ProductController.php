<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
use DB;
session_start();

class ProductController extends Controller
{
    //add product
    public function add_products() {
        $all_cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_size = DB::table('tbl_sizes')->where('size_status', 1)->get();

        $manager_cate_pro = view('admin/product/addProduct')->with('categories', $all_cate_pro)->with('sizes', $all_size);
        return view('adminLayout')->with('admin/product/addProduct', $manager_cate_pro);
        
    }
}
