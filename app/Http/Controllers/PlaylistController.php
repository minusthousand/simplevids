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

    public function showAll()
    {
        if (auth()->user()->role == 'admin') {
            $playlists = Playlist::where('name', '!=', 'Liked Videos')->get();
            return view('playlists', ['playlists' => $playlists]);
        }
        else {
            return "Access Denied!";
        }
    }

    public function getId(Request $request){
        $user = Auth::user();
        $id = Playlist::where('users_id', $user->id)->where('name', $request->name)->first()->id;
        return $id;
    }

    public function selection($id){
        $user = auth()->user();
        $playlists = Playlist::where('users_id', $user->id)->get();
        return view('selection', ['video_id' => $id, 'playlists' => $playlists]);
    }

    public function create(){
        if (Auth::guest()) {
            $reg = '/register';
            return redirect($reg);
        }
        return view('newPlaylist');
    }

    public function store(Request $request){
        $user = auth()->user();
        $playlist = new Playlist();
        $user = User::where('id', $user->id)->first();
        $playlist->Users()->associate($user);
        $playlist->name = $request->name;
        $playlist->type = $request->type;
        $playlist->save();
        return redirect('/'.$user->id.'/myplaylists');
    }

    public function delete($id){
        $user_id = auth()->user()->id;
        if (Auth::guest()){
            $reg = '/register';
            return redirect($reg);
        }
        if (auth()->user()->type != 'admin'){
            if ($user_id != $id){
                return "Access Denied!";
            }
        }
        $user = auth()->user();
        if (Playlist::where('id', $id)->first()->name == "Liked Videos") {
            return 'Cannot delete liked videos playlist.';
        }
        Playlist::where('id', $id)->delete();
        return redirect('/'.$user->id.'/myplaylists');
}
    }

