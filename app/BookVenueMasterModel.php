<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookVenueMasterModel extends Model
{
    // use Notifiable;
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = "book_venue_master";
    protected $fillable = ['customer_id','event_from_date','event_to_date','event_type','venue_type','booking_amount_paid','amount_paid_date','abount_venue','created_by','updated_by',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];
}
