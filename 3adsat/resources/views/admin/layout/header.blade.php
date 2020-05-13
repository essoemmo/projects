

<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="index.html">
                <!--<img class="img-fluid" height="" src="{{asset('admin2/assets/images/logo.png')}}" alt="Theme-Logo" />-->
                QeyeQ
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

                    <li>
                        <a href="#" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>

                </ul>
                <ul class="nav-right" >
                    <li class="header-notification lng-dropdown">
                        <a href="#" id="dropdown-active-item">
                            <i class="ti-world"></i> {{_i('language')}}
                        </a>
                        <ul class="show-notification" id="langs">
                        </ul>
                    </li>

                    <li class="user-profile header-notification">
                        <a href="#">
                            <img src="{{asset('admin2/assets/images/user.png')}}" alt="User-Profile-Image">
                            <span> {{auth()->user()->name}}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="{{url('admin/panel/users/'.auth()->user()->id.'/edit')}}">
                                    <i class="ti-user"></i> {{_i('View Profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/panel/settings')}}">
                                    <i class="ti-settings"></i> {{_i('Settings')}}
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('admin/panel/logout') }}">
                                    <i class="ti-layout-sidebar-left"></i> {{_i('Logout')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">
                        <input class="morphsearch-input" type="search" placeholder="Search..." />
                        <button class="morphsearch-submit" type="submit">Search</button>
                    </form>

                    <!-- /morphsearch-content -->
                    <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                </div>
                <!-- search end -->

            </div>
        </div>
    </div>
</nav>