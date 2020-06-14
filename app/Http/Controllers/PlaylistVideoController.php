<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist_Video;
use App\Video;
use App\Playlist;
use Auth;

class PlaylistVideoController extends Controller
{
    public function add($id, Request $request){
        $user = auth()->user();
        if (Playlist_Video::where('playlist_id', $id)->where('video_id', $request->id)->count() == 0){
        $playlistVid = new Playlist_Video();
        $playlist = Playlist::where('id', $id)->first();
        $video = Video::where('id', $request->id)->first();
        $playlistVid->Video()->associate($video);
        $playlistVid->Playlist()->associate($playlist);
        $playlistVid->save();
    }
    else {
        Playlist_Video::where('video_id', $request->id)->delete();
    }
    }

    public function show($id){
        $playlistLinks = Playlist_Video::where('playlist_id', $id)->with('video')->get();
        return view('playlistView', ['videos' => $playlistLinks]);
    }

    public function check($id, Request $request){
        return (Playlist_Video::where('playlist_id', $id)->where('video_id', $request->id)->count() == 0);
    }

    public function likedVideos($id){
        if (Auth::guest()) {
            $reg = '/register';
            return redirect($reg);
        }
        $user = auth()->user();
        if ($id != $user->id) {
            return "Access denied!";
        } else {
        $playlist_id = Playlist::where('users_id', $user->id)->where('name', 'Liked Videos')->first()->id;
            $playlistLinks = Playlist_Video::where('playlist_id', $playlist_id)->with('video')->get();
        return view('playlistView', ['videos' => $playlistLinks]);
        }

    }

}
