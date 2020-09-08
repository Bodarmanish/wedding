<?php

namespace App\Http\Controllers\Admin\VenueBooking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Session;

class CalendarController extends Controller
{

    // public function __construct()
    // {
    //     $venue_bookings = DB::table('book_venue_master')->where('deleted_at',NULL)->get();

    //     return response()->JSON($venue_bookings);
    // }

    public function index()
    {

        $title = 'Booking Calendar';        

        $tasks = DB::table('book_venue_master as bvm')
        ->leftJoin('leads as le','le.id','=','bvm.customer_id')
        ->leftJoin('venue_type_master as vtm','vtm.id','=','bvm.venue_type')
        ->where('bvm.deleted_at',NULL)
        ->select('bvm.*','le.customer_name','vtm.venue_type as venue_type_name')
        ->get();

        return view('venue-booking.calendar.index', compact('title','tasks'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['all_veenue_booking'] = DB::table('')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
