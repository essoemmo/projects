@extends('front.layout.user_auth')

@section('title')

    {{ _i('Register') }}

@endsection

@section('content')

    <form action="{{ route('userRegister') }}" method="post" data-parsley-validate="">

        @csrf

        @honeypot {{--prevent form spam--}}

        <div class="form-group">
            <input type="text" class="required form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                   name="first_name" placeholder="{{_i('First Name')}}  &#42;"
                   maxlength="191" required="" value="{{old('first_name')}}" minlength="3"
                   data-parsley-errors-container=".errorMessageFirst">
            <span class="errorMessageFirst"></span>
            @if ($errors->has('first_name'))
                <span class="text-danger invalid-feedback" role="alert">
                   <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input type="text" class="required form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                   name="last_name" placeholder="{{_i('Last Name')}}  &#42;"
                   maxlength="191" minlength="3" required="" value="{{old('last_name')}}"
                   data-parsley-errors-container=".errorMessageLast">
            <span class="errorMessageLast"></span>
            @if ($errors->has('last_name'))
                <span class="text-danger invalid-feedback" role="alert">
                           <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
            <input type="email" class="required form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   placeholder="{{ _i('Email') }}  &#42;"
                   name="email" data-parsley-type="email" data-parsley-maxlength="191" required=""
                   value="{{old('email')}}" data-parsley-errors-container=".errorMessageEmail">
            <span class="errorMessageEmail"></span>
            @if ($errors->has('email'))
                <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
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
            @if ($errors->has('password'))
                <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
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
            @if ($errors->has('password_confirmation'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <small class="form-text my-3">
            {{_i('When you click on the subscribe button, it means that you agree to the website terms and conditions and the privacy policy')}}
        </small>

        <input type="submit" class="btn grade btn-block  mb-2" value="{{_i('Subscription')}}">

    </form>
    <a href="{{ route('social_login', 'google') }}"
       class="btn btn-black-outlined  btn-block  my-3">{{_i('A subscription by Google')}}</a>

    <a href="{{url('/login')}}"
       class="btn btn-yellow-outlined  py-1 btn-block mt-3">{{_i('do you have an account?! Log in here')}}</a>

@endsection
