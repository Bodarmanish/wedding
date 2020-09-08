<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use App\VendorModel;

class vendorController extends Controller
{
    public function vendorlogin(Request $request){
    
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
                        
                if (Auth::guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $venue = Auth::guard('vendor')->user();

                    Session::put('vendor_id', $venue->id);
                    Session::put('vendor_name', $venue->venue_name);
                    return redirect()->route('vendor.dashboard');

                }
                return back()->with($request->only('email', 'password'));
            }
        } else {
            return view('Vendor.login');
        }
        
    }

    public function dashboard(Request $request){
        $venueid = Auth::guard('vendor')->user()->id;
        $data['venue'] = DB::table('book_venue_master')
        ->join('venue_master','venue_master.id','book_venue_master.vanue_id')
        ->join('leads','leads.id','book_venue_master.customer_id')
        ->join('event_type_master','event_type_master.id','book_venue_master.event_type')
        ->where('book_venue_master.vanue_id',$venueid)
        ->select('book_venue_master.*','leads.customer_name','event_type_master.event_type')
        ->get();

        $data['title'] = 'Vendor Dashboard';
        return view('Vendor.dashboard')->with($data);
    }

    public function edit_profile(Request $request,$id)
    {   
        if ($request->isMethod('post')) {
            $update_profile = DB::table('vendors')
            ->where('id', $id)
            ->update([
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'business_name' => $request->business_name,
                'address' => $request->address,
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
            $data['title'] = 'Vendor Profile';
            
            $data['vendor'] = DB::table('vendors')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();

            return view('Vendor.profile')->with($data);
        }
        
        
    }

    public function change_password(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $vendor = DB::table('vendors')
            ->select('*')
            ->where('id', $id)
            ->first();
            if (Hash::check($request->old_password, $vendor->password))
            {
                $update_pwd = DB::table('vendors')
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
            $data['vendor'] = DB::table('vendors')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();
            return view('Vendor.changepassword')->with($data);
        }
        
    }


    
    public function logout(){

        Session::forget('vendor_id');
        Session::forget('vendor_name');
        Auth::guard('vendor')->logout();
        return redirect('/vendor');

    }
}
