@extends('Layouts.layout')

@section('content')<br>
<div class=" card" style="width:30%;float:right;height:400px;">
        <nav id="sidebar">
        <div class="col-md-8 col-sm-8">
                <div class="sidebar-header">
                        <h3>Bootstrap Sidebar</h3>
                        <strong>BS</strong>
                </div>
                <ul class="list-unstyled components">
                        <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-home"></i>
                                Home
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li>
                                <a href="#">Home 1</a>
                                </li>
                                <li>
                                <a href="#">Home 2</a>
                                </li>
                                <li>
                                <a href="#">Home 3</a>
                                </li>
                        </ul>
                        </li>
                        <li>
                        <a href="#">
                                <i class="fas fa-briefcase"></i>
                                About
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-copy"></i>
                                Pages
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li>
                                <a href="#">Page 1</a>
                                </li>
                                <li>
                                <a href="#">Page 2</a>
                                </li>
                                <li>
                                <a href="#">Page 3</a>
                                </li>
                        </ul>
                        </li>
                </ul>
        </div>
        </nav>
</div>
<div class="card" style="width:60%;background:silver;padding:20px;">
        <h1>Create a post</h1>
        {!! Form::open(['action'=> ['PostsController@update',$posts->id],'method'=>'POST' ,'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title',$posts->title,['class'=>'form-control','placeholder'=>'title'])}}
        </div>
        <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body',$posts->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'content body'])}}
                </div>
                <div class="form-group">
                                {{Form::file('cover_image')}}
                        </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
</div>
@endsection