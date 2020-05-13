@extends('front.auth.index')

@section('content')
    <div class="form-wrapper">

        <form method="post" action="{{route('forgetPassword') }}"  data-parsley-validate="" >
                @csrf

            <input type="email" name="email" placeholder="{{ _i('Email') }}" class="form-control"  data-parsley-type="email"  data-parsley-maxlength="191" >

            <input type="submit" class="btn btn-yellow btn-block rounded-0 mb-5" value="{{ _i('Reset Password') }}">

            <div>
                @include('admin.layout.message')
            </div>

        </form>

    </div>

@endsection



