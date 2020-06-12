@extends('layouts.app')
@section('content')

<div class="container" margin="200px">
    <div class="row">
        <video class="col-8" controls controlsList="nodownload">
            <source src="/videos/{{$video->id}}/video" type="video/mp4">
          Your browser does not support the video tag.
          </video>
          <div class="col bg-dark">
            commentsection
        </div>
    </div>
    <div class="row">
    <div class="col">
        <br/>
        <h2>{{$video->name}}</h2>
        <p>{{$video->desc}}</p>
    </div>
    <div class="row">
        <div class="col">
            <br/>
        <h6>Likes: {{$video->am_of_likes}}</h6>
        <button class="btn btn-light btn-sm">Like</button>
        </div>
    </div>
    </div>
</div>

@endsection
