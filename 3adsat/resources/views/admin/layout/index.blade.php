
<!DOCTYPE html>
<html lang="en">

<head>
    <title> QeyeQ | {{ !empty($title)?$title:_i('admin.title') }}</title>
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
    <link rel="icon" href="{{asset('admin2/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/icon/icofont/css/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/menu-search/css/component.css')}}">
    <!-- Horizontal-Timeline css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/dashboard/horizontal-timeline/css/style.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/dashboard/amchart/css/amchart.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/css/style.css')}}">
    <!--color css-->

    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/css/linearicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/css/ionicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/css/jquery.mCustomScrollbar.css')}}">

    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{asset('admin2/bower_components/select2/css/select2.min.css')}}" />
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/multiselect/css/multi-select.css')}}" />

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">


@yield('css')

<!-- parsleyjs  css file -->
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin2/noty/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin2/noty/plugins/noty/noty.min.js') }}"></script>


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


        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                @include('admin.layout.nav')


                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-header">

                                    <div class="page-header-title">
                                        <h4>
                                            {{ !empty($subtitle)? $subtitle: '' }}
                                        </h4>
                                    </div>

                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="{{url('/admin/panel')}}">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">{{ !empty($activePageName)?$activePageName: '' }}</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="{{ !empty($additionalPageUrl)?$additionalPageUrl: '' }}">{{ !empty($additionalPageName)?$additionalPageName: '' }} </a>
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


<!-- Required Jqurey -->
<script type="text/javascript" src="{{asset('admin2/bower_components/jquery/js/jquery.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/classie/js/classie.js')}}"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('admin2/assets/js/script.js')}}"></script>
<script src="{{asset('admin2/assets/js/pcoded.min.js')}}"></script>

@if(LaravelGettext::getLocale() == "ar")
    <!---------------------------- rtl menu ---------------->
    <script src="{{asset('admin2/assets/js/menu/menu-rtl.js')}}"></script>

@endif

@if(LaravelGettext::getLocale() == "en")
    <script src="{{asset('admin2/assets/js/demo-12.js')}}"></script>
@endif

<script src="{{asset('admin2/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin2/assets/js/jquery.mousewheel.min.js')}}"></script>



<!-- data-table js -->
<script src="{{asset('admin2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin2/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{asset('admin2/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{asset('admin2/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin2/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/select2/js/select2.full.min.js')}}"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="{{asset('admin2/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}">
</script>
<script type="text/javascript" src="{{asset('admin2/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/assets/js/jquery.quicksearch.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{asset('admin2/assets/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('admin2/assets/pages/advance-elements/select2-custom.js')}}"></script>

<!-- ck editor -->
<script src="{{asset('admin2/assets/pages/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>


<script src="{{ asset('custom/parsley.min.js') }}"></script>


<script>

    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
    });

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


    $("document").ready(function(){
        setTimeout(function(){
            $(".dangerMessage").remove();
        }, 5000 );

    });
    function showImg(input) {
        var filereader = new FileReader();
        filereader.onload = (e) => {
            console.log(e);
            $('#image').attr('src', e.target.result).width(250).height(250);
        };
        console.log(input.files);
        filereader.readAsDataURL(input.files[0]);

    }


    $(document).ready(function () {

        // image preview
        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(this.files[0]);
            }

        });

        // CKEDITOR.config.language =  "{{ app()->getLocale() }}";
    });

    $(function(){
        $.ajax({
            url:"{{route('admin.languages')}}",
            success:(res)=>{
                // console.log(res);
                if(res == null) return false;
                $('#langs').html('');
                res.forEach(lang => {
                    $('#langs').append(`<li><form action="{{route('change_language')}}" method="get">
                    <input type="hidden" name="selLanguage" value="${lang.name}"/>
                    <button type="submit" class="btn btn-default btn-block">${lang['name']}</button></form></li>`);
                });
            },
            error:(err)=>{
                console.log(err);
            }
        });
    });

    $('.selectpicker').selectpicker();

</script>
@stack('js')
@stack('css')

</body>

</html>
