<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            {{_i("Joud Courses Online")}}  |

            @yield('title')
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=asset('admin/dist/css/AdminLTE'.((adminLang()=="ar")? "-rtl" : "").'.css')?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <!--<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins-rtl.css')}}">-->



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

        <!--- dropzone --->
        <link rel="stylesheet" href="{{asset('admin/css/dropzone.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/ekko-lightbox.css')}}">



        {{--parsleyjs  css file --}}
        <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.css')}}">
        <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/buttons.dataTables.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.css')}}">
        <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
        <link href="{{asset('front/css/message.css')}}" rel="stylesheet">

        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/bootstrap.min.css"/>


        @yield('header')
        <?php if(adminLang()=="ar"){?>
        <style>
            .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                float: right !important;
            }
            .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9 {
                float: right !important;
            }
        </style>
        <?php }?>

    </head>
    <body class="hold-transition skin-black sidebar-mini">
    <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('/home')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="img-responsive logo-mini">
                        @if(setting() == null)
                            <img src="https://via.placeholder.com/150"/>
                        @else
                            <img src="{{asset("uploads/settings/site_settings/") . '/' . setting()->logo}}"/>
                        @endif
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="img-responsive logo-lg">
                        @if(setting() == null)
                            <img src="https://via.placeholder.com/150"/>
                        @else
                            <img src="{{asset("uploads/settings/site_settings/") . '/' . setting()->logo}}" height="40px"/>
                        @endif
                    </span>
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
                            <!-- Messages: style can be found in dropdown.less-->


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">   {{Auth::user()->first_name}} {{Auth::user()->last_name}} </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                        {{--<p>--}}
                                        {{--{{Auth::user()->name}} - {{Auth::user()->getRoleNames()[0]}}--}}
                                        {{--<small>{{_i("Member since")}} {{Auth::user()->created_at->format("M Y")}}</small>--}}
                                        {{--</p>--}}
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{url('/admin/user/profile/'.auth()->user()->id.'/edit')}}" class="btn btn-default btn-flat">{{_i('Profile')}}</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">{{_i('Sign out')}}</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->

                            <li class="nav-item d-none d-sm-inline-block">
                                <a href="{{ url('/admin/myCourses') }}" class="nav-link">{{ _i('My Courses') }}</a>
                            </li>
                            <!----- ================ language ===== -->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-language"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="menu">
                                            @foreach(\App\Models\Language::all() as $language)
                                            <li>
                                                <a href="{{url('/admin/lang')}}/{{Config::get('laravel-gettext.supported-locales')[$language->id - 1]}}">
{{--                                                    <div class="pull-left">--}}
{{--                                                        <img src="http://localhost/joud/public/uploads/countries/1/4.png" class="img-circle" alt="User Image">--}}
{{--                                                    </div>--}}
                                                    <div class="pull-left">
                                                        <h4 > {{_i($language->title)}}  </h4>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success count"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="messages">

                                    </li>

                                    <li class="footer">
{{--                                        <a href="{{ url('/admin/adminMessages', auth()->id()) }}">{{ _i('See All Messages') }}</a>--}}
                                    </li>
                                </ul>
                            </li>

                            @if(auth()->id() != null)
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning">{{ App\User::findOrFail(auth()->id())->unreadNotifications()->count() }}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">{{ _i('you have') }} {{ App\User::findOrFail(auth()->id())->unreadNotifications()->count() }} {{ _i('notifications') }}</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->

                                            <ul class="menu">
                                                @foreach(App\User::findOrFail(auth()->id())->unreadNotifications()->get() as $notification)
                                                    <li style="background-color: #eee;">
                                                        <a href="{{ $notification->data['url'] }}" class="notify_read">
                                                            <input type="hidden" name="notify_id" value="{{ $notification->id }}" class="notify_id">
                                                            {{ $notification->data['first_name'] }} {{ $notification->data['last_name'] }}
                                                            <p>{{ $notification->data['description'] }}</p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                                @foreach(App\User::findOrFail(auth()->id())->readNotifications()->get() as $notification)
                                                    <li>
                                                        <a href="{{ $notification->data['url'] }}">
                                                            {{ $notification->data['first_name'] }} {{ $notification->data['last_name'] }}
                                                            <p>{{ $notification->data['description'] }}</p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        {{--                            <li class="footer"><a href="#">View all</a></li>--}}
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>
                                {{Auth::user()->first_name}} {{Auth::user()->last_name}}

                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @include('admin.layout.nav')
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->


                @yield('page_header')
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    @if(session('error')!==null)
                    <div class="alert alert-danger">
                        {{(session('error'))}}
                    </div>
                    @endif



                    <div class="flash-message success" >
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has($msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
                            @endif
                        @endforeach
                    </div>

                    @yield('content')


                    <!-- /.box -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <form action="{{ url('/admin/send_message') }}" method="POST">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <input type="hidden" id="to_id" name="to_id" value="">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">{{ _i('Replay To This Message') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <input type="hidden" name="message_id" value="" id="message_id">
                            <div class="modal-body mx-3">

                                <div class="md-form">
                                    <label data-error="wrong" data-success="right" for="form8">
                                        {{ _i('Your Message') }}
                                        <i class="fa fa-pencil prefix grey-text"></i>
                                    </label>
                                    <textarea type="text" id="form8" name="message" class="md-textarea form-control" rows="4" required></textarea>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-unique">{{ _i('Send') }} <i class="fa fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            @include('admin.layout.footer')



        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>

        <!-- CK Editor -->
       <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script> <!---- added text color & background  and browse image --->



        <!-- AdminLTE App -->
        <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>



        {{--parsleyjs--}}
        <script src="{{asset('custom/parsley.min.js')}}"></script>

        {{--files belonges to datatable--}}
        <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/jszip.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('admin/bower_components/select2/dist/js/select2.js')}}"></script>



        {{--Ajax Animation--}}
        <script src="{{asset('admin/bower_components/pace.min.js')}}"></script>




        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('admin/dist/js/demo.js')}}"></script>
        <script>
$(document).ready(function () {
    $('.sidebar-menu').tree()
})
        </script>
        <!--<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>-->


        {{--files belonges to datatable--}}
        <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/js/i18n/defaults-en_US.js"></script>

        <script> $(document).ready(function () {

    $.extend(true, $.fn.dataTable.defaults, {

        language:
                {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                }
    });
})
        </script>

        <script>
            $(function(){
                $.ajax({
                    url:"{{ url('admin/allMessages') }}",
                    success:(res)=>{
                        // console.log(res);
                        if(res == null) return false;
                        $('#messages').html('');
                        $('.count').text(res[1]);
                        res[0].forEach(message => {
                            if(message.image == null) {
                                message.image = "{{ asset('/front/images/user-avatar.png') }}";
                            }
                            if(message.message_id == null) {
                                $('#message_id').val(message.id);
                            } else {
                                $('#message_id').val(message.message_id);
                            }
                            $('#to_id').val(message.from_id);
                            $('#messages').append(`
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="" data-toggle="modal" class="get_id" data-target="#modalContactForm" style="white-space: normal;">
                                                <input type="hidden" name="id_message" id="id_message" value="${message.id}">
                                                <div class="pull-right">
                                                    <img src="{{asset("uploads/applicants/")}}/${message.from_id}/${message.image}" class="img-circle" alt="User Image">
                                                </div>
                                                    <h4>
                                                        ${message.first_name} ${message.last_name}
                                                    </h4>
                                                    <p style="word-break: break-all">${message.message}</p>
                                                    <div class="dropdown-divider"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            `);
                        });
                    },
                    error:(err)=>{
                        console.log(err);
                    }
                });
            });

            $(function () {
                $(document).on('click', '.get_id',function (e) {
                    var id_message = $(e.currentTarget).children('#id_message').val();
                    console.log(id_message);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ url('/admin/read_only') }}',
                        type: 'post',
                        data: {id_message: id_message},
                    })
                });
            })
        </script>

        <script>
            $(function () {
                $('.notify_read').on('click', function (e) {
                    var notify_id = $(this).children('.notify_id').val();
                    console.log(notify_id);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ url('/admin/notify_read') }}',
                        type: 'post',
                        data: {notify_id: notify_id},
                    })
                });
            })
        </script>

        @yield('footer')


        <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
        {{--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>--    }}


    {{-- ============ sweet alert  ============--}}
 <script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>

        <!---- dropzone ----->
        <script src="{{asset('admin/js/dropzone.js')}}"></script>
        <script src="{{asset('admin/js/ekko-lightbox.min.js')}}"></script>



<script>
    $('.select2').select2();
</script>

        <script>
            $("document").ready(function(){
                setTimeout(function(){
                    $("div.flash-message").remove();
                }, 5000 );

            });
        </script>

        @stack('css')
        @stack('js')

@include('admin.layout.message')


</body>
</html>
