<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenuePackagesModel extends Model
{
    // use Notifiable;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = "venue_packages";
    protected $fillable = ['package_name','venue_type', 'price', 'gst', 'total',
    'timing_from','timing_to','grand_total','created_by','updated_by',];

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
