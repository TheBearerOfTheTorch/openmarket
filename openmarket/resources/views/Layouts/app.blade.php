<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!--<link rel="stylesheet" href="{{asset('css/style1.css')}}">-->
        <link rel="stylesheet" href="{{asset('css/navStyle.css')}}">
        <link rel="icon" type="image/PNG" href="pic.PNG">
        <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Openmarket') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/navStyle.css')}}">
</head>
    <body>
            @include('inc.navbar')
        <div id="app">
            <div class="container">
                @include('inc.messages')
                @yield('content')
                <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace( 'article-ckeditor' );
                </script>
            </div>
        </div>
    </body>
</html>