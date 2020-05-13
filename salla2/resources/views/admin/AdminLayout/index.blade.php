<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{\Config::get('app.site')}} | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var laravel = @json(['baseURL' => url('/')]);
    </script>
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

    <!-- Latest Sortable -->
{{--    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>--}}
<!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/icon/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/menu-search/css/component.css')}}">

    <!---- added different css links  --->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/bower_components/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/icon/SVG-animated/svg-weather.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/pages/widget/flipclock/flipclock.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">

    <!-- list css -->
<!-----
{{--    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/js/list-scroll/list.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/js/stroll/css/stroll.css')}}">--}}
    --->

    <!------ end different  ---->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('masterAdmin/assets/pages/foo-table/css/footable.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('masterAdmin/assets/pages/foo-table/css/footable.bootstrap.min.css') }}">

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


    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/bower_components/switchery/css/switchery.min.css')}}">

    <!-- Color Picker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/bower_components/spectrum/css/spectrum.css')}}"/>
    <!-- Mini-color css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/assets/pages/jquery-minicolors/css/jquery.minicolors.css')}}"/>

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/style.css')}}">
    <!--color css-->

    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/linearicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/ionicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/assets/css/jquery.mCustomScrollbar.css')}}">


    <!-- parsleyjs  css file -->
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js') }}"></script>

    <style>
        .hidden {
            display: none !important;
        }

        .pcoded .pcoded-navbar .pcoded-item .pcoded-hasmenu[subitem-icon="style6"] .pcoded-submenu li > a .pcoded-mtext:before {
            content: "\e65d";
        }

        /* input[type='number'] {
            -moz-appearance: textfield;
        } */

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
    @stack('css')
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

    @include('admin.AdminLayout.header')

    <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                @include('admin.AdminLayout.menu')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-header">
                                    <div class="page-header-title">
                                        {{--                                        <h4>@yield("title")</h4>--}}

                                    </div>
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            @yield('page_url')
                                        </ul>
                                    </div>
                                </div>
                                @yield('content')


                                @include('admin.AdminLayout.message')
                                @include('admin.AdminLayout.session')
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
@stack('app')
<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<script type="text/javascript"
        src="{{ asset('masterAdmin/assets/pages/j-pro/js/jquery.maskedinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('masterAdmin/assets/pages/j-pro/js/jquery.j-pro.js') }}"></script>
<!-- start increase style links-->
<!----
<script type="text/javascript" src="{{asset('masterAdmin/js/bundle.min.js')}}"></script>
--->
<script type="text/javascript" src="{{asset('masterAdmin/assets/pages/widget/flipclock/flipclock.min.js')}}"></script>
<!-- end increase style links -->

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
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/ckeditor/ckeditor.js')}}"></script>

<!-- Switch component js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/switchery/js/switchery.min.js')}}"></script>


<!-- Color picker js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/spectrum/js/spectrum.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jscolor/js/jscolor.js')}}"></script>
<!-- Mini-color js -->
<script type="text/javascript"
        src="{{asset('masterAdmin/assets/pages/jquery-minicolors/js/jquery.minicolors.min.js')}}"></script>

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
{{--<script type="text/javascript" src="{{asset('masterAdmin/assets/pages/advance-elements/custom-picker.js')}}"></script>--}}

<script src="{{asset('masterAdmin/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/js/demo-12.js')}}"></script>
<script src="{{asset('masterAdmin/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('masterAdmin/assets/js/jquery.mousewheel.min.js')}}"></script>

<script type="text/javascript" src="{{asset('masterAdmin/assets/pages/advance-elements/swithces.js')}}"></script>


<script src="{{ asset('custom/parsley.min.js') }}"></script>
@if(config('app.locale') == 'ar')
    <script src="{{asset('AdminFlatAble/js/menu/menu-rtl.js')}}"></script>
@endif
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
{{--<script>--}}
{{--    $( document ).ready(function() {--}}
{{--        $( "#pcoded" ).pcodedmenu({--}}
{{--            verticalMenuplacement: 'right',--}}
{{--        });--}}
{{--        $('.nice-select').niceSelect();--}}
{{--        $('.selectpicker').selectpicker();--}}
{{--    });--}}

{{--</script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

{{--<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"--}}
{{--      rel="stylesheet"/>--}}
{{--<script--}}
{{--    src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}
<link href="{{ asset('custom/bootstrap-editable/css/bootstrap-editable.css') }}"
      rel="stylesheet"/>
<!--<script src="{{asset('custom/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script>-->


<script type="text/javascript" src="{{asset('AdminFlatAble/dist/clipboard.min.js')}}"></script>

<script>
    /*share icon toggle*/
    $('.share').hide();
    $(".option-font").on('click', function () {
        // $(this).next().slideToggle();
        $(this).next().toggle("slide");
    });
    $(function () {
        'use strict'

        $('.selectpicker').on('change', function (e) {
            $(this).next().next().toggleClass('show');
        })
        $('.dropdown-toggle').click(function () {
            $(this).next().toggleClass('show');
        });
    })
    /*end share icon toggle */
</script>

<script>
    //

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
//                CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        //    $('.textarea').wysihtml5();

        $('.modal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').removeClass('modal-backdrop');
            $('body').css({'padding-right': '0'});
        })
    });
    let locate = '{!! config('app.locale') !!}';
    if (locate === 'ar') {
        $(document).ready(function () {
            $("#pcoded").pcodedmenu({
                verticalMenuplacement: 'right',
            });
        });
    }

</script>


{{--<script>--}}
{{--    $('body').on('click','.store_pause',function () {--}}

{{--        Swal.fire({--}}
{{--            title: "{{_i('Warning')}}",--}}
{{--            text: "{{_i('All features of the package will be disabled, given that the maximum period of suspension is 30 days, and the subscription can be stopped twice a year only')}}",--}}
{{--            icon: 'warning',--}}
{{--            showCancelButton: true,--}}
{{--            confirmButtonColor: '#5dd5c4',--}}
{{--            cancelButtonColor: 'rgb(136, 136, 136)',--}}
{{--            confirmButtonText: '{{_i('Confirm')}}'--}}
{{--        }).then((result) => {--}}
{{--            if (result.value) {--}}
{{--                Swal.fire(--}}
{{--                    '',--}}
{{--                    "{{_i('subscription Stopped Temporarily')}}",--}}
{{--                    'success'--}}
{{--                ).then(function() {--}}
{{--                    //form.submit();--}}

{{--                    $(function () {--}}
{{--                        $.ajaxSetup({--}}
{{--                            headers: {--}}
{{--                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                            }--}}
{{--                        });--}}

{{--                        var store = "{{\App\Bll\Utility::getStoreId()}}";--}}
{{--                        $.ajax({--}}
{{--                            url: "{{url('adminpanel/accountControl/change')}}",--}}
{{--                            type: 'post',--}}
{{--                            dataType: 'json',--}}
{{--                            data: {--}}
{{--                                status: 0,--}}
{{--                                store: store--}}
{{--                            },--}}
{{--                            success: function (res) {--}}
{{--                                console.log(res);--}}
{{--                                if(res == true){--}}
{{--                                    $('.show_stop_div').hide();--}}
{{--                                    $('.show_resume_div').show();--}}
{{--                                }else{--}}

{{--                                    Swal.fire({--}}
{{--                                        icon: 'error',--}}
{{--                                        title: '{{_i('Oops...')}}',--}}
{{--                                        text: '{{_i('The subscription cannot be stopped more than twice a year')}}',--}}
{{--                                        //footer: '<a href>Why do I have this issue?</a>'--}}
{{--                                    })--}}
{{--                                }--}}
{{--                            }--}}
{{--                        });--}}


{{--                    })--}}
{{--                });--}}
{{--            }--}}
{{--        })--}}

{{--    });--}}
{{--</script>--}}

@stack('js')
</body>

</html>
