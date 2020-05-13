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
                background: #6c757d;
            }
            .pagination li.active span {
                background: #6f42c1 !important;
                border-color: #6f42c1 !important;
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

    <div class="member-section-columns top-famous common-wrapper">
        <div class="container">

            @if(count($blogs)> 0)
            <div class="row">
                @foreach($blogs as $key => $blog)

                    <div class="col-lg-3 col-md-6">
                        <div class="single-account {{$key%2 == 0 ? "facebook" : "instagram"}}">
                            <div class="img-wrapper">
                                <div class="account-img"><a href="{{url('/article/'.$blog['id'])}}">
                                        <img data-src="{{ asset($blog['image']) }}" alt="" class="img-fluid lazy"></a>
                                </div>
                                <div class="social-icons">
                                    <ul class="list-unstyled">
                                        <li class="show-on-hover"><a href="{{url('/article/'.$blog['id'])}}"><i class="fas fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="context justify-content-between text-center">
                                <div class="job-title">
                                    <a href="{{url('/article/'.$blog['id'])}}" style="color:black;">
                                        {{$blog->translate(app()->getLocale())->title}}
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>

                @endforeach
            </div>

            <div class="justify-content-center d-md-flex">
                <ul class="pagination" >
                    <li class="page-item quantity "  >
                        {{$blogs->links()}}
                    </li>
                </ul>
            </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            {{ _i('No Articles') }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>


@endsection

