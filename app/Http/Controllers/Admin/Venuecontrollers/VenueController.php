<?php

namespace App\Http\Controllers\Admin\Venue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;
use App\VenueModel;
use App\TermsConditionsModel;
// use APP\PolicyCancellationModel;
use App\PolicyCancellationModel;
use App\InstructionModel;
use App\DocumentModel;
use File;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Venue List';
        
        $data['venu_types'] = DB::table('venue_type_master')
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();

        $data['all_venues'] = DB::table('venue_master')
        ->join('venue_type_master','venue_type_master.id','venue_master.venue_type_id')
        ->select('venue_master.*','venue_type_master.venue_type as venue_type')
        ->where('venue_master.deleted_at', NULL)
        ->orderBy('venue_master.id')
        ->get();

        return view('venue.listvenue')->with($data);
    }



    public function add_venue()
    {
        $data['title'] = 'Create Venue';

        $data['venu_types'] = DB::table('venue_type_master')
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();

        $data['all_functions'] = DB::table('venue_function_master')
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();

        return view('venue.createvenue')->with($data);
    }


    public function save_venue(Request $request)
    {
        $save_venue = new VenueModel();

        $save_venue->venue_name = ucwords(trim($request->venue_name));
        $save_venue->venue_address = $request->venue_address;
        $save_venue->venue_email = trim($request->venue_email);
        $save_venue->venue_district = ucwords(trim($request->venue_district));
        $save_venue->venue_mobile = trim($request->venue_mobile);
        $save_venue->owner_name = ucwords(trim($request->owner_name));
        $save_venue->owner_email = trim($request->owner_email);
        $save_venue->owner_mobile_1 = trim($request->owner_mobile_first);
        $save_venue->owner_mobile_2 = trim($request->owner_mobile_second);
        $save_venue->about_venue = $request->about_venue;
        $save_venue->venue_type_id = $request->venue_type;
        $save_venue->recetion_capacity = trim($request->recetion_capacity);
        $save_venue->floating_capacity = trim($request->floating_capacity);
        $save_venue->dinning_dapacity = trim($request->dinning_capacity);
        $save_venue->number_of_rooms = trim($request->number_of_rooms);
        $save_venue->ac_rooms = trim($request->ac_rooms);
        $save_venue->non_ac_rooms = trim($request->non_ac_rooms);
        $save_venue->total_area = trim($request->total_area);
        $save_venue->number_of_chairs = trim($request->no_of_chairs);
        $save_venue->lpg_gas = $request->lpg_gas;
        $save_venue->power_backup = $request->power_backup;
        $save_venue->kitchen_type = $request->kitchen_type;
        
        // CHECKBOX VALUES
        $function_type = implode(',', $request->function_type);
        $save_venue->function_ids = $function_type;

        $save_venue->hot_water_available = $request->hot_water;
        $save_venue->lift_available = $request->lift_available;
        $save_venue->cctv_available = $request->cctv;
        $save_venue->jewellery_locker_available = $request->jewellery;
        $save_venue->generator_facility = $request->generator;
        $save_venue->security_guards = $request->security_guards;
        $save_venue->bike_parking_capacity = $request->bike_parking;
        $save_venue->car_parking_capacity = $request->car_parking;
        $save_venue->toilets = $request->toilets;
        $save_venue->helpers = $request->total_helpers;

        $save_venue->created_at = date('Y-m-d H:i:s');
        $save_venue->created_by = Session::get('lgn_id');
        $save_venue->save();

        // echo "<pre>";
        // print_r($save_venue);
        // return;
        // dd($save_venue);

        if($save_venue)
        {
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
        
    }

    public function edit_venue($id)
    {

        $data['title'] = 'Edit Venue';

        $data['venu_types'] = DB::table('venue_type_master')
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();

        $data['all_functions'] = DB::table('venue_function_master')
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();
        
        $data['single_venue'] =  DB::table('venue_master')
        ->where('id',$id)
        ->where('deleted_at', NULL)
        ->first();

        return view('venue.editvenue')->with($data);
    }

    public function update_venue(Request $request)
    {
        $function_type = implode(',', $request->function_type);
        $update_venue = DB::table('venue_master')
            ->where('id', $request->venue_hidden_id)
            ->update([
                'venue_name' => ucwords(trim($request->venue_name)),
                'venue_address' => $request->venue_address,
                'venue_email' => trim($request->venue_email),
                'venue_district' => ucwords(trim($request->venue_district)),
                'venue_mobile' => trim($request->venue_mobile),
                'owner_name' => ucwords(trim($request->owner_name)),
                'owner_email' => trim($request->owner_email),
                'owner_mobile_1' => trim($request->owner_mobile_first),
                'owner_mobile_2' => trim($request->owner_mobile_second),
                'about_venue' => $request->about_venue,
                'venue_type_id' => $request->venue_type,
                'recetion_capacity' => trim($request->recetion_capacity),
                'floating_capacity' => trim($request->floating_capacity),
                'dinning_dapacity' => trim($request->dinning_capacity),
                'number_of_rooms' => trim($request->number_of_rooms),
                'ac_rooms' => trim($request->ac_rooms),
                'non_ac_rooms' => trim($request->non_ac_rooms),
                'total_area' => trim($request->total_area),
                'number_of_chairs' => trim($request->no_of_chairs),
                'lpg_gas' => $request->lpg_gas,
                'power_backup' => $request->power_backup,
                'kitchen_type' => $request->kitchen_type,
                
                // CHECKBOX VALUES
                
                
                'function_ids' => $function_type,

                'hot_water_available' => $request->hot_water,
                'lift_available' => $request->lift_available,
                'cctv_available' => $request->cctv,
                'jewellery_locker_available' => $request->jewellery,
                'generator_facility' => $request->generator,
                'security_guards' => $request->security_guards,
                'bike_parking_capacity' => $request->bike_parking,
                'car_parking_capacity' => $request->car_parking,
                'toilets' => $request->toilets,
                'helpers' => $request->total_helpers,

                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => Session::get('lgn_id')
            ]);

        if($update_venue)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }

    }


    public function delete_venue(Request $request)
    {
        
        $delete_venue = DB::table('venue_master')
            ->where('id', $request->venue_hidden_id)
            ->update([
               
                'deleted_at' => date('Y-m-d H:i:s'),
                'deleted_by' => Session::get('lgn_id')
            ]);
    }





    public function add_tremsConditions(Request $request, $id)
    {
        $data['title'] = 'Terms & Conditions';

        $data['new_id'] = $id;

        $data['term_nc'] = DB::table('venue_terms_conditions')
        ->select('*')
        ->where('venue_id',$id)
        ->where('deleted_at', NULL)
        ->get()
        ->toArray();

        return view('venue.addtnc')->with($data);
    }

    public function save_termsConditions(Request $request, $id)
    {
        $all_row_ids = $request->row_id;
        
        foreach($request->terms_conditions as $key => $tnc)
        {
            if(trim($tnc) != '')
            {
                if($all_row_ids[$key] == '')
                {
                    $save_tnc = new TermsConditionsModel();
                    $save_tnc->terms_conditions = trim($tnc);
                    $save_tnc->venue_id = $id;

                    $save_tnc->created_at = date('Y-m-d H:i:s');
                    $save_tnc->created_by = Session::get('lgn_id');

                    $save_tnc->save();
                } 
                else
                {
                    $update_tnc = DB::table('venue_terms_conditions')
                    ->where('id',$all_row_ids[$key])
                    ->update([
                        'terms_conditions' => trim($tnc),
                        
                        'updated_by' => Session::get('lgn_id'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                }
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function delete_termsConditions(Request $request)
    {
        $tnc_delete = DB::table('venue_terms_conditions')
        ->where('id',$request->tnc_id)
        ->update([

            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function add_policy(Request $request, $id)
    {
        $data['title'] = 'Cancellation Policies';

        // TO GET THE ID OF EDITED VENUE
        $data['new_id'] = $id;

        // TO GET DATA FROM CANCEELLATION POLICY TABLE IF AVAILABLE
        $data['canc_policy'] = DB::table('venue_cancellation_policy')
        ->select('*')
        ->where('venue_id',$id)
        ->where('deleted_at', NULL)
        ->get()
        ->toArray();

        return view('venue.policy')->with($data);
    }

    public function save_policy(Request $request, $id)
    {

        $all_row_ids = $request->row_id;
        
        foreach($request->canc_policy as $key => $plcy)
        {
            if(trim($plcy) != '')
            {
                if($all_row_ids[$key] == '')
                {
                    $save_plcy = new PolicyCancellationModel();
                    $save_plcy->cancellation_policy = trim($plcy);
                    $save_plcy->venue_id = $id;

                    $save_plcy->created_at = date('Y-m-d H:i:s');
                    $save_plcy->created_by = Session::get('lgn_id');

                    $save_plcy->save();
                } 
                else
                {
                    $update_plcy = DB::table('venue_cancellation_policy')
                    ->where('id',$all_row_ids[$key])
                    ->update([
                        'cancellation_policy' => trim($plcy),
                        
                        'updated_by' => Session::get('lgn_id'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                }
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function delete_policy(Request $request)
    {
        $tnc_delete = DB::table('venue_cancellation_policy')
        ->where('id',$request->tnc_id)
        ->update([

            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function add_document(Request $request, $id)
    {
        $data['title'] = 'Add Documents';

        // TO GET THE ID OF EDITED VENUE
        $data['new_id'] = $id;

        // TO GET DATA FROM CANCEELLATION POLICY TABLE IF AVAILABLE
        $data['documents'] = DB::table('venue_document')
        ->select('*')
        ->where('venue_id',$id)
        ->where('deleted_at', NULL)
        ->get()
        ->toArray();

        return view('venue.document')->with($data);
    }

    public function save_document(Request $request, $id)
    {

        $all_row_ids = $request->row_id;
        $all_document_files = $request->document_file;
        $all_document_name = $request->document_name;

        // print_r( $all_document_files );
        // return;

        foreach ($all_document_files as $key => $doc) 
        {
            if($all_row_ids[$key] == '')
            {
                $file = $doc;
                $file_name = rand(10,100) . '.' . $file->getClientOriginalExtension();
                $destinationpath = 'images/';
                $file->move($destinationpath, $file_name);
                $file_path = $file_name;

                $upd_data = new DocumentModel();

                $upd_data->venue_id = $id;
                $upd_data->document_file = $file_path;
                $upd_data->document_name = $all_document_name[$key];
                $upd_data->created_at = date('Y-m-d H:i:s');
                $upd_data->created_by = Session::get('lgn_id');
                $upd_data->save();
            }

            else
            {
                $file = $doc;
                $file_name = rand(10,100) . '.' . $file->getClientOriginalExtension();
                $destinationpath = 'images/';
                $file->move($destinationpath, $file_name);
                $file_path = $file_name;

                $update_user = DB::table('venue_document')
                ->where('id',$all_row_ids[$key])
                ->update([
                    
                    'document_file' => $file_path,
                    'document_name' => $all_document_name[$key],
                    'updated_by' => Session::get('lgn_id'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        return;
        
        foreach($all_document_files as $key => $doc)
        {

            if($all_row_ids[$key] == '')
            {
                if ($doc != '') 
                {
                    $file = $doc;

                    $file_name = rand(10,100) . '.' . $file->getClientOriginalExtension();

                    $destinationpath = 'images/';

                    $file->move($destinationpath, $file_name);

                    $file_path = $destinationpath . $file_name;


                }



                $upd_data = new DocumentModel();

                $upd_data->document_file = $file_path;
                $upd_data->document_name = $all_document_name;
                $upd_data->save();
            } 
                // else
                // {
                //     $update_user = DB::table('venue_cancellation_policy')
                //     ->where('id',$all_row_ids[$key])
                //     ->update([
                //         'cancellation_policy' => trim($plcy),

                //         'updated_by' => Session::get('lgn_id'),
                //         'updated_at' => date('Y-m-d H:i:s'),
                //     ]);

                // }
            
        }
        return response()->json(['status' => 'success']);
    }







    public function add_instruction($id)
    {
        $data['title'] = 'Add Documents';

        // TO GET THE ID OF EDITED VENUE
        $data['new_id'] = $id;

        // TO GET DATA FROM CANCEELLATION POLICY TABLE IF AVAILABLE
        $data['all_instructions'] = DB::table('venue_instruction')
        ->select('*')
        ->where('venue_id',$id)
        ->where('deleted_at', NULL)
        ->get()
        ->toArray();

        return view('venue.instruction')->with($data);
    }

    public function save_instruction(Request $request, $id)
    {

        $all_row_ids = $request->row_id;
        
        foreach($request->instruction as $key => $inst)
        {
            if(trim($inst) != '')
            {
                if($all_row_ids[$key] == '')
                {
                    $save_inst = new InstructionModel();
                    $save_inst->instruction = trim($inst);
                    $save_inst->venue_id = $id;

                    $save_inst->created_at = date('Y-m-d H:i:s');
                    $save_inst->created_by = Session::get('lgn_id');

                    $save_inst->save();
                } 
                else
                {
                    $update_inst = DB::table('venue_instruction')
                    ->where('id',$all_row_ids[$key])
                    ->update([
                        'instruction' => trim($inst),
                        
                        'updated_by' => Session::get('lgn_id'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                }
            }
        }
        return response()->json(['status' => 'success']);

    }

    public function delete_instruction(Request $request)
    {
        $tnc_delete = DB::table('venue_instruction')
        ->where('id',$request->tnc_id)
        ->update([

            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
