<!DOCTYPE html>
<html lang="{{LaravelGettext::getLocale()}}" @if(LaravelGettext::getLocale() == "ar") dir="rtl" @else dir="ltr" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ !empty($title)?$title:trans('admin.title') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('/') }}/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/') }}/dashboard/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    {{--parsleyjs  css file --}}
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

@if(LaravelGettext::getLocale() == "ar")
    <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('/') }}/dashboard/dist/css/rtl/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/dashboard/dist/css/rtl/custom-style.css">
        <style>
            .nav-icon {
                float: right;
            }
        </style>
    @endif
    @yield('css')

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Right navbar links -->
        <ul @if(LaravelGettext::getLocale() == "ar") class="navbar-nav mr-auto" @else class="navbar-nav ml-auto" @endif>

            <li class="nav-item dropdown user user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ url('/') }}/dashboard/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="">
                    <span class="hidden-xs">{{auth()->user()->name}}</span>
                </a>
                <ul @if(LaravelGettext::getLocale() == "ar") class="dropdown-menu dropdown-menu-lg dropdown-menu-left" @else class="dropdown-menu dropdown-menu-lg dropdown-menu-right" @endif>
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ url('/') }}/dashboard/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                        <p>
                            {{auth()->user()->name}}
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">{{_('Profile')}}</a>
                        <a href="{{ url('admin/panel/logout') }}" class="btn btn-default btn-flat float-right">{{ _i('Sign out') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-globe-africa"></i>
                </a>

{{--                <ul @if(LaravelGettext::getLocale() == "ar") class="dropdown-menu dropdown-menu-lg dropdown-menu-left" @else class="dropdown-menu dropdown-menu-lg dropdown-menu-right" @endif>--}}
{{--                    <ul class="list-unstyled" > <!-- id="langs" -->--}}
{{--                        @foreach(\App\Models\Language::all() as $language)--}}
{{--                            <li  >--}}
{{--                                <a class="dropdown-item" href="{{url('/admin/panel/lang')}}/{{Config::get('laravel-gettext.supported-locales')[$language->id - 1]}}">--}}
{{--                                        <img src="{{ asset('uploads/languages/' . $language->id. '/' . $language->image) }}"  >--}}
{{--                                         {{_i($language->name)}}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                </ul>--}}


                <ul @if(LaravelGettext::getLocale() == "ar") class="dropdown-menu dropdown-menu-lg dropdown-menu-left" @else class="dropdown-menu dropdown-menu-lg dropdown-menu-right" @endif>
                    <li class="nav-item">
                        <ul class="list-unstyled" id="langs">

                        </ul>
                    </li>

                </ul>

            </li>



        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link">
                <img src="{{url('/')}}/dashboard/dist/img/user2-160x160.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">
                {{_i('QeyeQ')}}
        </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url('/')}}/dashboard/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>

            @include('admin.layout.menu')
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->


                    <div class="col-sm-6">
                        <ol class="breadcrumb">

                            @yield('page_url')

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            @yield('content')
        </section>
        <!-- /.content -->
        @include('admin.layout.session')

    </div>






{{--@include('admin.layout.session')--}}

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.0-beta.2
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/') }}/dashboard/plugins/jquery/jquery.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="{{ url('/') }}/dashboard/plugins/datatables/dataTables.bootstrap4.css">
<script src="{{ url('/') }}/dashboard/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/dashboard/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="{{ url('/') }}/dashboard/plugins/datatables/dataTables.buttons.min.js"></script>
{{--<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>--}}
<!-- Bootstrap -->
<script src="{{ url('/') }}/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/') }}/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/dashboard/dist/js/adminlte.js"></script>
<script src="{{ url('/') }}/dashboard/dist/js/parsley.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('/') }}/dashboard/dist/js/demo.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<!-- PAGE PLUGINS -->
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>

<!-- jQuery Mapael -->
<script src="{{ url('/') }}/dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ url('/') }}/dashboard/plugins/raphael/raphael.min.js"></script>
<script src="{{ url('/') }}/dashboard/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ url('/') }}/dashboard/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/') }}/dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- sweetAlert -->
{{--<script src="{{ url('/') }}/dashboard/js/admin/products/create.js"></script>--}}
{{--<script src="{{ url('/') }}/dashboard/js/admin/products/edit.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- PAGE SCRIPTS -->
{{--<script src="{{ url('/') }}/dashboard/dist/js/pages/dashboard2.js"></script>--}}

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    $('body').on('click','.delete',function (e) {

        var that = $(this)

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

    $(document).ready(function () {

        // image preview
        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });

        CKEDITOR.config.language =  "{{ app()->getLocale() }}";



    });

    $(function(){
        $.ajax({
            url:"{{route('admin.languages')}}",
            success:(res)=>{
                console.log(res);
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

</script>
@stack('js')
@stack('css')
</body>
</html>
