@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">{{ __('messages.Create_Playlist') }}</div>
                <div class="card-body">
                <form method="POST" action="{{ route('storePlaylist')}}" aria-label="{{ __('messages.Create_Playlist') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus />
                            </div>
                        </div>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="type" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('messages.Type') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="type" name="type">
                                    <option value="1">{{ __('messages.Public') }}</option>
                                    <option value="2">{{ __('messages.Private') }}</option>
                                </select>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;margin-top:20px;">
                                    {{ __('messages.Create_Playlist') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

