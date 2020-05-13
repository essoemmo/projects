<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="{{ url('home') }}">

                @php
                    $setting = \App\Setting\Setting::where('store_id', null)->first();
                @endphp
                @if(!empty(\App\Bll\Utility::getFrontSettigs()->logo))
                    <img class="img-fluid" style="width: 50px;height: 50px"
                         src="<?= asset(\App\Bll\Utility::getSetting()->logo)?>"
                         alt="Store logo">
                @else
                    <img src="{{asset('masterAdmin/assets/images/user.png')}}" alt="Store logo">
                @endif

            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-left">
                    <li>
                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                    </li>
                    <!----
                    <li>
                        <a class="main-search morphsearch-search" href="#">
                             <i class="ti-search"></i>
                        </a>
                    </li>
                    ---->


                    @php $langall = App\Models\Language::all(); @endphp


                    <li class="header-notification lng-dropdown">
                        <a href="#" id="dropdown-active-item">
                            @foreach ($langall as $item)
                                @if (adminlang() == $item->code )
                                    <img src="{{ asset('images/'.$item->flag) }}" alt="">
                                    {{_i($item->title)}}
                                @endif
                            @endforeach
                        </a>
                        <ul class="show-notification">
                            @foreach ($langall as $key => $item)
                                <li>
                                    <a href="{{url('/adminlang/')}}/{{$item->code}}" data-lng="en">
                                        <img src="{{ asset('images/'.$item->flag) }}" style="width: 18.66px;height: 14;"
                                             alt=""> {{_i($item->title)}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="header-notification lng-dropdown">
                        {{--                        <a href="#" id="dropdown-active-item">--}}
                        {{--                            <i class="ti-world"></i> {{_i('Language')}}--}}
                        {{--                        </a>--}}
                        <ul class="show-notification">
                            {{--                            @foreach($languages = \App\Models\SiteLanguage::all() as $lang)--}}
                            {{--                            <li>--}}
                            {{--                                <a href="{{url('/admin/lang/'.$lang['locale'])}}" data-lng="en">--}}
                            {{--                                    <i class="flag-icon flag-icon-gb m-r-5"></i> {{$lang['title']}}--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            @endforeach--}}

                            {{--                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
                            {{--                                <li>--}}
                            {{--                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
                            {{--                                        {{ $properties['native'] }}--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endforeach--}}

                        </ul>
                    </li>
                    <li class="user-profile header-notification">
                        <a href="#!">
                            @if (!empty(\App\Bll\Utility::getStoreprofile()->image))
                                <img class="img-fluid img-circle"
                                     src="{{asset('/uploads/users/'.\App\Bll\Utility::getStoreprofile()->id.'/'.\App\Bll\Utility::getStoreprofile()->image)}}"
                                     alt="User-Profile-Image">
                            @else
                                <img src="{{asset('masterAdmin/assets/images/user.png')}}" alt="User-Profile-Image">
                            @endif

                            <span>{{auth()->guard(\App\Help\Utility::Store)->user()->name}}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="{{url('/adminpanel/settings')}}">
                                    <i class="ti-settings"></i> {{_i('Settings')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/adminpanel/profile')}}">
                                    <i class="ti-user"></i> {{_i('Profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/adminpanel/logout')}}">
                                    <i class="ti-layout-sidebar-left"></i> {{_i('Logout')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">
                        <input class="morphsearch-input" type="search" placeholder="Search..."/>
                        <button class="morphsearch-submit" type="submit">{{_i('Search')}}</button>
                    </form>

                    <!-- /morphsearch-content -->
                    <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                </div>
                <!-- search end -->
            </div>
        </div>
    </div>
</nav>
