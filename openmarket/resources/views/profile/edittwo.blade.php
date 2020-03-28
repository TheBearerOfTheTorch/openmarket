@extends('layouts.app')

@section('content')
<br>
<h3>Update your Basic information</h3>
<div class="row">
    <div class="col-lg-6">
    <form class="form-vertical" role="form" method="post" action="{{route('profile.edittwo')}}">
            <div class="row">
                <!-- for date of birth  zanna-->
                <div class="col-lg-6">
                <div class="form-group {{$errors->has('date_of_birth') ? 'has-error' : ''}}">
                        <label for="date_of_birth" class="control-label">Date of birth</label>
                    <input type="text" name="date_of_birth" class="form-control" id="date_of_birth" 
                    value="{{Request::old('date_of_birth') ?: Auth::user()->date_of_birth}}">
                    @if($errors->has('date_of_birth'))
                        <span class="help-block">{{$errors->first('date_of_birth')}}
                    @endif
                    </div>
                </div>
            
                <!-- for concentration zanna-->
                <div class="col-lg-6">
                        <label for="concentration" class="control-label">Concentration</label>
                        <input type="text" name="concentration" class="form-control" id="concentration" 
                        value="{{Request::old('concentration') ?: Auth::user()->concentration}}">
                </div>
                <!-- phone_number dixa....zanna-->
                <div class="col-lg-6">
                    <div class="form-group {{$errors->has('phone_number') ? 'has-error' : ''}}">
                        <label for="phone_number" class="control-label">phone number</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" 
                        value="{{Request::old('phone_number') ?: Auth::user()->phone_number}}">
                        @if($errors->has('phone_number'))
                        <span class="help-block">{{$errors->first('phone_number')}}
                    @endif
                    </div>
                </div>
                 <!-- high_school zanna-->
                 <div class="col-lg-6">
                    <div class="form-group {{$errors->has('high_school') ? 'has-error' : ''}}">
                        <label for="high_school" class="control-label">High school</label>
                        <input type="text" name="high_school" class="form-control" id="high_school" 
                        value="{{Request::old('high_school') ?: Auth::user()->high_school}}">
                        @if($errors->has('high_school'))
                            <span class="help-block">{{$errors->first('high_school')}}
                        @endif
                    </div>
                </div>
                 <!-- university zanna-->
                 <div class="col-lg-12">
                    <div class="form-group {{$errors->has('university') ? 'has-error' : ''}}">
                        <label for="university" class="control-label">University</label>
                        <input type="text" name="university" class="form-control" id="university" 
                        value="{{Request::old('university') ?: Auth::user()->university}}">
                        @if($errors->has('university'))
                            <span class="help-block">{{$errors->first('university')}}
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