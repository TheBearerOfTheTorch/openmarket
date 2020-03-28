@extends('layouts.app')

@section('content')
<br>
<h3>Update your Extended information</h3>
<div class="row">
    <div class="col-lg-6">
    <form class="form-vertical" role="form" method="post" action="{{route('profile.edit')}}">
            <div class="row">
                <!-- screen name-->
                <div class="col-lg-6">
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">Username</label>
                    <input type="text" name="name" class="form-control" id="name" 
                    value="{{Request::old('name') ?: Auth::user()->name}}">
                    @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}
                    @endif
                    </div>
                </div>
            
                <!-- political_view zanna-->
                <div class="col-lg-6">
                    <div class="form-group {{$errors->has('political_view') ? 'has-error' : ''}}">
                        <label for="political_view" class="control-label">Political view</label>
                        <input type="text" name="political_view" class="form-control" id="political_view" 
                        value="{{Request::old('political_view') ?: Auth::user()->political_view}}">
                        @if($errors->has('political_view'))
                            <span class="help-block">{{$errors->first('political_view')}}
                        @endif
                    </div>
                </div>
                <!-- interest kappa zanna-->
                <div class="col-lg-12">
                    <div class="form-group {{$errors->has('interest') ? 'has-error' : ''}}">
                        <label for="interest" class="control-label">Interest</label>
                        <input type="text" name="interest" class="form-control" id="interest" 
                        value="{{Request::old('interest') ?: Auth::user()->interest}}">
                        @if($errors->has('interest'))
                        <span class="help-block">{{$errors->first('interest')}}
                    @endif
                    </div>
                </div>
                <!-- button-->
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>
@endsection