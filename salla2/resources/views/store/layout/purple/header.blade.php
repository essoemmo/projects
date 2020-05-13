<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if (\App\Bll\Utility::getStoreSettigs() != null)
        <title>{{\App\Bll\Utility::getStoreSettigs()->title}}</title>
    @else
        <title>{{ _i('No - title') }}</title>
    @endif

    <meta name="description"
          content="{{ \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_description'] : '' }}">
    <meta name="title"
          content="{{ \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting())) ? \App\Bll\Utility::storeSeo(\App\Bll\Utility::getStoreId(), \App\Bll\Utility::getSetting()->id, get_class(\App\Bll\Utility::getSetting()))['meta_title'] : '' }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}

<!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{asset('perpal/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('perpal/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('perpal/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('perpal/css/lightslider.min.css')}}" rel="stylesheet">
    <link href="{{asset('perpal/css/droopmenu-rtl.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <link href="{{asset('perpal/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('perpal/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('masterAdmin/bower_components/select2/css/select2.min.css')}}">

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <link href="{{asset('perpal/css/style.css')}}" rel="stylesheet" id="cpswitch">
    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet" id="cpswitch">

    <link href="{{asset('custom/noty/noty.css')}}" rel="stylesheet">
    <script src="{{asset('custom/noty/noty.min.js')}}"></script>

    {!! NoCaptcha::renderJs() !!}
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!----
    <style>
        .dropdown-cart-wrapper #cart .badge {
            position: absolute;
            top: 0;
            right: 0;!important;
            width: 10px;
            height: 10px;
            padding: 1px 0 0;
            font-size: 16px;
            border-radius: 50%;}
    </style>

    --->
    <?php

    if(file_exists(\App\Bll\FileLocation::CSS() . "/css.css"))
    {
    ?>
    <link href="{{\App\Bll\FileLocation::CSSLink()."/css.css"}}" rel="stylesheet">

    <?php
    }
    ?>
    @stack('css')
</head>
<body>

<header>
    <div class="top-header">
        <div class="top-bar ">
            <div class="container">
                <div class="justify-content-between align-items-center d-flex">

                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a
                                    href="{{ \App\Bll\Utility::getStoreSettigs()->facebook_url}}">
                                    <i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a
                                    href="{{ \App\Bll\Utility::getStoreSettigs()->twitter_url}}">
                                    <i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a
                                    href="{{ \App\Bll\Utility::getStoreSettigs()->instagram_url}}">
                                    <i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>


                    <ul class="user-helper  nav ">
                        <li class="user-profile list-inline-item dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                @if (auth()->guard('web')->check() && !auth()->guard('web')->guest() )
                                    <a class="dropdown-item" href="{{ route('myofflineorders',app()->getLocale()) }}">
                                        <i class="fa fa-money signin-btn"></i> {{_i('Orders awaiting payment')}}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('myorders',app()->getLocale()) }}">
                                        <i class="fa fa-shopping-cart"></i> {{_i('Orders List')}}
                                    </a>
                                    <a class="dropdown-item" href="{{ url(app()->getLocale().'/store/profile') }}">
                                        <i class="fa fa-gear"></i> {{_i('Profile')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('favorite',app()->getLocale())}}">
                                        <i class="fa fa-heart signin-btn"></i> {{_i('Favourite')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('ratingpro',app()->getLocale())}}">
                                        <i class="fa fa-star signin-btn"></i> {{_i('Product Rating')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('store_logout',app()->getLocale())}}">
                                        <i class="fa fa-power-off "></i> {{_i('Log Out')}}
                                    </a>

                                @else
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#registerModel">
                                        {{_i('Register')}}

                                    </a> <a href="#" class="dropdown-item" data-toggle="modal"
                                            data-target="#loginModel">
                                        {{_i('Log In')}}
                                    </a>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item"><a href="{{ route('store_contact_url',app()->getLocale()) }}"
                                                class="nav-link"> {{_i('Contact Us')}}</a></li>

                    </ul>

                </div>
            </div>
        </div>
        <div class="logo-search">
            <div class="container">

                <div class="row">
                    <div class="col-md-2 align-self-center">
                        <div class="logo" style="margin-top: 0;margin-right: 0">
                            <a href="{{ route('store.home' ,app()->getLocale()) }}">
                                <img style="width: 105px;height: 90px"
                                     src="{{ asset(\App\Bll\Utility::getStoreSettigs()->logo)}}"
                                     alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 align-self-center">
                        <div class="row">

                            <div class="col-lg-8 col-md-8 align-self-center">
                                <form class="header-search" action="{{route('store_search',app()->getLocale())}}"
                                      method="GET">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="category_id" class="nice-select">
                                                <option class="option selected focus" value="">{{_i('Nothing')}}
                                                </option>
                                                @foreach(\App\Bll\Utility::getCategoriesNav() as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" id="searchProducts"
                                               name="searchProducts" placeholder="{{ _i('Search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div
                                class="col-lg-4 col-md-4 d-md-flex align-items-center justify-content-between header-left-links">


                                <div class="dropdown-cart-wrapper d-inline-block">
                                    <div class="text-center">
                                        <a href="#" id="cart">
                                            <div class="cart-text" style="display: inline-block;">
                                                {{_i('Shopping cart')}} <i class="fa fa-shopping-basket"></i>
                                                @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                                    <span
                                                        class="badge">{{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }}</span>
                                                @else
                                                    <span class="badge">0</span>
                                                @endif
                                            </div>
                                        </a>

                                    </div>
                                    <div class="shopping-cart " data-simplebar>

                                        <div class="shopping-cart-header">
                                            <i class="fa fa-shopping-basket cart-icon"></i><span
                                                class="badge">{{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }}</span>
                                            <div class="shopping-cart-total">
                                                <span class="lighter-text">{{_i('Total')}}:</span>
                                                <span class="main-color-text total">
                                                        @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                                        {{ Cart::total() }}
                                                    @else
                                                        0
                                                    @endif
                                                    </span>
                                            </div>
                                        </div>
                                        <!--end shopping-cart-header -->

                                        <ul class="shopping-cart-items list-unstyled" id="scrl">
                                            @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)

                                                    <li class="clearfix">
                                                        <img src="{{getimage($item->id)}}" alt="item1"/>
                                                        <span class="item-name">{{ $item->name }}</span>
                                                        <?php $currency = \App\Models\Settings\Currency::where('show', '=', 1)->value('title'); ?>
                                                        <span class="item-name" style="display: inline-block;
                                                        width: 20px;
                                                        height: 20px;
                                                        border-radius: 50%;
                                                        margin-left: 10px;"></span>
                                                        <span class="item-price">{{ $item->price }} {{$currency}}</span>
                                                        <span
                                                            class="item-quantity">{{_i('the number')}}: {{ $item->qty }}</span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <div class="alert alert-danger" role="alert">
                                                    {{ _i('No Items In Cart') }}
                                                </div>
                                            @endif
                                        </ul>
                                        @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                            <a href="{{route('store.checkout',app()->getLocale())}}"
                                               class="button">{{_i('Pay')}}</a>
                                            <a href="{{route('store.cart' , app()->getLocale())}}"
                                               class="button">{{_i('Cart')}}</a>
                                        @else

                                            <a style="display: none"
                                               href="{{route('store.checkout',app()->getLocale())}}"
                                               class="button">{{_i('Pay')}}</a>
                                            <a style="display: none" href="{{route('store.cart',app()->getLocale())}}"
                                               class="button">{{_i('Cart')}}</a>

                                        @endif
                                    </div>
                                </div>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="droopmenu-navbar">
        <div class="droopmenu-inner">
            <div class="droopmenu-header">
                <a href="#" class="droopmenu-toggle"></a>
            </div><!-- droopmenu-header -->
            <div class="droopmenu-nav">
                <ul class="droopmenu">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <?php
                            $langall = App\Models\Language::all();

                            ?>
                            @foreach ($langall as $item)
                                @if ( app()->getLocale() == $item->code )
                                    <img src="{{ asset('images/'.$item->flag) }}" alt="">
                                @endif
                            @endforeach
                        </a>

                        <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                            @foreach ($langall as $key => $item)
                                @if ( app()->getLocale()  != $item->code )
                                    <a class="dropdown-item" href="{{url($item->code)}}/store/lang">
                                        <img src="{{ asset('images/'.$item->flag) }}" alt=""> {{_i($item->title)}} </a>
                                @endif
                            @endforeach
                        </div>

                    </li>
                    @if(count($list = \App\Bll\Utility::getCustomDesign()) > 0)
                        @foreach($list as $item)
                            <li class="nav-item  ">
                                @if($item['code'] == "product" )
                                    <a class="nav-link" @if($item['integer_value'] == 1) @endif
                                    href="{{ route('product_url',[app()->getLocale(),$item['value']]) }}">{{ \App\Bll\Utility::getProduct($item['value'])->title}}
                                    </a>
                                @elseif($item['code'] == "category")
                                    <a class="nav-link" @if($item['integer_value'] == 1) @endif
                                    href="{{route('store_category_product',[app()->getLocale(),$item['value']])}}">{{ \App\Bll\Utility::getCategory($item['value'])->title}}
                                    </a>
                                @elseif($item['code'] == "pages")
                                    <a class="nav-link" @if($item['integer_value'] == 1) @endif
                                    href="{{ $item['value'] }}">{{ \App\Bll\Utility::getPage($item['value'])->title}}
                                    </a>
                                @elseif($item['code'] == "link")
                                    <a class="nav-link" @if($item['integer_value'] == 1) @endif
                                    href="{{ $item['value'] }}">{{$item['title']}}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @else

                        <li class="nav-item active">
                            <a class="nav-link active"
                               href="{{ route('store.home',app()->getLocale()) }}">{{_i('Home')}}</a>
                        </li>

                        <!--------------------------------------- blogs ---------------------------->
                        <li>
                            <a href="#"> {{_i('Blogs')}}</a>
                            <ul>
                                @php
                                    $blog_cats = \App\Bll\Article::getStoreCategories();
                                @endphp
                                @if($blog_cats->count() > 0 )
                                    @foreach($blog_cats as $cat)
                                        <li>
                                            <a href="{{ url(app()->getLocale().'/store/blog_cat/'.$cat->id) }}">{{ $cat->title }}</a>
                                        </li>
                                    @endforeach
                                    <li class="dm-bottom-separator"></li>
                                    <li><a href="{{url(app()->getLocale().'/store/blog_cats')}}">{{_i('All Bogs')}}</a>
                                    </li>
                                @else
                                    <li><a href="#">{{ _i('No Blogs') }}</a></li>
                                @endif

                            </ul>
                        </li>
                        <!--------------------------------------- end blogs ---------------------------->
                        <!------------------------------------ product categories -------------------------->
                        @foreach(\App\Bll\Utility::getCategoriesNav() as $key => $cat)
                            @if(count($cat->children) > 0)
                                <li>
                                    <a href="#">{{$cat->title}}</a>
                                    @if(count(\App\Models\Category::where('lang_id',getLang(session('lang')))->where('parent_id'
                                                        , catLangCheck($cat->id))->get()) > 0)
                                        <ul>
                                            @foreach(\App\Models\Category::where('lang_id',getLang(session('lang')))->where('parent_id', catLangCheck($cat->id))->get() as $sub_cat)
                                                <li>
                                                    <a href="{{route('store_category_product',[app()->getLocale(),$sub_cat->id])}}">{{$sub_cat->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @else
                                <li>
                                    <a href="{{route('store_category_product',[app()->getLocale(),$cat->id])}}"> {{$cat->title}}</a>
                                </li>
                            @endif
                        @endforeach
                    <!------------------------------------- end product categories ------------------------------->

                        <li class="nav-item  ">
                            <a class="nav-link"
                               href="{{ route('store_contact_url',app()->getLocale()) }}">{{_i('Contact Us')}}</a>
                        </li>
                        @if(count($pages = \App\Bll\Utility::getPages()) >1)
                            <li>
                                <a href="#">{{_i('Who are We')}}</a>
                                <ul>
                                    @foreach(\App\Bll\Utility::getPages() as  $item)
                                        <li>
                                            <a href="{{url(app()->getLocale().'/store/page/'.$item['id'])}}">{{$item['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item  ">
                                <a class="nav-link"
                                   href="{{url(app()->getLocale().'/store/page/'.$pages->first()['id'])}}">{{$pages->first()['title']}}</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div><!-- droopmenu-nav -->

        </div><!-- droopmenu-inner -->
    </div><!-- droopmenu-navbar  -->
</header>
