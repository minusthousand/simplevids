@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#post").click(function () {
        if ('{{$user}}' == 'guest'){
            window.location.href = '/login';
        }
        else if ($('#text').val() == '') {
            $('#text').css("border","1.5px solid red");
            $('#error').append("Oops, it seems like you didn't write anything.");
        }
        else {
            $('#text').css("border","0");
            $('#error').html('');
            const user = {{($user)}};
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             $.post("/video/{{$video->id}}/comment", { content: $('#text').val(), user: user, _token: CSRF_TOKEN }, function(data) {
                var dt = new Date().toISOString().slice(0,19);
                dt = dt.replace('T', ' ');
                $('#comments').prepend('<div class="media"><div class="media-body"><span class="text-muted pull-right"><small class="text-muted">'+dt+'</small> </span><strong class="text-success">You</strong><p>'+$('#text').val()+'</p></div></div>')
        });
        }
    })
});
</script>
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
<p id="error" style="color: red"></p>
<div class="row bootstrap snippets">
    <div class="col">
        <div class="comment-wrapper">
                <div class="panel-body">
                    <textarea id="text" class="form-control" placeholder="write a comment..." rows="2"></textarea>
                    <br>
                    <button id="post" type="button" class="btn btn-info pull-right">Post</button>
                    <div class="clearfix"></div>
                    <hr>
                    <div id="comments" class="media-list">
                        @foreach($comments as $comment)
                        <div class="media">
                            <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted">{{$comment->created_at}}</small>
                                </span>
                                <strong class="text-success">{{$comment->user->name}}</strong>
                                <p>
                                {{$comment->text}}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
