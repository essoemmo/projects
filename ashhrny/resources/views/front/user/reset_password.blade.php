@extends('front.layout.user_auth')

@section('title')

    {{ _i('Reset Your Password') }}

@endsection

@section('content')
    <div class="form-wrapper">

        <form method="post" data-parsley-validate="">
            {!! csrf_field() !!}

            @honeypot {{--prevent form spam--}}

            <input type="email" name="email" value="{{ $check_token->email }}" placeholder="{{ _i('Email') }}"
                   class="form-control" data-parsley-type="email" data-parsley-maxlength="191">
            <input type="password" class="required form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" id="Password" placeholder="{{_i('Password')}}  &#42;"
                   value="{{old('password')}}"
                   data-parsley-minlength="8"
                   data-parsley-errors-container=".errorpassmessage"
                   data-parsley-required-message="{{ _i('Please enter your new password.') }}"
                   data-parsley-uppercase="1"
                   data-parsley-lowercase="1"
                   data-parsley-number="1"
                   data-parsley-special="1"
                   data-parsley-required
                   data-parsley-trigger="focusin"/>
            <span class="errorpassmessage"></span>

            <input type="password"
                   class="required form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                   name="password_confirmation" id="password_confirmation"
                   placeholder="{{_i('Password Confirmation')}}  &#42;"
                   value="{{old('password_confirmation')}}"
                   data-parsley-minlength="8"
                   data-parsley-errors-container=".errorpassconfirmmessage"
                   data-parsley-required-message="{{ _i('Please re-enter your new password.') }}"
                   data-parsley-equalto="#Password"
                   data-parsley-required
                   data-parsley-trigger="focusin"/>
            <span class="errorpassconfirmmessage"></span>

            <input type="submit" class="btn btn-yellow btn-block rounded-0 mb-5" value="{{ _i('Reset Password') }}">

        </form>

    </div>
@endsection



