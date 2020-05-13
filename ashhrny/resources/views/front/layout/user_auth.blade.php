
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    @include('front.layout.style')

</head>
<body>
<header>
    <div class="top-social-bar grade">
        <div class="container">
            <div class="social-icons">

                @php
                    $setting_socials = \App\Models\SocialLinkSetting::all();
                @endphp
                <ul class="list-inline d-flex justify-content-lg-end justify-content-center">
                    @foreach($setting_socials as $row)
                        <li class="list-inline-item"><a title="{{$row['title']}}" href="{{$row['url']}}"><i class="fab {{$row['icon']}}"></i></a></li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</header>

<div class="log-page-wrapper py-5">
    <div class="container ">
        <div class="text-left">
            <a href="{{url('/')}}" title="" class="btn btn-black-outlined rounded   d-inline-block">{{_i('Back to Website')}}</a>
        </div>

        <div class="text-center">

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div title="" class="form-wrapper">

                        @if(setting() != null)
                            <img data-src="{{ asset(setting()->logo) }}" alt="" class="img-fluid lazy">
                        @else
                            <img data-src="{{asset('front/images/Ashherni.png')}}" alt="" class="img-fluid lazy">
                        @endif

                        @yield('content')
                        @include('admin.layout.session')
                        @include('admin.layout.message')


                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<footer class="grade py-1 ">

    <div class="container">
        <div class="text-center">

            @include('front.layout.footer_nav')
        </div>
    </div>


</footer>

<a href="#" title="{{ _('Up') }}" class="go-top"><i class="fa fa-chevron-up"></i></a>

@include('front.layout.script')

</body>
</html>


