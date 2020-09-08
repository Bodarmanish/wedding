<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;

class PresentationStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Presentation Status';
        $data['presentation_status'] = DB::table('presentation_status_master')->where('deleted_at',NULL)->orderBy('id','desc')->get();

        return view('master.presentation-status.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Presentation Status';

        return view('master.presentation-status.create')->with($data);
    }

    public function store(Request $req)
    {
        $presentation_status_name = ucwords(trim($req->presentation_status_name));

        $duplicate = DB::table('presentation_status_master')->where('presentation_status', $presentation_status_name)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {

            $id = DB::table('presentation_status_master')->insertGetId([
                'presentation_status' => $presentation_status_name,
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

    public function edit($id)
    {
        $data['title'] = 'Edit Presentation Status';
        $data['edit'] = DB::table('presentation_status_master')->where('id',$id)->where('deleted_at',NULL)->first();

        // echo "<pre>";
        // print_r($data['edit']);
        // return;

        return view('master.presentation-status.create')->with($data);
    }

    public function update(Request $req)
    {
        $id = $req->rec_id;
        $presentation_status_name = ucwords(trim($req->presentation_status_name));

        $duplicate = DB::table('presentation_status_master')->where('presentation_status', $presentation_status_name)->where('id','!=',$id)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
            $update = DB::table('presentation_status_master')
            ->where('id', $id)
            ->update([
                'presentation_status' => $presentation_status_name,
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

    public function delete(Request $req)
    {
        $delete = DB::table('presentation_status_master')
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
