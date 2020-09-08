<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Bsm extends Model implements Authenticatable
{   
    use AuthenticableTrait;

    protected $table = 'bsm_master';

    protected $guard = 'bsm';

    protected $fillable = ['bsm_name','mobile','email','password',''];

}
