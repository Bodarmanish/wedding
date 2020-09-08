<?php

namespace App\Http\Controllers\Admin\BSM_CSM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;


class BsmController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        $data['title'] = 'BSM';
        $data['all_bsm'] = DB::table('bsm_master as bm')
                ->leftJoin('bsm_venue_master as bvm', 'bvm.bsm_master_id', '=', 'bm.id')
                ->leftJoin('venue_master as vm', 'vm.id', '=', 'bvm.venue_id')
                ->where('bm.deleted_at', NULL)
                ->where('bvm.deleted_at', NULL)
                ->where('vm.deleted_at', NULL)
                ->select('bm.*', 'vm.venue_name')
                ->orderBy('bm.id', 'DESC')
                ->get();

        return view('bsm-csm.bsm.index')->with($data);
    }

    public function create() {
        $data['title'] = 'Create BSM';
        $data['venues'] = DB::table('venue_master')->where('deleted_at', NULL)->select('id', 'venue_name')->get();
        $data['assigned_venue'] = DB::table('bsm_venue_master')
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();
        
        $data['csm'] = DB::table('csm_master')->where('deleted_at', NULL)->select('id', 'csm_name')->get();
        $data['assigned_csm'] = DB::table('bsm_csm_master')
                        ->where('deleted_at', NULL)
                        ->groupBy('csm_id')
                        ->select('csm_id')
                        ->get()->toArray();

        $data['vendor'] = DB::table('vendors')->where('deleted_at', NULL)->select('id', 'full_name')->get();
        
        return view('bsm-csm.bsm.create')->with($data);
    }

    public function store(Request $req) {
        $bsm_name = ucwords(trim($req->bsm_name));
        $mobile = $req->mobile;
        $email = trim($req->email);
        $venue = $req->venue;
        $csm = $req->csm;
        $vendor = $req->vendor;

        $master_id = DB::table('bsm_master')->insertGetId([
            'bsm_name' => $bsm_name,
            'mobile' => $mobile,
            'email' => $email,
            'password' => Hash::make($req->password),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Session::get('lgn_id')
        ]);

        if ($master_id != '') {

            foreach ($venue as $ve) {
                DB::table('bsm_venue_master')->insert([
                    'bsm_master_id' => $master_id,
                    'venue_id' => $ve,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);
            }

            foreach ($csm as $ve) {
                DB::table('bsm_csm_master')->insert([
                    'bsm_master_id' => $master_id,
                    'csm_id' => $ve,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);
            }

            foreach ($vendor as $ve) {
                DB::table('bsm_vendor_master')->insert([
                    'bsm_master_id' => $master_id,
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
        $data['title'] = 'Edit BSM';
        
        $data['venues'] = DB::table('venue_master')->where('deleted_at', NULL)->select('id', 'venue_name')->get();
        $data['assigned_venue'] = DB::table('bsm_venue_master')
                        ->where('bsm_master_id', '!=', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();
        
        $data['csm'] = DB::table('csm_master')->where('deleted_at', NULL)->select('id', 'csm_name')->get();
        $data['assigned_csm'] = DB::table('bsm_csm_master')
                        ->where('bsm_master_id', '!=', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('csm_id')
                        ->select('csm_id')
                        ->get()->toArray();

        $data['edit'] = DB::table('bsm_master')->where('id', $id)->where('deleted_at', NULL)->first();
        $data['edit_child'] = DB::table('bsm_venue_master')
                        ->where('bsm_master_id', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('venue_id')
                        ->select('venue_id')
                        ->get()->toArray();

        $data['edit_child_csm'] = DB::table('bsm_csm_master')
                        ->where('bsm_master_id', $id)
                        ->where('deleted_at', NULL)
                        ->groupBy('csm_id')
                        ->select('csm_id')
                        ->get()->toArray();

        $data['vendor'] = DB::table('vendors')->where('deleted_at', NULL)->select('id', 'full_name')->get();
        $data['bsm_vendors'] = DB::table('bsm_vendor_master')->where('bsm_master_id', $id)->where('deleted_at', NULL)->pluck('vendor_id')->toArray();

        return view('bsm-csm.bsm.create')->with($data);
    }

    public function update(Request $req) {

        $rec_id = $req->rec_id;
        $bsm_name = ucwords(trim($req->bsm_name));
        $mobile = $req->mobile;
        $email = trim($req->email);
        $venue = $req->venue;
        $csm = $req->csm;
        $vendor = $req->vendor;

        DB::table('bsm_master')
                ->where('id', $rec_id)
                ->update([
                    'bsm_name' => $bsm_name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'password' => Hash::make($req->password),
                    'updated_by' => Session::get('lgn_id'),
                    'updated_at' => date('Y-m-d'),
        ]);

        DB::table('bsm_venue_master')
                ->where('bsm_master_id', $rec_id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        DB::table('bsm_csm_master')
                ->where('bsm_master_id', $rec_id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        DB::table('bsm_vendor_master')
                ->where('bsm_master_id', $rec_id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        foreach ($venue as $ve) {
            DB::table('bsm_venue_master')->insert([
                'bsm_master_id' => $rec_id,
                'venue_id' => $ve,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);
        }

        foreach ($csm as $ve) {
            DB::table('bsm_csm_master')->insert([
                'bsm_master_id' => $rec_id,
                'csm_id' => $ve,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('lgn_id')
            ]);
        }

        foreach ($vendor as $ve) {
                DB::table('bsm_vendor_master')->insert([
                    'bsm_master_id' => $rec_id,
                    'vendor_id' => $ve,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);
            }

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $req) {
        DB::table('bsm_master')
                ->where('id', $req->id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        DB::table('bsm_venue_master')
                ->where('bsm_master_id', $req->id)
                ->update([
                    'deleted_by' => Session::get('lgn_id'),
                    'deleted_at' => date('Y-m-d'),
        ]);

        return response()->json(['status' => 'success']);
    }

}
