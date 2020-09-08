<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;

class FollowUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Follow Up';
        $data['follow_ups'] = DB::table('follow_up_master as fu')
        ->leftJoin('leads as le','le.id','=','fu.customer_id')
        ->leftJoin('presentation_status_master as ps','ps.id','=','fu.presentation_status_id')
        ->where('fu.deleted_at',NULL)
        ->orderBy('fu.id','desc')
        ->select('fu.*','le.customer_name','ps.presentation_status')
        ->get();

        return view('lead.follow-up.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Follow Up';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['presentation_status'] = DB::table('presentation_status_master')->where('deleted_at',NULL)->get();

        return view('lead.follow-up.create')->with($data);
    }

    public function store(Request $req)
    {
        $customer = trim($req->customer);
        $presentation_status = trim($req->presentation_status);

        $duplicate = DB::table('follow_up_master')->where('customer_id', $customer)->where('presentation_status_id', $presentation_status)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {

            $id = DB::table('follow_up_master')->insertGetId([
                'customer_id' => $customer,
                'presentation_status_id' => $presentation_status,
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
        $data['title'] = 'Edit Follow Up';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['presentation_status'] = DB::table('presentation_status_master')->where('deleted_at',NULL)->get();
        $data['edit'] = DB::table('follow_up_master')->where('id',$id)->where('deleted_at',NULL)->first();

        // echo "<pre>";
        // print_r($data['edit']);
        // return;

        return view('lead.follow-up.create')->with($data);
    }

    public function update(Request $req)
    {
        $id = $req->rec_id;
        $customer = trim($req->customer);
        $presentation_status = trim($req->presentation_status);

        $duplicate = DB::table('follow_up_master')->where('customer_id', $customer)->where('id','!=',$id)->where('presentation_status_id', $presentation_status)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()


        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
            $update = DB::table('follow_up_master')
            ->where('id', $id)
            ->update([
                'customer_id' => $customer,
                'presentation_status_id' => $presentation_status,
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
        $delete = DB::table('follow_up_master')
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
