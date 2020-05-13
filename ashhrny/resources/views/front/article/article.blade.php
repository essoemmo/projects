@extends('front.layout.index')

@section('title')

    {{ $blog->translate(app()->getLocale())->title }}

@endsection

@section('content')
    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item"><a href="{{url('blogCat/'.$blogCat['id'])}}"> {{$blogCat->translate(app()->getLocale())->title}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$blog->translate(app()->getLocale())->title}}</li>
            </ol>
        </div>
    </nav>

    <div class="member-section-columns top-famous common-wrapper">
        <div class="container">

            <div class="row">

                <div class="col-lg-4">
                    <img data-src="{{asset($blog['image'])}}" alt="{{_i('Article Image')}}"
                                    class="img-fluid lazy" style="width :400px; height: 300px; margin-top : -45px;">
                    </div>

                    <div class="col-lg-8">

                        <h3>{{$blog->translate(app()->getLocale())->title}}</h3>
                        <p> {!! $blog->translate(app()->getLocale())['content'] !!}</p>
                    </div>

                </div>

            </div>
        </div>


    @endsection

