@extends('web.layout.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Login')}}</li>
            </ol>
        </div>
    </nav>



    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="{{url('/register')}}" class="btn btn-pink ">{{_i('Don\'t have an account? Click here to register')}}</a>
                    </div>
                    <form class="shadow-lg" action="{{url('/login')}}" method="post">
                        {{method_field('post')}}
                        {{csrf_field()}}
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
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{_i('Remember Me')}}</label>
                                </div>

                                <div class="center">
                                    <button type="submit" class="btn btn-grad">{{_i('Login')}}</button>

<<<<<<< HEAD
                                    <a href="{{route('reset-password')}}" class="text-muted text-left d-block">{{_i('forget the password')}}</a>
=======
                                    <a href="{{url('/reset_password')}}" class="text-muted text-left d-block">{{_i('forget the password')}}</a>
>>>>>>> d89b3e74528ef104eb1b46d6badf31f87ef7a230
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br> <br><br><br><br><br>

    {{--    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">--}}
{{--        <div class="container">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">{{_i('Login')}}</li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <section class="register-form common-wrapper ">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 offset-md-3">--}}
{{--                    <div class="center">--}}

{{--                        <a href="{{url('/register')}}" class="btn btn-green "> {{_i('Don\'t have an account? Click here to register')}} </a>--}}
{{--                    </div>--}}
{{--                    <div class="row s-logins">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <a href="{{ url('/login/redirect/facebook') }}" class="btn btn-primary facebook">{{_i('Sign in via Facebook')}}</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <a href="{{ url('/login/redirect/google') }}" class="btn btn-default googel">{{_i('Sign in with your Google account')}}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <form class="shadow-lg" action="{{url('/login')}}" method="post" data-parsley-validate="">--}}

{{--                        @csrf--}}

{{--                        <div class="row">--}}

{{--                            <div class="col-sm-12">--}}
{{--                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  id="exampleInputEmail1" name="email" required=""--}}
{{--                                       data-parsley-type="email"  placeholder="{{_i('Email')}}">--}}
{{--                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
{{--                                @if ($errors->has('email'))--}}
{{--                                    <span class="text-danger invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}

{{--                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="Password"  name="password" required=""--}}
{{--                                       placeholder="{{_i('Password')}}">--}}
{{--                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
{{--                                @if ($errors->has('password'))--}}
{{--                                    <span class="text-danger invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}

{{--                                <div class="custom-control custom-checkbox">--}}
{{--                                    <input type="checkbox" class="custom-control-input" id="customCheck1" >--}}
{{--                                    <label class="custom-control-label" for="customCheck1">{{_i('Remember Me')}}</label>--}}
{{--                                </div>--}}

{{--                                <div class="center">--}}
{{--                                    <button type="submit" class="btn btn-red">{{_i('Login')}}</button>--}}
{{--                                </div>--}}


{{--                                <div class="">--}}
{{--                                    <div class="right" style="display:inline-block;">--}}
{{--                                        <button type="submit" class="btn btn-red">{{_i('Login')}}</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="left" style="text-align: left; display:inline-block; float: left;" >--}}
{{--                                        <a href="{{url('/reset_password')}}">--}}
{{--                                            <button type="button"  class="btn btn-green" >--}}
{{--                                                {{_i('Forgot your password')}}--}}
{{--                                            </button>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


@endsection
