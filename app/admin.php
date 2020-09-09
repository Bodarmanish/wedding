<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class admin extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = ['role_id','name','mobile','email','password',];

}
