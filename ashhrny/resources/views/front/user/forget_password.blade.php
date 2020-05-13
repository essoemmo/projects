@extends('front.layout.user_auth')

@section('title')

    {{ _i('Forget Your Password') }}

@endsection

@section('content')
    <form method="post" action="{{route('forgetPassword') }}" data-parsley-validate="">
        @csrf

        @honeypot {{--prevent form spam--}}

        <input type="email" name="email" placeholder="{{ _i('Email') }}" class="form-control" data-parsley-type="email"
               data-parsley-maxlength="191">

        <input type="submit" class="btn grade btn-block my-4" value="{{_i('Reset Password')}}">


    </form>
@endsection



