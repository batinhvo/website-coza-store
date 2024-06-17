<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use Carbon\Carbon;
use Validator;
use Session;
use DB;

session_start();

class ProductController extends Controller
{
    //add product
    public function add_products() {
        $all_cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_size = DB::table('tbl_sizes')->where('size_status', 1)->get();
        $all_color = DB::table('tbl_colors')->where('color_status', 1)->get();
        $manager_cate_pro = view('admin/product/addProduct')->with('categories', $all_cate_pro)->with('sizes', $all_size)->with('colors', $all_color);
        return view('adminLayout')->with('admin/product/addProduct', $manager_cate_pro);       
    }


    //save product
    public function save_products(Request $request) {
        $status = 1;
        if($request->product_status == '') {
            $status = 0;
        }
        $date = Carbon::now('Asia/Ho_Chi_Minh');

        $validator = Validator::make($request->all(), [
            'category_product_id' => 'bail|alpha_num|required',
            'product_size' => 'bail|required',
            'product_color' => 'required',
        ],
        [
            'category_product_id.alpha_num' => 'Please select a product category',
            'product_size.required' => 'Please select a product size',
            'product_color.required' => 'Please select a product color',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }       

        $proId = rand(0,99999);  
        $proSlug = Str::slug($request->product_name, "-");

        $data = array();
        $data['pro_id'] = $proId;
        $data['cate_id'] = $request->category_product_id;
        $data['cate_id'] = $request->category_product_id;
        $data['pro_name'] = $request->product_name;
        $data['pro_price'] = $request->product_price;
        $data['pro_desc'] = $request->product_desc;
        $data['pro_slug'] = $proSlug;
        $data['pro_status'] = $status;
        $data['created_at'] = $date->toDateTimeString();
        $get_image = $request->file('product_img');

        if($get_image) {            
            $name_img = sprintf("coza-store-product-%d", rand(0,99999));
            $new_img = $name_img.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products', $new_img);
            $data['pro_img'] = $new_img;
        } else {
            $data['pro_img'] = 'product-images.jpg';
        }
        DB::table('tbl_products')->insert($data);

        foreach ($request->product_size as $key => $val) {
            $dataS = array();
            $dataS['pro_id'] = $proId;
            $dataS['size_id'] = $val;
            DB::table('tbl_product_sizes')->insert($dataS);
        }

        foreach ($request->product_color as $key => $val) {
            $dataC = array();
            $dataC['pro_id'] = $proId;
            $dataC['color_id'] = $val;
            DB::table('tbl_product_colors')->insert($dataC);
        }

        Session::put('message', 'Added product successfully!');
        return Redirect::to('add-product');
    }


    //edit category
    public function edit_products($pro_id) {
        $all_cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_size = DB::table('tbl_sizes')->where('size_status', 1)->get();
        $all_color = DB::table('tbl_colors')->where('color_status', 1)->get();
        $all_pro = DB::table('tbl_products')
                    ->join('category_products', 'tbl_products.cate_id', '=', 'category_products.cate_id')
                    ->where('pro_id', $pro_id)
                    ->get();
            
        $all_size_pro = DB::table('tbl_product_sizes')
                    ->join('tbl_products', 'tbl_product_sizes.pro_id', '=', 'tbl_products.pro_id')       
                    ->join('tbl_sizes', 'tbl_product_sizes.size_id', '=', 'tbl_sizes.size_id')
                    ->where('tbl_product_sizes.pro_id', $pro_id)
                    ->get();  
        
        $all_color_pro = DB::table('tbl_product_colors')
                    ->join('tbl_products', 'tbl_product_colors.pro_id', '=', 'tbl_products.pro_id')       
                    ->join('tbl_colors', 'tbl_product_colors.color_id', '=', 'tbl_colors.color_id')
                    ->where('tbl_product_colors.pro_id', $pro_id)
                    ->get();              

        $pro_edit = view('admin/Product/editProduct')
                    ->with('pro_edit', $all_pro)
                    ->with('sizes', $all_size)
                    ->with('categories', $all_cate_pro)
                    ->with('sizePro', $all_size_pro)
                    ->with('colorPro', $all_color_pro)
                    ->with('colors', $all_color);  

        return view('adminLayout')->with('admin/product/editProduct', $pro_edit);
    }


    //update product
    public function update_products(Request $request, $pro_id) {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $old_img = DB::table('tbl_products')->where('pro_id', $pro_id)->value('pro_img');
        $proSlug = Str::slug($request->product_name, "-");

        $data = array();
        $data['cate_id'] = $request->category_product_id;
        $data['pro_name'] = $request->product_name;
        $data['pro_price'] = $request->product_price;  
        $data['pro_desc'] = $request->product_desc;
        $data['pro_slug'] = $proSlug;
        $data['updated_at'] = $date->toDateTimeString();
        $get_image = $request->file('product_img');

        if($get_image) {            
            $name_img = sprintf("coza-store-product-%d", rand(0,99999));
            $new_img = $name_img.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products', $new_img);
            $data['pro_img'] = $new_img;
            unlink(sprintf('public/upload/products/%s', $old_img));
            DB::table('tbl_products')->where('pro_id', $pro_id)->update($data);
            Session::put('message', 'Updated product successfully!');
            return Redirect::to('all-product');
        }
        DB::table('tbl_products')->where('pro_id', $pro_id)->update($data);

        DB::table('tbl_product_sizes')->where('pro_id', $pro_id)->delete();
        DB::table('tbl_product_colors')->where('pro_id', $pro_id)->delete();
        foreach ($request->product_size as $key => $val) {
            $dataS = array();
            $dataS['pro_id'] = $pro_id;
            $dataS['size_id'] = $val;
            DB::table('tbl_product_sizes')->insert($dataS);
        }
        foreach ($request->product_color as $key => $val) {
            $dataC = array();
            $dataC['pro_id'] = $pro_id;
            $dataC['color_id'] = $val;
            DB::table('tbl_product_colors')->insert($dataC);
        }
        Session::put('message', 'Updated product successfully!');
        return Redirect::to('all-product');
    }


    //delete product
    public function delete_products($pro_id) {
        $images = DB::table('tbl_products')->where('pro_id', $pro_id)->value('pro_img');
        DB::table('tbl_product_sizes')->where('pro_id', $pro_id)->delete();
        DB::table('tbl_product_colors')->where('pro_id', $pro_id)->delete();
        DB::table('tbl_products')->where('pro_id', $pro_id)->delete();
        unlink(sprintf('public/upload/products/%s', $images));
        Session::put('message', 'Deleted product successfully!');
        return Redirect::to('all-product');
    }


    //all product
    public function all_products() {
        $all_pro = DB::table('tbl_products')
                    ->join('category_products', 'tbl_products.cate_id', '=', 'category_products.cate_id')               
                    ->orderby('pro_id', 'DESC')
                    ->get();

        $all_size = DB::table('tbl_product_sizes')
                    ->join('tbl_products', 'tbl_product_sizes.pro_id', '=', 'tbl_products.pro_id')       
                    ->join('tbl_sizes', 'tbl_product_sizes.size_id', '=', 'tbl_sizes.size_id')
                    ->get();  
        
        $all_color = DB::table('tbl_product_colors')
                    ->join('tbl_products', 'tbl_product_colors.pro_id', '=', 'tbl_products.pro_id')       
                    ->join('tbl_colors', 'tbl_product_colors.color_id', '=', 'tbl_colors.color_id')
                    ->get();              
        
        $manager_pro = view('admin/product/allProduct')
                    ->with('all_pro', $all_pro)
                    ->with('colors', $all_color)
                    ->with('sizes', $all_size);
            
        return view('adminLayout')->with('admin/product/allProduct', $manager_pro);
    }


    //show category
    public function active_products($pro_id) {
        DB::table('tbl_products')->where('pro_id', $pro_id)->update(['pro_status'=>1]);        
        return Redirect::to('all-product');
    } 


    //Hide category
    public function unactive_products($pro_id) {
        DB::table('tbl_products')->where('pro_id', $pro_id)->update(['pro_status'=>0]);        
        return Redirect::to('all-product');
    } 
}
