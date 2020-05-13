<!DOCTYPE html>
<html lang="{{\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale()}}" dir="{{\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == 'ar' ? 'rtl':'ltr'}}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ _i('QeyeQ') }}</title>
    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <link href="{{ url('/') }}/web/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin2/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">


    @if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "en")
    <link href="{{url('/')}}/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/web/css/droopmenu.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/en.css" rel="stylesheet">
    @else
    <link href="{{ url('/') }}/web/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/droopmenu-rtl.css" rel="stylesheet">
    <link href="{{ url('/') }}/web/css/style.css" rel="stylesheet">
    @endif
    {{--@stack('css')--}}

    {{--parsleyjs  css file --}}
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

    @stack('css')

    <link rel="stylesheet" href="{{ asset('admin2/noty/plugins/noty/noty.css') }}">

    <link rel="stylesheet" href="{{asset('custom/select2/dist/css/select2.css')}}">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @include('web.layout.fav')
    <style>
        .fa-heart{
            color: red;
        }
    </style>

</head>
<body>

<header>

    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            @if(settings() != null)
                            <img  src="{{ asset('uploads/setting/'.settings()->loge) }}" src="{{ asset('uploads/setting/'.settings()->loge) }}" class="img-fluid ">
                            @endif
                        </a>
                    </div>
                </div>

                <div class="col-md-6 align-self-center d-md-flex text-center justify-content-end">
                    <ul class="user-helper d-inline-block list-inline">
                        <?php
                        if (request()->cookie('code') != null){
                            $country_id = request()->cookie('code');
                        }else{
                            $iso = DB::table('countries')->first();
                            $country_id = $iso->iso_code;

                        }
                        $country = DB::table('countries')->where('iso_code',$country_id)->first();
                        ?>
                        <li class="user-profile list-inline-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display:inline">
                                <img src="{{ asset('/images/countries/'. $country->image) }}" alt="" style="width: 32px;height: auto;">
                            </a>
                            <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                <?php
                                //                                        dd(lang());
                                //                                        $lang = \Illuminate\Support\Facades\DB::table('languages')
                                //                                            ->where('code',lang())->first();
                                //                                        dd($lang);

                                $country = \Illuminate\Support\Facades\DB::table('countries')
                                    ->leftJoin('country_descriptions','countries.id','country_descriptions.country_id')
                                    ->where('country_descriptions.language_id',getLang(lang()))
                                    ->where('country_descriptions.deleted_at', null)
                                    ->select(['countries.*','country_descriptions.name','country_descriptions.language_id'])
                                    ->get();


                                ?>
                                @foreach($country as $coun)


                                <a class="dropdown-item px-2" href="{{route('get-country-code',$coun->iso_code)}}">
                                    <img src="{{ asset('/images/countries/'. $coun->image) }}" alt="" style="width: 25px;height: 25px;">
                                    {{$coun->name}}
                                </a>

                                @endforeach
                            </div>
                        </li>
                        <!---
                        <li class="lang list-inline-item">
                            @foreach($langs= \App\Models\Language::all() as $lang)
                                <a href="javaScript:void(0)" id="changeLang"  @if(LaravelGettext::getLocale() == $lang->code) style="display: none" @endif>
                                    <input type="hidden" class="lang_code" value="{{ $lang->code }}" name="lang_code">
                                    <img id="lang" src="{{ asset('languages/' . $lang->image) }}" alt="">
                                </a>
                            @endforeach
                        </li> -->

                        <li class="user-profile list-inline-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"  role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{\App\Models\Language::where('code',lang())->first()->name}}
                                <i class="fa fa-globe"></i>
                            </a>
                            {{--                                    @dd(\App\Models\Language::all())--}}

                            {{--                                    @dd(Config::get('laravel-gettext.supported-locales'))--}}

                            <div class="dropdown-menu" aria-labelledby="usernavdropdown">
                                @foreach(\App\Models\Language::all() as $language)
                                <?php if(getLang(lang())!= $language->id ) {?>
                                    <a class="dropdown-item" href="{{url('/lang')}}/{{Config::get('laravel-gettext.supported-locales')[$language->id - 1]}}">
                                        <img id="lang" src="{{ asset('uploads/languages/' . $language->id. '/' . $language->image) }}" alt="">
                                        {{_i($language->name)}}
                                    </a>
                                <?php }?>
                                @endforeach
                            </div>
                        </li>
                        <li class="user-profile list-inline-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                <ul class="list-unstyled">
                                    @if(auth()->check())
                                    <li class="nav-item {{request()->segment(1) == "profile" ? 'active' : ''}}" >
                                    <a href="{{url('/profile')}}" class="nav-link"> {{_i('profile')}} </a>
                                    </li>
                                    <li class="nav-item {{request()->segment(1) == "profile" ? 'active' : ''}}">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        {{ _i('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    </li>

                                    @else

                                    <li class="nav-item {{request()->segment(1) == "login" ? 'active' : ''}}" >
                                    <a href="{{url('/login')}}" class="nav-link"> {{_i('Login')}} </a>
                                    </li>

                                    <li class="nav-item {{request()->segment(1) == "register" ? 'active' :''}}">
                                    <a href="{{url('/register')}}" class="nav-link"> {{_i('Register')}} </a>
                                    </li>

                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="list-inline-item dropdown-cart-wrapper">
                            <a href="#" id="cart">
                                <i class="fa fa-shopping-cart"></i>
                                @if(!empty(count(\Cart::getContent())))
                                <span class="badge"></span>
                                @endif
                            </a>
                            <div class="shopping-cart " data-simplebar>
                                <div class="shopping-cart-header">
                                    @if(!empty(count(\Cart::getContent())))
                                    <i class="fa fa-shopping-cart cart-icon"></i>
                                    <span class="badge">{{ count(\Cart::getContent()) }}</span>
                                    @elseif(empty(count(\Cart::getContent())))
                                    <strong class="cart-text">{{_i('Cart is empty')}}</strong>
                                    <i class="fa fa-shopping-cart cart-icon"></i>
                                    <span class="countItems badge"></span>
                                    @endif
                                    <div class="shopping-cart-total">
                                        <span class="lighter-text">{{ _i('Total :') }}</span>
                                        @if(!empty(\Cart::getContent()))
                                        <span class="main-color-text total">
                                                        {{ \Cart::getTotal() }}
                                                    </span>
                                        @else
                                        <span style="display: none" class="main-color-text total">
                                                            {{ \Cart::getTotal() }}
                                                        </span>
                                        @endif
                                    </div>
                                </div> <!--end shopping-cart-header -->

                                <ul class="shopping-cart-items list-unstyled" id="scrl">
                                    @if(!empty(count(\Cart::getContent())))
                                    @foreach(\Cart::getContent() as $item)
                                    <li class="clearfix">
                                        <img src="{{ asset('images/products/'. $item->attributes->image) }}" alt="item1"/>
                                        <span class="item-name">{{ $item->name }}</span>
                                        <!--                                                        --><?php //$currency = \App\Models\Settings\Currency::where('show','=',1)->value('title'); ?>
                                        <span class="item-price">{{ $item->price }} </span>
                                        <span class="item-quantity">{{ _i('quantity') }}: {{ $item->quantity }}</span>
                                    </li>
                                    @endforeach
                                    @else
                                    <div class="alert alert-danger" role="alert">
                                        {{ _i('No Items In Cart') }}
                                    </div>
                                    @endif
                                </ul>

                                @if(!empty(count(\Cart::getContent())))
                                {{--                                            <a href="{{route('checkout')}}" class="button">{{_i('Pay')}}</a>--}}
                                <a href="{{route('cart')}}" class="button">{{ _i('Cart Details') }}</a>
                                @else
                                <a style="display: none" href="{{route('cart')}}" class="button">{{ _i('Cart Details') }}</a>
                                @endif
                            </div>
                        </li>

                    </ul>
                </div>



            </div>
            <div class="droopmenu-navbar">
                <div class="droopmenu-inner">
                    <div class="droopmenu-header">
                        <a href="#" class="droopmenu-toggle"></a>
                    </div><!-- droopmenu-header -->
                    <div class="droopmenu-nav">
                        <ul class="droopmenu">
                            <li><a href="{{url('/')}}">{{ _i('Home') }} </a></li>
                            <?php
                            $category = \App\Models\Category::where('parent_id',null)
                                ->get();
                            ?>
                            @foreach($category as $cat)
                            <?php
                            $categoryname = \Illuminate\Support\Facades\DB::table('category_descriptions')
                                ->where('category_id',$cat->id)
                                ->where('language_id',getLang(lang()))
                                ->get();
                            ?>
                            @foreach($categoryname as $name)
                            <li>
                                <a href="{{route('category',$name->category_id)}}"> {{ $name->name}} </a>

                                <ul class="droopmenu-megamenu droopmenu-grid">
                                    <li class="droopmenu-tabs tabs-justify">
                                        <?php
                                        $categorytab = \App\Models\Category::where('parent_id',$cat->id)
                                            ->get();
                                        ?>
                                        @foreach($categorytab as $cattab1)
                                        <!-- TAB ONE -->
                                        <div class="droopmenu-tabsection">
                                            <?php
                                            $categorytab = \Illuminate\Support\Facades\DB::table('category_descriptions')
                                                ->where('category_id',$cattab1->id)
                                                ->where('language_id',getLang(lang()))
                                                ->get();
                                            ?>
                                            @foreach($categorytab as $tab1)
                                            <a href="" class="droopmenu-tabheader">{{$tab1->name}} </a>
                                            <?php
                                            $categorytab2 = \App\Models\Category::where('parent_id',$cattab1->id)
                                                ->get();
                                            ?>
                                            <div class="droopmenu-tabcontent">

                                                <div class="droopmenu-row">
                                                    @foreach($categorytab2 as $cattab2)
                                                    <?php
                                                    $categorytab2 = \Illuminate\Support\Facades\DB::table('category_descriptions')
                                                        ->where('category_id',$cattab2->id)
                                                        ->where('language_id',getLang(lang()))
                                                        ->get();
                                                    ?>
                                                    @foreach($categorytab2 as $cattab2)

                                                    <ul class="droopmenu-col droopmenu-col3">
                                                        <li><a href="{{route('category',$cattab2->category_id)}}">{{$cattab2->name}}</a></li>
                                                    </ul>
                                                    @endforeach
                                                    @endforeach

                                                </div><!-- droopmenu-row -->

                                            </div><!-- droopmenu-tabcontent -->

                                        </div><!-- droopmenu-tabsection -->
                                        @endforeach
                                        @endforeach
                                    </li>
                                </ul>

                            </li>
                            @endforeach
                            @endforeach

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{_i('News')}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 10rem;padding: 10px;">
                                    @if(\App\Models\Article\Artcl_category::where('published' , 1)->where('lang_id', getLang(session('lang')))->get()->count() > 0 )
                                    @foreach(\App\Models\Article\Artcl_category::where('published' , 1)->where('lang_id', getLang(session('lang')))->limit(6)->get() as $art_cat)
                                    <a class="dropdown-item" href="{{ url('article_cat/'.$art_cat->id) }}" style="padding: 0.25rem 1.5rem;">{{ $art_cat->title }}</a>
                                    @endforeach
                                    @else
                                    <a class="dropdown-item" href="#" style="padding: 0.25rem 1.5rem;">{{ _i('No News') }}</a>
                                    @endif

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/article_categories')}}" style="padding: 0.25rem 1.5rem;">{{_i('All Categories')}}</a>
                                </div>
                            </li>

                            <li class="{{request()->is('contact') ? 'active' : ''}}"><a href="{{url('/contact')}}">{{_i('Contact Us')}}</a></li>
                        </ul>

                    </div><!-- droopmenu-nav -->
                    <div class="droopmenu-extra">
                        <ul class="droopmenu social list-inline d-inline-block text-center">
                            <li class="list-inline-item"><a href="{{ settings()->facebook_url }}"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="{{ settings()->twitter_url }}"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="{{ settings()->instagram_url }}"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="{{ settings()->youtube_url }}"><i class="fa fa-youtube"></i></a></li>
                        </ul>

                    </div>
                </div><!-- droopmenu-inner -->
            </div>
        </div>
    </div>
</header>


@include('web.layout.message')
@yield('content')

@include('web.layout.session')

<footer>
    <div class="links">
        <div class="container">
            @php
            if (request()->cookie('code') != null){
            $country_id = request()->cookie('code');
            }else{
            $iso = \Illuminate\Support\Facades\DB::table('countries')->first();
            $country_id = $iso->iso_code;
            }
            $country = \Illuminate\Support\Facades\DB::table('countries')->where('iso_code',$country_id)->first();
            $footer_sections = \App\Models\Content\ContentSection::where('type', 'footer')->orderBy('order', 'asc')
            ->rightJoin('section_country' ,'content_sections.id' ,'=' ,'section_country.section_id')
            ->where('section_country.country_id' ,$country->id)
            ->select('content_sections.id','content_sections.columns')
            ->get();
            @endphp
            {{--@dd($footer_sections)--}}
            @foreach($footer_sections as $section)
            <?php $contents_data = \App\Models\Content\ContentSectionData::where('section_id' , $section['id'])->where('lang_id',getLang(session('lang')))->get();?>
            <div class="row">
                @foreach($contents_data as $single_content)
                <div class="col-md-{{intval(8/$section['columns'])}} col-sm-{{intval(8/$section['columns'])}}">
                    {!! $single_content['content'] !!}
                </div>
                @endforeach
                @if($loop->first)
                @include('web.news_letter')
                @endif
            </div>
            @endforeach

        </div>
    </div>


    <hr>

    <div class="copyrights text-md-center">
        <div class="container">
            <div class="d-lg-flex justify-content-between">
                <div>{{_i('Copyright')}} © 2018 .com™. {{_i('All rights reserved')}}.</div>
                <div class="social">
                    <ul class="list-inline">
                        <?php $settins= settings();?>
                        <li class="list-inline-item"><a href="{{ $settins->facebook_url }}"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="{{ $settins->twitter_url }}"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="{{ $settins->instagram_url }}"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="{{ $settins->youtube_url }}"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div>{{_i('design and development by ')}}<span><a href="https://www.serv5.com" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>

</footer>

{{--<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>--}}


<script type="text/javascript" src="{{ url('/') }}/web/js/jquery-3.3.1.min.js"></script>
<script src="{{ url('/') }}/web/js/popper.min.js"></script>
<script src="{{ url('/') }}/web/js/droopmenu.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/vanilla-load@12.4.0/dist/load.min.js"></script>-->
<script src="{{ url('/') }}/web/js/bootstrap-input-spinner.js"></script>
<script src="{{ url('/') }}/web/js/jquery.nice-select.min.js"></script>
<script src="{{ url('/') }}/web/js/owl.carousel.min.js"></script>
<script src="{{ url('/') }}/web/js/jquery.flexslider-min.js"></script>
<script src="{{ url('/') }}/web/js/wow.min.js"></script>

<script src="{{ asset('admin2/noty/plugins/noty/noty.min.js') }}"></script>
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
@if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "ar")
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{ url('/') }}/web/js/bootstrap-rtl.js"></script>
<script src="{{ url('/') }}/web/js/custom.js"></script>
@else
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{url('/')}}/web/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/web/js/custom-en.js"></script>

@endif
<script>
    /*
     $(function () {
         $('body').on('click','#changeLang',function (e) {
             // alert('samer')
             var lang_code = $(this).children().val();
             console.log(lang_code);
             // console.log(lang_code);
             $.ajax({
                {{--// url:'{{ route('web_change_language') }}',--}}
                 DataType:'json',
                 type:'get',
                 data: {lang_code: lang_code},
                 success:function (res) {
                     window.location.reload();

                 }
             })
         });
     });
 */


    $("document").ready(function(){
        setTimeout(function(){
            $("div.flash-message").remove();
        }, 5000 );

    });

</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="{{asset('custom/parsley.min.js')}}"></script>

<script src="{{asset('custom/select2/dist/js/select2.js')}}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5df11cc943be710e1d21a57a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
    $('.select2').select2()
</script>


@include('web.layout.addCart')
@include('web.layout.updateTotal')

{{--@stack('css')--}}
@stack('js')

</body>
</html>
