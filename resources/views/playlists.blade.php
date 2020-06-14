@extends('layouts.app')
@section('content')
<div class="container" margin="200px">
@foreach ($playlists as $playlist)
<div class="media">
    <a href="/playlist/{{$playlist->id}}" style="text-decoration:none; color: black;">
        <div class="row text-center">
            <div class="col-md-3 text-center my-auto">
              <div class="card card-block d-flex" style="height: 200px; width: 360px;">
                <h4 class="card-body align-items-center d-flex justify-content-center">
                  {{$playlist->name}}
                </h4>
              </div>
            </div>
          </div>
    </a>
    <div class="media-body">
        <a href="/playlist/{{$playlist->id}}" style="text-decoration:none; color: white;">
        <h2 style="padding-left: 20px">{{$playlist->name}}</h2>
        </a>
        @if ($playlist->name != 'Liked Videos')
        <a href="/playlist/{{$playlist->id}}/delete" style="text-decoration:none; color: white; padding-left: 20px;">
            <button type="button" class="btn btn-danger">{{__('messages.Delete')}}</button>
            </a>
            @endif
        <br/>
    </div>
</div>
<br/>
<br/>
@endforeach
</div>
@endsection
