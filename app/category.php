<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name','city', 'email','rating', 'prize', 'is_save','image','is_verified'];

    public function sub_cat(){
        return $this->hasMany('App\category', 'category_id');
    }
}
