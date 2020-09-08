<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $fillable = ['customer_id','vanue_id','lead_id','received_payment','remaining_amount','payment_date'];
    
}
