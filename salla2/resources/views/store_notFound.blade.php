@extends('store.layout.master')

@section('content')



    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}">{{_i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Not Found') }}</li>
            </ol>
        </div>
    </nav>

    <section class="contact-page common-wrapper">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger text-center ">
                        <h5><?=_i("Sorry the page you are looking for is not found")?></h5>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{route('store.home',app()->getLocale())}}" class="">
                    <input type="button" class="btn btn-blue mr-auto  mt-3" value="{{_i('Go Home')}}">
                </a>
            </div>
        </div>



@endsection