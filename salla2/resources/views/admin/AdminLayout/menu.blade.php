@php
    $ShippingOption_menu=0;
    $languages_menu=1;
    $comments_menu=0;
    $product_menu=0;
    $orders_menu=0;
    $article_menu=0;
    // $pages_menu=0;
    $chat_menu=0;
    $transactionType_menu=0;
    $transferBank_menu=0;
    $contact_menu=0;


    //$store_menu=0;
    if(Auth::user()->hasPermissionTo('ShippingOption-Add','store') ||Auth::user()-> hasPermissionTo('ShippingOption-Edit','store') || Auth::user()-> hasPermissionTo('ShippingOption-Delete','store') )
    {
    $ShippingOption_menu=1;
    }

    if(Auth::user() -> hasPermissionTo('Comment-Show','store')) {
    $comments_menu=1;
    }

    if(Auth::user() -> hasPermissionTo('Product-Add','store')||Auth::user() -> hasPermissionTo('Product-Edit','store') || Auth::user()-> hasPermissionTo('Product-Delete','store')) {
    $product_menu=1;
    }
    if(Auth::user() -> hasPermissionTo('Order-Add','store')||Auth::user() -> hasPermissionTo('Order-Edit','store') || Auth::user()-> hasPermissionTo('Order-Delete','store')) {
    $orders_menu=1;
    }
    // if(Auth::user() -> hasPermissionTo('Store-Add','store')||Auth::user() -> hasPermissionTo('Store-Edit','store') || Auth::user()-> hasPermissionTo('Store-Delete','store')) {
    //   $store_menu=1;
    // }

    if(Auth::user() -> hasPermissionTo('Article-Add','store')||Auth::user() -> hasPermissionTo('Article-Edit','store') || Auth::user()-> hasPermissionTo('Article-Delete','store')) {
    $article_menu=1;
    }

    // if(Auth::user() -> hasPermissionTo('Page-Add','store')||Auth::user() -> hasPermissionTo('Page-Edit','store') || Auth::user()-> hasPermissionTo('Page-Delete','store')) {
    // $article_menu=1;
    // }

    if(Auth::user()-> hasPermissionTo('Chat-Show','store')) {
    $chat_menu=1;
    }

    if(Auth::user()-> hasPermissionTo('TransactionType-Add','store')||Auth::user() -> hasPermissionTo('TransactionType-Edit','store') || Auth::user()-> hasPermissionTo('TransactionType-Delete','store')) {
    $transactionType_menu=1;
    }

    if(Auth::user()-> hasPermissionTo('Contact-Show','store')) {
    $contact_menu=1;
    }



@endphp


<nav class="pcoded-navbar" pcoded-header-position="relative">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">

                @php

                    $input = route('store.home',app()->getLocale());

                    // remove www
                    $domain = preg_replace('#^https?://#', '', rtrim($input,'/'));

                @endphp
                <a href="{{request()->getScheme()}}://{{\App\Bll\Utility::getStoreDomain()}}.{{ $domain }}">
                    <img class="img-fluid" style="width: 50px;height: 50px"
                         src="<?= \App\Bll\Utility::getSetting()->logo ?>" alt="Store logo">
                </a>
                <div class="user-details">
                    <a href="{{request()->getScheme()}}://{{\App\Bll\Utility::getStoreDomain()}}.{{ $domain }}">
                        <span>{{\App\Bll\Utility::getStoreName()}}</span>
                    </a>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{url('/adminpanel/profile')}}"><i class="ti-user"></i>{{_i('View Profile')}}</a>
                        <a href="{{url('/adminpanel/settings')}}"><i class="ti-settings"></i>{{_i('Settings')}}</a>
                        <a href="{{url('/adminpanel/logout')}}"><i class="ti-layout-sidebar-left"></i>{{_i('Logout')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"
             menu-title-theme="theme5">{{_i('MAIN NAVIGATION')}}</div>

        {{--main navigation menu--}}
        <ul class="pcoded-item pcoded-left-item">

            {{-------------  index -----------------}}
            <li class=" {{(request()->is('adminpanel')) ? 'active':''}}">
                <a href="{{url('/adminpanel')}}">
                    <span class="pcoded-micon"><i class="ti-dashboard"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.analytics">{{_i('Home')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            {{--            --------------------products--------------------}}
            @if ($product_menu == 1)
                <li class="{{request()->is('adminpanel/product') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/product')}}">
                        <span class="pcoded-micon"><i class="ti-view-list"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Products')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>

                </li>
            @endif


        <!------------------------------- Orders ------------------->
            @if ($orders_menu == 1)
                <li class=" {{request()->is('adminpanel/orders/all') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/orders/all')}}">
                        <span class="pcoded-micon"><i class="ti-shopping-cart"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Orders')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>

                </li>
            @endif

            {{--            customers              --}}
            @if(Auth::guard('store')->user()->hasPermissionTo('AdminUser-Add'))

                <li class=" {{ request()->is('adminpanel/store_user')  ? 'active' : '' }}">
                    <a href="{{url('/adminpanel/store_user')}}">
                        <span class="pcoded-micon"><i class="ti-user"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Customers')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>

                </li>
            @endcan

            @if(Auth::guard('store')->user()->hasPermissionTo('reports'))
                <li class="{{(request()->is('adminpanel/reports')) ? 'active' : '' }}">
                    <a href="{{ url('/adminpanel/reports') }}">
                        <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Reports')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            {{-------------  comments -----------------}}
            @if ($comments_menu == 1)
                <li class="{{(request()->is('adminpanel/comments')) ? 'active ':''}}">
                    <a href="{{url('/adminpanel/comments')}}">
                        <span class="pcoded-micon"><i class="ti-flag-alt-2"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.analytics">{{_i('Comments')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

            @endif

            @if ($contact_menu == 1)
                <li class="{{(request()->is('adminpanel/contact/*')) ? 'active' : '' }}">
                    <a href="{{url('/adminpanel/contact/all')}}">
                        <span class="pcoded-micon"><i class="ti-comment-alt"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Contacts')}}</span>
                    </a>
                </li>
            @endif

            {{-------------  pages -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('Page-Add'))
                <li class="{{request()->is('adminpanel/pages/*') || request()->is('adminpanel/pages') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/pages')}}">
                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Pages')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif


            {{-------------  articles -----------------}}
            @if ($article_menu == 1)
            <!--                <li class="pcoded-hasmenu {{request()->is('adminpanel/article/*')||request()->is('adminpanel/artcle_category/*')  ? 'pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-text"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Articles')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">


                        <li class="{{(request()->is('adminpanel/article/all')) ? 'active' : '' }} ">
                            <a href="{{url('/adminpanel/article/all')}}">
                                <span class="pcoded-micon"><i class="ti-view-list"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('All')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="{{(request()->is('adminpanel/artcle_category/all')) ? 'active' : '' }} ">
                            <a href="{{url('/adminpanel/artcle_category/all')}}">
                                <span class="pcoded-micon"><i class="ti-view-list"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Categories')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                    </ul>
                </li>-->
            @endif

            {{-------------  transaction -----------------}}
            @if ($transactionType_menu == 1)
                <li class=" {{request()->is('adminpanel/transactionType/*') ? 'active pcoded-trigger' :''}}">
                    <a href="{{url('/adminpanel/transactionType/all')}}">
                        <span class="pcoded-micon"><i class="ti-money"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('transactionType')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

        </ul>

        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"
             menu-title-theme="theme5">{{_i('Marketing')}}</div>

        {{--marketing menu--}}

        <ul class="pcoded-item pcoded-left-item">

            {{-------------  Discount Code -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('Discount'))
                <li class="{{request()->is('adminpanel/settings/discount_code') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/settings/discount_code')}}">
                        <span class="pcoded-micon"><i class="ti-ticket"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Discount Code')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            {{-------------  Marketing campaigns -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('campaign'))
                <li class="{{request()->is('adminpanel/campaign') ||request()->is('adminpanel/campaign/*') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/campaign')}}">
                        <span class="pcoded-micon"><i class="icofont icofont-social-telegram"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Marketing campaigns')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            {{-------------  abandoned carts -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('Abandon-Cart'))
                <li class="{{(request()->is('adminpanel/abandoned_carts')) || request()->is('adminpanel/abandoned_carts/*') ? 'active' : '' }}">
                    <a href="{{ url('/adminpanel/abandoned_carts') }}">
                        <span class="pcoded-micon"><i class="ti-flag-alt-2"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.analytics">{{_i('abandoned carts')}}</span>
                    </a>
                </li>
            @endif

            {{-------------  offers -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('offers'))
                <li class="{{request()->is('adminpanel/settings/offer') ||request()->is('adminpanel/settings/offer/*') ? 'active' :''}}">
                    <a href="{{url('/adminpanel/settings/offer')}}">
                        <span class="pcoded-micon"><i class="icofont icofont-sale-discount"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Offers')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            {{-------------  celebrates -----------------}}
            <li class="{{request()->is('adminpanel/celebrates') ? 'active' :''}}">
                <a href="{{route('celebrates.index')}}">
                    <span class="pcoded-micon"><i class="ti-settings"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('celebrates')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>

            </li>
        </ul>


        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"
             menu-title-theme="theme5">{{_i('Setting')}}</div>

        {{--setting menu--}}

        <ul class="pcoded-item pcoded-left-item">

            {{------------- setting -----------------}}
            @if ($languages_menu == 1)
                <li class=" {{request()->is('adminpanel/settings/*')  || request()->is('adminpanel/settings') || request()->is("adminpanel/content_management")  ? 'active' : '' }}">
                    <a href="{{url('/adminpanel/settings')}}">
                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Settings')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>

                </li>
            @endif

            {{------------- Store design -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('Design'))
                <li class="{{(request()->is('adminpanel/design')) ? 'active' : '' }}">
                    <a href="{{url('/adminpanel/design')}}">
                        <span class="pcoded-micon"><i class="ti-layout "></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Store design')}}</span>
                    </a>
                </li>
            @endif
            {{------------- Salla Store -----------------}}
            @if(Auth::guard('store')->user()->hasPermissionTo('Store-Controll'))
                <li class="{{(request()->is('adminpanel/salla_store')) ? 'active' : '' }}">
                    <a href="{{url('/adminpanel/salla_store')}}">
                        <span class="pcoded-micon"><i class="ti-layout "></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Sallatk Store')}}</span>
                    </a>
                </li>
            @endif

            {{------------- shipping -----------------}}
            @if ($ShippingOption_menu == 1)
                <li class="pcoded-hasmenu {{(request()->is('adminpanel/shipping_option/*') || request()->is('adminpanel/companies')) ? 'pcoded-trigger':''}}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('shipping')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=" {{request()->is('adminpanel/companies/*') ? 'active' :''}}">
                            <a href="{{url('/adminpanel/companies')}}">
                                <span class="pcoded-micon"><i class="ti-bookmark"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('companies')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>

                        </li>
                        <li class="{{request()->is('adminpanel/shipping_option/*') ? 'active' :''}}">
                            <a href="{{url('/adminpanel/shipping_option/all')}}">
                                <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('shipping option')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>

                        </li>
                    </ul>
                </li>
            @endif

            {{------------- banks -----------------}}
            {{--            @can(['BankTransfer-Add','BankTransfer-Edit','BankTransfer-Delete'])--}}
            {{--                <li class=" {{(request()->is('adminpanel/transferBank/*') || request()->is('adminpanel/transferBank') )? 'active' :''}}">--}}
            {{--                   <a href="{{url('/adminpanel/transferBank')}}">--}}
            {{--                        <span class="pcoded-micon"><i class="ti-home"></i></span>--}}
            {{--                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('bank transfer')}}</span>--}}
            {{--                        <span class="pcoded-mcaret"></span>--}}
            {{--                    </a>--}}
            {{--                    --}}
            {{--                </li>--}}
            {{--            @endif--}}

            @if(Auth::guard('store')->user()->hasPermissionTo('Role-Add')|Auth::guard('store')->user()->hasPermissionTo('Role-Edit'))
                <li class="pcoded-hasmenu  {{request()->is('adminpanel/permission/*')||request()->is('adminpanel/role/*')||request()->is('adminpanel/user/*')  ? 'pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-shield"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Security')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">

                        @if(Auth::guard('store')->user()->hasPermissionTo('Permission-Add')|Auth::guard('store')->user()->hasPermissionTo('Permission-Edit'))
                            <li class="{{(request()->is('adminpanel/permission/*')) ? 'active' : '' }}">
                                <a href="{{url('/adminpanel/permission/all')}}">
                                    <span class="pcoded-micon"><i class="ti-view-list"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('permission')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        @endif


                        <li class=" {{(request()->is('adminpanel/role/*')) ? 'active':''}}">
                            <a href="{{url('/adminpanel/role/all')}}">
                                <span class="pcoded-micon"><i class="ti-shield"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Roles')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>

                        </li>
                        {{--                        <li class=" {{(request()->is('adminpanel/user/*')) ? 'active':''}}">--}}
                        {{--                            <a href="{{url('/adminpanel/user/all')}}">--}}
                        {{--                                <span class="pcoded-micon"><i class="ti-user"></i></span>--}}
                        {{--                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Admins')}}</span>--}}
                        {{--                                <span class="pcoded-mcaret"></span>--}}
                        {{--                            </a>--}}

                        {{--                        </li>--}}


                    </ul>
                </li>
            @endif
            @can('Ticket-Add')
                {{--                <li class="pcoded-hasmenu {{(request()->is('adminpanel/ticket/*')) ? 'pcoded-trigger':''}}">--}}
                {{--                    <a href="javascript:void(0)">--}}
                {{--                        <span class="pcoded-micon"><i class="ti-ticket"></i></span>--}}
                {{--                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('ticket')}}</span>--}}
                {{--                        <span class="pcoded-mcaret"></span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="pcoded-submenu">--}}
                {{--                        <li class="{{(request()->is('adminpanel/ticket')) ? 'active' : '' }}">--}}
                {{--                            <a href="{{url('/adminpanel/ticket')}}">--}}
                {{--                                <span class="pcoded-micon"><i class="ti-ticket"></i></span>--}}
                {{--                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('active tickets')}}</span>--}}
                {{--                                <span class="pcoded-mcaret"></span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="{{(request()->is('adminpanel/ticket/completed/index')) ? 'active' : '' }}">--}}
                {{--                            <a href="{{url('/adminpanel/ticket/completed/index')}}">--}}
                {{--                                <span class="pcoded-micon"><i class="ti-check-box"></i></span>--}}
                {{--                                <span class="pcoded-mtext"--}}
                {{--                                      data-i18n="nav.dash.default">{{_i('completed tickets')}}</span>--}}
                {{--                                <span class="pcoded-mcaret"></span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="pcoded-hasmenu {{request()->is('adminpanel/ticketSetting/*') ? 'pcoded-trigger' :''}}">--}}
                {{--                            <a href="javascript:void(0)">--}}
                {{--                                <span class="pcoded-micon"><i class="ti-settings"></i></span>--}}
                {{--                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('ticket Setting')}}</span>--}}
                {{--                                <span class="pcoded-mcaret"></span>--}}
                {{--                            </a>--}}
                {{--                            <ul class="pcoded-submenu">--}}
                {{--                                <li class="{{(request()->is('adminpanel/ticketSetting/category')) ? 'active' : '' }}">--}}
                {{--                                    <a href="{{url('/adminpanel/ticketSetting/category')}}">--}}
                {{--                                        <span class="pcoded-micon"><i class="ti-layout-grid2-thumb"></i></span>--}}
                {{--                                        <span class="pcoded-mtext"--}}
                {{--                                              data-i18n="nav.dash.default">{{_i('category')}}</span>--}}
                {{--                                        <span class="pcoded-mcaret"></span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="{{(request()->is('adminpanel/ticketSetting/priority')) ? 'active' : '' }}">--}}
                {{--                                    <a href="{{url('/adminpanel/ticketSetting/priority')}}">--}}
                {{--                                        <span class="pcoded-micon"><i class="ti-check"></i></span>--}}
                {{--                                        <span class="pcoded-mtext"--}}
                {{--                                              data-i18n="nav.dash.default">{{_i('priority')}}</span>--}}
                {{--                                        <span class="pcoded-mcaret"></span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                <li class="{{(request()->is('adminpanel/ticketSetting/agent')) ? 'active' : '' }}">--}}
                {{--                                    <a href="{{url('/adminpanel/ticketSetting/agent')}}">--}}
                {{--                                        <span class="pcoded-micon"><i class="ti-user"></i></span>--}}
                {{--                                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('agent')}}</span>--}}
                {{--                                        <span class="pcoded-mcaret"></span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            @endcan
            @if(Auth::guard('store')->user()->hasPermissionTo('Chat-Show'))
                <li class="pcoded-hasmenu {{(request()->is('adminpanel/chat')||request()->is('adminpanel/chat')) ? 'pcoded-trigger':''}}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-comments"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('chat room')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{(request()->is('adminpanel/chat')) ? 'active' : '' }}">
                            <a href="{{url('/adminpanel/chat')}}">
                                <span class="pcoded-micon"><i class="ti-comments"></i></span>
                                <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('chat room')}}</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</nav>
