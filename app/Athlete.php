<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    // １人の選手は複数の試合に出場
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}