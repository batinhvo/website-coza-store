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
    //add category
    public function add_category_product() {
        return view('admin/categoryProduct/addCategory');
    }
    //edit category
    public function edit_category_product($cate_pro_id) {
        $cate_pro = DB::table('category_products')->where('cate_id', $cate_pro_id)->get();
        $cate_pro_edit = view('admin/categoryProduct/editCategory')->with('cate_pro_edit', $cate_pro);
        return view('adminLayout')->with('admin/categoryProduct/editCategory', $cate_pro_edit);
    }
    //update category
    public function update_category_product(Request $request, $cate_pro_id) {
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_desc'] = $request->category_product_desc;

        DB::table('category_products')->where('cate_id', $cate_pro_id)->update($data);
        Session::put('message', 'Updated product categories successfully!');
        return Redirect::to('all-category-product');
    }
    //delete category
    public function delete_category_product($cate_pro_id) {
        DB::table('category_products')->where('cate_id', $cate_pro_id)->delete();
        Session::put('message', 'Deleted product categories successfully!');
        return Redirect::to('all-category-product');
    }
    //save category
    public function save_category_product(Request $request) {
        $status = 1;
        if($request->category_product_status == '') {
            $status = 0;
        }

        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_desc'] = $request->category_product_desc;
        $data['cate_status'] = $status;

        DB::table('category_products')->insert($data);
        Session::put('message', 'Added product categories successfully!');
        return Redirect::to('add-category-product');
    }
    //show category
    public function active_category_product($cate_pro_id) {
        DB::table('category_products')->where('cate_id', $cate_pro_id)->update(['cate_status'=>1]);        
        return Redirect::to('all-category-product');
    } 
    //Hide category
    public function unactive_category_product($cate_pro_id) {
        DB::table('category_products')->where('cate_id', $cate_pro_id)->update(['cate_status'=>0]);        
        return Redirect::to('all-category-product');
    } 


    /**--------------SIZE PRODUCT----------------- **/
    public function all_size_product() {
        $all_size_pro = DB::table('tbl_sizes')->get();
        $manager_size_pro = view('admin/sizeColorProduct/allSize')->with('all_size_pro', $all_size_pro);
        return view('adminLayout')->with('admin/sizeColorProduct/allSize', $manager_size_pro);
    }
    //show
    public function active_size_product($size_pro_id) {
        DB::table('tbl_sizes')->where('size_id', $size_pro_id)->update(['size_status'=>1]);        
        return Redirect::to('all-size-product');
    } 
    //Hide
    public function unactive_size_product($size_pro_id) {
        DB::table('tbl_sizes')->where('size_id', $size_pro_id)->update(['size_status'=>0]);         
        return Redirect::to('all-size-product');
    } 

    /**--------------COLOR PRODUCT----------------- **/
    public function all_color_product() {
        $all_color_pro = DB::table('tbl_colors')->get();
        $manager_color_pro = view('admin/sizeColorProduct/allColor')->with('all_color_pro', $all_color_pro);
        return view('adminLayout')->with('admin/sizeColorProduct/allColor', $manager_color_pro);
    }
    //save category
    public function save_color_product(Request $request) {
        $status = 1;
        if($request->color_product_status == '') {
            $status = 0;
        }

        $data = array();
        $data['color_name'] = $request->color_product_name;        
        $data['color_status'] = $status;

        DB::table('tbl_colors')->insert($data);
        Session::put('message', 'Added color product successfully!');
        return Redirect::to('all-color-product');
    }
    //show
    public function active_color_product($color_pro_id) {
        DB::table('tbl_colors')->where('color_id', $color_pro_id)->update(['color_status'=>1]);        
        return Redirect::to('all-color-product');
    } 
    //Hide
    public function unactive_color_product($color_pro_id) {
        DB::table('tbl_colors')->where('color_id', $color_pro_id)->update(['color_status'=>0]);         
        return Redirect::to('all-color-product');
    } 
    
}
