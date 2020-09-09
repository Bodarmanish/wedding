<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;
use Auth;
use App\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.adminLogin');
    }
    public function login(Request $request)
    {

        $rules = ([
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        $message = ([
            "email.required" => "Please Enter Email",
            "password.required" => "Please Enter Password ",
        ]);

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages);
        } else {
                    
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $admin = Auth::guard('admin')->user();

                Session::put('lgn_id', $admin->id);
                Session::put('role_id', $admin->role_id);
                Session::put('name', $admin->name);
                
                return redirect()->route('admin.dashboard');

            }
            return response()->json(['status' => 'error']);
        }
        
    }


    public function logout()
    {
        
        Session::forget('lgn_id');
        Session::forget('role_id');
        Session::forget('name');
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
