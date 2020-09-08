<?php

namespace App\Http\Controllers\BSM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Bsm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class bsmController extends Controller
{
   
    public function bsmlogin(Request $request){
    
        if ($request->isMethod('post')) {
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
                        
                if (Auth::guard('bsm')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $bsm = Auth::guard('bsm')->user();

                    Session::put('bsm_id', $bsm->id);
                    Session::put('name', $bsm->bsm_name);
                    return redirect()->route('bsm.dashboard');

                }
                return back()->with($request->only('email', 'password'));
            }
        } else {
            return view('BSM.login');
        }
        
    }

    public function dashboard(Request $request){
        $bsmid = Auth::guard('bsm')->user()->id;
        $data['bsm'] = DB::table('bsm_csm_master')
        ->join('csm_master','bsm_csm_master.csm_id','csm_master.id')
        ->where('bsm_master_id',$bsmid)
        ->select('csm_master.*')
        ->get();

        // echo '<pre>';print_r($bsm);die;
        $data['title'] = 'BSM Dashboard';
        return view('BSM.dashboard')->with($data);
    }

    public function edit_profile(Request $request,$id)
    {   
        if ($request->isMethod('post')) {
            $update_profile = DB::table('bsm_master')
            ->where('id', $id)
            ->update([
                'bsm_name' => ucwords(trim($request->full_name)),
                'mobile' => trim($request->mobile),
                'updated_by' => $id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if($update_profile)
            { 
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        } else {
            $data['title'] = 'BSM Profile';
            
            $data['bsm'] = DB::table('bsm_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();

            return view('BSM.profile')->with($data);
        }
        
        
    }

    public function change_password(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $bsm = DB::table('bsm_master')
            ->select('*')
            ->where('id', $id)
            ->first(); //also use doesntExist()
            if (Hash::check($request->old_password, $bsm->password))
            {
                $update_pwd = DB::table('bsm_master')
                ->where('id', $id)
                ->update([
                    'password' => Hash::make($request->password),
                    'updated_by' => $id,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                if($update_pwd)
                { 
                    return response()->json(['status' => 'success']);
                }
                else
                {
                    return response()->json(['status' => 'error']);
                }
            } 
            else 
            {
                return response()->json(['status' => 'exist']);
            }
        } else {

            $data['title'] = 'Change Password';
            $data['bsm'] = DB::table('bsm_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();
            return view('BSM.changepassword')->with($data);
        }
        
    }


    
    public function logout(){

        Session::forget('bsm_id');
        Session::forget('name');
        Auth::guard('bsm')->logout();
        return redirect('/bsm');

    }
    
}
