@extends('layouts.app')
@section('content')

<div class="container" margin="200px">
    <div class="row">
        <video class="col" controls controlsList="nodownload">
            <source src="/videos/{{$video->id}}/video" type="video/mp4">
          Your browser does not support the video tag.
          </video>
        </div>
    <div class="row">
    <div class="col">
        <br/>
        <h2>{{$video->name}}</h2>
        <p>{{$video->desc}}</p>
        <h6>Likes: {{$video->am_of_likes}}</h6>
        <button class="btn btn-light btn-sm">Like</button>
    </div>
</div>
    <br><br>
<h3>Comment section</h3>
<div class="row bootstrap snippets">
    <div class="col-sm-10">
        <div class="comment-wrapper">
                <div class="panel-body">
                    <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>
                    <br>
                    <button type="button" class="btn btn-info pull-right">Post</button>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">
                        @foreach($comments as $comment)
                        <li class="media">
                            <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted">{{$comment->created_at}}</small>
                                </span>
                                <strong class="text-success">{{$comment->user->name}}</strong>
                                <p>
                                {{$comment->text}}
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
