
<!DOCTYPE html>
<html lang="en">

<head>
    <title>XCard | {{ !empty($title)? $title: _i('admin.title') }}</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('adminPanel/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/menu-search/css/component.css')}}">
    <!-- Horizontal-Timeline css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/dashboard/horizontal-timeline/css/style.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/dashboard/amchart/css/amchart.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/j-pro/css/demo.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/j-pro/css/j-forms.css">

    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/bower_components/bootstrap-daterangepicker/css/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/bower_components/datedropper/css/datedropper.min.css" />

    <!-- Color Picker css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/bower_components/spectrum/css/spectrum.css" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <!--- dropzone --->
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/ekko-lightbox.css')}}">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/style.css')}}">
    <!--color css-->



    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/linearicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/ionicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/jquery.mCustomScrollbar.css')}}">

    @stack('css')

    <style>
        textarea.form-control{
            height: 100px;
        }
        .j-forms .footer{
            position: relative !important;
        }
        div.dataTables_wrapper div.dataTables_length label {
            float: right;
            margin-left: 20px;
        }
        .j-forms input[type="text"], .j-forms input[type="password"], .j-forms input[type="email"], .j-forms input[type="search"], .j-forms input[type="url"], .j-forms textarea, .j-forms select {
            font-size: 14px;
        }
        .btn-light {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.15);
        }
        .btn-light:hover, .btn-light:focus {
            border:1px solid #1abc9c;
        }
        .ck-editor__editable {
            min-height: 200px;
            margin: 1.5rem !important;
        }
        .ck-editor__top {
            margin: 1.5rem !important;
        }
        .clone-select {
            height: 48px !important;
        }
        .md-tabs .nav-item, .md-tabs .main-menu .main-menu-content .nav-item .tree-1 a, .main-menu .main-menu-content .nav-item .tree-1 .md-tabs a, .md-tabs .main-menu .main-menu-content .nav-item .tree-2 a, .main-menu .main-menu-content .nav-item .tree-2 .md-tabs a, .md-tabs .main-menu .main-menu-content .nav-item .tree-3 a, .main-menu .main-menu-content .nav-item .tree-3 .md-tabs a, .md-tabs .main-menu .main-menu-content .nav-item .tree-4 a, .main-menu .main-menu-content .nav-item .tree-4 .md-tabs a {
            width: calc(100% / 6);
        }
        .nav-tabs .slide {
            width: calc(100% / 6);
        }
    </style>


    <!-- parsleyjs  css file -->
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('adminPanel/noty/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/noty/plugins/noty/noty.min.js') }}"></script>

</head>

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

    @include('admin.layout.header')



    <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                @include('admin.layout.nav')

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
                                                <a href="{{url('admin/')}}">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">{{ !empty($activePageName)?$activePageName: '' }}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{ !empty($additionalPageUrl)?$additionalPageUrl: '' }}">{{ !empty($additionalPageName)?$additionalPageName: '' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="page-body">

                                    @include('admin.layout.message')
                                    @yield('content')

                                </div>

                                @include('admin.layout.session')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Older IE warning message -->

<!-- Warning Section Ends -->
<!-- Required Jqurey -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jquery/js/jquery.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{url('/')}}/js/ckeditor.js"></script>

<!-- data-table js -->
<script src="{{asset('adminPanel/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{url('/')}}/adminPanel/assets/pages/j-pro/js/jquery-cloneya.min.js"></script>
<script src="{{url('/')}}/adminPanel/assets/pages/j-pro/js/custom/cloned-form.js"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/classie/js/classie.js')}}"></script>
<!-- Rickshow Chart js -->
<script src="{{asset('adminPanel/bower_components/d3/js/d3.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/rickshaw/js/rickshaw.js')}}"></script>
<!-- Morris Chart js -->
<script src="{{asset('adminPanel/bower_components/raphael/js/raphael.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/morris.js/js/morris.js')}}"></script>
<!-- Horizontal-Timeline js -->
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/horizontal-timeline/js/main.js')}}"></script>
<!-- amchart js -->
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/amchart/js/amcharts.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/amchart/js/serial.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/amchart/js/light.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/amchart/js/custom-amchart.js')}}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/dashboard/custom-dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/js/script.js')}}"></script>


<!-- pcmenu js -->
<script src="{{asset('adminPanel/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/demo-12.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/jquery.mousewheel.min.js')}}"></script>


<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/advance-elements/select2-custom.js')}}"></script>



<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="{{url('/')}}/adminPanel/assets/pages/advance-elements/moment-with-locales.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminPanel/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminPanel/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminPanel/assets/pages/advance-elements/custom-picker.js"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="{{url('/')}}/adminPanel/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{url('/')}}/adminPanel/bower_components/datedropper/js/datedropper.min.js"></script>

<!-- Color picker js -->
<script type="text/javascript" src="{{url('/')}}/adminPanel/bower_components/spectrum/js/spectrum.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>


<script>
    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>

<script>
    $('body').on('click','.delete',function (e) {

        var that = $(this);

        e.preventDefault();

        var n = new Noty({
            text: "{{_i('Are you sure ?')}}",
            type: "warning",
            killer: true,
            buttons: [
                Noty.button("{{_i('yes')}}", 'btn btn-success mr-2', function () {
                    that.closest('form').submit();
                }),

                Noty.button("{{_i('no')}}", 'btn btn-primary mr-2', function () {
                    n.close();
                })
            ]
        });

        n.show();

    });//end of delete
</script>

<script>
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $("li .active:first").closest("li.pcoded-hasmenu").addClass("active");
    });

    $('.selectpicker').selectpicker();

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

<script src="{{ asset('custom/parsley.min.js') }}"></script>

<!---- dropzone ----->
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{asset('js/ekko-lightbox.min.js')}}"></script>

@stack('js')


</body>

</html>

