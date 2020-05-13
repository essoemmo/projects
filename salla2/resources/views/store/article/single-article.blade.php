@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url(app()->getLocale().'/store/blog_cat/'.$category->id)}}">{{$category['title']}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$article['title']}} </li>
            </ol>
        </div>
    </nav>
    <div class="wide-ad text-center mt-4">
        <div class="container">
        </div>
    </div>

    <div class="single-product-page-wrapper common-wrapper">
        <div class="container">
            <div class="row">
               

                <div class="col-md-6">
                    
                    <h1 class="main-title"> {{$article['title']}} </h1>

                    <div class="head-title"> {{$article['created']}}</div>
                    <div class="description" style="overflow-wrap: break-word">
                         {!! $article['content'] !!}
                    </div>

                </div>
                <div class="col-md-6">
                      <img id="change-image" src=" {{asset($article['img_url'])}}"
                                 alt="{{_i('Blog Image')}}" class="img-fluid "/>
                </div>
            </div>
        </div>
    </div>

    <div class="products-wrapper common-wrapper bg-white ">

        <div class="container">


            <div class="section-title">   {{_i('Similar Articles')}} </div>
            <div class="row">

                @if(count($articles) > 0)
                    @foreach($articles as $article)
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="single-feature-product d-flex">
                        <div class="media">

                            <a href="{{ url(app()->getLocale().'/store/blog/'.$article->id) }}" class="img-wrapper-anchor align-self-stretch">
                                <img src="{{asset($article['img_url'])}}"
                                     class="align-self-center" alt="{{_i('Blog Image')}}">
                            </a>

                            <div class="media-body align-self-center">
                                <h3 class="title"><a href="{{ url(app()->getLocale().'/store/blog/'.$article->id) }}"> {{$article['title']}} </a></h3>

                                <div class="price-rate-purchase d-flex justify-content-between mt-auto">
                                    <div class="price"> {{$article['created']}} </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    @endforeach

                @else
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            {{ _i('No Blogs') }}
                        </div>
                    </div>
                @endif

            </div>
        </div>


    </div>
<br />
@endsection



