@extends('front.auth.index')

@section('content')
    <div class="form-wrapper">
{{--        <form action="{{ route('userLogin') }}" method="post" data-parsley-validate="">--}}
            @csrf
            <input type="email" name="email" placeholder="{{ _i('Email') }}" class="form-control">
            <input type="password" name="password" placeholder="{{ _i('Password') }}" class="form-control">
            <div class="d-md-flex justify-content-between text-center my-2">
                <a href="">{{ _i('Subscribe') }}</a>
                <a href="">{{ _i('Forget Password') }}</a>
            </div>
            <input type="submit" class="btn btn-yellow btn-block rounded-0 mb-5" value="{{ _i('Login') }}">

            <a href="" class="btn btn-white-outlined rounded-0 py-1 btn-block mb-3">{{ _i('Login With Facebook') }}</a>
            <a href="" class="btn btn-white-outlined rounded-0 py-1 btn-block mb-3">{{ _i('login With Google') }}</a>

        </form>
    </div>
@endsection
