@extends('layouts.layout')

@section('content')
<br>
<div class="row">
    <div class="col-md-3">
    <h3 style="text-align:center;background-color:#fff;">@{{msg}}</h3>
    </div>

    <div class="col-md-7">
        <h3 style="text-align:center;background-color:#fff;">center bar</h3>
    </div>

    <div class="col-md-2">
        <h3 style="text-align:center;background-color:#fff;">Left sidebar</h3>
    </div>
</div>
@endsection