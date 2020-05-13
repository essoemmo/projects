<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> {{_i("Joud Academy")}} </title>
    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
<!--    <link href="{{asset('front/css/bootstrap-rtl.css')}}" rel="stylesheet">-->
@if(LaravelGettext::getLocale() == "ar")
        <link href="{{ asset('front/css/bootstrap-rtl.css') }}" rel="stylesheet">
        @else
        <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
        @endif
        
    <link href="{{asset('front/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/message.css')}}" rel="stylesheet">
    
    
    @if(LaravelGettext::getLocale() == "ar")
        <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
        @else
        <link href="{{asset('front/css/en.css')}}" rel="stylesheet">
        @endif
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    {{--parsleyjs  css file --}}
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <style>
        /*.fa-heart{*/
        /*    color: red;*/
        /*}*/
        /*.star-ratings-css {*/
        /*    unicode-bidi: bidi-override;*/
        /*    color: #c5c5c5;*/
        /*    font-size: 29px;*/
        /*    height: 25px;*/
        /*    width: 120px;*/
        /*    margin: 0 auto;*/
        /*    position: relative;*/
        /*    padding: 0;*/
        /*    text-shadow: 0px 1px 0 #a2a2a2;*/
        /*}*/
        /*.star-ratings-css-top {*/
        /*    color: #106E9F;*/
        /*    padding: 0;*/
        /*    position: absolute;*/
        /*    z-index: 1;*/
        /*    display: block;*/
        /*    top: 0;*/
        /*    right: 0;*/
        /*    overflow: hidden;*/
        /*}*/
        /*.star-ratings-css-bottom {*/
        /*    padding: 0;*/
        /*    display: block;*/
        /*    z-index: 0;*/
        /*}*/
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
            color: #106E9F;
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

    <!--------------------------- select2 ---->
    <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">

    @stack('css')

    @include('front.layout.fav')

</head>
<body>
@include("front.layout.header")
@include("front.layout.message")

@yield('slider')

{{--@yield('find-course')--}}
@include("front.layout.search")

@yield("content")

@include("front.layout.footer")
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('front/js/lazyload.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('custom/parsley.min.js')}}"></script>
<!--<script src="{{asset('front/js/custom.js')}}"></script>-->
 @if(LaravelGettext::getLocale() == "ar")
        <script src="{{ asset('front/js/custom.js') }}"></script>
        @else
        <script src="{{ asset('front/js/custom-en.js') }}"></script>
        @endif



<!--<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>-->
 <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- CK Editor -->
<script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>

<!------------------ select2 -------------------------------------------->
<script src="{{asset('admin/bower_components/select2/dist/js/select2.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
    $('.select2').select2()
</script>

<script>
    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert-success").remove();
            // $("div.alert-info").remove();
        }, 5000 );

    });
    $("document").ready(function(){
        setTimeout(function(){
            $(".login_message").remove();
        }, 5000 );

    });
</script>



@stack('css')
@stack('js')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



@yield("script")
</body>
</html>

