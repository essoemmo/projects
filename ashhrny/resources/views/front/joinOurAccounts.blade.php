@extends('front.layout.user_auth')

@section('title')

    {{ _i('Verify Your E-mail') }}

@endsection

@section('content')

    <div class="container">
        <div class="text-center">
            <h6>{{ _i('Please Join Our Accounts') }}</h6>

            <div class="social-icons">
                <ul class="list-inline ">
                    @foreach($setting_socials as $row)
                        <li class="list-inline-item"><a href="{{$row['url']}}" rel="nofollow"
                                                        title="{{$row['title']}}" target="_blank"><i
                                    class="text-black-50 fab {{$row['icon']}} fa-3x"></i></a></li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ route('getLogin') }}" class="btn grade btn-block mt-3 mb-3">{{ _i('Login') }}</a>

            @include('front.layout.footer_nav')

        </div>
    </div>

@endsection

