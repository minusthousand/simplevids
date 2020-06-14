<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Video;
use Auth;

class CommentController extends Controller
{
    public function store($id, Request $request){
        $comment = new Comment();
        $video = Video::where('id', $id)->first();
        $user = User::where('id', $request->user)->first();
        $comment->User()->associate($user);
        $comment->Video()->associate($video);
        $comment->text = $request->content;
        $comment->save();
    }
}
