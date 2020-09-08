<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;


class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.adminLogin');
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5(trim($request->password));

        // DB::enableQueryLog(); // Enable query log
        $usr = DB::table('admins')
        ->where('email', '=', $request->email)
        ->where('password', '=', $password )
        ->where('deleted_at','=', NULL)
        ->first();
        // dd(DB::getQueryLog()); // Show results of log
        if ($usr != '')
        {
        	Session::put('lgn_id', $usr->id);
        	Session::put('role_id', $usr->role_id);
        	Session::put('name', $usr->name);

        	return response()->json(['status' => 'success']);
        }
        else
        {

        	return response()->json(['status' => 'error']);
        }
    }


    public function logout()
    {
        Session::forget('lgn_id');
        Session::forget('role_id');
        Session::forget('name');
        return redirect('/admin');
    }
}
