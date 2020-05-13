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
{{--                    <div class="center">--}}

{{--                        <a href="{{url('/register')}}" class="btn btn-pink ">{{_i('Don\'t have an account? Click here to register')}}</a>--}}
{{--                    </div>--}}
                    <form method="post">
                        {{method_field('post')}}
                        {{csrf_field()}}
                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" name="email" value="{{ $check_token->email }}" class="form-control" placeholder="{{ trans('admin.email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <input type="password" name="password" class="form-control" placeholder="{{ trans('admin.password') }}">

                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif


                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('admin.password_confirm') }}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif



                                <div class="center">
                                    <button type="submit" class="btn btn-grad">{{ trans('admin.reset_password') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br> <br><br><br><br><br>


    @endsection