<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Support\Facades\Storage;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('type', '1')->orderBy('am_of_likes', 'desc')->get();
        return view('video', ['videos' => $videos]);
    }

    public function showAll()
    {
        if (auth()->user()->role == 'admin') {
            $videos = Video::orderBy('am_of_likes', 'desc')->get();
            return view('video', ['videos' => $videos]);
        }
        else {
            return "Access Denied!";
        }
    }

    public function preview($id)
    {
        $filePath = $id.'\preview.png';
        return response()->file(storage_path('\app\public\videos'.DIRECTORY_SEPARATOR.($filePath)));
    }

    public function videoView($id)
    {
        if (Auth::guest()){
            $user = 'guest';
        }
        else {
            $user = Auth::user()->id;
        }
        $comments = Comment::where('video_id', $id)->with('user')->orderBy('created_at', 'desc')->get();
        $video = Video::where('id', $id)->first();
        if ($video->type == '0'){
            if (auth()->user()->role != 'admin'){
                if (auth()->user()->id != $video->users_id){
                    return "Access Denied!";
                }
            }
    }
        return view('videoView', ['video' => $video, 'comments' => $comments, 'user' => $user] );
}

    public function video($id){
        $filePath = $id.'/video.mp4';
        return response()->file(storage_path('/app/public/videos'.DIRECTORY_SEPARATOR.($filePath)));
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
        $user_id = auth()->user()->id;
        $request->validate([
            'name' => 'required:max:255',
            'desc' => 'required'
          ]);

          $video = new Video();
          $user = User::where('id', $user_id)->first();
          $video->Users()->associate($user);
          $video->name = $request->name;
          $video->type = $request->type;
          $video->category = $request->category;
          $video->desc = $request->desc;
          $video->am_of_likes = '0';
          $video->save();
            $video_file = $request->file('video');
            $preview = $request->file('preview');

            Storage::disk('local')->putFileAs(
                '/public/videos/'.$video->id,
                $video_file,
                'video.mp4'
              );
            Storage::disk('local')->putFileAs(
                '/public/videos/'.$video->id,
                $preview,
                'preview.png'
              );
              return redirect('/');

    }

    public function like($id, Request $request){
        $video = Video::where('id', $id)->first();
        if ($request->val == 1){
            $video->increment('am_of_likes');
        }
        else {
            $video->decrement('am_of_likes');
        }

    }

    public function getlikes($id){
        return $video = Video::where('id', $id)->first()->am_of_likes;
    }

    public function delete($id){
        $user_id = auth()->user()->id;
        $video = Video::where('id', $id)->first();
        if (Auth::guest()){
            $reg = '/register';
            return redirect($reg);
        }
        if (auth()->user()->type != 'admin'){
            if ($user_id != $video->users_id){
                return "Access Denied!";
            }
        }
        Storage::disk('local')->deleteDirectory('/public/videos/'.$id);
        Video::where('id', $id)->delete();
        return redirect('/home');
    }

    public function edit($id) {
        if (Auth::guest()){
            $reg = '/register';
            return redirect($reg);
        }
        $video = Video::where('id', $id)->first();
        return view('editVideo', ['video' => $video]);
    }

    public function update($id, Request $request) {
        $user_id = auth()->user()->id;
        $video = Video::where('id', $id)->first();
        if (auth()->user()->type != 'admin'){
            if ($user_id != $video->users_id){
                return "Access Denied!";
            }
        }
        $request->validate([
            'name' => 'required:max:255',
            'desc' => 'required'
          ]);
          $video->name = $request->name;
          $video->type = $request->type;
          $video->category = $request->category;
          $video->desc = $request->desc;
          $video->save();

          return redirect('/');
    }
}
