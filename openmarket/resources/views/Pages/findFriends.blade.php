@extends('layouts.layout')

@section('content')
<br>
<div class="container">
    <div class="column">
        <div class="card" style="width:40%;" >
            <div class="card-body">
                    @foreach($allUsers_jully as $allUsers_jaydee)
                    <div class="card row caption" >
                        <div >
                            <div style="text-align: center;">
                                <h2 style="padding:10px;border:0.5px;"><a href="#">{{$allUsers_jaydee->name}}</a></h2>
                            </div>
                            <div style="margin-left:130px">
                                <img src="/storage/profilePictures/{{$allUsers_jaydee->profile}}" alt="profile-image"   
                                style="width:150px;height:150px;border-radius:50%;"> 
                            </div>
                            <div style="margin-left:120px;padding:20px">
                            <p><a href="{{url('/')}}/addFriend/{{$allUsers_jaydee->id}}" class="btn btn-success" style="background:maroon;">Add to friends</a></p>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
        <br>
    </div>
</div>
@endsection