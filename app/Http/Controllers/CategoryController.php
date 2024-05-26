<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
use DB;
session_start();

class CategoryController extends Controller
{   
    public function all_category_product() {
        $all_cate_pro = DB::table('category_products')->get();
        $manager_cate_pro = view('admin/categoryProduct/allCategory')->with('all_cate_pro', $all_cate_pro);
        return view('adminLayout')->with('admin/categoryProduct/allCategory', $manager_cate_pro);
    }

    public function add_category_product() {
        return view('admin/categoryProduct/addCategory');
    }

    public function save_category_product(Request $request) {
        $status = $request->category_product_status;
        if($request->category_product_status == '') {
            $status = 'off';
        }
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_desc'] = $request->category_product_desc;
        $data['cate_status'] = $status;

        DB::table('category_products')->insert($data);
        Session::put('message', 'Added product categories successfully!');

        return Redirect::to('add-category-product');
    }
}
