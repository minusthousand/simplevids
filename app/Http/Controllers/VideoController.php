<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('am_of_likes', 'desc')->get();
        return view('video', ['videos' => $videos]);
    }

    public function preview($id)
    {
        $filePath = $id.'/preview.png';
        return response()->file(storage_path('videos'.DIRECTORY_SEPARATOR.($filePath)));
    }

    public function videoView($id)
    {
        $video = Video::where('id', $id)->first();
        return view('videoView', ['video' => $video] );
    }

    public function video($id){
        $filePath = $id.'/video.mp4';
        return response()->file(storage_path('videos'.DIRECTORY_SEPARATOR.($filePath)));
    }

    public function myVideos($id){
        if (Auth::guest()){
            $reg = '/register';
            return redirect($reg);
        }
        $user = auth()->user();
        if ($id != $user->id) {
            return "Access denied!";
        }
        else{
            $videos = Video::where('users_id', $user->id)->orderBy('am_of_likes', 'desc')->get();
            return view('video', ['videos' => $videos]);
        }

    }

    public function upload() {
        if (Auth::guest()){
            $reg = '/register';
            return redirect($reg);
        }
        return view('videoUpload');
    }

    public function store(Request $request){
        $user = auth()->user();
        $request->validate([
            'name' => 'required:max:255',
            'desc' => 'required'
          ]);
            $video = $request->file('video');
            $preview = $request->file('preview');

            if ($request->hasFile('video')){
                return 'hello';
            }
            else {
                return 'world!';
            }
    }
}
