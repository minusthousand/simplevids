@extends('layouts.app')
@section('content')
<div class="container">
@foreach ($videos as $video)
<div class="media">
    <a href="/videos/{{$video->id}}/videoview"><img class="align-self-center mr-3" src="/videos/{{$video->id}}/preview" alt="sorry" height="180" width="320"></a>
    <div class="media-body">
        <a href="/videos/{{$video->id}}/videoview" style="text-decoration:none; color: white;">
        <h2>{{$video->name}}</h2>
        </a>
        <p style="white-space: nowrap;
        width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;">{{$video->desc}}</p>
        <br/>
        <h6>{{__("messages.Likes: ")}} {{$video->am_of_likes}}</h6>
    </div>
</div>
<br/>
<br/>
@endforeach
</div>
@endsection
