@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card bg-dark">
                <div class="card-header">{{ __('messages.Create_Report') }}</div>
                <div class="card-body">
                <form method="POST" action="{{ route('storeReport')}}" aria-label="{{ __('messages.Create_Report') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" style="display: none" name="video" value="{{$video_id}}"></imput>
                        <div class="input-group-text bg-dark row" style="border:none;">
                            <label for="reason" class="col-sm-4 col-form-label text-md-right" style="color:white;">{{ __('messages.Reason') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select"  id="reason" name="reason">
                                    <option value="Violence">{{ __('messages.Violence') }}</option>
                                    <option value="Racism">{{ __('messages.Racism') }}</option>
                                    <option value="Adult">{{ __('messages.Adult_Content') }}</option>
                                    <option value="Illegal">{{ __('messages.Illegal_Actions') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;margin-top:20px;">
                                    {{ __('messages.Report') }}
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

