<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    $master_setting = App\Bll\Utility::getFrontSettigs();
    ?>
    <title>{{$master_setting->title}}</title>

    <meta name="description"
          content="{{ \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getMasterSettigs()->id, get_class(\App\Bll\Utility::getMasterSettigs())) ? \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getMasterSettigs()->id, get_class(\App\Bll\Utility::getMasterSettigs()))['meta_description'] : '' }}">
    <meta name="title"
          content="{{ \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getMasterSettigs()->id, get_class(\App\Bll\Utility::getMasterSettigs())) ? \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getMasterSettigs()->id, get_class(\App\Bll\Utility::getMasterSettigs()))['meta_title'] : '' }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}


    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{url('/')}}/front/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/animate.css" rel="stylesheet">
    <link href="{{asset('front/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{url('/')}}/front/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{url('/')}}/front/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {!! NoCaptcha::renderJs() !!}

<!-- Select2 -->
    <link rel="stylesheet" href="{{asset('front/select2/dist/css/select2.min.css')}}">
    <link href="{{asset('custom/noty/noty.css')}}" rel="stylesheet">
    <script src="{{asset('custom/noty/noty.min.js')}}"></script>

    @yield('css')
    @stack('css')

</head>

<body>
<header>
    <div class="welcome-note">
        <div class="container">
            {{-- @dd(session()->get('lang')); --}}
            <p>{{_i('Welcome to') }} {{$master_setting->title}} {{_i('to build e-stores')}}
                .<span>{{_i('Glad to have you with us')}}</span>
            </p>
        </div>
    </div>
    <div class="top-header">

        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">

                @php
                    $setting = \App\Models\Settings\Setting::where('store_id' , null)->first();
                @endphp

                <a href="{{url(LaravelGettext::getLocale(),'')}}" class="navbar-brand"><img
                        @if($setting) src="{{asset($setting['logo'])}}" @else src="{{asset('front/images/logo.png')}}"
                        @endif
                        alt="" class="img-fluid"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <?php
                                $langall = App\Models\Language::all();

                                ?>
                                @foreach ($langall as $item)
                                    @if ( LaravelGettext::getLocale() == $item->code )
                                        <img src="{{ asset('images/'.$item->flag) }}" alt="">
                                    @endif
                                @endforeach
                            </a>

                            <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                @foreach ($langall as $key => $item)
                                    @if ( LaravelGettext::getLocale() != $item->code )
                                        <a class="dropdown-item" href="{{url($item->code)}}/lang">
                                            <img src="{{ asset('images/'.$item->flag) }}" alt=""> {{_i($item->title)}}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url(LaravelGettext::getLocale(),'')}}">{{_i('Home')}} <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{url(LaravelGettext::getLocale(),'prices')}}">{{_i('Prices')}} </a>
                        </li>


                        @php
                            $blog_cats = \App\Models\Article\ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
                            ->select('article_category.*','article_category_data.category_id','article_category_data.lang_id',
                                'article_category_data.source_id', 'article_category_data.title')
                            ->where('article_category_data.lang_id' , getLang(session('lang')))
                             ->where('article_category.published' , 1)
                             ->where('article_category.store_id' , null)
                            ->orderBy('article_category.id', 'desc')->get();
                        @endphp
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{_i('Blogs')}}
                            </a>
                            @if(count($blog_cats) > 0)
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($blog_cats as $cat)
                                        <a class="dropdown-item"
                                           href="{{url(LaravelGettext::getLocale().'/blog_cat/'.$cat->id)}}">{{$cat->title}}</a>
                                    @endforeach

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                       href="{{url(LaravelGettext::getLocale().'/blog_cats')}}">{{_i('All Bogs')}}</a>
                                </div>
                            @else
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">{{_i('No Blogs')}}</a>
                                </div>
                            @endif
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('try_demo', LaravelGettext::getLocale())}}"> {{_i('Demo')}} </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{url(LaravelGettext::getLocale(),'contact')}}">{{_i('Call Us')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{url(LaravelGettext::getLocale(),'stores')}}">{{_i('Stores')}}</a>
                        </li>

                        <li class="nav-item ">
                            @php
                                $demo_store = session()->get('StoreId');
                                $dash =false ;
                            @endphp
                            @if(empty(Auth::guard('store')->check()) || $demo_store == \App\Bll\Utility::$demoId)

                                <a class="nav-link " href="{{route('webLogin', LaravelGettext::getLocale())}}"
                                   id="navbarDropdown" role="button">
                                    {{_i('Login')}}
                                </a>

                            @else
                                @if($demo_store != \App\Bll\Utility::$demoId)
                                <!--<form method="post" action="{{ url(LaravelGettext::getLocale(),'logout') }}">-->

                                    <a class="nav-link" href="{{url('adminpanel/logout')}}">{{_i('LogOut')}}</a>
                                    <!--</form>-->
                                    <?php $dash = true ?>
                                @endif

                            @endif

                        </li>
                        <?php if($dash == true) { ?>
                        <li class="nav-item">
                            <a href="{{route('storedashboard',LaravelGettext::getLocale())}}"
                               class="nav-link creat-shop" data-animation="animated fadeInRight">
                                {{_i('My Dashboard')}}
                            </a>
                        </li>
                        <?php } ?>

                        <?php if($dash == false) { ?>
                        <li class="nav-item">
                            <a class="nav-link creat-shop"
                               href="{{url(LaravelGettext::getLocale(),'signup')}}">{{_i('Build Your Store')}}</a>
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </nav>
        </div>

    </div>
</header>
