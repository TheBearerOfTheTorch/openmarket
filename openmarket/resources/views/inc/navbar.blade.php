<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dar" id="background">
    <h2>{{ config('app.name', 'openmarket') }} </h2>
    <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
            </button>

            @guest
            
            @else
            
                <!-- Home link-->
                <a class="navbar-brand" href="{{ url('/') }}">
                Home
                </a>
                 <!-- Home link-->
                 <a class="navbar-brand" href="{{ url('/friends') }}">
                    Friends
                </a>
                <!-- create post link-->
                <a class="navbar-brand" href="/posts/create" >Create Post</a>

                <!-- create post link-->
                <a class="navbar-brand" href="{{ url('/timeline') }}" >Timeline</a>
                
                @endguest
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-success my-2 my-sm-0 open" href="{{ route('login') }}">{{ __('Login  ') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="btn btn-outline-success my-2 my-sm-0 open" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                <!-- The search area-->
                <form class="navbar-form navbar-left" role="search" action="{{route('search.results')}}">
                        <button type="submit" class="btn btn-default" style="float:right;">Search</button>
                    <div class="form-group" style="width:500px;padding-right:80px">
                        <input type="text" name="query" class="form-control" placeholder="Find people or your favourite stores">
                    </div>
                </form>
                <!-- The drop down that shows the name of the user and the logout. this showa that the user has been logged in-->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="/home" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a  href="/posts" class="dropdown-item">
                                {{ __('Postboard') }}
                            </a>
                                <!-- Edit profile link-->
                            <a class="dropdown-item" href="{{ url('profilePage') }}">
                                {{ __('Edit Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                    <!-- showing the user profile picture-->
                <div >
                        <img class="profile-image" src="/storage/ProfilePictures/{{Auth::user()->profile}}" style="width:50px;height:50px;position:absolute;top:5px;right:1px;border-radius:50%;" alt="profile-image"  class="profile-image">
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>
