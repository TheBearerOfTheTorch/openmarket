@extends('layouts.app')

@section('content')
    @foreach($allUsers_jully as $allUsers_jaydee)
    {{$allUsers_jaydee->id}}
    @endforeach
@endsection
 