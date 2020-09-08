<?php

namespace App\Http\Controllers\Admin\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use DB;
use App\PaymentStatus;

class PaymentStatusController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $data['title'] = 'Payment Status';
        $data['payment_status'] = DB::table('payment_statuses as ps')
        ->leftJoin('leads as le','le.id','=','ps.customer_id')
        ->join('venue_master', 'venue_master.id', '=', 'ps.vanue_id')
        ->join('lead_quatation', 'lead_quatation.id', '=', 'ps.lead_id')
        ->orderBy('ps.id','desc')
        ->select('ps.*','le.customer_name','venue_master.venue_name', 'lead_quatation.amount')
        ->get();


        return view('lead.payment-status.index')->with($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            PaymentStatus::create([
                'customer_id' => $request->customer_id,
                'vanue_id' => $request->vanue_id,
                'lead_id' => $request->lead_id,
                'received_payment' => $request->received_payment,
                'remaining_amount' => $request->remaining_amount,
                'payment_date' => $request->payment_date,
            ]);
        return 'true';
            
        } else {
            $data['title'] = 'Create Payment Status';
            $data['create'] = 'create';
            $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
            $data['venue'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
            $data['leads'] = DB::table('leads')->where('deleted_at',NULL)->get();

            return view('lead.payment-status.create')->with($data);
        }
    }

    public function edit(Request $request){
        if ($request->isMethod('post')) {
            $payment = PaymentStatus::findOrFail($request->id);
            $payment->update([
                'customer_id' => $request->customer_id,
                'vanue_id' => $request->vanue_id,
                'lead_id' => $request->lead_id,
                'received_payment' => $request->received_payment,
                'remaining_amount' => $request->remaining_amount,
                'payment_date' => $request->payment_date,
            ]);
        return 'true';
            
        } else {
            $data['payment'] = PaymentStatus::findOrFail($request->id);

            $data['title'] = 'Create Payment Status';
            $data['create'] = 'create';
            $data['customers'] = DB::table('leads')->where('deleted_at',NULL)->get();
            $data['venue'] = DB::table('venue_master')->where('deleted_at',NULL)->get();
            $data['leads'] = DB::table('leads')->where('deleted_at',NULL)->get();

            return view('lead.payment-status.edit')->with($data);
        }
    }

    public function get_remaining_amount(Request $request)
    {
        $customer_id = $request->customer_id;
        $reamount = DB::table('payment_statuses')
                            ->where('customer_id',$customer_id)
                            ->where('lead_id',$request->lead)
                            ->where('vanue_id',$request->venue)
                            ->orderBy('updated_at', 'DESC')
                            ->select('remaining_amount')
                            ->first();
        if ($reamount != '') {
            $remainingamount = $reamount->remaining_amount - $request->reamount;
        } else {
            $amount = DB::table('lead_quatation')->where('id',$request->lead)->where('deleted_at',NULL)->select('amount')->first();
            $remainingamount = $amount->amount - $request->reamount;
        }
        
        return response()->json($remainingamount);
    }

    public function get_amount(Request $request)
    {
        $customer_id = $request->customer_id;
        $amount = DB::table('lead_quatation')->where('customer_id',$customer_id)->where('deleted_at',NULL)->get();

        return response()->json($amount);
    }

    public function delete(Request $request){

        $payment = PaymentStatus::findOrFail($request->id)->delete();
        return 'true';
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
