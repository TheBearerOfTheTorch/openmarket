@extends('layouts.layout')

@section('content')
<br>
<div class="row">
    <div class="col-lg-6">
    <form role="form" action="{{route('status.post')}}" method="POST">
    <div class="form-group{{$errors->has('status') ? 'has-error' : ''}}">
                <textarea placeholder="What's up {{Auth::user()->getFirstNameOrUsername()}}?" name="status" class="form-control" row="2"></textarea>
                @if($errors->has('status'))
                    <span style="border-color: red;color:red;" class="help-block">{{$errors->first('status')}}
                @endif
            </div>
            <button type="submit" class="btn btn-default">Update status</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
        <hr>
    </div>
</div>
<div class="row">
    <!-- timeline statuses and replies-->
    <div class="col-lg-5">
        @if(!$statuses->count())
            <p>Theres nothing in your timeline ,yet.</p>
        @else
            @foreach($statuses as $status)
                <div class="media">
                <a class="pull-left" href="{{route('friend.index',['name'=>$status->name])}}">
                    <img class="media-object" alt="{{$status->user->getNameOrUsername()}}" src="/storage/profilePictures/{{$status->user->profile}}" style="width:40px;height:40px;">
                    </a>
                    <div class="media-body">
                        <!--showing status-->
                        <h4 class="media-heading"><a href="{{route('friend.index',['name'=>$status->name])}}">{{$status->user->getNameOrUsername()}}</a></h4>
                        <p> {{$status->body}}</p>
                        <ul class="list-inline">
                            <!-- make to stay in one line-->
                            <span>
                                <li>{{$status->created_at->diffForHumans()}}</li>
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{route('status.like',['statusId'=> $status->id])}}">like</a></li>
                                @endif
                                <li>
                                    {{$status->likes->count()}} {{str_plural('like',$status->likes->count())}}
                                </li>
                            </span>
                        </ul>
                        <!-- showing replies-->
                        @foreach($status->replies as $reply)
                            <div class="media">
                                <a class="pull-left" href="{{route('friend.index',['name'=>$reply->name])}}">
                                    <img class="media-object" alt="{{$reply->user->getNameOrUsername()}}" src="/storage/profilePictures/{{$reply->user->profile}}" style="width:40px;height:40px;"">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading"><a href="{{route('friend.index',['name'=>$reply->name])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
                                    <p>{{$reply->body}}</p>
                                    <ul class="list-inline">
                                        <li>{{$reply->created_at->diffForHumans()}}</li>
                                        @if($reply->user->id !== Auth::user()->id)
                                            <li><a href="{{route('status.like',['statusId'=> $reply->id])}}">like</a></li>
                                        @endif
                                        <li>
                                            {{$reply->likes->count()}} {{str_plural('like',$reply->likes->count())}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <!-- replies side field-->
                    <form role="form" action="{{route('status.reply',['statusId'=> $status->id])}}" method="POST">
                    <div class="form-group{{$errors->has("reply-{$status->id}") ? 'has-error' : ''}}">
                            <textarea name="reply-{{$status->id}}" class="form-control" row="2" 
                                placeholder="Reply to this status"></textarea>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                @if($errors->has("reply-{$status->id}"))
                                    <span style="color:red" class="help-block">{{$errors->first("reply-{$status->id}")}}</span>
                                @endif
                            </div>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </form>
                    </div>
                </div>
            @endforeach
            {!!$statuses->render() !!}
        @endif
    </div>
</div>
@endsection