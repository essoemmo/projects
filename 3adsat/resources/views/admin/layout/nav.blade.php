<nav class="pcoded-navbar" pcoded-header-position="relative">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-40" src="{{asset('admin2/assets/images/user.png')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <span> {{auth()->user()->name}}</span>
                    <span id="more-details"> {{auth()->user()->email}}<i class="ti-angle-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{url('admin/panel/users/'.auth()->user()->id.'/edit')}}"><i class="ti-user"></i>{{_i('View Profile')}}</a>
                        <a href="{{url('admin/panel/settings')}}"><i class="ti-settings"></i>{{_i('Settings')}}</a>
                        <a href="{{ url('admin/panel/logout') }}"><i class="ti-layout-sidebar-left"></i>{{_i('Logout')}}</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{request()->is('admin/panel') ? 'active pcoded-trigger' : ''}}">
                <a href="{{url('/admin/panel')}}">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Dashboard')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <!--------------------------- Settings ---------------------------------------->
            <li class="pcoded-hasmenu   {{request()->is('admin/panel/slider')||request()->is('admin/panel/slider/*')|| request()->is('admin/panel/content_management/*')|| request()->is('admin/panel/content_management')||
             request()->is('admin/panel/section_products')||request()->is('admin/panel/section_products/*')||request()->is('admin/panel/settings')|| request()->is('admin/panel/content_management/*')||
             request()->is('admin/panel/manufacturers')||request()->is('admin/panel/manufacturers/*')||request()->is('admin/panel/translate')||request()->is('admin/panel/translate/*')||request()->is('admin/panel/discount') ||
             request()->is('admin/panel/countries')||request()->is('admin/panel/countries/*')||request()->is('admin/panel/currency') || request()->is('admin/panel/city/all') || request()->is('admin/panel/city*')?
             'active pcoded-trigger' : '' }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-settings"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Settings')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{request()->is('admin/panel/slider') ||request()->is('admin/panel/slider/*')? 'active' : '' }}">
                        <a href="{{url('/admin/panel/slider')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Slider')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{request()->is('admin/panel/content_management')||request()->is('admin/panel/content_management/*')  ? 'active' : '' }}">
                        <a href="{{route('content_management.index')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Sections Management')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="{{request()->is('admin/panel/section_products')||request()->is('admin/panel/section_products/*') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/section_products')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Section Products')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{request()->is('admin/panel/settings') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/settings')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('General Setting')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!----------------------- manufacturers ---------------->
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/manufacturers') ||request()->is('admin/panel/manufacturers/*')? 'active' : ''}}">
                        <a href="{{url('/admin/panel/manufacturers')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Manufacturers')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!----------------------- translation ---------------->
                    <li class="{{request()->is('admin/panel/translate')||request()->is('admin/panel/translate/*') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/translate')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Translation')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!----------------------- Discount Code ---------------->
                    <li class="{{request()->is('admin/panel/discount') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/discount')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Discount')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{request()->is('admin/panel/countries')||request()->is('admin/panel/countries/*') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/countries')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Countries')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="{{request()->is('admin/panel/city/all')||request()->is('admin/panel/city/*') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/city/all')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Cities')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="{{request()->is('admin/panel/currency') ? 'active' : '' }}">
                        <a href="{{url('/admin/panel/currency')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">{{_i('Currencies')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>


                </ul>
            </li>

            <!--------------------------- security ---------------------------------------->
            <li class="pcoded-hasmenu  {{request()->is('admin/panel/lang_id/*') | request()->is('admin/panel/role/*') || request()->is('admin/panel/permission/*') || request()->is('admin/panel/users') || request()->is('admin/panel/users/create')
            | request()->is('admin/panel/front_users') || request()->is('admin/panel/front_users/*')? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Security')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!-----------------------  permissions  ---------------->
                    <li class="{{request()->is('admin/panel/permission/*')? 'active' : ''}}">
                        <a href="{{url('/admin/panel/permission/all')}}">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default"> {{_i('Permissions')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-----------------------  roles  ---------------->
                    <li class=" {{request()->is('admin/panel/role/*')? 'active' : ''}}">
                        <a href="{{url('/admin/panel/role/all')}}">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Roles')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!----------------------- admins ----------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/users') || request()->is('admin/panel/users/create')? 'active' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Admins')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/users/create')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/users/create')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Add')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/users')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/users')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('All')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!----------------------- users ----------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/front_users') || request()->is('admin/panel/front_users/*')? 'active' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Users')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/front_users/create')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/front_users/create')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Add')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/front_users')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/front_users')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('All')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>


            <!--------------------------- General ---------------------------------------->
            <li class="pcoded-hasmenu {{request()->is('admin/panel/categories')  || request()->is('admin/panel/products') || request()->is('admin/panel/spheres') || request()->is('admin/panel/cylinder')
            || request()->is('admin/panel/axis') || request()->is('admin/panel/rating/all') || request()->is('admin/panel/lens')|| request()->is('admin/panel/stockStatus/all') ? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-package"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i("Products Manager")}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!----------------------- category ---------------->

                    <li class="pcoded {{request()->is('admin/panel/categories') ? 'active pcoded-trigger' : ''}}">
                        <a href="{{url('/admin/panel/categories')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Category')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <!----------------------- products ---------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/products') || request()->is('admin/panel/spheres') || request()->is('admin/panel/cylinder') || request()->is('admin/panel/axis') || request()->is('admin/panel/rating/all') || request()->is('admin/panel/lens') || request()->is('admin/panel/attributegroups')
                    || request()->is('admin/panel/attributegroups') || request()->is('admin/panel/attributes')|| request()->is('admin/panel/stockStatus/all') ? 'active pcoded-trigger' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Products')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/products')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/products')}}">
                                    {{--                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('All Products')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/stockStatus/all')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/stockStatus/all')}}">
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Stock Status')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/spheres')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/spheres')}}">
                                    {{--                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Spheres')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/cylinder')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/cylinder')}}">
                                    {{--                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Cylinder')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/axis')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/axis')}}">
                                    {{--                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Axis')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                            <li class="{{request()->is('admin/panel/rating/all')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/rating/all')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Ratings')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            {{-- Lens --}}
                            <li class="{{request()->is('admin/panel/lens')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/lens')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Lenses')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!----------------------- article ---------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/attributegroups') || request()->is('admin/panel/attributegroups') || request()->is('admin/panel/attributes') ? 'active pcoded-trigger' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Attributes')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/attributegroups')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/attributegroups')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Attributes Group')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/attributes')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/attributes')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Attributes')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>


            <!--------------------------- articles ---------------------------------------->
            <li class="pcoded-hasmenu {{request()->is('admin/panel/artcle_category/*') | request()->is('admin/panel/article/*')? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-pencil-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Article Management')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!----------------------- article category ---------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/artcle_category/*')? 'active pcoded-trigger' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Category')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/artcle_category/create')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/artcle_category/create')}}">
                                    {{--                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>--}}
                                    <span class="pcoded-micon"><i class="ti-plus"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Add')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/artcle_category/all')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/artcle_category/all')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('All')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!----------------------- article ---------------->
                    <li class="pcoded-hasmenu {{request()->is('admin/panel/article/*')? 'active pcoded-trigger' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Article')}} </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{request()->is('admin/panel/article/create')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/article/create')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('Add')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="{{request()->is('admin/panel/article/all')? 'active' : ''}}">
                                <a href="{{url('/admin/panel/article/all')}}">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{_i('All')}}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <!--------------------------- contact ---------------------------------------->
            <li class="pcoded {{request()->is('admin/panel/contact/all') ? 'active pcoded-trigger' : ''}}">
                <a href="{{url('/admin/panel/contact/all')}}">
                    <span class="pcoded-micon"><i class="ti-email"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Contacts')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <!--------------------------- newsletter ---------------------------------------->
            <li class="pcoded {{request()->is('admin/panel/newsletters/all') ? 'active pcoded-trigger' : ''}}">
                <a href="{{url('/admin/panel/newsletters/all')}}">
                    <span class="pcoded-micon"><i class="ti-bell"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('News Letter')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="pcoded {{request()->is('admin/panel/orders.*') ? 'active pcoded-trigger' : ''}}">
                <a href="{{url('/admin/panel/orders')}}">
                    <span class="pcoded-micon"><i class="ti-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Orders')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="pcoded-hasmenu {{request()->is('admin/panel/shipping_company') || request()->is('admin/panel/shipping_option')? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Shipping') }} </span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/shipping_company.*') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/shipping_company')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Shipping Company')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/shipping_option.*') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/shipping_option')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Shipping Option')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{request()->is('admin/panel/transferBank') || request()->is('admin/panel/transactionType')? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Transactions') }} </span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/transferBank.*') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/transferBank')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('bank transfer')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/transactionType.*') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/transactionType')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Transaction Type')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu {{request()->is('admin/panel/orderReport') || request()->is('admin/panel/purchasedProductsReport') || request()->is('admin/panel/customerOrderReport')? 'active pcoded-trigger' : ''}}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main"> {{_i('Reports') }} </span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/orderReport') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/orderReport')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Order Report')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/purchasedProductsReport') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/purchasedProductsReport')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Purchased Products Report')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="pcoded  pcoded-trigger {{request()->is('admin/panel/customerOrderReport') ? 'active' : ''}}">
                        <a href="{{url('/admin/panel/customerOrderReport')}}">
                            <span class="pcoded-micon"><i class="ti-bell"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">{{_i('Customer Order Report')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>



        </ul>



    </div>
</nav>
