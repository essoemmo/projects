@extends('front.layout.app')


@section('content')

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Login')}}</li>
            </ol>
        </div>
    </nav>

    <div class="login-page common-wrapper">
        
@if(session("success"))

<h6 class="alert alert-success text-center" > <b>   {{ session("success") }} </b></h6>
@endif

        <div class="container">
            <div class="wide-title-box ">

                <div class="title bg-gray"> {{_i('Welcome, Log in')}}</div>

                <div class="wide-box-content-wrapper reversed-form-color">
                    <div class="course-register-form">
                        <form action="{{url('/user/login')}}" method="post" data-parsley-validate="">

                            @csrf

                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="field">
                                        <input type="text" class="form-control"  id="user" name="email" required="" data-parsley-type="email"
                                               placeholder="{{_i('Email')}}">
{{--                                        {{ $errors->has('email') ? 'is-ivalid' : ''}}--}}
                                        <label for="user"> {{_i('Email')}}</label>
                                    </div>
                                    @if ($errors->has('email'))
                                        {{--                                            <span class="text-danger invalid-feedback" role="alert">--}}
                                        <strong style="color: #db1b4c;">{{ $errors->first('email') }}</strong>
                                        {{--                                            </span>--}}
                                    @endif

                                    <div class="field">
                                        <input type="password" class="form-control" id="password"  name="password" required=""
                                               placeholder="{{_i('Enter Your Email Password')}}">
                                        <label for="password"> {{_i('Password')}}</label>
                                        @if ($errors->has('password'))
{{--                                            <span class="text-danger invalid-feedback" role="alert">--}}
                                                <strong style="color: #db1b4c;">{{ $errors->first('password') }}</strong>
{{--                                            </span>--}}
                                        @endif

                                    </div>

                                    <div class="d-md-flex justify-content-between my-3">
                                        <div class="custom-control custom-checkbox my-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                            <label class="custom-control-label blue-color" for="customControlAutosizing">{{_i('Remember Me?')}}</label>
                                        </div>
                                        <div class="login-btn ">
                                            <input type="submit" class="btn btn-blue d-block w-100" value="{{_i("login")}}">
                                            <a href="" class="w-100 text-muted small"> {{_i('Forgot your password ?')}}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection