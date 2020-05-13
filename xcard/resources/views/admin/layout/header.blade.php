<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="{{ route('home') }}">
                @if(setting() != null)
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px" src="{{ setting()->logo }}" alt="Theme-Logo" />
                @else
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px" src="{{asset('adminPanel/assets/images/logo.png')}}" alt="Theme-Logo" />
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
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="header-notification lng-dropdown">
                        <a href="#" id="dropdown-active-item">
                            <i class="ti-world"></i> {{_i('Language')}}
                        </a>
                        <ul class="show-notification">
{{--                            @foreach($languages = \App\Models\SiteLanguage::all() as $lang)--}}
{{--                            <li>--}}
{{--                                <a href="{{url('/admin/lang/'.$lang['locale'])}}" data-lng="en">--}}
{{--                                    <i class="flag-icon flag-icon-gb m-r-5"></i> {{$lang['title']}}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endforeach--}}

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="user-profile header-notification">
                        <a href="#!">
                            <img src="{{asset('adminPanel/assets/images/user.png')}}" alt="User-Profile-Image">
                            <span>{{ admin()->user()->first_name }} {{ admin()->user()->last_name }}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="{{aUrl('setting')}}">
                                    <i class="ti-settings"></i> {{ _i('Settings') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/profile')}}">
                                    <i class="ti-user"></i> {{ _i('Profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ aUrl('logout') }}">
                                    <i class="ti-layout-sidebar-left"></i>
                                    {{ _i('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">
                        <input class="morphsearch-input" type="search" placeholder="Search..." />
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
