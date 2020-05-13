<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>salla</title>
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{url('/')}}/front/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/animate.css" rel="stylesheet">
    <link href="{{asset('front/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{url('/')}}/front/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">

    @yield('css')

</head>
<body>
<header id="header">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="{{url('/')}}"><img src="{{asset(frontSetting()['logo'])}}" alt="" title="" width="200"/></a>
            </div>

        </div>

        <div class="login">

            <a href="{{url("email/verfiy/".encrypt($id))}}" class="btn btn-info">{{_i('Verfiy Email')}}</a>
        </div>
    </div>
</header><!-- #header -->

<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('front/js/lazyload.min.js')}}"></script>
<script src="{{asset('front/js/jquery.countimator.min.js')}}"></script>
<script src="{{asset('front/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
{{--parsleyjs--}}
<script src="{{asset('custom/parsley.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>

@yield('js')


</body>
</html>
