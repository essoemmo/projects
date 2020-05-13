
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        <link href="{{asset('shade/css/bootstrap-rtl.css')}}" rel="stylesheet">
        <link href="{{asset('shade/css/intlTelInput-rtl.min.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
        <link href="{{asset('shade/css/style.css')}}" rel="stylesheet">
        
        <link href="{{asset('storemain/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/droopmenu-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/flexslider.css')}}" rel="stylesheet">
    <link href="{{asset('storemain/css/flexslider-rtl-min.css')}}" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">-->
    <!--<link href="{{asset('storemain/css/owl.carousel.min.css')}}" rel="stylesheet">-->
    <link href="{{asset('storemain/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminFlatAble/css/select2.min.css')}}">


    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet" id="cpswitch">

    <link href="{{asset('custom/noty/noty.css')}}" rel="stylesheet">
    <script src="{{asset('custom/noty/noty.min.js')}}"></script>

    </head>
    <body>
        @include('store.layout.modal')
        <div class="main-wrapper">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">
<!--                        <div class="text-center">
                        <img src="images/contact.png" alt="" class="img-fluid">
                        <div class="text-dark  fz24">معلومات الإتصال</div>
                        <div class="">سوف نستخدم تلك المعلومات لنوافيك بإحداثيات الطلب</div>
                    </div>-->
                        
                        
                        
                        @include("store.layout.message")
                                        @yield('content')
                    </div>

                    <div class="col-md-8 p-0">
                        <div class="fixed-wrapper ">
                            <div class="bg-wrapper"
                                 style="background-image: url('https://static.zyda.com/photos/restaurants/photo_urls/289/default/WhatsApp_Image_2019-07-04_at_2.12.03_PM.jpeg');">
                                <div class="over-content">

                                    <header>
                                        <nav class="navbar navbar-expand-lg navbar-light   ">

                                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                                    aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>

                                            <div class="collapse navbar-collapse justify-content-between"
                                                 id="navbarSupportedContent">
                                                <div class="empty"></div>
                                                <ul class="navbar-nav ">
                                                    <li class="nav-item active">
                                                        <a class="nav-link" href="{{ route('store.home' , app()->getLocale()) }}">{{_i('Home')}} <span class="sr-only">(current)</span></a>

                                                    </li>

                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <i class="fa fa-user"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <!--                                                            <a class="dropdown-item" href="#">Action</a>
                                                                                                                        <a class="dropdown-item" href="#">Another action</a>
                                                                                                                        <div class="dropdown-divider"></div>
                                                                                                                        <a class="dropdown-item" href="#">Something else here</a>-->


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
                                                    <li class="nav-item dropdown">

                                                        <?php
                                                        $langall = App\Models\Language::all();
                                                        ?>
                                                        @foreach ($langall as $item)
                                                        @if ( app()->getLocale() == $item->code )



                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <img src="{{ asset('images/'.$item->flag) }}" alt=""> 
                                                        </a>
                                                        @endif
                                                        @endforeach


                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            @foreach ($langall as $key => $item)
                                                            @if ( app()->getLocale()  != $item->code )
                                                            <a href="{{url($item->code)}}/store/lang" class="dropdown-item">
                                                                <img src="{{ asset('images/'.$item->flag) }}" alt=""> {{$item->title}}
                                                            </a>

                                                            @endif
                                                            @endforeach

                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </nav>
                                    </header>

                                    <div class="logo-wrapper flex-column text-center m-auto">
                                        <?php
                                        $sliders = \App\Bll\Utility::getSlider();
                                        ?>
                                        @foreach($sliders as $key => $slider)

                                        <img src="{{ asset('uploads/settings/sliders/'. $slider->id . '/' . $slider->image) }}"
                                             class="d-block w-100" alt="...">
                                        <a href="">
                                            <img src="{{ asset('uploads/settings/sliders/'. $slider->id . '/' . $slider->image) }}" alt="" class="img-fluid">
                                        </a>
                                        @endforeach
                                       
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('shade/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('shade/js/popper.js')}}"></script>
        <script src="{{asset('shade/js/bootstrap-rtl.js')}}"></script>
        <script src="https://kit.fontawesome.com/e5696f83c8.js" crossorigin="anonymous"></script>
        <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>-->
        <!--<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>-->
        <!--<script src="js/wow.min.js"></script>-->
 <script src="{{asset('storemain/js/droopmenu.min.js')}}"></script>
 <script src="{{asset('storemain/js/bootstrap-input-spinner.js')}}"></script>
 <script src="{{asset('storemain/js/jquery.nice-select.min.js')}}"></script>
 <!--<script src="{{asset('storemain/js/owl.carousel.min.js')}}"></script>-->
 <!--<script src="{{asset('storemain/js/owl.carousel.min.js')}}"></script>-->
 <script src="{{asset('storemain/js/wow.min.js')}}"></script>
 <script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>
 <script src="{{asset('storemain/js/owl.carousel.min.js')}}"></script>
 <script src="{{asset('storemain/js/jquery.flexslider-min.js')}}"></script>
 <!--<script src="{{asset('storemain/js/owl.carousel.min.js')}}"></script>-->

<!-- data-table js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

 <script src="{{asset('custom/parsley.min.js')}}"></script>
 
 
        <script src="{{asset('shade/js/intlTelInput.min.js')}}"></script>
        <script src="{{asset('shade/js/custom.js')}}"></script>
        
        @include('store.layout.fav')
    </body>
</html>