@extends('front.layout.index')

@section('title')

    {{ $cat->translate(app()->getLocale())->title }}

@endsection

@section('content')
    @include('front.layout.header')
    @include('front.layout.headerSearch')

    @push('css')

        <style>
            .pagination a {
                margin: 0 !important;
                border: none !important;
                color: #ffffff;
                background: #F4941C;
            }
            .pagination li.active span {
                background: #6610f2 !important;
                border-color: #6610f2 !important;
            }
        </style>

    @endpush


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$cat->translate(app()->getLocale())->title}}</li>
            </ol>
        </div>
    </nav>

    @if(count($blogs) >0)

    <div class=" page-wrapper common-wrapper ">
        <div class="container">

            <div class="row">

                @foreach($blogs as $blog)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-account instagram">
                            <div class="img-wrapper">
                                <div class="account-img">
                                    <a href="{{url('blog/'.$blog->id)}}" title="stone">
                                        <img  data-src="{{asset($blog->image)}}" alt=""
                                             class="img-fluid lazy" href="{{url('blog/'.$blog->id)}}">
                                    </a>
                                </div>

                            </div>
                            <div class="context  justify-content-between text-center">
                                <div title="" class="name">
                                    <a href="{{url('blog/'.$blog->id)}}" style="color: black;">{{$blog->translate(app()->getLocale())->title}}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>

    <div class="d-flex justify-content-center">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item ">
                    {{$blogs->links()}}
                </li>
            </ul>
        </nav>
    </div>

    @else
        <div class="login-box-body text-center mt-3 mb-3" style="direction: rtl">

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        <h5><?=_i("Not Found Articles")?></h5>
                    </div>
                </div>
            </div>

            <a href="{{ url('/') }}">{{ _i('Go Home') }}</a>

        </div>
    @endif


@endsection
