<?php

namespace App\Http\Controllers\Admin\VenueBooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;

class DiscountController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Discount';
        $data['discounts'] = DB::table('discount_master as dm')
        ->leftJoin('venue_type_master as vt','vt.id','=','dm.venue_type')
        ->where('dm.deleted_at',NULL)
        ->where('vt.deleted_at',NULL)
        ->orderBy('dm.id','desc')
        ->select('dm.*','vt.venue_type as venue_type_name')
        ->get();

        return view('venue-booking.discount.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Discount';
        $data['venue_types'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();

        return view('venue-booking.discount.create')->with($data);
    }

    public function store(Request $req)
    {
        $date1 = strtr($req->from_date, '/', '-');
        $from_date =  date('Y-m-d', strtotime($date1));
        $date2 = strtr($req->to_date, '/', '-');
        $to_date =  date('Y-m-d', strtotime($date2));

        $discount_type = $req->discount_type;
        $discount_in_percentage = $req->discount_in_percentage;
        $discount_in_amount = $req->discount_in_amount;
        $venue_discount_in_amount = $req->venue_discount_in_amount;
        $venue_type = $req->venue_type;


        $id = DB::table('discount_master')->insertGetId([
            'from_date' => $from_date,
            'to_date' => $to_date,
            'discount_type' => $discount_type,
            'discount_in_percentage' => $discount_in_percentage,
            'discount_in_amount' => $discount_in_amount,
            'venue_discount_in_amount' => $venue_discount_in_amount,
            'venue_type' => $venue_type,
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

    public function edit($id)
    {
        $data['title'] = 'Edit Discount';
        $data['edit'] = DB::table('discount_master')->where('id',$id)->where('deleted_at',NULL)->first();
        $data['venue_types'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();

        // echo "<pre>";
        // print_r($data['edit']);
        // return;

        return view('venue-booking.discount.create')->with($data);
    }

    public function update(Request $req)
    {
        $id = $req->rec_id;
        $date1 = strtr($req->from_date, '/', '-');
        $from_date =  date('Y-m-d', strtotime($date1));
        $date2 = strtr($req->to_date, '/', '-');
        $to_date =  date('Y-m-d', strtotime($date2));

        $discount_type = $req->discount_type;
        $discount_in_percentage = $req->discount_in_percentage;
        $discount_in_amount = $req->discount_in_amount;
        $venue_discount_in_amount = $req->venue_discount_in_amount;
        $venue_type = $req->venue_type;

        if($discount_type == '1') {
            $venue_discount_in_amount = '0.00';
            $venue_type = '0';
        } else {
            $discount_in_percentage = '0.00';
            $discount_in_amount = '0.00';
        }


        // dd($discount_in_percentage);

        $update = DB::table('discount_master')
        ->where('id', $id)
        ->update([
            'from_date' => $from_date,
            'to_date' => $to_date,
            'discount_type' => $discount_type,
            'discount_in_percentage' => $discount_in_percentage,
            'discount_in_amount' => $discount_in_amount,
            'venue_discount_in_amount' => $venue_discount_in_amount,
            'venue_type' => $venue_type,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        $delete = DB::table('discount_master')
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
