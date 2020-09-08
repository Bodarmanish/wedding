<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class VendorModel extends Model implements Authenticatable
{
    // use Notifiable;
    use SoftDeletes;
    use AuthenticableTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = "vendors";
    protected $guard = 'vendor';

    protected $fillable = ['full_name','mobile','email','password','business_name','address','created_by','updated_by',];

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
