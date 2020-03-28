@extends('layouts.app')

@section('content')
<br>
<h3>Your search for "{{Request::input('query')}}"</h3>
    <div class="row">
        @if(!$users->count())
            <p>No results found,Sorry.</p>
        @else
            <div class="row">
                <div class="col-lg-12">
                    @foreach($users as $user)
                        @include('user/partials/userblock')
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection