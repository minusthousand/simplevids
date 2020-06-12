<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function Video()
    { // FK relationship
        return $this->belongsTo('App\Video');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
