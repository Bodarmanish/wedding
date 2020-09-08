<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Session;

class EventTypeController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        $data['title'] = 'Event Type';
        $data['event_types'] = DB::table('event_type_master')->where('deleted_at', NULL)->orderBy('id', 'desc')->get();

        return view('master.event-type.index')->with($data);
    }

    public function create() {
        $data['title'] = 'Create Event Type';

        return view('master.event-type.create')->with($data);
    }

    public function store(Request $req) {
        $event_type_name = ucwords(trim($req->event_type_name));

        $duplicate = DB::table('event_type_master')->where('event_type', $event_type_name)->where('deleted_at', '=', NULL)->exists();
        //also use doesntExist()
        // dd($check_role);

        if ($duplicate == 'true') {
            return response()->json(['status' => 'duplicate']);
        } else {

            $id = DB::table('event_type_master')->insertGetId([
                'event_type' => $event_type_name,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);

            if ($id) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Facility Charge';
        $data['edit'] = DB::table('event_type_master')->where('id', $id)->where('deleted_at', NULL)->first();

        // echo "<pre>";
        // print_r($data['edit']);
        // return;

        return view('master.event-type.create')->with($data);
    }

    public function update(Request $req) {
        $id = $req->rec_id;
        $event_type_name = ucwords(trim($req->event_type_name));

        $duplicate = DB::table('event_type_master')->where('event_type', $event_type_name)->where('id', '!=', $id)->where('deleted_at', '=', NULL)->exists();
        //also use doesntExist()
        // dd($check_role);

        if ($duplicate == 'true') {
            return response()->json(['status' => 'duplicate']);
        } else {
            $update = DB::table('event_type_master')
                    ->where('id', $id)
                    ->update([
                'event_type' => $event_type_name,
                'updated_by' => Session::get('lgn_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if ($update) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    }

    public function delete(Request $req) {
        $delete = DB::table('event_type_master')
                ->where('id', $req->id)
                ->update([
            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d'),
        ]);

        if ($delete) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

}
