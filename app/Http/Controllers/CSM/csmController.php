<?php

namespace App\Http\Controllers\CSM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Csm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class csmController extends Controller
{
    public function csmlogin(Request $request){
    
        if ($request->isMethod('post')) {
            $rules = ([
                'email'   => 'required|email',
                'password' => 'required|min:6'
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
                        
                if (Auth::guard('csm')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $csm = Auth::guard('csm')->user();

                    Session::put('csm_id', $csm->id);
                    Session::put('csm_name', $csm->csm_name);
                    return redirect()->route('csm.dashboard');

                }
                return back()->with($request->only('email', 'password'));
            }
        } else {
            return view('CSM.login');
        }
        
    }

    public function dashboard(Request $request){
        $csmid = Auth::guard('csm')->user()->id;

        $data['csm'] = DB::table('csm_venue_master')
        ->join('venue_master','csm_venue_master.venue_id','venue_master.id')
        ->where('csm_master_id',$csmid)
        ->select('venue_master.*')
        ->get();

        $data['title'] = 'CSM Dashboard';
        return view('CSM.dashboard')->with($data);
    }

    public function edit_profile(Request $request,$id)
    {   
        if ($request->isMethod('post')) {
            $update_profile = DB::table('csm_master')
            ->where('id', $id)
            ->update([
                'csm_name' => ucwords(trim($request->full_name)),
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
            $data['title'] = 'CSM Profile';
            
            $data['csm'] = DB::table('csm_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();

            return view('CSM.profile')->with($data);
        }
        
        
    }

    public function change_password(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $csm = DB::table('csm_master')
            ->select('*')
            ->where('id', $id)
            ->first(); //also use doesntExist()
            if (Hash::check($request->old_password, $csm->password))
            {
                $update_pwd = DB::table('csm_master')
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
            $data['csm'] = DB::table('csm_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();
            return view('CSM.changepassword')->with($data);
        }
        
    }


    
    public function logout(){

        Session::forget('csm_id');
        Session::forget('csm_name');
        Auth::guard('csm')->logout();
        return redirect('/csm');

    }
}
