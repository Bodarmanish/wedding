<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceMail;
use App\ServiceModel;
use Session;
use DB;

class ServiceController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('guest');

        $this->id = isset($request->id)?$request->id:0;
        $this->type = ($this->id > 0 ? 'edit' : 'create');
        $this->table = 'services';
        $this->data['type'] = $this->type;
        $this->data['id'] = $this->id;

        if($this->id>0){
            $quearyData =  DB::table($this->table)->where('id',$this->id)->first();
            
            $this->data['service_name']    = $this->service_name = $quearyData->service_name;
            $this->data['service_description']    = $this->service_description = $quearyData->service_description;
        }else{            
            $this->data['service_name']    = $this->service_name = '';
            $this->data['service_description']    = $this->service_description = '';
        }
    }

    public function index()
    {
        $data['title'] = 'Service';
        $data['services'] = DB::table('services as s')
        ->where('s.deleted_at',NULL)
        ->select('s.*')
        ->get();
        return view('service.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Service';
        $data['db_data'] = (object)$this->data;
        return view('service.create-service')->with($data);
    }

    public function store(Request $req)
    {
        $service_name = $req->service_name;
        $service_description = $req->service_description;
        $id = $req->id;
        $type = $req->type;

        $duplicate = ServiceModel::where('service_name', $service_name)->exists(); 
        if($id > 0){
        	$duplicate = ServiceModel::where('service_name', $service_name)->where('id','!=',$id)->exists(); 	
        }
        //also use doesntExist()
        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
        	$service = null;
        	if($id == 0){
        		$service = new ServiceModel();
				$service->service_name = $service_name;
	            $service->service_description = $service_description;
	            $service->created_by = Session::get('lgn_id');
	            $service->created_at = date('Y-m-d H:i:s');
	            $service->save();	
        	}else{
        		$service = DB::table($this->table)
	            ->where('id', $id)
	            ->update([
	                'service_name' => $service_name,
	                'service_description' => $service_description,
	                'updated_by' => Session::get('lgn_id'),
	                'updated_at' => date('Y-m-d H:i:s'),
	            ]);	
        	}

            if($service)
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
    	$data['title'] = 'Service';
        $data['db_data'] = (object)$this->data;
        return view('service.create-service')->with($data);
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
