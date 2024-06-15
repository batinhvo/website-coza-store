<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
session_start();

class HomeController extends Controller
{
    // home ----------------------------------------------------------------
    public function index() {

        $cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_pro = DB::table('tbl_products')
                    ->join('category_products', 'tbl_products.cate_id', '=', 'category_products.cate_id')      
                    ->where('pro_status', 1)
                    ->get();     
                        
        $cate_show = view('pages/home')->with('cate_show', $cate_pro)->with('pro_show', $all_pro);

        return view('layout')->with('pages/home', $cate_show);
    }

    // product ----------------------------------------------------------------
    public function products() {

        $cate_pro = DB::table('category_products')->where('cate_status', 1)->get();
        $all_pro = DB::table('tbl_products')
                    ->join('category_products', 'tbl_products.cate_id', '=', 'category_products.cate_id')      
                    ->where('pro_status', 1)
                    ->get();     
                        
        $cate_show = view('pages/product')->with('cate_show', $cate_pro)->with('pro_show', $all_pro);

        return view('layout')->with('pages/product', $cate_show);
    }

    // product detail -------------------------------------------------------
    public function product_details() {
        return view('layout')->with('pages/productDetails');
    } 

    // about ----------------------------------------------------------------
    public function about() {
        return view('pages/about');
    }

    // contact ----------------------------------------------------------------
    public function contact() {
        return view('pages/contact');
    }

    // blog ----------------------------------------------------------------
    public function blog() {
        return view('pages/blog');
    }
}
