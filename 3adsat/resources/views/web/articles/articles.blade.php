@extends('web.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{url('/article_cat/'.$category->id)}}">{{ $category->title }} </a>
                </li>
            </ol>
        </div>
    </nav>
    <div class="wide-ad text-center mt-4">
        <div class="container">
        </div>
    </div>

    <div class="products-wrapper py-4">
        <div class="container">

            <div class="row">

                @if(count($articles) > 0)
                    @foreach($articles as $article)
                        <div class="col-lg-4  col-md-6 d-flex ">
                            <div class="single-full-product text-center d-flex flex-column">
                                <div class="top-floating-icons d-flex justify-content-between">

                                    @if(\App\Models\Article\Article::findOrFail($article->id)->isFavorited())
                                        <a href="javascript:void(0)" class="add-to-fav article-fav" data-id="{{$article->id}}">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="add-to-fav article-fav" data-id="{{$article->id}}" >
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    @endif

                                </div>

                                <?php

                                $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                                // you can add different browsers with the same way ..
                                if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
                                    $browser = 'chromium';
                                elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
                                    $browser = 'chrome';
                                elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
                                    $browser = 'safari';
                                elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
                                    $browser = 'opera';
                                elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
                                    $browser = 'msie';
                                elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
                                    $browser = 'mozilla';

                                preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

                                ?>

                                <div class="product-thumbnail">
                                    <a href="{{ url('article', $article->id) }}" @if($browser == 'safari') style="display: block !important" @endif>
                                        <img src="@if(is_file(public_path('uploads/articles/'.$article->id.'/'.$article->img_url)))
                                                {{asset('uploads/articles/'.$article->id.'/'.$article->img_url)}}
                                                @else    {{asset('uploads/articles/'.$article->source_id.'/'.$article->img_url)}} @endif"
                                             alt="{{_i('Article Image')}}" class="img-fluid">
                                    </a>
                                </div>

                                <h3 class="title"><a href="{{ url('article', $article->id) }}">
                                        <b> {{ $article->title }} </b></a>
                                </h3>
                                <div class="price-rate-purchase d-flex justify-content-between mt-auto">

                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-md-12" style="margin: 2em ;">
                        <div class="alert alert-info text-center">
                            {{ _i('No Articles') }}
                        </div>
                    </div>
                @endif

            </div>


            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item ">
                            {{$articles->links()}}
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>



@endsection
