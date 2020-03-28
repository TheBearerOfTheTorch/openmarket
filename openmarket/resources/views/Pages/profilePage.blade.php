@extends('layouts.layout')

@section('content')
<br>
<div class="container">
        <div class="card" style="width:65%;height:auto;float:right;">
        
                <div class="card-header" style="background:lightsalmon">
                        <div style="float:right;">
                        <a href="{{route('profile.edit')}}">[Edit]</a>
                           </div>
                   <label> Information</label>
                   
                </div>
                <div class="card-body">
                    <h2>Account information</h2>
                <label>first name           .......................{{Auth::user()->first_name}}</label><br>
                            <label>last name            ........................{{Auth::user()->last_name}}</label><br>
                            <label>Location            ..........................{{Auth::user()->location}}</label><br>
                            <label>member since         ................</label><br>
                            <label>last update          ......................{{Auth::user()->updated_at}}</label><br>
                    <hr>

                    <div style="float:right;">
                            <a href="{{route('profile.edittwo')}}">[Edit]</a>
                    </div>
                    <h2>Basic information</h2>
                    <label>email            ................................{{Auth::user()->email}}</label><br>
                    <label>status           ...............................</label><br>
                    <label>sex              ....................................{{Auth::user()->gender}}</label><br>
                    <label>birth             ..................................{{Auth::user()->date_of_birth}}</label><br>
                    <label>concentration    .................{{Auth::user()->concentration}}</label><br>
                    <label>phone            ................................phone_number</label><br>
                    <label>high school      ......................{{Auth::user()->high_school}}</label><br>
                    <label>university       .........................{{Auth::user()->university}}</label><br>
                    <hr>

                    <div style="float:right;">
                            <a href="{{route('profile.editthree')}}">[Edit]</a>
                    </div>
                    <h2>Extended information</h2>
                    <label>Screen name       ............... {{Auth::user()->name}}</label><br>
                    <label>political view       ...............{{Auth::user()->political_view}}</label><br>
                    <label>interest       .........................{{Auth::user()->interest}}</label><br>
                </div>
                
        </div>
    <div class="card" style="width:30%;">
        <div class="card-header" style="text-align:center;background:lightsalmon;">
            <label>Profile Picture</label>
        </div>
        <div class="card_body">
                <div style="margin:35px;">
                        <div class="col-md-8 col-sm-8">
                        <img src="/storage/profilePictures/{{$user->profile}}" alt="profile-image"   style="width:220px;height:220px;border-radius:50%;">
                            
                        </div>
                        
                </div>
                
        </div>
    </div>
    <br>
    <div class="card" style="width:30%;text-align:center;padding-top:5px;padding-left:20px;">
                <div class="col-md-8 col-sm-8">
                        <label>{{$user->name}}</label>
                </div>
            
    </div>
    <br>
    <div class="card" style="width:30%;">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                        <div style="padding:20px;">
                                <form enctype="multipart/form-data" action="/profilePage" method="POST">
                                    <label>Update profile Image</label>
                                    <input type="file" name="profile">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="submit" class="pull-right btn btn-sm " style="background:green; color:white;"> 
                                </form>
                        </div>
                </div>
            </div>
    </div>
    
</div>
@endsection