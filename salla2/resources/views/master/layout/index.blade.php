<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @php
        $setting = \App\Bll\Utility::getMasterSettigs();
    @endphp
    @if($setting != null)
        <title> {{ $setting['title'] }} | {{ !empty($title)? $title: _i('title') }}</title>
    @else
        <title> {{ _i('Sallatk') }} | {{ !empty($title)? $title: _i('title') }}</title>
@endif
<!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords"
          content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('masterAdmin/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/menu-search/css/component.css')}}">

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/j-pro/css/demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/j-pro/css/j-forms.css')}}">


    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/style.css')}}">
    <!--color css-->

    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/linearicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/ionicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/jquery.mCustomScrollbar.css')}}">
@stack('css')


<!-- parsleyjs  css file -->
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js') }}"></script>
</head>
<!-- Menu sidebar static layout -->

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div></div>
    </div>
</div>
<!-- Pre-loader end -->
<!-- Menu header start -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

    @include('master.layout.header')

    <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                @include('master.layout.nav')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-header">
                                    <div class="page-header-title">
                                        <h4> {{ !empty($subtitle)? $subtitle: '' }}</h4>
                                    </div>
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="{{url('master/home')}}">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="#!">{{ !empty($activePageName)?$activePageName: '' }}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ !empty($additionalPageUrl)?$additionalPageUrl: '' }}">{{ !empty($additionalPageName)?$additionalPageName: '' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="page-body">

                                    @include('admin.AdminLayout.message')
                                    @yield('content')

                                </div>

                                @include('master.layout.session')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>


<!-- data-table js -->
<script src="{{asset('masterAdmin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('masterAdmin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('masterAdmin/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('masterAdmin/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('masterAdmin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script
    src="{{asset('masterAdmin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script
    src="{{asset('masterAdmin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/classie/js/classie.js')}}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('masterAdmin/assets/js/script.js')}}"></script>
<script src="{{asset('masterAdmin/assets/js/pcoded.min.js')}}"></script>


@if(LaravelGettext::getLocale() == "ar")
    <!---------------------------- rtl menu ---------------->
    <script src="{{asset('masterAdmin/assets/js/menu/menu-rtl.js')}}"></script>
@else
    <script src="{{asset('masterAdmin/assets/js/demo-12.js')}}"></script>
@endif


<script src="{{asset('masterAdmin/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/js/jquery.mousewheel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/ckeditor/ckeditor.js')}}"></script>

<script src="{{ asset('custom/parsley.min.js') }}"></script>

<script>
    //delete
    //    $('body').on('click', '.delete', function (e) {
    //
    //        var that = $(this);
    //
    //        e.preventDefault();
    //        var n = new Noty({
    //            text: "{{_i('Are you sure ? ')}}",
    //            type: "warning",
    //            killer: true,
    //            buttons: [
    //                Noty.button("{{_i('Yes')}}", 'btn btn-success mr-2', function () {
    //                    that.closest('form').submit();
    //                }),
    //                Noty.button("{{_i('No')}}", 'btn btn-primary mr-2 col-md-offset-1', function () {
    //                    n.close();
    //                })
    //            ]
    //        });
    //        n.show();
    //    }); //end of delete

</script>
@stack('js')
</body>

</html>
