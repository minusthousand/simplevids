@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        @foreach($playlists as $playlist)
        $("#{{$playlist->id}}").click(function () {
            $.post("/playlist/"+{{$playlist->id}}, { id: {{$video_id}}, _token: CSRF_TOKEN }, function() {
                window.location.href = '/playlist/'+'{{$playlist->id}}';
            });
        });
        @endforeach
    });
    </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">{{__("messages.Add_To_Playlist")}}</div>
                <div class="card-body">
                    <div class="row">
                        <a href="/newplaylist" style="text-decoration:none; color: white; margin: 20px;">
                            <h5 style="padding-left: 30px;">
                                {{__("messages.Create_New_Playlist")}}
                            </h5>
                </a>
                    </div>
                    @foreach ($playlists as $playlist)
                <div class="row">
                    <a id="{{$playlist->id}}" href="#" style="text-decoration:none; color: white; margin: 20px;">
                        <h5 style="padding-left: 30px;">
                            {{__("messages.Add_To")}} {{$playlist->name}}
                        </h5>
                    </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
