<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // １つの試合に複数の選手が出場
    public function Athletes()
    {
        return $this->hasMany('App\Athlete');
    }
}
