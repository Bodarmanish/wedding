<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\LeadModel;
use App\LeadQuatationModel;
use Session;
use DB;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Quatations';
        $data['quatations'] = DB::table('lead_quatation as qu')
        ->leftJoin('leads as le','le.id','=','qu.customer_id')
        ->where('qu.deleted_at',NULL)
        ->orderBy('qu.id','desc')
        ->select('qu.*','le.customer_name')
        ->get();

        return view('lead.quatation.index')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Create Quatation';
        $data['customers'] = LeadModel::where('deleted_at',NULL)->get();

        return view('lead.quatation.create')->with($data);
    }

    public function store(Request $request)
    {
        $customer_id = $request->customer_name;
        $quatation = $request->quatation;
        $amount = $request->amount;

        // print_r($quatation);
        // return;
        $qua_id = DB::table('lead_quatation')->insertGetId(
            [
                'customer_id' => $customer_id,
                'amount' => $amount,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]
        );


        if ($request->hasFile('quatation')) {
            $file = $request->file('quatation');
            $file_name = $qua_id . '.' . $file->getClientOriginalExtension();
            $destinationpath = 'assets/uploads/lead_quatation/';
            $file->move($destinationpath, $file_name);
            $file_path = $destinationpath . $file_name;
            $upd_data = new LeadQuatationModel();
            $upd_data = $upd_data->findOrFail($qua_id);
            $upd_data->quatation = $file_path;
            $upd_data->save();
        }

        if ($qua_id) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }

    }

    public function show($id) {
        $data['title'] = 'Show Quatation';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['edit'] = DB::table('lead_quatation')->where('id',$id)->where('deleted_at',NULL)->first();


        return view('lead.quatation.show')->with($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Quatation';
        $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
        $data['edit'] = DB::table('lead_quatation')->where('id',$id)->where('deleted_at',NULL)->first();


        return view('lead.quatation.create')->with($data);
    }

    public function update(Request $request)
    {
        $id = $request->rec_id;
        $customer_id = $request->customer_name;
        $quatation = $request->quatation;
        $amount = $request->amount;

        $update = DB::table('lead_quatation')
        ->where('id', $id)
        ->update([
            'customer_id' => $customer_id,
            'amount' => $amount,
            'updated_by' => Session::get('lgn_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($request->hasFile('quatation')) {
            $file = $request->file('quatation');
            $file_name = $id . '.' . $file->getClientOriginalExtension();
            $destinationpath = 'assets/uploads/lead_quatation/';
            $file->move($destinationpath, $file_name);
            $file_path = $destinationpath . $file_name;

            $upd_data = new LeadQuatationModel();
            $upd_data = $upd_data->findOrFail($id);
            $upd_data->quatation = $file_path;
            $upd_data->save();
        }

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
        $delete = DB::table('lead_quatation')
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
