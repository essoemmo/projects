@extends('store.layout.master')

@section('content')
    @push('css')

        <style>
            .s-logins{
                margin-top: 15px;
            }
            .s-logins .facebook{
                background-color: #40588A !important;
                border-radius: 7.25rem;
                border: 2px solid transparent;
                font-size: 14px;
            }
            .s-logins .googel{
                background-color: #fff !important;
                border-radius: 7.25rem;
                border: 2px solid #333;
                color: #333333;
                font-size: 14px;
            }
            .s-logins .googel:hover,.s-logins .facebook:hover{
                background-color: transparent !important;
                border: 2px solid #fff;
                color: #fff;
            }
        </style>

    @endpush

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Login')}}</li>
            </ol>
        </div>
    </nav>


    @if(\App\Bll\Utility::getTemplateCode() == "purple")

        <section class="register-form common-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="center">
                            <a href=""><img src="{{asset('perpal/images/logo.png')}}" alt="" class="img-fluid logo"></a>
                            <div class="welcome-head-1">{{_i('Welcome to our website')}}</div>
                            <div class="welcome-head-2">{{_i('Log in to your account')}}</div>
                            <a href="{{route('register')}}">{{_i('Don\'t have an account? Click here to register')}}</a>
                        </div>


                        <div class="row s-logins">
                            <div class="col-md-6">
                                <a href="{{ url('/store/login/redirect/facebook') }}" class="btn btn-mainColor btn-primary facebook">{{_i('Sign in via Facebook')}}</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/store/login/redirect/google') }}" class="btn btn-mainColor  google">{{_i('Sign in with your Google account')}}</a>
                            </div>
                        </div>

                        <form  action="{{route('store_login')}}" method="post" data-parsley-validate="">

                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/envelope.png')}}" alt=""></span>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""
                                           data-parsley-type="email"  placeholder="{{_i('Email')}}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/lock.png')}}" alt=""></span>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="Password"  name="password" required=""
                                           placeholder="{{_i('Password')}}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{_i('Remember Me')}}</label>
                                </div>
                                <a href="{{route('resetpass')}}"> {{_i('Forgot your password')}}</a>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn btn-mainColor btn-block rounded my-4">{{_i('Login')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="register-form common-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="center">
                            <a href="{{route('register')}}" class="btn btn-green "> {{_i('Don\'t have an account? Click here to register')}} </a>
                        </div>
                        <div class="row s-logins">
                            <div class="col-md-6">
                                <a href="{{ url('/store/login/redirect/facebook') }}" class="btn btn-primary facebook">{{_i('Sign in via Facebook')}}</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/store/login/redirect/google') }}" class="btn btn-default googel">{{_i('Sign in with your Google account')}}</a>
                            </div>
                        </div>
                        <form class="shadow-lg" action="{{route('store_login')}}" method="post" data-parsley-validate="">

                            @csrf

                            <div class="row">

                                <div class="col-sm-12">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""
                                           data-parsley-type="email"  placeholder="{{_i('Email')}}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="Password"  name="password" required=""
                                           placeholder="{{_i('Password')}}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" >
                                        <label class="custom-control-label" for="customCheck1">{{_i('Remember Me')}}</label>
                                    </div>
                                    <div class="">
                                        <div class="right" style="display:inline-block;">
                                            <button type="submit" class="btn btn-blue">{{_i('Login')}}</button>
                                        </div>
                                        <div class="left" style="text-align: left; display:inline-block; float: left;" >
                                            <a href="{{route('resetpass')}}">
                                                <button type="button"  class="btn btn-green" >
                                                    {{_i('Forgot your password')}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
