<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
use DB;
session_start();

class AdminController extends Controller
{
    //log-in
    public function index() {
        return view('admin_login');
    }
    //log-out
    public function logout() {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    // ------------------------------DASHBOARD---------------------------------- //
    public function show_dashboard() {
        return view('admin/dashboard');
    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_pass = $request->admin_password;
                
        $result = DB::table('user_admins')->where('username', $admin_email)->where('password', $admin_pass)->first();

        if($result) {
            Session::put('admin_name', $result->name);
            Session::put('admin_id', $result->id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'username or password incorrect<br> Please re-enter!');
            return Redirect::to('admin');
        }
    }

    
}
