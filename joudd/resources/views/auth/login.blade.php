@extends('layouts.app')
@section("content")
@if(Session::has("success"))

<h6 class="alert alert-success text-center" > <b>   {{ Session::get("success") }} </b></h6>
@endif
<div class="login-box-body" style="direction: rtl">
    <p class="login-box-msg">{{_i('Sign in to start your website')}}</p>

    <form method="POST" action="{{ route('login') }}" data-parsley-validate="">
        @csrf
        <div class="form-group has-feedback">
            <input type="email"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required="" >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="text-danger invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required="" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
            <span class="text-danger invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{_i('Remember Me')}}
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{_i('Sign In')}}</button>


                {{--@if (Route::has('password.request'))--}}
                {{--<a class="btn btn-link" href="{{ route('password.request') }}" >--}}
                {{--{{ __('Forgot Your Password?') }}--}}
                {{--</a>--}}
                {{--@endif--}}

            </div>
            <!-- /.col -->
        </div>
    </form>


    <!-- /.social-auth-links -->
    @if (Route::has('password.request'))
    <a href="{{url('/admin/password/reset')}}">
        {{_i('I forgot my password')}}
    </a><br>
    @endif

    {{--<a href="register.html" class="text-center">Register a new membership</a>--}}

</div>
@endsection
