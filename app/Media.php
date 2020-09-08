<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "venue_media";
    protected $fillable = ['venue_id','video_link','image'];
    
}
