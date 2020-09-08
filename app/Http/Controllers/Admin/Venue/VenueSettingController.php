<?php

namespace App\Http\Controllers\Admin\Venue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Helper;
use App\FacilityChargesModel;
use App\VenuePackageChildModel;
use App\VenuePackagesModel;
use DB;
use Session;

class VenueSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function list()
    {
        $data['title'] = 'Venue Settings';
        $data['packages'] = DB::table('venue_packages as vp')
        ->leftJoin('venue_type_master as vtm','vtm.id','=','vp.venue_type')
        ->where('vp.deleted_at',NULL)
        ->select('vp.*','vtm.venue_type as venue_type_name')
        ->get();

        return view('venue-settings.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Package';
        $data['venue_type'] = DB::table('venue_type_master')
        ->where('deleted_at', NULL)
        ->get();
        $data['facilities'] = FacilityChargesModel::where('deleted_at',NULL)->get();

        // echo "<pre>";
        // dd($data['facilities']);

        return view('venue-settings.package')->with($data);
    }

    public function store(Request $req)
    {
        $package_name = ucwords(trim($req->package_name));
        $venue_type = $req->venue_type;
        $price = $req->price;
        $gst = $req->gst;
        $total = $req->total;
        $timing_from = trim($req->timing_from);
        $timing_to = trim($req->timing_to);

        $facility = $req->facility;
        $facility_quantity = $req->facility_quantity;
        $facility_price = $req->facility_price;
        $facility_gst = $req->facility_gst;
        $facility_total = $req->facility_total;

        $grand_total = $req->grand_total;
        // return;

        $master_id = DB::table('venue_packages')->insertGetId([
            'package_name' => $package_name,
            'venue_type' => $venue_type,
            'price' => $price,
            'gst' => $gst,
            'total' => $total,
            'timing_from' => $timing_from,
            'timing_to' => $timing_to,
            'grand_total' => $grand_total,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Session::get('lgn_id')
        ]);

        if($master_id != '') {

            foreach ($facility as $key => $value) {
                // 'subcategory_id',$subcategory_id[$key]
                $vpc = new VenuePackageChildModel();        
                $vpc->package_master_id = $master_id;  
                $vpc->facility_id = $value;  
                $vpc->quantity = $facility_quantity[$key];  
                $vpc->price = $facility_price[$key];  
                $vpc->gst = $facility_gst[$key];  
                $vpc->total = $facility_total[$key];  
                $vpc->created_at = date('Y-m-d H:i:s');  
                $vpc->created_by = Session::get('lgn_id');
                $vpc->save();
            }

            return response()->json(['status'=>'success']);
        } else {
            return response()->json(['status'=>'error']);
        }

    }

    public function get_facility_price(Request $req)
    {
        $facility_id = $req->id;

        $price = DB::table('facility_charges')
        ->where('id',$facility_id)
        ->where('deleted_at',NULL)
        ->first();

        // echo $price->price;
        // return;
        
        return response()->json(['price' => $price->price]);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Package';
        $data['master'] = VenuePackagesModel::where('id',$id)->where('deleted_at',NULL)->first();
        $data['child'] = VenuePackageChildModel::where('package_master_id',$id)->where('deleted_at',NULL)->get();
        $data['venue_type'] = DB::table('venue_type_master')
        ->where('deleted_at', NULL)
        ->get();
        $data['facilities'] = FacilityChargesModel::where('deleted_at',NULL)->get();
        // echo "<pre>";
        // print_r($data['child']);
        // return;
        return view('venue-settings.edit-package')->with($data);
    }

    public function update(Request $req)
    {
        $rec_id = $req->rec_id;
        $package_name = ucwords(trim($req->package_name));
        $venue_type = $req->venue_type;
        $price = $req->price;
        $gst = $req->gst;
        $total = $req->total;
        $timing_from = $req->timing_from;
        $timing_to = $req->timing_to;

        $master_id = $req->master_id;
        $child__id = $req->child__id;
        $facility = $req->facility;
        $facility_quantity = $req->facility_quantity;
        $facility_price = $req->facility_price;
        $facility_gst = $req->facility_gst;
        $facility_total = $req->facility_total;

        $grand_total = $req->grand_total;
        // return;

        DB::table('venue_packages')
        ->where('id', $rec_id)
        ->update([
            'package_name' => $package_name,
            'venue_type' => $venue_type,
            'price' => $price,
            'gst' => $gst,
            'total' => $total,
            'timing_from' => $timing_from,
            'timing_to' => $timing_to,
            'grand_total' => $grand_total,
            'updated_by' => Session::get('lgn_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        foreach ($facility as $key => $value) {
            if($child__id[$key] != '') {
                DB::table('venue_package_child')
                ->where('id', $child__id[$key])
                ->update([
                    'facility_id' => $value,
                    'quantity' => $facility_quantity[$key],
                    'price' => $facility_price[$key],
                    'gst' => $facility_gst[$key],
                    'total' => $facility_total[$key],
                    'updated_by' => Session::get('lgn_id'),
                ]);
            } else {
                $vpc = new VenuePackageChildModel();        
                $vpc->package_master_id = $master_id;  
                $vpc->facility_id = $value;  
                $vpc->quantity = $facility_quantity[$key];  
                $vpc->price = $facility_price[$key];  
                $vpc->gst = $facility_gst[$key];  
                $vpc->total = $facility_total[$key];  
                $vpc->created_at = date('Y-m-d H:i:s');  
                $vpc->created_by = Session::get('lgn_id');
                $vpc->save();
            }
        }

        return response()->json(['status'=>'success']);

    }

    public function child_data_delete(Request $req)
    {
        $id = $req->id;
        
        DB::table('venue_package_child')
        ->where('id', $id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $req) {
        $package_id = $req->package_id;

        DB::table('venue_packages')
        ->where('id', $package_id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        DB::table('venue_package_child')
        ->where('package_master_id', $package_id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        return response()->json(['status' => 'success']);
        
    }
}
