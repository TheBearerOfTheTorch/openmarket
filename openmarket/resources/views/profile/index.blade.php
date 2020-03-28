@extends('layouts.app')

@section('content')
<br>
    <div class="row">
        <div class="col-lg-5">
            <!-- user information and status-->
            @include('user.partials.userblock')
            <hr>
            <!-- the pasted code went here-->
            @if(!$statuses->count())
                <p>{{$user->getFirstNameOrUsername()}} haven't posted anything ,yet.</p>
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
                                <span>
                                 <li>{{$status->created_at->diffForHumans()}}</li>
                                </span>
                            </ul>
                            <!-- showing replies-->
                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a class="pull-left" href="{{route('friend.index',['name'=>$reply->name])}}">
                                        <img class="media-object" alt="{{$reply->user->getNameOrUsername()}}" src="/storage/profilePictures/{{$reply->user->profile}}" style="width:40px;height:40px;">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{route('friend.index',['name'=>$reply->name])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
                                        <p>{{$reply->body}}</p>
                                        <ul class="list-inline">
                                            <li>{{$reply->created_at->diffForHumans()}}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li><a href="{{route('status.like',['statusId'=> $reply->id])}}">like</a></li>
                                        <li>{{$reply->likes->count()}} {{str_plural('like',$reply->likes->count())}}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            <!-- showing this if the the user and the logged are friends-->
                            @if($authUserIsFriend || Auth::user()->id === $status->user->id)
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
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            <!-- friend, friend requests-->
            <!-- checking if there any pending requests-->
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>waiting for {{$user->getNameOrUsername()}} to accept your friend request</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
            <!-- checking if the friend request has been received-->
                <a href="{{route('friend.accept',['name'=>$user->name])}}" class="btn btn-primary">Accept friend request</a>

            @elseif(Auth::user()->isFriendsWith($user))
            <!-- dixa zanna checking if they are already friends with the user-->
                <p> You and {{$user->getNameOrUsername($user)}} are friends</p>
            @elseif(Auth::user()->id !== $user->id)
                <a href="{{route('friend.add',['name'=>$user->name])}}" class="btn btn-primary">Add as friend</a>
            @endif

            <h4>{{$user->getFirstNameOrUsername()}}'s friends</h4>
            <!-- checking if we have any friends-->
            @if(!$user->friends()->count())
                <p>{{$user->getFirstNameOrUsername()}} has no friends</p>
            @else
                @foreach($user->friends() as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@endsection