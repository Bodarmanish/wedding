<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "leads";
    protected $fillable = ['venue','customer_name', 'email','password', 'mobile', 'alt_mobile',
    'event_date','event_type','created_by','updated_by',];

    protected $hidden = [
        'remember_token',
     ];
     protected $dates = ['deleted_at'];
 
     public function getJWTIdentifier()
     {
         return $this->getKey();
     }
     public function getJWTCustomClaims()
     {
         return [];
     }
}
