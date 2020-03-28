@extends('Layouts.app')

@section('content')
<br>
<div>
    <div class="container">
            @if(count($posts) >0)
                @foreach($posts as $post)
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <img class="profile-image" src="/storage/ProfilePictures/{{Auth::user()->profile}}" style="width:40px;height:40px;position:absolute;top:4px;right:10px;border-radius:50%;">
                                    {{$post->user ? $post->user->name : '-' }}
                            </div>
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                    <img style="width:100%" src="/storage/cover_image/{{$post->cover_image}}">
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                            <small> Written on {{$post->created_at}} by {{$post->user ? $post->user->name : '-' }}</small>
                                            <hr>
                                            <p>the icons for liking and disliking will later come here plus emoji</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @endforeach
                {{$posts->links()}}
            @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                                <div class="card-header">
                                        <p>no posts found</p>
                                </div>
                                <div class="card card-body">
                                    <hr>
                                        <p>the icons for liking and disliking will later come here plus emoji</p>
                                </div>
                        </div>
                    </div>
                </div>
            @endif
        @endsection
    </div>
</div>

