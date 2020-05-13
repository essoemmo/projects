@extends('front.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(LaravelGettext::getLocale(),'')}}">{{_i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Verify Email') }}</li>
            </ol>
        </div>
    </nav>


    <section class="contact-us-home common-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-md-6 offset-md-3">
                    <div class="center">
                       

                        <div class="section-title">{{_i('Sorry, please check your email')}}</div>
                        <p class="section-description">
                            {{_i("An email has been sent to ")}} <b style="color: #00ABCC;"> {{$email}} </b> {{_i("Please check your email address to activate your account.")}}
                        </p>
                        <a href="{{url(LaravelGettext::getLocale(),'')}}" class="btn btn-pink animated fadeInDown">{{_i('Go to home')}}</a>
                        <form action="{{route('master.resend_verify',LaravelGettext::getLocale())}}"  method="POST" style="display: inline-block">

                            @csrf
                            <input type="hidden" value="{{$email}}" name="email">
                            <button type="submit" class="btn btn-pink  creat-shop">{{_i('Resend verify email')}}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection


