@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">{{__("messages.Reports")}}</div>
                <div class="card-body">
                    @foreach ($reports as $report)
                <div class="row">
                    <a id="{{$report->id}}" href="/videos/{{$report->video_id}}/videoview" style="text-decoration:none; color: white; margin: 20px;">
                        <h5 style="padding-left: 30px;">
                             {{$report->video->name}}
                        </h5>
                        <p style="padding-left: 30px;">
                             {{$report->reason}}
                        </p>
                    </a>
                </div>
                <div class="row">
                    <a href="report/{{$report->id}}/delete" style="text-decoration: none; margin-left: 20px;">
                        <p class="text-danger" style="padding-left: 30px;">
                            {{__("messages.Delete")}}
                       </p>
                    </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
