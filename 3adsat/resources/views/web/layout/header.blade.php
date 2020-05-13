<!DOCTYPE html>
<html lang="{{\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale()}}" dir="{{\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == 'ar' ? 'rtl':'ltr'}}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ _i('QeyeQ') }}</title>
    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <link href="{{ url('/') }}/web/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/nice-select.css" rel="stylesheet">

    {{--parsleyjs  css file --}}
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

@if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "en")

        <link href="{{url('/')}}/web/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{url('/')}}/web/css/droopmenu.css" rel="stylesheet">
        <link href="{{ url('/') }}/web/css/en.css" rel="stylesheet">
    @else
        <link href="{{ url('/') }}/web/css/bootstrap-rtl.css" rel="stylesheet">
        <link href="{{ url('/') }}/web/css/droopmenu-rtl.css" rel="stylesheet">
        <link href="{{ url('/') }}/web/css/style.css" rel="stylesheet">
@endif
@stack('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @include('web.layout.fav')
</head>
<body>


