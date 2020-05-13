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
                @if($setting != null)
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px" src="{{ asset($setting->logo )}}" alt="Theme-Logo" />
                @else
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px" src="{{asset('masterAdmin/assets/images/logo.png')}}" alt="Theme-Logo" />
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
                        <?php
                        $languages = \App\Models\Language::where('code',"!=",session()->get('MasterLang'))->get();
                        ?>
                        <a href="#" id="dropdown-active-item">
{{--                            <i class="ti-world"></i> {{_i('Language')}}--}}
                            <?php
                                $selected_lang = \App\Models\Language::where('code',session()->get('MasterLang'))->first();
                            ?>
                            <img src="{{ asset('images/'.$selected_lang['flag']) }}" alt=""> {{_i($selected_lang['title'])}}
                        </a>
                        <ul class="show-notification">
                            @foreach($languages as $lang)
                            <li>
                                <a href="{{url('/master/lang/'.$lang['code'])}}" data-lng="en">
                                    <img src="{{ asset('images/'.$lang['flag']) }}"  style="max-width:25px; max-height:25px; !important;" alt="">
                                    {{_i($lang['title'])}}
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </li>
                    <li class="user-profile header-notification">
                        <a href="#!">
                            @if (!empty(\App\Bll\Utility::getMasterprofile()->image))
                            <img src="{{asset('/uploads/users/'.\App\Bll\Utility::getMasterprofile()->id.'/'.\App\Bll\Utility::getMasterprofile()->image)}}" alt="User-Profile-Image">
                            @else
                            <img src="{{asset('masterAdmin/assets/images/user.png')}}" alt="User-Profile-Image">
                            @endif
                      
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="{{url('master/settings')}}">
                                    <i class="ti-settings"></i> {{ _i('Settings') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('master/profile')}}">
                                    <i class="ti-user"></i> {{ _i('Profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('master/logout') }}">
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
