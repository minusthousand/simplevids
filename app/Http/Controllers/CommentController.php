<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function show($id){
        $comments = Comment::where('video_id', $id)->get();
        return ['comments' => $comments];
    }
}
