<header>
    <div class="top-social-bar grade">
        <div class="container">
            <div class="social-icons">

                @php
                    $setting_socials = \App\Models\SocialLinkSetting::all();
                @endphp
                @php
                    $user_setting = \App\Models\UserSetting::first();
                @endphp
                <ul class="list-inline d-flex justify-content-lg-end justify-content-center">
                    @foreach($setting_socials as $row)
                        <li class="list-inline-item">
                            <a rel="nofollow" title="{{$row['title']}}"
                               href="https://{{$row['url']}}">
                                <i class="fab {{$row['icon']}}"></i>
                            </a>
                        </li>
                    @endforeach
                    @if($user_setting['contact_us'] == 1)
                        <li class="list-inline-item">
                            <a title="{{ _i('Contact Us') }}" style="font-size: 14px; display: inline-block"
                               href="{{ url('contact_us') }}">{{_i('Contact Us')}} </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
    <div class="menu-logo py-2">
        <div class="container">
            <div class="menu-wrapper">


                <nav class="navbar navbar-expand-lg navbar-light">
                    {{--                    <a class="navbar-brand" href="#">--}}
                    {{--                        <img src="{{asset('front/images/logo.png')}}" width="50" height="50" class=" align-top d-lg-none d-inline-block"--}}
                    {{--                             alt="">--}}

                    {{--                    </a>--}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a title="{{ _i('Home') }}" class="nav-link" href="{{ route('home') }}">{{_i('Home')}}
                                    <span class="sr-only">(current)</span></a>
                            </li>

                            <!-------------------------------------------------- Content --------------------------------------------------------------->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{url('articleCats/all')}}"
                                   id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{_i('Content')}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @php
                                        $main_blogCat = \App\Models\BlogCategory::where('main' ,"!=", 1)->take(6)->get();
                                    @endphp

                                    @foreach($main_blogCat as $cat)
                                        <a class="dropdown-item"
                                           href="{{url('articleCat/'.$cat->id)}}">{{$cat->translate(\app()->getLocale())->title}}</a>
                                    @endforeach
                                    <a class="dropdown-item" href="{{url('articleCats/all')}}">{{_i('View All')}}</a>

                                </div>
                            </li>


                            <!--------------------------------------------------------- about us ----------------------------------------------------------------->
                            @php
                                $main_blogCat = \App\Models\BlogCategory::where('main' , 1)->first();
                            @endphp
                            @if($main_blogCat)
                                <li class="nav-item dropdown">
                                    <a title="" class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                       role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{$main_blogCat->translate(\app()->getLocale())->title}}
                                    </a>
                                    @php
                                        $blogs = \App\Models\blog::where('category_id' , $main_blogCat->id)->where('publish' , 1)->take(6)->get();
                                    @endphp

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if(count($blogs) > 0)
                                            @foreach($blogs as $blog)
                                                <a title="" class="dropdown-item"
                                                   href="{{url('blog/'.$blog->id)}}">{{$blog->translate(app()->getLocale())->title}}</a>
                                            @endforeach
                                        @endif
                                        <a title="" class="dropdown-item"
                                           href="{{url('blogCat/'.$main_blogCat->id)}}">{{_i('View All')}}</a>
                                    </div>
                                </li>

                            @endif

                        </ul>

                        <ul class="logo-middle navbar-nav m-auto">
                            <li class="nav-item">
                                <a title="" class="nav-link" href="#">
                                    @if(setting() != null)
                                        <img data-src="{{ asset(setting()->logo) }}" alt="" class="img-fluid lazy">
                                    @else
                                        <img data-src="{{asset('front/images/Ashherni.png')}}" alt=""
                                             class="img-fluid lazy">
                                    @endif
                                </a>
                            </li>


                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @if(auth()->check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{_i('My Account')}}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                           href="{{ route('userProfile') }}">{{ _i('Profile') }}</a>
                                        @if(auth()->user()->user_type == 'famous')
                                            @if(userSetting()->myAds_menu == 1 && userSetting()->myAds_menu != 0)
                                                <a class="dropdown-item"
                                                   href="{{ route('myAds') }}">{{ _i('My Advertisements') }}</a>
                                            @endif
                                        @endif

                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a title="" class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">{{ _i('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @honeypot {{--prevent form spam--}}
                                    </form>
                                </li>

                            @else

                                <li class="nav-item">
                                    <a title="" class="nav-link" href="{{route('getLogin')}}">{{ _i('Login') }}</a>
                                </li>
                                @if(userSetting()->register_section == 1 && userSetting()->register_section != 0)
                                    <li class="nav-item">
                                        <a title="" class="nav-link"
                                           href="{{route('getRegister')}}"> {{ _i('Register') }}</a>
                                    </li>
                            @endif
                        @endif

                        <!--------------------------------------------------- language ------------------------------------------------------------>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{_i('Language')}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    {{--                                    <a class="dropdown-item" href="#">Action</a>--}}
                                    {{--                                        @dd(LaravelLocalization::getSupportedLocales() )--}}
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ _i($properties['name']) }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                            <!------------------------------------- end language --------------------------------------------------------->

                        </ul>
                    </div>
                </nav>


            </div>
        </div>
    </div>


</header>
