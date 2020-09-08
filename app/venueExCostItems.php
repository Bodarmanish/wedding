<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venueExCostItems extends Model
{
    protected $fillable = ['vanue_id','item_name','price','des'];
}
