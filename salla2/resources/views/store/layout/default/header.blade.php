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
    <link href="{{asset('storemain/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/droopmenu-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/flexslider.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/flexslider-rtl-min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <link href="{{asset('storemain/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminFlatAble/css/select2.min.css')}}">


    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <link href="{{asset('storemain/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet" id="cpswitch">

    <link href="{{asset('custom/noty/noty.css')}}" rel="stylesheet">
    <script src="{{asset('custom/noty/noty.min.js')}}"></script>

    <style>
        .nice-select {
            display: none;
        }

        .order-status {
            margin: 2em 0;
            text-align: center;
        }

        .order-status ul {
            display: flex;
            justify-content: center;
        }

        .order-status ul li {
            color: #000;
            font-size: 22px;
            display: flex;
            width: 40%;
        }

        .order-status ul li:after {
            content: '';
            border-top: 1px solid #0074BB;
            margin: 20px 20px 0 20px;
            flex: 1;
        }

        .order-status ul li:last-child {
            width: auto;
        }

        .order-status ul li:last-child:after {
            content: none;
        }

        .order-status ul li i {
            margin-top: 5px;
            margin-left: 8px;
        }

        .order-status ul li i.fa-square {
            color: #0074BB;
        }
    </style>

    {!! NoCaptcha::renderJs() !!}
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        <div class="col-lg-7 col-md-6">
                            <form class="header-search" action="{{route('store_search' ,app()->getLocale())}}"
                                  method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select name="category_id">
                                            <option data-display="Select" disabled="" selected
                                                    value="">{{_i('Nothing')}}</option>
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

                        <div class="col-lg-5 col-md-6 justify-content-center d-flex">
                            <ul class="social list-inline d-inline-block ">
                                <li class="list-inline-item">
                                    <a href="{{ \App\Bll\Utility::getStoreSettigs()->facebook_url}}"><i
                                            class="fa fa-facebook"></i></a>
                                </li>
                                <li class="list-inline-item"><a
                                        href="{{ \App\Bll\Utility::getStoreSettigs()->twitter_url}}"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a
                                        href="{{ \App\Bll\Utility::getStoreSettigs()->instagram_url}}"><i
                                            class="fa fa-instagram"></i></a></li>
                            </ul>
                            <ul class="user-helper d-inline-block list-inline">
                                <li class="user-profile list-inline-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i>
                                    </a>

                                    <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                        @if (auth()->guard('web')->check() && !auth()->guard('web')->guest() )
                                            <a class="dropdown-item"
                                               href="{{ route('myofflineorders' , app()->getLocale()) }}">
                                                <i class="fa fa-money signin-btn"></i> {{_i('Orders awaiting payment')}}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('myorders' ,app()->getLocale()) }}">
                                                <i class="fa fa-shopping-cart"></i> {{_i('Orders List')}}
                                            </a>
                                            <a class="dropdown-item"
                                               href="{{ url(app()->getLocale().'/store/profile') }}">
                                                <i class="fa fa-gear"></i> {{_i('Profile')}}
                                            </a>
                                            <a class="dropdown-item" href="{{route('favorite' ,app()->getLocale())}}">
                                                <i class="fa fa-heart signin-btn"></i> {{_i('Favourite')}}
                                            </a>
                                            <a class="dropdown-item" href="{{route('ratingpro' ,app()->getLocale())}}">
                                                <i class="fa fa-star signin-btn"></i> {{_i('Product Rating')}}
                                            </a>
                                            <a class="dropdown-item"
                                               href="{{route('store_logout' ,app()->getLocale())}}">
                                                <i class="fa fa-power-off "></i> {{_i('Log Out')}}
                                            </a>

                                        @else
                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                               data-target="#registerModel">
                                                {{_i('Register')}}

                                            </a> <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#loginModel">
                                                {{_i('Log In')}}
                                            </a>
                                        @endif
                                    </div>

                                </li>

                                <li class="list-inline-item dropdown-cart-wrapper">
                                    <a href="#" id="cart"><i class="fa fa-shopping-cart"></i>
                                        @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                            <span class="badge"></span>
                                        @endif
                                    </a>
                                    <div class="shopping-cart " data-simplebar>
                                        <div class="shopping-cart-header">
                                            <i class="fa fa-shopping-cart cart-icon"></i><span
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


                                                    @php

                                                        if($item->options->currency == null) {
                                                            $currency = \App\Bll\Constants::defaultCurrency;
                                                        } else {
                                                            $currency = $item->options->currency;
                                                        }

                                                    @endphp

                                                    <li class="clearfix">
                                                        <img src="{{getimage($item->id)}}" alt="item1"/>
                                                        <span class="item-name">{{ $item->name }}</span>
                                                        <?php $currency = \App\Models\Settings\Currency::where('show', '=', 1)->value('title'); ?>
                                                        <span class="item-name" style=" display: inline-block;
                                                        width: 20px;
                                                        height: 20px;
                                                        border-radius: 50%;
                                                        margin-left: 10px;"></span>

                                                        <span class="item-price">{{ $item->price }} {{$currency}}</span>
                                                        <span
                                                            class="item-quantity">{{_i('Quantity')}}: {{ $item->qty }}</span>
                                                    </li>

                                                @endforeach
                                            @else
                                                <div class="alert alert-danger" role="alert">
                                                    {{ _i('No Items In Cart') }}
                                                </div>
                                            @endif
                                        </ul>

                                        @if(!empty(count(\Gloudemans\Shoppingcart\Facades\Cart::content())))
                                            <a href="{{route('store.checkout' ,app()->getLocale())}}"
                                               class="button">{{_i('Pay')}}</a>
                                            <a href="{{route('store.cart' , app()->getLocale())}}"
                                               class="button">{{_i('Cart')}}</a>
                                        @else

                                            <a style="display: none"
                                               href="{{route('store.checkout' , app()->getLocale())}}"
                                               class="button">{{_i('Pay')}}</a>
                                            <a style="display: none" href="{{route('store.cart' ,app()->getLocale())}}"
                                               class="button">{{_i('Cart')}}</a>

                                        @endif
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-light ">
                        <div class="">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">


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
                                                        <img src="{{ asset('images/'.$item->flag) }}"
                                                             alt=""> {{_i($item->title)}} </a>
                                                @endif
                                            @endforeach
                                        </div>

                                    </li>

                                    @if(count($list = \App\Bll\Utility::getCustomDesign()) > 0)
                                        @foreach($list as $item)
                                            <li class="nav-item  ">
                                                @if($item['code'] == "product" )
                                                    <a class="nav-link" @if($item['integer_value'] == 1)
                                                    @endif
                                                    href="{{ route('product_url',[app()->getLocale() ,$item['value']]) }}">{{ \App\Bll\Utility::getProduct($item['value'])->title}}
                                                    </a>
                                                @elseif($item['code'] == "category")
                                                    <a class="nav-link" @if($item['integer_value'] == 1)
                                                    @endif
                                                    href="{{route('store_category_product',[app()->getLocale(),$item['value']])}}">{{ \App\Bll\Utility::getCategory($item['value'])->title}}
                                                    </a>
                                                @elseif($item['code'] == "pages")
                                                    <a class="nav-link" @if($item['integer_value'] == 1)
                                                    @endif
                                                    href="{{ $item['value'] }}">{{ \App\Bll\Utility::getPage($item['value'])->title}}
                                                    </a>
                                                @elseif($item['code'] == "link")
                                                    <a class="nav-link" @if($item['integer_value'] == 1)
                                                    @endif
                                                    href="{{ $item['value'] }}">{{$item['title']}}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="nav-item active">
                                            <a class="nav-link"
                                               href="{{ route('store.home' ,app()->getLocale()) }}">{{_i('Home')}}
                                                <span class="sr-only">(current)</span>
                                            </a>
                                        </li>
                                        <!------------------------------------ blogs -------------------------->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{_i('Blogs')}}
                                            </a>
                                            @php
                                                $blog_cats = \App\Bll\Article::getStoreCategories();
                                            @endphp

                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                @if($blog_cats->count() > 0)
                                                    @foreach($blog_cats as $cat)
                                                        <a class="dropdown-item"
                                                           href="{{ url(app()->getLocale().'/store/blog_cat/'.$cat->id) }}">{{ $cat->title }}</a>
                                                    @endforeach
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item"
                                                       href="{{url(app()->getLocale().'/store/blog_cats')}}">{{_i('All Bogs')}}</a>
                                                @else
                                                    <a class="dropdown-item" href="#">{{ _i('No Blogs') }}</a>
                                                @endif
                                            </div>
                                        </li>
                                        <!---------------------------------- end blogs categories ---------------------------------->
                                        <!------------------------------------ product categories -------------------------->
                                        @foreach(\App\Bll\Utility::getCategoriesNav() as $key => $cat)
                                            @if(count($cat->children) > 0)
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                       role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        {{$cat->title}}
                                                    </a>
                                                    @if(count(\App\Models\Category::where('lang_id',getLang(session('lang')))->where('parent_id'
                                                        , catLangCheck($cat->id))->get()) > 0)
                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            @foreach(\App\Models\Category::where('lang_id',getLang(session('lang')))->where('parent_id', catLangCheck($cat->id))->get() as $sub_cat)
                                                                <a class="dropdown-item"
                                                                   href="{{route('store_category_product',['locale' => app()->getLocale(),'id' => $sub_cat->id])}}">{{$sub_cat->title}}</a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </li>
                                            @else
                                                <li class="nav-item  ">
                                                    <a class="nav-link"
                                                       href="{{route('store_category_product',[app()->getLocale() ,$cat->id])}}">
                                                        {{$cat->title}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    <!------------------------------------- end product categories ------------------------------->
                                        <li class="nav-item  ">
                                            <a class="nav-link"
                                               href="{{ route('store_contact_url' ,app()->getLocale()) }}">{{_i('Contact Us')}}</a>
                                        </li>
                                        @if(count($pages = \App\Bll\Utility::getPages()) >1)
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                   role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{_i('Who are We')
                                                    }}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    @foreach(\App\Bll\Utility::getPages() as  $item)
                                                        <a class="dropdown-item"
                                                           href="{{url(app()->getLocale().'/store/page/'.$item['id'])}}">{{$item['title']}}</a>
                                                    @endforeach

                                                </div>
                                            </li>
                                        @else
                                            <li class="nav-item  ">
                                                <a class="nav-link"
                                                   href="{{url(app()->getLocale().'/store/page/'.$pages->first()['id'])}}">{{$pages->first()['title']}}</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>

                            </div>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>


</header>
