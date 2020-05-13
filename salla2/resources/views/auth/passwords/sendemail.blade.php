@extends('layouts.app')

@section('content')

{{--    <a href="" class="navbar-brand">--}}
{{--        <img src="http://localhost/salla2/public/uploads/settings/site_settings/18/1582717534.png" alt="" class="img-fluid lazy">--}}
{{--    </a>--}}

    <div class="container">
        <div class="row">
            <div class="link">
                <a href="{{route('reset-site' ,LaravelGettext::getLocale())}}">{{_i('Change password Please click here')}}</a>
            </div>
        </div>
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