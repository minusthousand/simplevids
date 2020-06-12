@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">Video Upload</div>
                <div class="card-body">
                <form method="POST" action="{{ route('storeVideo')}}" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group row ">
                        <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Video') }}</label>
                        <div class="col-md-6">
                            <input id="video" type="file" name="video" class="form-control bg-dark" style="border:none;color:white;" accept=".mp4" required>
                        </div>
                        </div>
                        <div class="form-group row ">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Video Preview') }}</label>
                            <div class="col-md-6">
                                <input id="video" type="file" name="preview" class="form-control bg-dark" style="border:none;color:white;"  accept=".png, .jpg, .jpeg" required>
                            </div>
                            </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>
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
                            <label for="desc" class="col-sm-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="desc" cols="10" rows="10" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" name="desc" value="{{ old('overview') }}" required autofocus></textarea>
                            </div>
                        </div>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="type" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('Type') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="type" name="type">
                                    <option value="1">Public</option>
                                    <option value="2">Private</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="category" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="category" name="category">
                                    <option value="Nature">Nature</option>
                                    <option value="Games">Games</option>
                                    <option value="Funny">Funny</option>
                                    <option value="Education">Education</option>
                                    <option value="Music">Music</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;margin-top:20px;">
                                    {{ __('Upload') }}
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

