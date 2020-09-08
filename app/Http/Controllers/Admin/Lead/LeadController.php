<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadMail;
use App\LeadModel;
use Session;
use DB;
use Carbon\Carbon;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Leads';
        $data['leads'] = DB::table('leads as l')
        ->leftJoin('venue_master as vm','vm.id','=','l.venue')
        ->leftJoin('event_type_master as em','em.id','=','l.event_type')
        ->where('l.deleted_at',NULL)
        ->where('vm.deleted_at',NULL)
        ->select('l.*','vm.venue_name','em.event_type as event_type_name')
        ->get();
        
        return view('lead.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Lead';
        $data['venue'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
        $data['events'] = DB::table('event_type_master')->where('deleted_at',NULL)->get();

        return view('lead.create-lead')->with($data);
    }

    public function store(Request $req)
    {
        $venue = $req->venue;
        $customer_name = ucwords(trim($req->customer_name));
        $email = trim($req->email);
        $mobile_no = $req->mobile_no;
        $alternate_mobile_no = $req->alternate_mobile_no;
        // $event_date = date('Y-m-d',strtotime($req->event_date));
        // $event_date = date('Y-m-d', strtotime(str_replace('-', '/', $req->event_date)));
        $event_type = $req->event_type;

        $date1 = strtr($req->event_date, '/', '-');
        $event_date =  date('Y-m-d', strtotime($date1));

        // echo $event_date;   
        // return;

        $duplicate = LeadModel::where('venue', $venue)->where('customer_name',$customer_name)->where('event_date',$event_date)->exists(); 
        //also use doesntExist()

        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {

            $lead = new LeadModel();

            $lead->venue = $venue;
            $lead->customer_name = $customer_name;
            $lead->email = $email;
            $lead->mobile = $mobile_no;
            $lead->alt_mobile = $alternate_mobile_no;
            $lead->event_date = $event_date;
            $lead->event_type = $event_type;
            $lead->created_by = Session::get('lgn_id');
            $lead->created_at = date('Y-m-d H:i:s');
            $lead->save();

            $user_data = array(
                'customer_name' => $customer_name
            );

            Mail::to($email)->send(new LeadMail($user_data));

            if($lead)
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
        $data['title'] = 'Create Lead';
        $data['venue'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
        $data['events'] = DB::table('event_type_master')->where('deleted_at',NULL)->get();
        $data['edit'] = LeadModel::where('id',$id)->where('deleted_at',NULL)->first();

        return view('lead.create-lead')->with($data);
    }

    public function update(Request $req)
    {
        $rec_id = $req->rec_id;
        $venue = $req->venue;
        $customer_name = ucwords(trim($req->customer_name));
        $email = trim($req->email);
        $mobile_no = $req->mobile_no;
        $alternate_mobile_no = $req->alternate_mobile_no;
        // $event_date = date('Y-m-d',strtotime($req->event_date));
        // $event_date = date('Y-m-d', strtotime(str_replace('-', '/', $req->event_date)));
        $event_type = $req->event_type;

        $date1 = strtr($req->event_date_edit, '/', '-');
        $event_date =  date('Y-m-d', strtotime($date1));

        $duplicate = LeadModel::where('venue', $venue)->where('customer_name',$customer_name)->where('event_date',$event_date)->where('id','!=',$rec_id)->exists(); ; 
        //also use doesntExist()


        if ($duplicate == 'true') 
        {
            return response()->json(['status' => 'duplicate']);
        } 
        else 
        {
            $update = DB::table('leads')
            ->where('id', $rec_id)
            ->update([
                'venue' => $venue,
                'customer_name' => $customer_name,
                'email' => $email,
                'mobile' => $mobile_no,
                'alt_mobile' => $alternate_mobile_no,
                'event_date' => $event_date,
                'event_type' => $event_type,
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
        $id = $req->id;

        $delete = DB::table('leads')
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
