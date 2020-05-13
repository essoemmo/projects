
@extends('front.layout.user_auth')

@section('title')

    {{ _i('Choose Your Account') }}

@endsection

@section('content')

    @if(userSetting()->register_section == 1 && userSetting()->register_section != 0)
        @if(userSetting()->normal_user_register == 1 && userSetting()->normal_user_register != 0)
            <a href="{{ route('continueRegister', ['type' => 'normal']) }}" title="{{ _i('Compelete Register') }}" class="btn btn-black-outlined  btn-block  my-3">{{ _i('Compelete Register') }}</a>
        @endif
        @if(userSetting()->famous_user_register == 1 && userSetting()->famous_user_register != 0)
            <p class="mt-2">{{ _i('If you are famous, complete the registration here') }}</p>
            <a href="{{ route('continueRegister', ['type' => 'famous']) }}" title="{{ _i('Famous user') }}" class="btn grade btn-block mt-3">{{ _i('Famous user') }}</a>
        @endif
    @endif
@endsection

