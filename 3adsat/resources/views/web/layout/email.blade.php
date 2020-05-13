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
    
    
    
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">


    @if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "en")

        <link href="{{url('/')}}/web/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="{{ url('/') }}/web/css/en.css" rel="stylesheet">
    @else
        <link href="{{ url('/') }}/web/css/bootstrap-rtl.css" rel="stylesheet">
        
        <link href="{{ url('/') }}/web/css/style.css" rel="stylesheet">
@endif

    <style>
        .fa-heart{
            color: red;
        }
    </style>

</head>
<body>


@yield('content')






</body>
</html>
