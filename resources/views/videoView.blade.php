@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function getPlaylistId($name){
        id = jQuery.ajax({
            type:"POST",
            url:"/getId",
            data: {name: $name, _token: CSRF_TOKEN },
            dataType: "html",
            async: false,
            success: function(data) { console.log("success"); },
            error: function(ts) { console.log(ts.responseText); },
            complete: function(data) {console.log(data); }
        }).responseText;
        return id;
    }

    function getLikes(){
        var likes = jQuery.ajax({
            type:"POST",
            url:"/video/"+{{$video->id}}+"/getlikes",
            data: { _token: CSRF_TOKEN },
            dataType: "html",
            async: false,
            success: function(data) { console.log("success"); },
            error: function(ts) { alert(ts.responseText); },
            complete: function(data) {console.log(data); }
        }).responseText;
        return likes;
    }

    function checkStatus($id){
        $.post("/playlist/"+$id+"/check", { id: {{$video->id}}, _token: CSRF_TOKEN }, function(data) {
            if (data){
                $("#like").attr('class', 'btn btn-light btn-sm');
            }
            else {
                $("#like").attr('class', 'btn btn-success btn-sm');
            }
        });
    }

    var likedId = getPlaylistId('Liked Videos');
    checkStatus(likedId);

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
             $.post("/video/{{$video->id}}/comment", { content: $('#text').val(), user: user, _token: CSRF_TOKEN }, function(data) {
                var dt = new Date().toISOString().slice(0,19);
                dt = dt.replace('T', ' ');
                $('#comments').prepend('<div class="media"><div class="media-body"><span class="text-muted pull-right"><small class="text-muted">'+dt+'</small> </span><strong class="text-success">You</strong><p>'+$('#text').val()+'</p></div></div>')
        });
        }
    });
    $("#like").click(function () {
        if ('{{$user}}' == 'guest'){
            window.location.href = '/login';
        }
        else {
        $.post("/playlist/"+likedId, { id: {{$video->id}}, _token: CSRF_TOKEN }, function() {
            checkStatus(likedId);
            if ($("#like").attr('class') == 'btn btn-light btn-sm'){
                $.post("/video/"+{{$video->id}}+"/likes", {val: 1, _token: CSRF_TOKEN }, function(){
                    $("#likes").html('{{__("messages.Likes: ")}}');
                    $("#likes").append(getLikes());

                })
            }
            else if ($("#like").attr('class') == 'btn btn-success btn-sm'){
                $.post("/video/"+{{$video->id}}+"/likes", {val: 0, _token: CSRF_TOKEN }, function(){
                    $("#likes").html('{{__("messages.Likes: ")}}');
                    $("#likes").append(getLikes());
                })
            }
        });
    }
    });
});
</script>
<div class="container" margin="200px">
    <div class="row">
        <video class="col" controls controlsList="nodownload">
        <source src="{{url('videos')}}/{{$video->id}}/video" type="video/mp4">
          Your browser does not support the video tag.
          </video>
        </div>
    <div class="row">
    <div class="col">
        <br/>
        <h2>{{$video->name}}</h2>
            @guest
            @else
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle float-right text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ __('messages.Options') }}</a>
            <div class="dropdown-menu dropdown-menu-right bg-dark">
            <a class="dropdown-item bg-dark text-white " href="addtoplaylist">
                {{ __('messages.Add_To_Playlist') }}
            </a>
            @if (Auth::user()->id == $video->users_id || auth()->user()->role == 'admin')
            <a class="dropdown-item bg-dark text-white " href="delete">
                {{ __('messages.Delete') }}
            </a>
            <a class="dropdown-item bg-dark text-white " href="edit">
                {{ __('messages.Edit') }}
            </a>
            @endif
            <a class="dropdown-item bg-dark text-white " href="report">
                {{ __('messages.Report') }}
            </a>
        </div>
    </div>
            @endguest
        <p style="white-space: pre-line;">{{$video->desc}}</p>
        <h6 id="likes">{{__("messages.Likes: ")}}{{$video->am_of_likes}}</h6>
        <button id="like" class="btn btn-light btn-sm">{{__("messages.Like")}}</button>
    </div>
</div>
    <br><br>
<h3>{{__("messages.Comment_Section")}}</h3>
<p id="error" style="color: red"></p>
<div class="row bootstrap snippets">
    <div class="col">
        <div class="comment-wrapper">
                <div class="panel-body">
                <textarea id="text" class="form-control" placeholder="{{__("messages.Comment_Holder")}}" rows="2"></textarea>
                    <br>
                    <button id="post" type="button" class="btn btn-info pull-right">{{__("messages.Post")}}</button>
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
                                @guest
                                @elseif (($comment->user_id == auth()->user()->id) || auth()->user()->role == 'admin')
                                <br>
                                <span class="text-muted pull-right">
                                    <a href="/video/{{$video->id}}/comment/{{$comment->id}}/delete" style="text-decoration: none"><small class="text-danger">{{__("messages.Delete")}}</small></a>
                                </span>
                                @endguest
                                <span style="white-space: pre-line;">
                                {{$comment->text}}
                                </span>
                                <br>
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
