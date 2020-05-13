<!DOCTYPE html>
<html lang="{{ LaravelGettext::getLocale() }}" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>zwag</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{asset('web/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet">
    @stack('css')

    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/plugins/noty/noty.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.bootstrap4.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header>
    <div class="top-header">
        <div class="top-orange-bar ">
            <div class="container">
                <div class="justify-content-between align-items-center d-flex">

                    <ul class="nav lang">

                        <li class="user-profile list-inline-item dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <?php
                                $language = \App\Models\Language::where('id',session('language'))->first();
                                   ?>
                                <img src='{{asset("web/images/$language->code.png")}}' alt="" style="width: 23px;height: 23px;">
                                {{_i('Language')}}
                            </a>
                            <div class="dropdown-menu animated" id="langs" aria-labelledby="userDropdown">
                                <ul class="list-unstyled">

                                </ul>

                            </div>
                        </li>

                    </ul>


                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href=""><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">

                <a href="{{url('/')}}" class="navbar-brand"><img data-src="{{asset('uploads/setting/'.settings()->loge)}}" alt="" class="img-fluid lazy"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
{{--                        {{dd(request()->segment(0))}}--}}
                        <li class="nav-item {{request()->segment(1) == "" ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('home')}}">{{_i('Home')}} <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item {{request()->segment(1) == "LatestUser" ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('get-latestUser')}}">{{_i('Latest Members')}}</a>
                        </li>
                        <li class="nav-item {{request()->segment(1) == "bestUser" ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('get-bestUser')}}">{{_i('BestMember')}}</a>
                        </li>
                        <li class="nav-item {{request()->segment(1) == "active" ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('get-activeUser')}}">{{_i('Active Members')}}</a>
                        </li>

                        <li class="nav-item {{request()->segment(1) == "stories" ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('get-story')}}">{{_i('successful Story')}}</a>
                        </li>

                        @if(auth()->check())
                            <li class="user-profile list-inline-item dropdown nav-item {{request()->segment(1) == "profile" ? 'active' : ''}}">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{_i('Members area')}}
                                </a>
                                <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                    @if (auth()->guard('web')->check() && !auth()->guard('web')->guest() )

                                        <a class="dropdown-item" href="{{route('profile-user')}}">{{_i('Profile')}}</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ _i('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        {{--                                <div class="dropdown-divider"></div>--}}
                                    @else
                                        <a class="dropdown-item" href="{{url('/register')}}"> {{_i('Register')}} </a>
                                        <a class="dropdown-item" href="{{url('/login')}}"> {{_i('Log In')}} </a>
                                    @endif
                                </div>
                            </li>

                        @else

                            <li class="nav-item {{request()->segment(1) == "login" ? 'active' : ''}}" ><a href="{{url('/login')}}" class="nav-link"> {{_i('Login')}} </a></li>
                            <li class="nav-item {{request()->segment(1) == "register" ? 'active' :''}}"><a href="{{url('/register')}}" class="nav-link"> {{_i('Register')}} </a></li>

                        @endif

                    </ul>

                </div>
            </nav>
        </div>
    </div>

</header>

@yield('content')

@include('admin.layouts.session')
<footer class="pink-bg pink-shape">
    <div class="links text-center">
        <div class="container">

            <ul class="footer-list list-inline ">
                <li class="list-inline-item">
                    <a class="nav-link" href="{{route('home')}}">{{_i('Home')}} <span class="sr-only">(current)</span></a>
                </li>


                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-latestUser')}}">{{_i('Latest Members')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-bestUser')}}">{{_i('BestMember')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-onlineUser')}}">{{_i('Active Members')}}</a>
                    </li>

                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-story')}}">{{_i('successful Story')}}</a>
                    </li>

                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-article')}}">{{_i('Article')}}</a>
                    </li>



            @if(\Illuminate\Support\Facades\Auth::check())

                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-latestUser')}}">{{_i('Latest Members')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-bestUser')}}">{{_i('BestMember')}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-onlineUser')}}">{{_i('Active Members')}}</a>
                    </li>

                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-story')}}">{{_i('successful Story')}}</a>
                    </li>

                    <li class="list-inline-item">
                        <a class="nav-link" href="{{route('get-article')}}">{{_i('Article')}}</a>
                    </li>

                    @endif



            </ul>
            <br>
            <div class="subscripe">
                @if ($errors->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('store-subscript')}}" method="post" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('post')}}

                    <input type="email" name="email" data-parsley-trigger="change" required="" class="form-control" style="width: 433px;
                     position: relative;
                  right: 335px;">
                    <br>
                    <input type="submit" class="btn btn-grad animated fadeInDown" value="{{_i('subscribe')}}">
                </form>

            </div>
            <br><br>
            <div class="row justify-content-center">
                <a href=""><img src="{{asset('web/images/andriod.png')}}" alt="" class="img-fluid"></a>
                <a href=""><img src="{{asset('web/images/ios.png')}}" alt="" class="img-fluid"></a>
            </div>
        </div>
    </div>


    <div class="copyrights text-md-center ">
        <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div>Copyright © 2018 .com™. All rights reserved.</div>

                <div>design and development by <span><a href="serv5.com" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="{{asset('web/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap-rtl.js')}}"></script>
<script src="{{ url('/') }}/adminPanel/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset('web/js/lazyload.min.js')}}"></script>
<script src="{{asset('web/js/jquery.nice-select.min.js')}}"></script>

<script src="{{ url('/') }}/adminPanel/dist/js/parsley.min.js"></script>

<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('web/js/wow.min.js')}}"></script>
<script src="{{asset('web/js/custom.js')}}"></script>



@stack('css')
@stack('js')

{{--parsleyjs--}}
{{--<script src="{{asset('custom/parsley.min.js')   }}"></script>--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(function(){
        $.ajax({
            url:"{{route('web.languages')}}",
            success:(res)=>{
                // console.log(res);
                if(res == null) return false;
                $('#langs').html('');

                for (var i =0 ; i< res.length ; i++){
                    $('#langs').append(`<form action="{{url('change_language')}}" id="getLang-${res[i].id}" method="get">
                    <input type="hidden" name="setLanguage" value="${res[i].name}"/>
                    <a href="javascript:{}" onclick="document.getElementById('getLang-${res[i].id}').submit();" class="dropdown-item">${res[i].name}</a></form>`);
                }

                {{--res.forEach(lang => {--}}
                {{--    $('#langs').append(`<form action="{{url('change_language')}}" id="getLang" method="get">--}}
                {{--    <input type="hidden" name="setLanguage" value="${lang.name}"/>--}}
                {{--    <a href="javascript:{}" onclick="document.getElementById('getLang').submit();" class="dropdown-item">${lang['name']}</a></form>`);--}}
                {{--});--}}
            },
            error:(err)=>{
                console.log(err);
            }
        });
    });
</script>
<script>
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

{{--        CKEDITOR.config.language =  "{{ app()->getLocale() }}";--}}

        $('body').on('click','.nav-link',function (e) {
            // e.preventDefault();

    $(this).parent().addClass('active').siblings().removeClass('active')

    // $('.nav-link').parent().removeClass('active');
    // $(this).parent().addClass('active');

            })
    });
</script>
</body>
</html>

