<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use DB;

session_start();

class ProductController extends Controller
{
    //add product
    public function add_products() {
        $all_cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_size = DB::table('tbl_sizes')->where('size_status', 1)->where('size_id', '>', 1)->get();
        $all_color = DB::table('tbl_colors')->where('color_status', 1)->where('color_id', '>', 1)->get();

        $manager_cate_pro = view('admin/product/addProduct')->with('categories', $all_cate_pro)->with('sizes', $all_size)->with('colors', $all_color);
        return view('adminLayout')->with('admin/product/addProduct', $manager_cate_pro);       
    }
    //save product
    public function save_products(Request $request) {
        $status = 1;
        if($request->product_status == '') {
            $status = 0;
        }
        $pro_size = implode(', ',$request->product_size);
        $pro_color = implode(', ',$request->product_color);
        $date = Carbon::now('Asia/Ho_Chi_Minh');

        $data = array();
        $data['cate_id'] = $request->category_product_id;
        $data['pro_name'] = $request->product_name;
        $data['pro_price'] = $request->product_price;
        $data['pro_size'] = $pro_size;
        $data['pro_color'] = $pro_color;       
        $data['pro_desc'] = $request->product_desc;
        $data['pro_status'] = $status;
        $data['created_at'] = $date->toDateTimeString();
        $get_image = $request->file('product_img');

        if($get_image) {            
            $name_img = sprintf("coza-store-product-%d", rand(0,99999));
            $new_img = $name_img.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products', $new_img);
            $data['pro_img'] = $request->product_img;
            DB::table('tbl_products')->insert($data);
            Session::put('message', 'Added product successfully!');
            return Redirect::to('add-product');
            echo $name_img;
        }
        $data['pro_img'] = 'no pictures';
        DB::table('tbl_products')->insert($data);
        Session::put('message', 'Added product successfully!');
        return Redirect::to('add-product');
    }
    
}
