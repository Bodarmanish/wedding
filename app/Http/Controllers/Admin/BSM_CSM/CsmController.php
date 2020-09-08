<?php

namespace App\Http\Controllers\Admin\BSM_CSM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;

class CsmController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        $data['title'] = 'CSM';
        $data['all_csm'] = DB::table('csm_master as cm')
                ->leftJoin('csm_venue_master as cvm', 'cvm.csm_master_id', '=', 'cm.id')
                ->leftJoin('venue_master as vm', 'vm.id', '=', 'cvm.venue_id')
                ->where('cm.deleted_at', NULL)
                ->where('cvm.deleted_at', NULL)
                ->where('vm.deleted_at', NULL)
                ->select('cm.*', 'vm.venue_name')
                ->orderBy('cm.id', 'DESC')
                ->get();

//        echo '<pre>';
//        print_r($data['all_bsm']);
//        return;

        return view('bsm-csm.csm.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['title'] = 'Create CSM';
        $data['venues'] = DB::table('venue_master')->where('deleted_at', NULL)->select('id', 'venue_name')->get();
        $data['assigned_venue'] = DB::table('csm_venue_master')
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();

        $data['vendor'] = DB::table('vendors')->where('deleted_at', NULL)->select('id', 'full_name')->get();
//        echo '<pre>';
//        print_r($assigned_venue);
//        return;
        return view('bsm-csm.csm.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
        $csm_name = ucwords(trim($req->csm_name));
        $mobile = $req->mobile;
        $email = trim($req->email);
        $venue = $req->venue;
        $vendor = $req->vendor;

        $master_id = DB::table('csm_master')->insertGetId([
            'csm_name' => $csm_name,
            'mobile' => $mobile,
            'email' => $email,
            'password' => Hash::make($req->password),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Session::get('lgn_id')
        ]);

        if ($master_id != '') {

            foreach ($venue as $ve) {
                DB::table('csm_venue_master')->insert([
                    'csm_master_id' => $master_id,
                    'venue_id' => $ve,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);
            }

            foreach ($vendor as $ve) {
                DB::table('csm_vendor_master')->insert([
                    'csm_master_id' => $master_id,
                    'vendor_id' => $ve,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);
            }

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit CSM';
        $data['venues'] = DB::table('venue_master')->where('deleted_at', NULL)->select('id', 'venue_name')->get();
        $data['assigned_venue'] = DB::table('csm_venue_master')
                        ->where('csm_master_id', '!=', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();
        $data['edit'] = DB::table('csm_master')->where('id', $id)->where('deleted_at', NULL)->first();
        $data['edit_child'] = DB::table('csm_venue_master')
                        ->where('csm_master_id', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();

        $data['vendor'] = DB::table('vendors')->where('deleted_at', NULL)->select('id', 'full_name')->get();
        $data['csm_vendors'] = DB::table('csm_vendor_master')->where('csm_master_id', $id)->where('deleted_at', NULL)->pluck('vendor_id')->toArray();
//        echo '<pre>';
//        print_r($data['assigned_venue']);
//        return;
        return view('bsm-csm.csm.create')->with($data);
    }

    public function update(Request $req) {
//        echo 'came in csm update method.';
//        return;

        $rec_id = $req->rec_id;
        $csm_name = ucwords(trim($req->csm_name));
        $mobile = $req->mobile;
        $email = trim($req->email);
        $venue = $req->venue;
        $vendor = $req->vendor;

        DB::table('csm_master')
                ->where('id', $rec_id)
                ->update([
                    'csm_name' => $csm_name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'password' => Hash::make($req->password),
                    'updated_by' => Session::get('lgn_id'),
                    'updated_at' => date('Y-m-d'),
        ]);

        DB::table('csm_venue_master')
                ->where('csm_master_id', $rec_id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        DB::table('csm_vendor_master')
                ->where('csm_master_id', $rec_id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        foreach ($venue as $ve) {
            DB::table('csm_venue_master')->insert([
                'csm_master_id' => $rec_id,
                'venue_id' => $ve,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);
        }

        foreach ($vendor as $ve) {
            DB::table('csm_vendor_master')->insert([
                'csm_master_id' => $rec_id,
                'vendor_id' => $ve,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $req) {
        DB::table('csm_master')
                ->where('id', $req->id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        DB::table('csm_venue_master')
                ->where('csm_master_id', $req->id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        return response()->json(['status' => 'success']);
    }

}
