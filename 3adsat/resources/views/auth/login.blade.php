@extends('web.layout.master')

@section('content')
    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="{{url('register')}}" class="btn btn-green ">{{_i('Dont have an account? Click here to register')}}</a>
                    </div>
                    <hr>
                  @include("auth.social")
                    <form action="{{url('login')}}" method="post" data-parsley-validate="">
                        {{csrf_field()}}
                        {{method_field('post')}}
                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                       placeholder="{{_i('email')}}"  data-parsley-type="email"   data-parsley-required="true">
                                @if ($errors->has('email'))
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                @endif

                                <input type="password" name="password" class="form-control" id="Password"
                                       data-parsley-required="true"
                                       data-parsley-minlength="6"

                                       placeholder="{{_i('password')}}">
                                @if ($errors->has('password'))
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                @endif

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{_i('Remember me')}}</label>
                                  
                                </div>


                                <div class="center">
                                    <button type="submit" class="btn btn-blue">{{_i('login')}}</button>
                                                                      <a class="btn btn-green" href="{{ url('forgetPassword') }}">{{ _i('Forget Password ?') }}</a>
                                                                      

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
