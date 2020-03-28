<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style1.css')}}">
    
    </head>
    <body>
        <div class="content">
            <div class="heade-content">
                <h1>OPENMARKET</h1>
            </div>
            <div class="body-content">
                <div class="header">
                      <h1>Login</h1>
                </div>
                @include('inc.messages')
                @yield('content')
            </div>
        </div>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
    </body>
</html>