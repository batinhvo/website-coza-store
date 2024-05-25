<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index() {
        return view('admin_login');
    }

    public function show_dashboard() {
        return view('dashboard/dashboard');
    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_pass = $request->admin_password;
        
        $result = DB::table('user_admins')->where('username', $admin_email)->where('password', $admin_pass)->first();

        return view('dashboard/dashboard');
    }
}
