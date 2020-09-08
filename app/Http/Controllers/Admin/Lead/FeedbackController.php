<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Feedback';
        $data['feedbacks'] = DB::table('feedback_master as fm')
        ->leftJoin('leads as le','le.id','=','fm.customer_id')
        ->where('fm.deleted_at',NULL)
        ->orderBy('fm.id','desc')
        ->select('fm.*','le.customer_name')
        ->get();

        return view('lead.feedback.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Feedback';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();

        return view('lead.feedback.create')->with($data);
    }

    public function store(Request $req)
    {
        $customer = $req->customer;
        $feedback = trim($req->feedback);

        $duplicate = DB::table('feedback_master')->where('customer_id', $customer)->where('feedback',$feedback)->where('deleted_at', '=', NULL)->exists(); 
        //also use doesntExist()

        // dd($check_role);

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {

            $id = DB::table('feedback_master')->insertGetId([
                'customer_id' => $customer,
                'feedback' => $feedback,
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
     $data['title'] = 'Edit Facility Charge';
     $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
     $data['edit'] = DB::table('feedback_master')->where('id',$id)->where('deleted_at',NULL)->first();


     return view('lead.feedback.create')->with($data);
 }

 public function update(Request $req)
 {
    $id = $req->rec_id;
    $customer = $req->customer;
    $feedback = trim($req->feedback);

    $duplicate = DB::table('feedback_master')->where('customer_id', $customer)->where('feedback',$feedback)->where('id','!=',$id)->where('deleted_at', '=', NULL)->exists(); 


    if ($duplicate == 'true') 
    {
        return response()->json(['status' => 'duplicate']);
    } 
    else 
    {

        $update = DB::table('feedback_master')
        ->where('id', $id)
        ->update([
            'customer_id' => $customer,
            'feedback' => $feedback,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        $delete = DB::table('feedback_master')
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
