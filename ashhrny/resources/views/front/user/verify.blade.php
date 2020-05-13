@extends('front.layout.user_auth')

@section('title')

    {{ _i('Verify Your E-mail') }}

@endsection

@section('content')
    <br>
    <br>
    <div>
        <p>{{ _i('Please Verify Your Email ') }}</p>
        <p>{{ _i('(Check Spam for Email)') }}</p>
        <a href="{{ route('resend_code', $user->id) }}" class="btn grade btn-block mt-3">{{ _i('Resend Code') }}</a>

        <hr>
        <p> {{ _i('Please enter the verification code') }} </p>
        <form action="{{ route('verifyUser') }}" method="GET" data-parsley-validate>
            <input type="text" class="form-control text-center" name="code" id="code"
                   placeholder="{{ _i('Please enter the verification code') }}" required>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn grade btn-block mt-3">{{ _i('Confirm') }}</button>
        </form>

        {{--        @dd(session('warning'))--}}
        @if(session('warning'))
            <div class="alert alert-danger mt-4">
                <p>{{ _i('Wrong Activation Code') }}</p>
            </div>
        @endif
    </div>

@endsection

