<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadQuatationModel extends Model
{
    // use Notifiable;
	use SoftDeletes;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = "lead_quatation";
    protected $fillable = ['customer_id','quatation','amount','created_by','updated_by',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'remember_token',
    ];
    protected $dates = ['deleted_at'];
}
