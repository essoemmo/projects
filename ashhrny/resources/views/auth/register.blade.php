@extends('front.auth.index')

@section('content')
    <div class="form-wrapper">
        <form  action="{{ route('userRegister') }}" method="post" data-parsley-validate="">
            @csrf
            <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"  name="first_name"  placeholder="{{_i('First Name')}}"
                   maxlength="191"	data-parsley-maxlength="191" required="" value="{{old('first_name')}}">
            @if ($errors->has('first_name'))
                <span class="text-danger invalid-feedback" role="alert">
                       <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif

            <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"  name="last_name"  placeholder="{{_i('Last Name')}}"
                   maxlength="191"	data-parsley-maxlength="191" required="" value="{{old('last_name')}}">
            @if ($errors->has('last_name'))
                <span class="text-danger invalid-feedback" role="alert">
                       <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif

            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="{{_i('E-mail')}}"
                   name="email" data-parsley-type="email"  data-parsley-maxlength="191" required="" value="{{old('email')}}">
            @if ($errors->has('email'))
                <span class="text-danger invalid-feedback" role="alert">
                     <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  name="password" id="Password" placeholder="{{_i('Password')}}"
                   value="{{old('password')}}"
                   data-parsley-minlength="8"
                   data-parsley-errors-container=".errorspannewpassinput"
                   data-parsley-required-message="Please enter your new password."
                   data-parsley-uppercase="1"
                   data-parsley-lowercase="1"
                   data-parsley-number="1"
                   data-parsley-special="1"
                   data-parsley-required >
            <span class="errorspannewpassinput"></span>
            @if ($errors->has('password'))
                <span class="text-danger invalid-feedback" role="alert">
                     <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" placeholder="{{_i('Password Confirmation')}}"
                   value="{{old('password_confirmation')}}"
                   data-parsley-minlength="8"
                   data-parsley-errors-container=".errorspanconfirmnewpassinput"
                   data-parsley-required-message="Please re-enter your new password."
                   data-parsley-equalto="#Password"
                   data-parsley-required />
            <span class="errorspanconfirmnewpassinput"></span>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif


            <div class="custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" name="subscribe_newsletter">
                <label class="custom-control-label text-white" for="customCheck1">{{_i('Do you want to receive e-mail offers?')}}</label>
            </div>

            <input type="submit" class="btn btn-yellow btn-block rounded-0 mb-2" value="{{_i('Subscription')}}">
            <small class="form-text text-white ">
               {{_i('When you press the subscribe button, you are at least 16 years old You agree to the Terms and Conditions and Privacy Policy')}}
            </small>
        </form>
        <a href="{{url('user/login')}}" class="btn btn-white-outlined rounded-0 py-1 btn-block mt-3">{{_i('do you have an account?! Sign in here')}}</a>

    </div>
@endsection

@push('js')

    <script>
        //has uppercase
        window.Parsley.addValidator('uppercase', {
            requirementType: 'number',
            validateString: function(value, requirement) {
                var uppercases = value.match(/[A-Z]/g) || [];
                return uppercases.length >= requirement;
            },
            messages: {
                en: '{{ _i('Your password must contain at least (%s) uppercase letter.') }}'
            }
        });

        //has lowercase
        window.Parsley.addValidator('lowercase', {
            requirementType: 'number',
            validateString: function(value, requirement) {
                var lowecases = value.match(/[a-z]/g) || [];
                return lowecases.length >= requirement;
            },
            messages: {
                en: '{{ _i('Your password must contain at least (%s) lowercase letter.') }}'
            }
        });

        //has number
        window.Parsley.addValidator('number', {
            requirementType: 'number',
            validateString: function(value, requirement) {
                var numbers = value.match(/[0-9]/g) || [];
                return numbers.length >= requirement;
            },
            messages: {
                en: '{{ _i('Your password must contain at least (%s) number.') }}'
            }
        });

        //has special char
        window.Parsley.addValidator('special', {
            requirementType: 'number',
            validateString: function(value, requirement) {
                var specials = value.match(/[^a-zA-Z0-9]/g) || [];
                return specials.length >= requirement;
            },
            messages: {
                en: '{{ _i('Your password must contain at least (%s) special characters.') }}'
            }
        });
    </script>

@endpush

