@extends('front.auth.index')

@section('content')
    <div class="form-wrapper">

        <form method="post" data-parsley-validate="">
            {!! csrf_field() !!}

            <input type="email" name="email" value="{{ $check_token->email }}"  placeholder="{{ _i('Email') }}" class="form-control"  data-parsley-type="email"  data-parsley-maxlength="191" >
            <input type="password" name="password" placeholder="{{ _i('Password') }}" class="form-control"  id="Password" data-parsley-minlength="8">
            <input type="password" name="password_confirmation"  placeholder="{{ _i('password confirm') }}" class="form-control" data-parsley-equalto="#Password">

            <input type="submit" class="btn btn-yellow btn-block rounded-0 mb-5" value="{{ _i('Reset Password') }}">

            <div>
                @include('admin.layout.message')
            </div>

        </form>

    </div>

@endsection




