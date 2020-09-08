<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Csm extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'csm_master';

    protected $guard = 'csm';

    protected $fillable = ['csm_name','mobile','email','password'];
}
