<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorMail;
use App\VendorModel;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('guest');

        $this->id = isset($request->id)?$request->id:0;
        $this->type = ($this->id > 0 ? 'edit' : 'create');
        $this->table = 'vendors';
        $this->data['type'] = $this->type;
        $this->data['id'] = $this->id;

        if($this->id>0){
            $quearyData =  DB::table($this->table)->where('id',$this->id)->first();
            
            $this->data['full_name']    = $this->full_name = $quearyData->full_name;
            $this->data['business_name']    = $this->business_name = $quearyData->business_name;
            $this->data['mobile']    = $this->mobile = $quearyData->mobile;
            $this->data['email']    = $this->email = $quearyData->email;
            $this->data['password']    = $this->password = $quearyData->password;
            $this->data['address']    = $this->address = $quearyData->address;
        }else{            
            $this->data['full_name']    = $this->full_name = '';
            $this->data['business_name']    = $this->business_name = '';
            $this->data['mobile']    = $this->mobile = '';
            $this->data['email']    = $this->email = '';
            $this->data['password']    = $this->password = '';
            $this->data['address']    = $this->address = '';
        }
    }

    public function index()
    {
        $data['title'] = 'Vendor';
        /*$data['vendors'] = DB::table($this->table.' as v')
        ->leftJoin('vendor_services as vs', 'vs.vendor_id','=', 'v.id')
        ->leftJoin('services as s', 's.id','=','vs.service_id')
        ->where('v.deleted_at',NULL)
        ->where('vs.deleted_at', NULL)
        ->where('s.deleted_at', NULL)
        ->select('v.*',DB::raw('group_concat(s.service_name) as service_name'))
        ->groupBy('vs.vendor_id')
        ->get();*/
        $data['vendors'] = DB::table($this->table.' as v')
        ->where('v.deleted_at',NULL)
        ->select('v.*')
        ->get();
        return view('vendor.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Vendor';
        $data['db_data'] = (object)$this->data;
        $data['services'] = DB::table('services')->where('deleted_at', NULL)->select('id', 'service_name')->get();

        return view('vendor.create-vendor')->with($data);
    }

    public function store(Request $req)
    {
        $full_name = $req->full_name;
        $business_name = $req->business_name;
        $mobile = $req->mobile;
        $email = $req->email;
        $password = Hash::make($req->password);
        $address = $req->address;
        $id = $req->id;
        $type = $req->type;
        $service = $req->service;

        $duplicate = VendorModel::where('email', $email)->exists(); 
        if($id > 0){
        	$duplicate = VendorModel::where('email', $email)->where('id','!=',$id)->exists(); 	
        }
        //also use doesntExist()
        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
        	$vendor = null;
        	if($id == 0){
        		$id = DB::table($this->table)->insertGetId([
                    'full_name' => $full_name,
                    'business_name' => $business_name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'password' => $password,
                    'address' => $address,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => Session::get('lgn_id')
                ]);

        	}else{
        		$vendor = DB::table($this->table)
	            ->where('id', $id)
	            ->update([
	                'full_name' => $full_name,
	                'business_name' => $business_name,
	                'mobile' => $mobile,
                    'email' => $email,
                    'password' => $password,
	                'address' => $address,
	                'updated_by' => Session::get('lgn_id'),
	                'updated_at' => date('Y-m-d H:i:s'),
	            ]);	
        	}

            if($id)
            {
                DB::table('vendor_services')
                    ->where('vendor_id', $id)
                    ->update([
                        'deleted_by' => Session::get('lgn_id'),
                        'deleted_at' => date('Y-m-d'),
                ]);

                foreach ($service as $ve) {
                    DB::table('vendor_services')->insert([
                        'vendor_id' => $id,
                        'service_id' => $ve,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Session::get('lgn_id')
                    ]);
                }

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
    	$data['title'] = 'Vendor';
        $data['db_data'] = (object)$this->data;

        $data['services'] = DB::table('services')->where('deleted_at', NULL)->select('id', 'service_name')->get();

        $data['vendor_services'] = DB::table('vendor_services')->where('vendor_id', $id)->where('deleted_at', NULL)->pluck('service_id')->toArray();
        return view('vendor.create-vendor')->with($data);
    }

    public function delete(Request $req)
    {
        $id = $req->id;

        $delete = DB::table($this->table)
        ->where('id', $id)
        ->update([
            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d H:i:s'),
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
