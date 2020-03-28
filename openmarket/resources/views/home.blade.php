@extends('layouts.app')

@section('content')
<br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                        <div >
                            <img class="profile-image" src="/storage/ProfilePictures/{{Auth::user()->profile}}" style="width:50px;height:50px;position:absolute;top:6px;right:10px;border-radius:50%;" alt="profile-image"  class="profile-image">
                        </div>
                            <a href="/posts/create" class="btn btn-default">Create Post</a>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <h3> You are logged in!</h3>

                   <!--statuses placed here-->
                   

                   <table class="table table-striped">
                       <th>Title</th>
                       <th></th>
                       <th></th>
                       <div class="col-md-4 col-sm-4">
                            <tr>
                                   
                            </tr>
                        </div>
                            
                      
                   </table>
                </div>
            </div>
        </div>
    </div>
@endsection