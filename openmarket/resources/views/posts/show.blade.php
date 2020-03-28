@extends('Layouts.layout')

@section('content')
    <br>
    <h1>welcome to using the model to fetch data from the database</h1>
    <br>
    <div class="btn btn-danger">
        <a href="/posts">back</a>
    </div>
    <hr>
    <h1>{{$posts->title}}</h1>
    <div class="card">
            <img style="width:100%;" src="/storage/cover_image/{{$posts->cover_image}}">
    </div>
    <div>
            {!!$posts->body!!}
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $posts->user_id)
            <small> Written on {{$posts->created_at}} by {{$posts->user ? $posts->user->name : '-' }}</small><br>
            <a href="/posts/{{$posts->id}}/edit" class="btn btn-outline-success my-2 my-sm-0">
            Edit</a>
            {!!Form::open(['action'=>['PostsController@destroy',$posts->id],'method'=>'POST','class'=>'btn pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection