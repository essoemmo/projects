<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="{{asset('logo.jpg')}}">
    <title>اليسر</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css')}}">
    <!-- build:css ../assets/css/app.min.css -->
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('adminPanel/assets/css/rtl.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">

    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('adminPanel/select/select2.min.css')}}">

    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/dropzone.css') }}">


@stack('css')

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/plugins/noty/noty.min.js') }}"></script>

    {{--morris--}}
    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/morris/morris.css') }}">

    {{--<!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/icheck/all.css') }}">


    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/parsly/parsly.css') }}">
    <!-- endbuild -->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">--}}
    <script src="{{asset('adminPanel/libs/bower/breakpoints.js/dist/breakpoints.min.js')}}"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

    <!-- navbar header -->
    <div class="navbar-header">
        <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-more"></span>
        </button>

        <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="zmdi zmdi-hc-lg zmdi-search"></span>
        </button>

        <a href="" class="navbar-brand">
            <span class="brand-icon"><img src="{{asset('logo.jpg')}}" style="width: 70px"></span>
            <span class="brand-name" style="margin: 25px;
    position: relative;
    top: 17px;
">Yosr</span>
        </a>
    </div><!-- .navbar-header -->

    <div class="navbar-container container-fluid">
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
                <li class="hidden-float hidden-menubar-top">
                    <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </a>
                </li>
                <li>
                    <h5 class="page-title hidden-menubar-top hidden-float">الرئيسية</h5>
                </li>
            </ul>
        </div>
    </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive" src="{{asset('logo.jpg')}}" alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username">{{auth()->user()->name}}</a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Web Developer</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="{{route('dashboard')}}">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>

                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
                        <span class="menu-text">الرئيسيه</span>
                    </a>
                </li>
                @if(auth()->user()->hasPermission('read_roles'))
                <li>
                    <a href="{{route('roles.index')}}">
                        <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
                        <span class="menu-text">الصلاحيات</span>
                    </a>
                </li>
                @endif


                @if(auth()->user()->hasPermission('read_users'))
                    <li>
                        <a href="{{route('users.index')}}">
                            <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
                            <span class="menu-text">المستخدمين</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasPermission('read_categories'))
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">الاقسام</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu" style="display: none;">
                        <li><a href="{{route('categories.index')}}"><span class="menu-text">الاقسام الرئيسية</span></a></li>
                        <li><a href="{{route('subcategories.index')}}"><span class="menu-text">الاقسام الفرعية</span></a></li>
                        <li><a href="{{route('subcats.index')}}"><span class="menu-text">اختار قسم فرعي</span></a></li>
                    </ul>
                </li>
                @endif


                    @if(auth()->user()->hasPermission('read_uploads'))
                        <li>
                            <a href="{{route('uploads.index')}}">
                                <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
                                <span class="menu-text">رفع الملفات</span>
                            </a>
                        </li>
                    @endif


                @if(auth()->user()->hasPermission('read_reports'))
                    <li>
                        <a href="{{route('reports.index')}}">
                            <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
                            <span class="menu-text">التقارير</span>
                        </a>
                    </li>
                @endif




            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->

<!-- navbar search -->
<div id="navbar-search" class="navbar-search collapse">
    <div class="navbar-search-inner">
        <form action="#">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input class="search-field" type="search" placeholder="search..."/>
        </form>
        <button type="button" class="search-close" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
            <i class="fa fa-close"></i>
        </button>
    </div>
    <div class="navbar-search-backdrop" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false"></div>
</div><!-- .navbar-search -->

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">

        @yield('content')

        </section>
    </div><!-- .wrap -->

    <!-- /#app-footer -->
</main>
<!--========== END app main -->
@include('admin.layout.session')

<!-- build:js ../assets/js/core.min.js -->
<script src="{{asset('adminPanel/libs/bower/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/PACE/pace.min.js')}}"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<script src="{{asset('adminPanel/assets/js/library.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/plugins.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/app.js')}}"></script>
<!-- endbuild -->
<script src="{{asset('adminPanel/libs/bower/moment/moment.js')}}"></script>
<script src="{{asset('adminPanel/libs/bower/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/fullcalendar.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('adminPanel/select/select2.min.js')}}"></script>

<script src="{{asset('adminPanel/plugins/parsly/parsley.min.js')}}"></script>
<script src="{{ url('adminPanel/plugins/dropzone.js') }}"></script>
<script src="{{ url('adminPanel/plugins/printThis.js') }}"></script>

<link href="https://printjs-4de6.kxcdn.com/print.min.css">
<script src="https://printjs-4de6.kxcdn.com/print.min.js"> </script>

@stack('js')

<script>

    //delete
    $('body').on('click','.delete',function (e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({
            text: "تاكيد الحذف",
            type: "warning",
            killer: true,
            buttons: [
                Noty.button("نعم", 'btn btn-success mr-2', function () {
                    that.closest('form').submit();
                }),

                Noty.button("لا", 'btn btn-primary mr-2', function () {
                    n.close();
                })
            ]
        });

        n.show();

    });//end of delete

    $('.select2').select2({
        width: "100%"
    })
    ;
</script>
</body>
</html>
