<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function Video()
    { // FK relationship
        return $this->belongsTo('App\Video');
    }
}
