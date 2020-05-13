@extends('front.layout.user_auth')

@section('title')

    {{ _i('Login') }}

@endsection

@section('content')

    <form action="{{ route('userLogin') }}" method="post" data-parsley-validate="">
        @csrf

        @honeypot {{--prevent form spam--}}

        <input type="email" name="email" placeholder="{{ _i('Email') }}" class="form-control" data-parsley-type="email"
               data-parsley-maxlength="191" required="" value="{{old('email')}}">
        @if ($errors->has('email'))
            <strong style="color: #db1b4c;">{{ $errors->first('email') }}</strong>
        @endif

        <input type="password" name="password" placeholder="{{ _i('Password') }}" class="form-control"
               data-parsley-required-message="Please re-enter your new password.">
        @if ($errors->has('password'))
            <strong style="color: #db1b4c;">{{ $errors->first('password') }}</strong>
        @endif

        <div class="d-md-flex justify-content-between text-center my-2">
            <a href="{{url('/register')}}">{{_i('Subscription')}}</a>
            <a href="{{url('forgetPassword')}}">{{_i('?did you forget your password')}}</a>
        </div>
        <input type="submit" class="btn grade btn-block my-4" value="{{_i('Login')}}">

        <a href="{{ route('social_login', 'google') }}"
           class="btn btn-black-outlined  btn-block  mb-3">{{ _i('login With Google') }}</a>


    </form>

@endsection
