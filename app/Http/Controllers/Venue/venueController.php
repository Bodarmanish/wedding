<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use App\VenueModel;

class venueController extends Controller
{
    public function venuelogin(Request $request){
    
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
                        
                if (Auth::guard('venue')->attempt(['venue_email' => $request->email, 'password' => $request->password])) {
                    $venue = Auth::guard('venue')->user();

                    Session::put('venue_id', $venue->id);
                    Session::put('venue_name', $venue->venue_name);
                    return redirect()->route('venue.dashboard');

                }
                return back()->with($request->only('email', 'password'));
            }
        } else {
            return view('Venue.login');
        }
        
    }

    public function dashboard(Request $request){
        $venueid = Auth::guard('venue')->user()->id;
        $data['venue'] = DB::table('book_venue_master')
        ->join('venue_master','venue_master.id','book_venue_master.vanue_id')
        ->join('leads','leads.id','book_venue_master.customer_id')
        ->join('event_type_master','event_type_master.id','book_venue_master.event_type')
        ->where('book_venue_master.vanue_id',$venueid)
        ->select('book_venue_master.*','leads.customer_name','event_type_master.event_type')
        ->get();

        // echo '<pre>';print_r($bsm);die;
        $data['title'] = 'Venue Dashboard';
        return view('Venue.dashboard')->with($data);
    }

    public function edit_profile(Request $request,$id)
    {   
        if ($request->isMethod('post')) {
            $update_profile = DB::table('venue_master')
            ->where('id', $id)
            ->update([
                'venue_name' => $request->venue_name,
                'venue_mobile' => $request->venue_mobile,
                'venue_address' => $request->venue_address,
                'venue_district' => $request->venue_district,
                'owner_name' => $request->owner_name,
                'owner_email' => $request->owner_email,
                'owner_mobile_1' => $request->owner_mobile,
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
            $data['title'] = 'Venue Profile';
            
            $data['venue'] = DB::table('venue_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();

            return view('Venue.profile')->with($data);
        }
        
        
    }

    public function change_password(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $venue = DB::table('venue_master')
            ->select('*')
            ->where('id', $id)
            ->first(); //also use doesntExist()
            if (Hash::check($request->old_password, $venue->password))
            {
                $update_pwd = DB::table('venue_master')
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
            $data['venue'] = DB::table('venue_master')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();
            return view('Venue.changepassword')->with($data);
        }
        
    }


    
    public function logout(){

        Session::forget('veneu_id');
        Session::forget('venue_name');
        Auth::guard('venue')->logout();
        return redirect('/venue');

    }
}
