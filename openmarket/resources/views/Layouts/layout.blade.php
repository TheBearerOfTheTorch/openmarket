<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!--<link rel="stylesheet" href="{{asset('css/style1.css')}}">-->
        <link rel="stylesheet" href="{{asset('css/navStyle.css')}}">
        <title>Openmarket</title>
        <link rel="icon" type="image/PNG" href="pic.PNG">
        <script src="{{asset('js/jquery.min.js')}}"></script>

        <style>
            .pop-outer{
                background-color:rgda(0,0,0,0.5);
                position:fixed;
                top:0;
                left:0;
                width:100%;
                height:100%;
            }
            .pop-inner{
                background-color:maroon;
                width:500px;
                height:300px;
                padding:25px;
                margin:15% auto;
            }
            .main-timeline11{overflow:hidden;position:relative}
            .main-timeline11:before{content:"";width:7px;height:100%;background:#909090;position:absolute;top:0;left:50%;transform:translateX(-50%)}
            .main-timeline11 .timeline{width:50%;padding-left:50px;float:right;position:relative}
            .main-timeline11 .timeline:after,.main-timeline11 .timeline:before{position:absolute;content:"";top:50%;transform:translateY(-50%)}
            .main-timeline11 .timeline:before{width:30px;height:30px;border-radius:50%;background:#909090;border:7px solid #fff;left:-15px}
            .main-timeline11 .timeline:after{display:block;border-right:30px solid #ee4423;border-top:20px solid transparent;border-bottom:20px solid transparent;left:24px}
            .main-timeline11 .timeline-content{display:block;padding:25px;border-radius:100px;background:#ee4423;position:relative}
            .main-timeline11 .timeline-content:after,.main-timeline11 .timeline-content:before{content:"";display:block;width:100%;clear:both}
            .main-timeline11 .timeline-content:hover{text-decoration:none}
            .main-timeline11 .inner-content{width:70%;float:right;padding:15px 20px 15px 15px;background:#fff;border-radius:0 100px 100px 0;color:#ee4423}
            .main-timeline11 .year{display:inline-block;font-size:50px;font-weight:600;color:#fff;position:absolute;top:50%;left:7%;transform:translateY(-50%)}
            .main-timeline11 .title{font-size:24px;font-weight:600;text-transform:uppercase;margin:0 0 5px}
            .main-timeline11 .description{font-size:14px;margin:0 0 5px}
            .main-timeline11 .timeline:nth-child(2n){padding:0 50px 0 0}
            .main-timeline11 .timeline:nth-child(2n) .year,.main-timeline11 .timeline:nth-child(2n):before{left:auto;right:-15px}
            .main-timeline11 .timeline:nth-child(2n) .year{right:7%}
            .main-timeline11 .timeline:nth-child(2n):after{border-right:none;border-left:30px solid #ee4423;left:auto;right:24px;border-left-color:#f68829}
            .main-timeline11 .timeline:nth-child(2n) .inner-content{float:none;border-radius:100px 0 0 100px;text-align:right}
            .main-timeline11 .timeline:nth-child(2){margin-top:130px}
            .main-timeline11 .timeline:nth-child(odd){margin:-130px 0 0}
            .main-timeline11 .timeline:nth-child(even){margin-bottom:80px}
            .main-timeline11 .timeline:first-child,.main-timeline11 .timeline:last-child:nth-child(even){margin:0}
            .main-timeline11 .timeline:nth-child(2n) .timeline-content{background:#f68829}
            .main-timeline11 .timeline:nth-child(2n),.main-timeline11 .timeline:nth-child(2n) .inner-content{color:#f68829}
            .main-timeline11 .timeline:nth-child(3n) .timeline-content{background:#2991d0}
            .main-timeline11 .timeline:nth-child(3n),.main-timeline11 .timeline:nth-child(3n) .inner-content{color:#2991d0}
            .main-timeline11 .timeline:nth-child(3n):after{border-right-color:#2991d0}
            .main-timeline11 .timeline:nth-child(4n) .timeline-content{background:#9361aa}
            .main-timeline11 .timeline:nth-child(4n),.main-timeline11 .timeline:nth-child(4n) .inner-content{color:#9361aa}
            .main-timeline11 .timeline:nth-child(4n):after{border-left-color:#9361aa}
            .main-timeline11 .timeline:nth-child(5n) .timeline-content{background:#a7be26}
            .main-timeline11 .timeline:nth-child(5n),.main-timeline11 .timeline:nth-child(5n) .inner-content{color:#a7be26}
            .main-timeline11 .timeline:nth-child(5n):after{border-right-color:#a7be26}
            @media only screen and (max-width:1200px){.main-timeline11 .inner-content{width:80%}
            .main-timeline11 .year{font-size:45px;left:10px;transform:translateY(-50%) rotate(-90deg)}
            .main-timeline11 .timeline:nth-child(2n) .year{right:10px}
            }
            @media only screen and (max-width:990px){.main-timeline11 .year{font-size:40px;left:0}
            .main-timeline11 .timeline:nth-child(2n) .year{right:0}
            }
            @media only screen and (max-width:767px){.main-timeline11 .timeline:before,.main-timeline11:before{left:10px;transform:translateX(0)}
            .main-timeline11 .timeline:nth-child(2n):after{border-left:none;border-right:30px solid #ee4423;right:auto;left:24px;border-right-color:#f68829}
            .main-timeline11 .timeline,.main-timeline11 .timeline:nth-child(even),.main-timeline11 .timeline:nth-child(odd){width:100%;float:none;margin:0 0 30px}
            .main-timeline11 .timeline:last-child{margin-bottom:0}
            .main-timeline11 .timeline:nth-child(2n){padding:0 0 0 50px}
            .main-timeline11 .timeline:before,.main-timeline11 .timeline:nth-child(2n):before{left:-2px}
            .main-timeline11 .inner-content{width:85%}
            .main-timeline11 .timeline:nth-child(2n) .inner-content{float:right;border-radius:0 100px 100px 0;text-align:left}
            .main-timeline11 .timeline:nth-child(2n) .year{right:auto;left:0}
            .main-timeline11 .timeline:nth-child(3n):after{border-left-color:#2991d0}
            .main-timeline11 .timeline:nth-child(4n):after{border-right-color:#9361aa}
            .main-timeline11 .timeline:nth-child(5n):after{border-left-color:#a7be26}
            }
            @media only screen and (max-width:479px){.main-timeline11 .timeline-content{padding:15px}
            .main-timeline11 .inner-content{width:80%}
            .main-timeline11 .year{font-size:30px}
            }
</style>

    </head>
    <body>
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
                @yield('content')
            </div>
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
        </div>
        <script src="resource/js/app.js"></script>
    </body>
</html>

