<?php

namespace App\Http\Controllers\Admin\VenueBooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\FacilityChargesModel;
use App\BookVenueMasterModel;
use App\BookVenueChildModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\VenueBook;
use DB;
use Session;

class VenueBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Venue Booking';
        $data['all_bookings'] = DB::table('book_venue_master as bvm')
        ->leftJoin('leads as le','le.id','=','bvm.customer_id')
        ->leftJoin('event_type_master as etm','etm.id','=','bvm.event_type')
        ->leftJoin('venue_type_master as vtm','vtm.id','=','bvm.venue_type')
        ->where('bvm.deleted_at',NULL)
        ->select('bvm.*','le.customer_name','etm.event_type as event_type_name','vtm.venue_type as venue_type_name')
        ->get();

        // echo "<pre>";
        // print_r($data['all_booking']);
        // return;

        return view('venue-booking.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Venue Booking';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['event_types'] = DB::table('event_type_master')->where('deleted_at',NULL)->get();
        $data['venue_types'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();
        $data['venue_master'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
        $data['facilities'] = FacilityChargesModel::where('deleted_at',NULL)->get();

        return view('venue-booking.create')->with($data);
    }

    public function store(Request $req)
    {
        $customer = $req->customer;
        // $event_date = date('Y-m-d',strtotime($req->event_date));
        $from_date = strtr($req->event_from_date, '/', '-');
        $event_from_date =  date('Y-m-d', strtotime($from_date));
        $to_date = strtr($req->event_to_date, '/', '-');
        $event_to_date =  date('Y-m-d', strtotime($to_date));
        $event_type = $req->event_type;
        $venue_type = $req->venue_type;

        $booking_amount_paid = $req->booking_amount_paid;
        // echo 'amount'.$amount_paid_date = date('Y-m-d',strtotime($req->amount_paid_date));
        $date2 = strtr($req->amount_paid_date, '/', '-');
        $amount_paid_date =  date('Y-m-d', strtotime($date2));
        $about_venue = $req->about_venue;

        $facility = $req->facility;
        $facility_quantity = $req->facility_quantity;
        $facility_price = $req->facility_price;
        $facility_gst = $req->facility_gst;
        $facility_total = $req->facility_total;

        // return;


        $master_id = DB::table('book_venue_master')->insertGetId([
            'customer_id' => $customer,
            'event_from_date' => $event_from_date,
            'event_to_date' => $event_to_date,
            'event_type' => $event_type,
            'venue_type' => $venue_type,
            'vanue_id' => $req->venue,
            'booking_amount_paid' => $booking_amount_paid,
            'amount_paid_date' => $amount_paid_date,
            'abount_venue' => $about_venue,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Session::get('lgn_id')
        ]);

        $customer_details = DB::table('leads')->where('id',$customer)->where('deleted_at',NULL)->first();

        $user_data = array(
            'customer_name' => $customer_details->customer_name,
        );
        Mail::to($customer_details->email)->send(new VenueBook($user_data));


        if($master_id != '') {

            foreach ($facility as $key => $value) {
                // 'subcategory_id',$subcategory_id[$key]
                $bvc = new BookVenueChildModel();        
                $bvc->booking_master_id = $master_id;  
                $bvc->facility_id = $value;  
                $bvc->quantity = $facility_quantity[$key];  
                $bvc->price = $facility_price[$key];  
                $bvc->gst = $facility_gst[$key];  
                $bvc->total = $facility_total[$key];  
                $bvc->created_at = date('Y-m-d H:i:s');  
                $bvc->created_by = Session::get('lgn_id');
                $bvc->save();
            }

            return response()->json(['status'=>'success']);
        } else {
            return response()->json(['status'=>'error']);
        }

    }

    public function edit($id)
    {
        $data['title'] = 'Edit Booking';
        $data['master'] = BookVenueMasterModel::where('id',$id)->where('deleted_at',NULL)->first();
        $data['child'] = BookVenueChildModel::where('booking_master_id',$id)->where('deleted_at',NULL)->get();
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['event_types'] = DB::table('event_type_master')->where('deleted_at',NULL)->get();
        $data['venue_types'] = DB::table('venue_type_master')->where('deleted_at',NULL)->get();
        $data['venue_master'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
        $data['facilities'] = FacilityChargesModel::where('deleted_at',NULL)->get();
        // echo "<pre>";
        // print_r($data['master']);
        // return;
        return view('venue-booking.edit')->with($data);
    }

    public function delete_child_date(Request $req) {
        $id = $req->id;
        
        DB::table('book_venue_child')
        ->where('id', $id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function update(Request $req)
    {
        $rec_id = $req->rec_id;
        $customer = $req->customer;
        // $event_date = date('Y-m-d',strtotime($req->event_date));
        $date1 = strtr($req->event_date, '/', '-');
        $event_date =  date('Y-m-d', strtotime($date1));
        $event_type = $req->event_type;
        $venue_type = $req->venue_type;

        $booking_amount_paid = $req->booking_amount_paid;
        // echo 'amount'.$amount_paid_date = date('Y-m-d',strtotime($req->amount_paid_date));
        $date2 = strtr($req->amount_paid_date, '/', '-');
        $amount_paid_date =  date('Y-m-d', strtotime($date2));
        $about_venue = $req->about_venue;

        $master_id = $req->master_id;
        $child__id = $req->child__id;
        $facility = $req->facility;
        $event_from_date =  date('Y-m-d', strtotime($req->event_from_date));
        $to_date = date('Y-m-d', strtotime($req->event_to_date));
        $facility_quantity = $req->facility_quantity;
        $facility_price = $req->facility_price;
        $facility_gst = $req->facility_gst;
        $facility_total = $req->facility_total;

        DB::table('book_venue_master')
        ->where('id', $rec_id)
        ->update([
            'customer_id' => $customer,
            'event_from_date' => $event_from_date,
            'event_to_date' => $to_date,
            'event_type' => $event_type,
            'vanue_id' => $req->venue,
            'venue_type' => $venue_type,
            'booking_amount_paid' => $booking_amount_paid,
            'amount_paid_date' => $amount_paid_date,
            'abount_venue' => $about_venue,
            'updated_by' => Session::get('lgn_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        foreach ($facility as $key => $value) {
            if($child__id[$key] != '') {
                DB::table('book_venue_child')
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
                $vpc = new BookVenueChildModel();        
                $vpc->booking_master_id = $master_id;  
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

    public function delete(Request $req)
    {
        $booking_id = $req->id;

        DB::table('book_venue_master')
        ->where('id', $booking_id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        DB::table('book_venue_child')
        ->where('booking_master_id', $booking_id)
        ->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => Session::get('lgn_id'),
        ]);

        return response()->json(['status' => 'success']);
    }
}
