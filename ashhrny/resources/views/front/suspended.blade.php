@extends('front.layout.index')

@section('title')

    {{ _i('Suspended') }}

@endsection

@push('css')

    <style>
        .container6 {
            height: 10em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container6 h5 {
            margin: auto;
        }
    </style>

@endpush
@section("content")
    @include('front.layout.header')
    @include('front.layout.headerSearch')
    <div class="login-box-body text-center mt-3 mb-3 action" style="direction: rtl">


        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-center container6">
                    <h5>{{ _i("Membership has been suspended temporarily, please contact the site administration") }}</h5>
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}">{{ _i('Go Home') }}</a>


    </div>
@endsection
