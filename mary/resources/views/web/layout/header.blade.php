<!DOCTYPE html>
<html lang="{{ LaravelGettext::getLocale() }}"  dir="rtl" >
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Zawag</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/animate.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/droopmenu-rtl.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">--}}
    <link href="{{ url('/') }}/web/css/owl.carousel.min.css" rel="stylesheet">
{{--    <link href="{{ url('/') }}/web/css/nice-select.css" rel="stylesheet">--}}
    <link href="{{ url('/') }}/web/css/style.css" rel="stylesheet">


{{--    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/buttons.dataTables.min.css')}}">--}}
    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/plugins/noty/noty.min.js') }}"></script>

    <link href="{{ url('/') }}/web/css/flexslider-rtl-min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/flexslider.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/nice-select.css" rel="stylesheet">

    <style>
        .fa-heart{
            color: red;
        }
        .star-ratings-css {
            unicode-bidi: bidi-override;
            color: #c5c5c5;
            font-size: 29px;
            height: 25px;
            width: 120px;
            margin: 0 auto;
            position: relative;
            padding: 0;
            text-shadow: 0px 1px 0 #a2a2a2;
        }
        .star-ratings-css-top {
            color: #ffc107;
            padding: 0;
            position: absolute;
            z-index: 1;
            display: block;
            top: 0;
            right: 0;
            overflow: hidden;
        }
        .star-ratings-css-bottom {
            padding: 0;
            display: block;
            z-index: 0;
        }
        .star-ratings-sprite {
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
            font-size: 0;
            height: 21px;
            line-height: 0;
            overflow: hidden;
            text-indent: -999em;
            width: 110px;
            margin: 0 auto;
        }
        .star-ratings-sprite-rating {
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
            background-position: 0 100%;
            float: left;
            height: 21px;
            display: block;
        }
        .product-gallery #slider img{
            max-width:100% !important;
        }
        .rat {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 30px;
        }
        .rat label {
            position: absolute;
            top: 0;
            height: 100%;
            cursor: pointer;
        }

        .rat label:last-child {
            position: static;
        }

        .rat label:nth-child(1) {
            z-index: 5;
        }

        .rat label:nth-child(2) {
            z-index: 4;
        }

        .rat label:nth-child(3) {
            z-index: 3;
        }

        .rat label:nth-child(4) {
            z-index: 2;
        }

        .rat label:nth-child(5) {
            z-index: 1;
        }

        .rat label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rat label .icon {
            float: left;
            color: transparent;
        }

        .rat label:last-child .icon {
            color: #ccc;
        }

        .rat:not(:hover) label input:checked ~ .icon,
        .rat:hover label:hover input ~ .icon {
            color: #ffc107;
        }

        .rat label input:focus:not(:checked) ~ .icon:last-child {
            color: #ccc;
            text-shadow: 0 0 5px #09f;
        }

        .nice-select .list{
            position: relative;
            z-index: 9999;
        }
        .droopmenu-navbar{
            z-index: 0 !important;
        }
    </style>

    @stack('css')

    {{--parsleyjs  css file --}}
{{--    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">--}}

{{--    <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.css')}}">--}}


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header>
    <div class="top-header">
        <div class="top-orange-bar ">
            <div class="container">
                <div class="justify-content-between align-items-center d-flex">

                    <ul class="nav lang">


                        <li class="user-profile list-inline-item dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/ar.png" alt="">
                                {{_i('Language')}}
                            </a>
                            <div class="dropdown-menu animated" id="langs" aria-labelledby="userDropdown">
                                <ul class="list-unstyled">

                                </ul>
{{--                                <a class="dropdown-item" href="/lang/{{Config::get('laravel-gettext.supported-locales')[3]}}"> <img src="images/ar.png" alt="">--}}
{{--                                    {{_i('Arabic')}}--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item" href="/lang/{{Config::get('laravel-gettext.supported-locales')[1]}}"> <img src="images/en.png" alt="">--}}
{{--                                    {{_i('English')}}--}}
{{--                                </a>--}}

                            </div>
                        </li>

                    </ul>


                    <ul class="user-helper  nav ">
                        <li class="nav-item"><a href="{{route('get-story')}}" class="nav-link">{{_i('Stories')}}</a></li>
                        <li class="nav-item"><a href="{{route('get-onlineUser')}}" class="nav-link">{{_i('onlineUser')}}</a></li>
                        <li class="nav-item"><a href="{{route('profile-value','like')}}" class="nav-link">{{_i('My wish list')}}</a></li>


                    <ul class="user-helper nav">
                        @if(auth()->check())


                        <li class="user-profile list-inline-item dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{_i('Members area')}}
                            </a>
                            <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                @if (auth()->guard('web')->check() && !auth()->guard('web')->guest() )

                                    <a class="dropdown-item" href="{{route('profile-user')}}">{{_i('Profile')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>  {{--                                <div class="dropdown-divider"></div>--}}
                                @else
                                    <a class="dropdown-item" href="{{url('/register')}}"> {{_i('Register')}} </a>
                                    <a class="dropdown-item" href="{{url('/login')}}"> {{_i('Log In')}} </a>
                                @endif
                            </div>
                        </li>
                        @else
                            <li class="nav-item"><a href="{{url('/login')}}" class="nav-link"> {{_i('Login')}} </a></li>
                            @endif
                        <li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">  {{_i('Contact Us')}} </a></li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</header>

@push('js')
    <script>
        $(function(){
            $.ajax({
                url:"{{route('web.languages')}}",
                success:(res)=>{
                    console.log(res);
                    if(res == null) return false;
                    $('#langs').html('');
                    res.forEach(lang => {
                        $('#langs').append(`<form action="{{url('change_language')}}" id="getLang" method="get">
                    <input type="hidden" name="selLanguage" value="${lang.name}"/>
                    <a href="javascript:{}" onclick="document.getElementById('getLang').submit();" class="dropdown-item">${lang['name']}</a></form>`);
                    });
                },
                error:(err)=>{
                    console.log(err);
                }
            });
        });
    </script>
@endpush
