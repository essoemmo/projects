@extends('layouts.app')

@section('content')
    <div class="login-box-body" style="direction: rtl">
        <div class="login-box-msg">{{ _i('Reset Password') }}</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{url('/adminpanel/user/password/update')}}" data-parsley-validate="">
            @csrf
            <div class="form-group has-feedback">
                <input type="number" id="code" class="form-control{{ $errors->has('pin_code') ? ' is-invalid' : '' }}" value="{{old('pin_code')}}"
                       name="pin_code" required="" data-parsley-maxlength="6" placeholder="رقم الكود">

                @if ($errors->has('pin_code'))
                    <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('pin_code') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group has-feedback">
                <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}"
                       name="password" required="" placeholder="الرقم السري">

                @if ($errors->has('password'))
                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input type="password" id="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}"
                       name="password_confirmation" required="" placeholder="تأكيد الرقم السري">

                @if ($errors->has('password_confirmation'))
                    <span class="text-danger invalid-feedback" role="alert">
                         <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary">
            {{ _i('Save') }}
            </button>
            </div>


        </form>

        @foreach ([ 'success', 'danger'] as $key)
            @if(Session::has($key))

                <div class="container alert alert-{{ $key }}">
                    <strong> <p >{{ Session::get($key) }}</p> </strong>
                </div>

            @endif
        @endforeach

    </div>
@endsection

@section('script')

    {{--<script>--}}

        {{--$("#update_password").hide();--}}

        {{--@if(session('success'))--}}

         {{--$(document).ready(function()--}}
                {{--{--}}
                    {{--$("#update_password").show(1000);--}}
                {{--});--}}


        {{--@endif--}}
    {{--</script>--}}

@endsection