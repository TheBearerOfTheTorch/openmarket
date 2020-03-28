@extends('layouts.layout')

@section('content')
<br>
<div class="row">
    <div class="col-lg-6">
        <h4>Your friends</h4>
        <!-- user information and status-->
        @if(!$friends->count())
            <p>You have no friends</p>
        @else
            @foreach($friends as $user)
                @include('user/partials/userblock')
            @endforeach
        @endif
        
    </div>
    <div class="col-lg-6">
            <h4>Friend request</h4>
        <!-- friend, friend requests-->
        @if(!$requests->count())
            <p>You have no friend requests</p>
        @else
            @foreach($requests as $user)
                @include('user.partials.userblock')
            @endforeach
        @endif
    </div>
</div>
@endsection