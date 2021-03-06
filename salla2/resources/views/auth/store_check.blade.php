@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home' , app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Verify Email')}}</li>
            </ol>
        </div>
    </nav>


    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">
                        <a href="{{route('store.home', app()->getLocale())}}"><img src="{{asset('perpal/images/logo.png')}}" alt="" class="img-fluid"></a>
                        <div class="welcome-head-2">{{_i('Sorry, please check your email')}}</div>
                        <div class="color-purple">
                            {{_i("An email has been sent to ")}} <b> {{$email}} </b> {{_i("Please check your email address to activate your account.")}}
                        </div>
                        <a href="{{route('store.home', app()->getLocale())}}" class="btn btn-mainColor btn-block btn-red my-3">{{_i('Go to home')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection


