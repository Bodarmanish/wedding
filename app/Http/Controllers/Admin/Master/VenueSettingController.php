<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\FacilityChargesModel;
use DB;
use Session;

class VenueSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function facility_charges()
    {
        $data['title'] = 'Facility Charges';
        $data['all_facility'] = FacilityChargesModel::where('deleted_at',NULL)->orderBy('id','DESC')->get();

        return view('master.venue-settings.facility-charges')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_facility_charges()
    {
        $data['title'] = 'Create Facility Charges';

        return view('master.venue-settings.create-facility-charges')->with($data);
    }

    public function store_facility_charges(Request $req)
    {
        $facility_name = ucwords(trim($req->facility_name));
        $price = trim($req->price);
        $complementory = $req->complementory;

        $check_facility = FacilityChargesModel::where('facility_name', $facility_name)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($check_facility == 'true') 
        {
            return response()->json(['status' => 'facility_exist']);
        } 
        else 
        {

            $role = new FacilityChargesModel();

            $role->facility_name = $facility_name;
            $role->price = $price;
            $role->complementory = $complementory;
            $role->created_by = Session::get('lgn_id');
            $role->created_at = date('Y-m-d H:i:s');
            $role->save();

            if($role)
            {
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        }

    }

    public function edit_facility_charges($id)
    {
        $data['title'] = 'Edit Facility Charge';
        $data['edit'] = FacilityChargesModel::where('id',$id)->where('deleted_at',NULL)->first();

        // echo "<pre>";
        // dd($data['edit']);

        return view('master.venue-settings.create-facility-charges')->with($data);
    }

    public function update_facility_charges(Request $req)
    {
        $facility_id = $req->facility_id;
        $facility_name = ucwords(trim($req->facility_name));
        $price = trim($req->price);
        $complementory = $req->complementory;

        $check_facility = FacilityChargesModel::where('facility_name', $facility_name)->where('id','!=',$facility_id)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($check_facility == 'true') 
        {
            return response()->json(['status' => 'facility_exist']);
        } 
        else 
        {
            $update = DB::table('facility_charges')
            ->where('id', $facility_id)
            ->update([
                'facility_name' => $facility_name,
                'price' => $price,
                'complementory' => $complementory,
                'updated_by' => Session::get('lgn_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if($update)
            { 
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        }
    }

    public function delete_facility_charges(Request $req)
    {
        $delete = DB::table('facility_charges')
        ->where('id', $req->facility_id)
        ->update([
            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d'),
        ]);

        if($delete)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    public function venue_type_and_charges() {
        $data['title'] = 'Venue Type & Charges';
        $data['all_rec'] = DB::table('venue_type_and_charges as vtc')
        // ->leftJoin('venue_type_master as vtm','vtm.id','=','vtc.venue_type')
        ->where('vtc.deleted_at',NULL)
        // ->where('vtm.deleted_at',NULL)
        ->orderBy('vtc.id','DESC')
        ->select('vtc.*')
        ->get();



        return view('master.venue-settings.venue-type-and-charges')->with($data);
    }

    public function create_venue_type_and_charges() {
        $data['title'] = 'Create Venue Type & Charges';
        $data['venue_type'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();

        return view('master.venue-settings.create-venue-type-and-charges')->with($data);
    }

    public function save_venue_type_and_charges(Request $req) {
        $venue_type = $req->venue_type;
        $price_per_plate_or_rent = $req->price_per_plate_or_rent;

        $venue_type_arr = implode(",", $venue_type);


        // echo "<pre>";
        // print_r($venue_type_arr);
        // return;


        // $duplicate = DB::table('venue_type_and_charges')->where('venue_type', $venue_type)->where('price_per_plate_or_rent',$price_per_plate_or_rent)->where('deleted_at', '=', NULL)->exists(); 
        $duplicate = 'false';
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {

            $id = DB::table('venue_type_and_charges')->insertGetId([
                'venue_type' => $venue_type_arr,
                'price_per_plate_or_rent' => $price_per_plate_or_rent,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);

            if($id)
            {
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        }

    }

    public function edit_venue_type_and_charges($id) {

        $data['title'] = 'Edit Facility Charge';
        $data['venue_type'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();
        $data['edit'] = DB::table('venue_type_and_charges')->where('id',$id)->where('deleted_at',NULL)->first();

        // echo "<pre>";
        // print_r($data['edit']);
        // return;

        return view('master.venue-settings.create-venue-type-and-charges')->with($data);

    }

    public function update_venue_type_and_charges(Request $req) {
        $id = $req->rec_id;
        $venue_type = $req->venue_type;
        $price_per_plate_or_rent = $req->price_per_plate_or_rent;

        $duplicate = DB::table('venue_type_and_charges')->where('venue_type', $venue_type)->where('price_per_plate_or_rent',$price_per_plate_or_rent)->where('id', '!=', $id)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
            $update = DB::table('venue_type_and_charges')
            ->where('id', $id)
            ->update([
                'venue_type' => $venue_type,
                'price_per_plate_or_rent' => $price_per_plate_or_rent,
                'updated_by' => Session::get('lgn_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if($update)
            { 
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        }
    }

    public function delete_venue_type_and_charges(Request $req) {
        $delete = DB::table('venue_type_and_charges')
        ->where('id', $req->id)
        ->update([
            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d'),
        ]);

        if($delete)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

}
