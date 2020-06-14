<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use Auth;

class PlaylistController extends Controller
{
    public function createLiked()
    {
        $home = '/home';
        $user = auth()->user()->id;
        if (Playlist::where('users_id', $user)->count() == 0) {
            $playlist = new Playlist();
            $user = User::where('id', $user)->first();
            $playlist->Users()->associate($user);
            $playlist->name = "Liked Videos";
            $playlist->type = '0';
            $playlist->save();
        }
        return redirect($home);
    }

    public function myPlaylists($id)
    {
        if (Auth::guest()) {
            $reg = '/register';
            return redirect($reg);
        }
        $user = auth()->user();
        if ($id != $user->id) {
            return "Access denied!";
        } else {
            $playlists = Playlist::where('users_id', $user->id)->get();
            return view('playlists', ['playlists' => $playlists]);
        }
    }

    public function getId(Request $request){
        $user = auth()->user();
        $id = Playlist::where('users_id', $user->id)->where('name', $request->name)->first()->id;
        return $id;
    }
}
