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

    <div class=" page-wrapper common-wrapper ">
        <div class="container">

            <div class="bg-gray p-5">

                <div class="text-center mb-5">
                    <img data-src="{{ asset($blog->image) ? asset($blog->image) : setting()['logo']}}" alt="" class="img-fluid lazy">
                </div>

                <p>
                {!! $blog->translate(app()->getLocale())->content !!}
                </p>
            </div>

        </div>
    </div>





@endsection
