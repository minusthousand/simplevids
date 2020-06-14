@extends('layouts.app')
@section('content')

<div class="container" margin="200px">
@foreach ($videos as $video)
<div class="media">
    <a href="/videos/{{$video->video->id}}/videoview"><img class="align-self-center mr-3" src="/videos/{{$video->video->id}}/preview" alt="sorry" height="180px" width="320px"></a>
    <div class="media-body">
        <a href="/videos/{{$video->video->id}}/videoview" style="text-decoration:none; color: white;">
        <h2>{{$video->video->name}}</h2>
        </a>
        <p>{{$video->video->desc}}</p>
        <br/>
        <h6>{{__('messages.Likes: ')}} {{$video->video->am_of_likes}}</h6>
    </div>
</div>
<br/>
<br/>
@endforeach
</div>
@endsection
