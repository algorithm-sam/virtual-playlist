<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    //
    protected $fillable = ['name','artist','language','play_count','last_seen','first_seen','first_play'];
}
