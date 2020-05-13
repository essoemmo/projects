@extends('layouts.app')
@section("content")
<div class="login-box-body" >


    <h5><?=_i("Sorry the page you are looking for is not found")?></h5>

    <a href="{{ url('/') }}">{{ _i('Go Home') }}</a>


    </div>
@endsection
