
@extends('web.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Forget Password')}} </li>
            </ol>
        </div>
    </nav>



<section class="contact-page common-wrapper">

        @if(session()->has('success'))
            <div class="alert alert-success">
                <h1>{{ session('success') }}</h1>
            </div>
        @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-6" style="margin: 0 auto;">
                <form method="post">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="{{ _i('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
{{--                    <div class="col-6">--}}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ _i('Reset Password') }}</button>
{{--                    </div>--}}
                    <!-- /.col -->
                </form>
            </div>
        </div>
    </div>

</section>

@endsection
