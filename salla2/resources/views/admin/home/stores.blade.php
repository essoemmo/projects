<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{_i('Salla')}} | {{_i('Select Store')}}  </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">

<!------ Theme style arabic -->

    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE-rtl.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins-rtl.css')}}">



    <style>
        .container_custom {
            position: relative;
            width: 100%;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_custom:hover .image {
            opacity: 0.3;
        }

        .container_custom:hover .middle {
            opacity: 1;
        }

        .text {
            background-color: rgba(12, 80, 47, 0.29);
            color: #c44dae;
            font-size: 16px;
            padding: 10px;
        }
    </style>

</head>



<body class="hold-transition skin-black sidebar-mini">

<div id="app" style="width: 100%;">


    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('adminpanel/get_stores')}}" class="logo">
            {{--<span class="logo-mini"><img src="{{asset("admin/dist/img/user2-160x160.jpg")}}"/></span>--}}
            <span class="logo-lg"><b>Salla</b> LTE</span>

            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{asset("admin/dist/img/user2-160x160.jpg")}}" height="40px"/></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{auth()->guard(getGuard())->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{auth()->guard(getGuard())->user()->name}}
                                    {{--                                    -  {{Auth::user()->getRoleNames()[0]}}--}}
                                    <small>{{_i("Member since")}} <?=(auth()->guard(getGuard())->user()->created_at == null)?"" : auth()->guard(getGuard())->user()->created_at->format("M Y")?> </small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
{{--                                <div class="pull-left">--}}
{{--                                    <a href="{{url('/adminpanel/profile')}}" class="btn btn-default btn-flat">{{_i('Profile')}}</a>--}}
{{--                                </div>--}}
                                <div class="pull-right">
                                    <a href="{{url('/adminpanel/logout')}}" class="btn btn-default btn-flat">{{_i('Sign out')}}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>


    <div class="content"  >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{_i('Select Store')}}
            </h1>
{{--            <ol class="breadcrumb">--}}
{{--                {{_i('Select Store')}}--}}
{{--            </ol>--}}
        </section>
        <!-- Main content -->
        <section class="content">



         <div class="container-fluid">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-puzzle-piece"></i> {{_i('Stores List')}}</h3>
            </div>

            <div class="panel-body">

                <div class="row">

                    @foreach($stores as $store)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <section>
                            <div class="extension-preview container_custom">
                                <a href="{{url('adminpanel/stores/'.$store->id)}}">
                                    <div class="extension-description">

                                    </div>
                                    <img src="data:image/jpeg;base64,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"
                                         class="img-responsive image" />

                                    <div class="middle">
                                        <div class="text">{{$store->title}}</div>
                                    </div>
                                </a>
                            </div>
                            <div class="extension-name text-center" >
                                <h4>
{{--                                    <a href="{{$store->domain}}">--}}
                                    <a href="{{url('adminpanel/stores/'.$store->id)}}">
                                        {{$store->title}}
                                    </a>
                                </h4>
                            </div>

                        </section>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>

    </div>

        </section>
    </div>

</div>



<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>



</body>


</html>
