<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    protected $fillable = ['category_id','name','image'];

    public function cat(){
        return $this->belongsTo('App\category', 'category_id');
    }
}
