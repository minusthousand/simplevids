<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist_Video extends Model
{
    public function Video()
    { // FK relationship
        return $this->belongsTo('App\Video');
    }

    public function Playlist()
    { // FK relationship
        return $this->belongsTo('App\Playlist');
    }


    protected $table = 'playlist_videos';
}
