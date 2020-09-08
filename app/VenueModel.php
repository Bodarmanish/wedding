<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class VenueModel extends Model implements Authenticatable
{
    // use Notifiable;
    use SoftDeletes;

    use AuthenticableTrait;

    protected $guard = 'venue';
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = "venue_master";
    protected $fillable = ['venue_name','venue_address', 'venue_email','password', 'venue_district', 'venue_mobile',
    'owner_name','owner_email','owner_mobile_1','owner_mobile_2','venue_type_id','recetion_capacity','floating_capacity','dinning_dapacity','number_of_rooms','ac_rooms','non_ac_rooms','total_area','number_of_chairs','lpg_gas','power_backup','kitchen_type','function_id','hot_water_available','lift_available','cctv_available','jewellery_locker_available','generator_facility','security_guards','bike_parking_capacity','car_parking_capacity','toilets','helpers','created_by','updated_by',];

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
