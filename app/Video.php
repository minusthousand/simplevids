<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function Users()
    { // FK relationship
        return $this->belongsTo('App\User');
    }

    public function Report(){
        return $this->hasMany('App\Report');
    }

    public function Comment(){
        return $this->hasMany('App\Comment');
    }
}
