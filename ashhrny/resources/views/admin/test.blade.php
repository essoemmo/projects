<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


<head>
    <title> {{ setting()['title'] }} | {{ !empty($title)? $title: _i('title') }}</title>

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
    <meta name="keywords"
          content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('adminPanel/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/pages/menu-search/css/component.css')}}">

    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{asset('adminPanel/bower_components/select2/css/select2.min.css')}}"/>
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/bower_components/multiselect/css/multi-select.css')}}"/>


    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/bower_components/bootstrap-daterangepicker/css/daterangepicker.css')}}"/>
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/bower_components/datedropper/css/datedropper.min.css')}}"/>
    <!-- Color Picker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/bower_components/spectrum/css/spectrum.css')}}"/>
    <!-- Mini-color css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/assets/pages/jquery-minicolors/css/jquery.minicolors.css')}}"/>


    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/linearicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/ionicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/jquery.mCustomScrollbar.css')}}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
          href="{{url('/')}}/adminPanel/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{url('/')}}/adminPanel/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{url('/')}}/adminPanel/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{url('/')}}/adminPanel/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css">
    {{--    multi input fields--}}
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/j-pro/css/demo.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/adminPanel/assets/pages/j-pro/css/j-forms.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('adminPanel/assets/css/style.css')}}">


    @stack('css')

    <style>
        textarea.form-control {
            height: 100px;
        }

        .j-forms .footer {
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
            border: 1px solid #1abc9c;
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


<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">


        <!-- Sidebar chat start -->
        <!-- Sidebar inner chat start-->

        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('admin.layout.header')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page header start -->

                                <!-- Page header end -->
                                <!-- Page body start -->
                                <div class="page-body">


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5> {{ _i('Add User') }} </h5>
                                                    <div class="card-header-right">
                                                        <i class="icofont icofont-rounded-down"></i>
                                                        <i class="icofont icofont-refresh"></i>
                                                        <i class="icofont icofont-close-circled"></i>
                                                    </div>
                                                </div>
                                                <!-- Blog-card start -->
                                                <div class="card-block">
                                                    <form method="POST" action="{{ url('/admin/user/add') }}"
                                                          class="form-horizontal" id="demo-form"
                                                          data-parsley-validate="">
                                                        @csrf
                                                        @honeypot {{--prevent form spam--}}

                                                        <div class="card-body card-block">


                                                            <div class="form-group row ">
                                                                <label
                                                                    class="col-sm-2 control-label">{{ _i('User') }}</label>
                                                                <div class="col-sm-10">
                                                                    <select class="js-example-basic-single select2"
                                                                            name="user_id" id="user_id">
                                                                        <optgroup label="{{_i('Select User')}}">

                                                                            <option value="">ggff</option>
                                                                            <option value="">ggff</option>
                                                                            <option value="">ggff</option>
                                                                            <option value="">ggff</option>
                                                                            <option value="">ggff</option>
                                                                        </optgroup>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name"
                                                                       class="col-sm-2 control-label">{{ _i('First Name :') }}</label>

                                                                <div class="col-sm-6">
                                                                    <input id="name" type="text"
                                                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                                           name="first_name"
                                                                           value="{{ old('first_name') }}"
                                                                           placeholder=" {{_i('First Name')}}"
                                                                           required="">

                                                                    @if ($errors->has('first_name'))
                                                                        <span class="text-danger invalid-feedback"
                                                                              role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-xl-4 m-b-30">
                                                                <h4 class="sub-title">Date Time Picker</h4>
                                                                <p>Add type<code>&lt;input type="date"&gt;</code></p>
                                                                <div class="form-group">
                                                                    <div class='input-group date' id='datetimepicker1'>
                                                                        <input type='text' class="form-control"/>
                                                                        <span class="input-group-addon bg-default">
                                                                        <span
                                                                            class="icofont icofont-ui-calendar"></span>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <!-- /.box-body -->
                                                        <div class="box-footer">
                                                            {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                                                            <button type="submit"
                                                                    class="btn btn-primary "> {{ _i('Add') }}</button>
                                                        </div>
                                                        <!-- /.box-footer -->

                                                    </form>

                                                </div>


                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">


                                            <!-- Bootstrap Date-Picker card start -->
                                            <div class="card">


                                                <div class="card-block">
                                                    <div class="row">

                                                        <div class="form-group row ">
                                                            <label
                                                                class="col-sm-2 control-label">{{ _i('User') }}</label>
                                                            <div class="col-sm-10">
                                                                <select class="js-example-basic-single select2"
                                                                        name="user_id" id="user_id">
                                                                    <optgroup label="{{_i('Select User')}}">
                                                                        <option value=""> gfgfg</option>
                                                                        <option value=""> gfgfg</option>
                                                                        <option value=""> gfgfg</option>
                                                                        <option value=""> gfgfg</option>
                                                                    </optgroup>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                                            <h4 class="sub-title">Date Time Picker</h4>
                                                            <p>Add type<code>&lt;input type="date"&gt;</code></p>
                                                            <div class="form-group">
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type='text' class="form-control"/>
                                                                    <span class="input-group-addon bg-default">
                                                                        <span
                                                                            class="icofont icofont-ui-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->


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
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- data-table js -->
<script src="{{asset('adminPanel/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminPanel/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script
    src="{{asset('adminPanel/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script
    src="{{asset('adminPanel/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

{{--    multi input fields--}}
<script src="{{url('/')}}/adminPanel/assets/pages/j-pro/js/jquery-cloneya.min.js"></script>
<script src="{{url('/')}}/adminPanel/assets/pages/j-pro/js/custom/cloned-form.js"></script>


<!-- jquery slimscroll js -->
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/classie/js/classie.js')}}"></script>


<!-- Bootstrap date-time-picker js -->
<script type="text/javascript"
        src="{{asset('adminPanel/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Date-range picker js -->
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/bootstrap-daterangepicker/js/daterangepicker.js')}}"></script>
<!-- Date-dropper js -->
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/datedropper/js/datedropper.min.js')}}"></script>
<!-- Color picker js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/spectrum/js/spectrum.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/bower_components/jscolor/js/jscolor.js')}}"></script>
<!-- Mini-color js -->
<script type="text/javascript"
        src="{{asset('adminPanel/assets/pages/jquery-minicolors/js/jquery.minicolors.min.js')}}"></script>


<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>


<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('adminPanel/bower_components/select2/js/select2.full.min.js')}}"></script>
<!-- Multiselect js -->
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript"
        src="{{asset('adminPanel/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/js/jquery.quicksearch.js')}}"></script>


<!-- Custom js -->
<script type="text/javascript" src="{{asset('adminPanel/assets/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/advance-elements/select2-custom.js')}}"></script>
<script type="text/javascript" src="{{asset('adminPanel/assets/pages/advance-elements/custom-picker.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/demo-12.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/jquery.mousewheel.min.js')}}"></script>


@if(LaravelGettext::getLocale() == "ar")
    <!---------------------------- rtl menu ---------------->
    <script src="{{asset('adminPanel/assets/js/menu/menu-rtl.js')}}"></script>
@endif

@if(LaravelGettext::getLocale() == "en")
    <script src="{{asset('adminPanel/assets/js/demo-12.js')}}"></script>
@endif

<script src="{{asset('adminPanel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('adminPanel/assets/js/jquery.mousewheel.min.js')}}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="{{url('/')}}/js/ckeditor.js"></script>


<script>
    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>


<script>
    $('body').on('click', '.delete', function (e) {

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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $("li .active:first").closest("li.pcoded-hasmenu").addClass("active");
    });

    $('.selectpicker').selectpicker();

</script>


<script src="{{ asset('custom/parsley.min.js') }}"></script>

@stack('js')


</body>

</html>

