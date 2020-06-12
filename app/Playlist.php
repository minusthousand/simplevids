<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public function Users()
    { // FK relationship
        return $this->belongsTo('App\User');
    }

    public function playlist_videp()
    {
        return $this->hasMany('App\Playlist_Video');
    }
}
