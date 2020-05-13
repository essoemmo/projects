
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ setting()['title'] }}</title>

    @include('front.layout.style')

</head>
<body>


<div class="log-page-wrapper py-5">
    <div class="container">
        <div class="text-left fixed-top">
            <a href="{{url('/')}}" class="btn btn-yellow-outlined py-0  d-inline-block">{{_i('Back to website')}}</a>
        </div>

        <div class="text-center">
            <div class="welcome">{{_i('Welcome')}}</div>
            <img src="{{asset('front/images/logo.png')}}" alt="" class="logo img-fluid">

            <div class="row">
                <div class="col-md-4 offset-md-4">

                    @yield('content')
                    @include('front.layout.session')

                    <footer>

                        <ul class="footer-nav list-inline">
                            <li class="list-inline-item"><a href="{{url('/')}}"> {{_i('Home')}}</a></li>
                            <li class="list-inline-item"><a href="{{url('/categories')}}">{{_i('Categories')}}</a></li>
                            @php
                                $main_blogCat = \App\Models\BlogCategory::where('main' , 1)->first();
                            @endphp
                            @if($main_blogCat)
                            <li class="list-inline-item"><a href="{{url('blogCat/'.$main_blogCat->id)}}">{{$main_blogCat->translate(\app()->getLocale())->title}}</a></li>
                            @endif
                        </ul>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.layout.script')

</body>
</html>


