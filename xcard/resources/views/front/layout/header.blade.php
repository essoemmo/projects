<header>
    <div class="menu-logo py-3">
        <div class="container">
            <div class="menu-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6 align-self-center ">
                        <div class="logo">
                            @if(setting()['logo'] != null)
                                <a href="{{ route('home') }}"><img data-src="{{ setting()->logo }}" alt="" class="img-fluid lazy"></a>
                            @else
                                <a href="{{ route('home') }}"><img data-src="{{asset('front/images/logo.png')}}" alt="" class="img-fluid lazy"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6   align-self-md-center d-md-flex ">
                        <form action="{{ route('search') }}" class="w-100">
                            <div class="search-form ">
                                <input type="search" name="search" class="form-control " placeholder="{{ _i('Search') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-6   align-self-md-center d-md-flex ">
                        <div class="country-currency">
                            <div class="country">
                                <i class="fa fa-globe"></i>
                                <select class="custom-select country-select">
                                    <option selected disabled>{{_i('Country')}}</option>
                                    @foreach(countries() as $country)
                                        <option href="{{url('change_country')}}" value="{{$country->id}}"> {{$country->title}} ({{ $country->code }}) </option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="currency">--}}
{{--                                <i class="fa fa-money"></i>--}}
{{--                                <select class="custom-select ">--}}
{{--                                    <option selected>العملة</option>--}}
{{--                                    <option value="1">One</option>--}}
{{--                                    <option value="2">Two</option>--}}
{{--                                    <option value="3">Three</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                @dd(Config::get('laravel-gettext.supported-locales')[0])--}}
{{--                            <div class="currency">--}}
{{--                                <i class="fa fa-globe"></i>--}}
{{--                                <ul class="custom-select lang list-unstyled" >--}}
{{--                                    <option selected disabled>{{_i('Language')}}</option>--}}
{{--                                    @foreach($languages = \App\Models\SiteLanguage::all() as $lang)--}}
{{--                                    <option href="{{url('/lang/'.$lang['locale'])}}" value="{{$lang['locale']}}"> {{$lang['title']}} </option>--}}
{{--                                    @endforeach--}}

{{--                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--                                        <li>--}}
{{--                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                                                {{ $properties['native'] }}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}

{{--                                </ul>--}}
{{--                            </div>--}}

                            <div class="currency">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
                                    <i class="fa fa-globe"></i> {{_i('Language')}}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ _i($properties['name']) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 align-self-center">
                        <ul class="list-inline user-nav">
                            <li class="dropdown-cart-wrapper d-inline-block">
                                <div class="text-center">
                                    <a href="#" id="cart">
                                        <div class="cart-text">
                                            @if(!empty(count(\Cart::getContent())))
                                                <span class="badge">{{ count(\Cart::getContent()) }}</span>
                                            @else
                                                <span style="display: none" class="badge"></span>
                                            @endif
                                            <i class="fa fa-shopping-cart"></i>
                                            {{ _i('Cart') }}
                                        </div>
                                    </a>
                                </div>
                                <div class="shopping-cart ">
                                    <div class="shopping-cart-header">
                                        <div class="shopping-cart-total">
                                            <span class="lighter-text">{{ _i('Total') }}:</span>
                                            @if(!empty(\Cart::getContent()))
                                                <span class="main-color-text total">
                                                        {{ round(\Cart::getTotal() * getRate(country_code())->rate) }}
                                                    </span>
                                            @else
                                                <span style="display: none" class="main-color-text total">
                                                            {{ round(\Cart::getTotal() * getRate(country_code())->rate) }}
                                                        </span>
                                            @endif
                                        </div>
                                    </div> <!--end shopping-cart-header -->

                                    <ul class="shopping-cart-items list-unstyled" id="scrl">
                                        @if(!empty(count(\Cart::getContent())))
                                            @foreach(\Cart::getContent() as $item)
                                                <li class="clearfix">
                                                    <img src="{{ asset($item->attributes->image) }}" alt="item1" style="width:200px!important; height:50px!important;"/>
                                                    <span class="item-name">{{ $item->name }}</span>
                                                    <span class="item-price">{{ round($item->price * getRate(country_code())->rate) }} {{ currency()->code }}</span>
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
                                        <a href="{{route('cart')}}" class="button">{{ _i('Cart Details') }}</a>
                                    @else
                                        <a style="display: none" href="{{route('cart')}}" class="button">{{ _i('Cart Details') }}</a>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown list-inline-item">
                                @if(auth()->check())
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-sign-in"></i> {{ _i('My Profile') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('userProfile') }}">{{ _i('Profile') }}</a>
                                        <a class="dropdown-item" href="{{ route('orders') }}">{{ _i('My Orders') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                            {{ _i('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                @else
                                    <a class="nav-link" href="{{ route('getLogin') }}">
                                        <i class="fa fa-sign-in"></i> {{ _i('Login') }}
                                    </a>
                                @endif
                            </li>
                            @if(!auth()->check())
                                <li class="list-inline-item"><a href="{{route('getRegister')}}"><i class="fa fa-user-plus"></i> {{_i('Register')}}</a></li>
                            @endif
                        </ul>


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
                    <li>
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> {{_i('Home')}}</a>
                    </li>

                    <!-------------------------------- product category -------------------------------------------------------->
                    <li>
                        <a href="{{url('/categories')}}"><i class="fa fa-credit-card"></i> {{_i('Product Categories')}}</a>
                        <ul>
                            @php
                                // level one
                                $categories = \App\Models\Category::where('main_menu' , 1)->where('parent_id' , null)->orderBy('id', 'desc')->get();
                            @endphp

                            <li class="dm-block-title">{{_i('Categories')}}</li>
                            @foreach($categories as $category)
                                @php
                                    // level two
                                    $subCats = \App\Models\Category::where('parent_id' , $category['id'])->orderBy('id', 'desc')->get();
                                @endphp
                            @if(count($subCats) > 0)
                            <li>
                                <a href="{{url('/parent_cat/'.$category['id'])}}">{{$category->translate(\app()->getLocale())->title}}</a>
                                <ul>
                                    @foreach($subCats as $cat)
                                        @php
                                            // level three
                                            $childs = \App\Models\Category::where('parent_id' , $cat['id'])->orderBy('id', 'desc')->get();
                                        @endphp
                                    @if(count($childs) > 0)
                                    <li>
                                        <a href="{{url('/parent_cat/'.$cat['id'])}}">{{$cat->translate(\app()->getLocale())->title}}</a>
                                        <ul>
                                            @foreach($childs as $child)
                                            <li><a href="{{url('/category/'.$child['id'])}}">{{$child->translate(\app()->getLocale())->title}}</a></li>
                                             @endforeach
                                        </ul>
                                    </li>
                                    @else
                                    <li><a href="{{url('/category/'.$cat['id'])}}">{{$cat->translate(\app()->getLocale())->title}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li><a href="{{url('/category/'.$category['id'])}}">{{$category->translate(\app()->getLocale())->title}}</a></li>
                            @endif

                            @endforeach

                            <li><a href="{{url('/categories')}}" >{{_i('View All')}}</a></li>
                        </ul>
                    </li>

                    <!-------------------------------- product category -------------------------------------------------------->

{{--                    <li><a href="{{url('/categories')}}"><i class="fa fa-gamepad"></i>{{_i('Product Categories')}}</a>--}}
{{--                        <ul class="droopmenu-megamenu droopmenu-grid ">--}}
{{--                            <li class="droopmenu-tabs droopmenu-tabs-vertical droopmenu-tab-hover">--}}
{{--                            @php--}}
{{--                                // level one--}}
{{--                                $categories = \App\Models\Category::where('main_menu' , 1)->where('parent_id' , null)->orderBy('id', 'desc')->get();--}}
{{--                            @endphp--}}
{{--                            @foreach($categories as $category)--}}

{{--                                @if($loop->first)--}}
{{--                                    <!-- TAB ONE -->--}}
{{--                                        <div class="droopmenu-tabsection">--}}
{{--                                            <a href="{{url('/parent_cat/'.$category['id'])}}" class="droopmenu-tabheader">{{$category->translate(\app()->getLocale())->title}}</a>--}}
{{--                                            <div class="droopmenu-tabcontent">--}}
{{--                                                <div class="droopmenu-row">--}}
{{--                                                    <ul class="droopmenu-col droopmenu-col4">--}}
{{--                                                        @php--}}
{{--                                                            // level two--}}
{{--                                                            $subCats = \App\Models\Category::where('parent_id' , $category['id'])->orderBy('id', 'desc')->get();--}}
{{--                                                        @endphp--}}
{{--                                                        @foreach($subCats as $cat)--}}
{{--                                                            <li><h4>{{$cat->translate(\app()->getLocale())->title}}</h4></li>--}}
{{--                                                            @php--}}
{{--                                                                // level three--}}
{{--                                                                $childs = \App\Models\Category::where('parent_id' , $cat['id'])->orderBy('id', 'desc')->get();--}}
{{--                                                            @endphp--}}
{{--                                                            @foreach($childs as $child)--}}
{{--                                                                <li><a href="{{url('/category/'.$cat['id'])}}">{{$child->translate(\app()->getLocale())->title}}</a></li>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endforeach--}}

{{--                                                    </ul>--}}

{{--                                                </div><!-- droopmenu-row -->--}}
{{--                                            </div><!-- droopmenu-tabcontent -->--}}
{{--                                        </div><!-- droopmenu-tabsection -->--}}
{{--                                @else--}}

{{--                                    <!-- TAB TWO -->--}}
{{--                                        <div class="droopmenu-tabsection">--}}
{{--                                            <a href="{{url('/parent_cat/'.$category['id'])}}" class="droopmenu-tabheader">{{$category->translate(\app()->getLocale())->title}}</a>--}}
{{--                                            <div class="droopmenu-tabcontent">--}}
{{--                                                <div class="droopmenu-row">--}}
{{--                                                    @php--}}
{{--                                                        // level two--}}
{{--                                                        $subCats = \App\Models\Category::where('parent_id' , $category['id'])->orderBy('id', 'desc')->get();--}}
{{--                                                    @endphp--}}
{{--                                                    @foreach($subCats as $cat)--}}
{{--                                                        <ul class="droopmenu-col droopmenu-col6">--}}
{{--                                                            <li><h4>{{$cat->translate(\app()->getLocale())->title}}</h4></li>--}}
{{--                                                            @php--}}
{{--                                                                // level three--}}
{{--                                                                $childs = \App\Models\Category::where('parent_id' , $cat['id'])->orderBy('id', 'desc')->get();--}}
{{--                                                            @endphp--}}
{{--                                                            @foreach($childs as $child)--}}
{{--                                                                <li><a href="{{url('/category/'.$cat['id'])}}">{{$child->translate(\app()->getLocale())->title}} </a></li>--}}
{{--                                                            @endforeach--}}
{{--                                                        </ul>--}}
{{--                                                    @endforeach--}}

{{--                                                </div><!-- droopmenu-row -->--}}
{{--                                            </div><!-- droopmenu-tabcontent -->--}}
{{--                                        </div><!-- droopmenu-tabsection -->--}}
{{--                            @endif--}}

{{--                            @endforeach--}}
{{--                            <li>--}}
{{--                                <a href="{{url('/categories')}}" >{{_i('View All')}}</a>--}}
{{--                            </li>--}}

{{--                            </li><!-- droopmenu-tabs vertical -->--}}
{{--                        </ul><!-- droopmenu-grid -->--}}
{{--                    </li>--}}

                    <!-------------------------------- content -------------------------------------------------------->
                    @php
                        $main_blogCat = \App\Models\BlogCategory::where('main' ,"!=", 1)->take(6)->get();
                    @endphp
                    @if(count($main_blogCat) > 0)
                    <li>
                        <a href="{{url('articleCats/all')}}"><i class="fa fa-globe"></i>{{_i('Content')}}</a>
                        <ul>

                            <li class="dm-block-title">{{_i('Blog Categories')}}</li>
                            @if(count($main_blogCat) > 0)
                                @foreach($main_blogCat as $cat)
                                    <li>
                                        <a href="{{url('articleCat/'.$cat->id)}}">{{$cat->translate(\app()->getLocale())->title}} </a>
                                        <!---
                                        @php
                                            $blogs = \App\Models\blog::where('category_id' , $cat->id)->where('publish' , 1)->take(6)->get();
                                        @endphp
                                        @if(count($blogs) > 0)
                                            <ul>
                                                @foreach($blogs as $blog)
                                                    <li><a href="{{url('article/'.$blog->id)}}">{{$blog->translate(app()->getLocale())->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        -->
                                    </li>
                                @endforeach
                            @endif

                            <li class="dm-bottom-separator"></li>
                            <li><a href="{{url('articleCats/all')}}">{{_i('View All')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    <!-------------------------------- about us -------------------------------------------------------->
                    @php
                        $main_blogCat = \App\Models\BlogCategory::where('main' , 1)->first();
                    @endphp
                    @if($main_blogCat)
                        <li>
                            <a href="{{url('blogCat/'.$main_blogCat->id)}}"><i class="fa fa-file-archive-o"></i> {{_i('About')}}</a>
                            <ul>
                                @php
                                    $blogs = \App\Models\blog::where('category_id' , $main_blogCat->id)->where('publish' , 1)->take(6)->get();
                                @endphp

                                <li class="dm-block-title">{{$main_blogCat->translate(\app()->getLocale())->title}}</li>

                                @foreach($blogs as $blog)
                                    <li><a href="{{url('blog/'.$blog->id)}}">{{$blog->translate(app()->getLocale())->title}}</a></li>
                                @endforeach

                                <li class="dm-bottom-separator"></li>
                                <li><a href="{{url('blogCat/'.$main_blogCat->id)}}">{{_i('View All')}}</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div><!-- droopmenu-nav -->

{{--            <div class="droopmenu-extra">--}}
{{--                <a href="{{url('/quick_purchase')}}">{{_i('Quick purchase')}}</a>--}}
{{--            </div>--}}

        </div><!-- droopmenu-inner -->
    </div><!-- droopmenu-navbar  -->

</header>
