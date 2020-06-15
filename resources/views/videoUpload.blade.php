@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">{{__("messages.Video_Upload")}}</div>
                <div class="card-body">
                <form method="POST" action="{{ route('storeVideo')}}" aria-label="{{ __('messages.Upload') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group row ">
                        <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Video') }}</label>
                        <div class="col-md-6">
                            <input id="video" type="file" name="video" class="form-control bg-dark" style="border:none;color:white;" accept=".mp4" required>
                        </div>
                        </div>
                        <div class="form-group row ">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Video_Preview') }}</label>
                            <div class="col-md-6">
                                <input id="video" type="file" name="preview" class="form-control bg-dark" style="border:none;color:white;"  accept=".png" required>
                            </div>
                            </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus />
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desc" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="desc" cols="10" rows="10" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc" value="{{ old('overview') }}" required autofocus></textarea>
                            </div>
                        </div>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="type" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('messages.Type') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="type" name="type">
                                    <option value="1">{{ __('messages.Public') }}</option>
                                    <option value="0">{{ __('messages.Private') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="category" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('messages.Category') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="category" name="category">
                                    <option value="Nature">{{ __('messages.Nature') }}</option>
                                    <option value="Games">{{ __('messages.Games') }}</option>
                                    <option value="Funny">{{ __('messages.Funny') }}</option>
                                    <option value="Education">{{ __('messages.Education') }}</option>
                                    <option value="Music">{{ __('messages.Music') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;margin-top:20px;">
                                    {{ __('messages.Upload') }}
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

