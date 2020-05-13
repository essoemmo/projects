@extends('web.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Article Categories')}} </li>
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

                @if(count($categories) > 0)
                    @foreach($categories as $category)
                <div class="col-lg-4  col-md-6 d-flex ">
                    <div class="single-full-product text-center d-flex flex-column">
                        <div class="top-floating-icons d-flex justify-content-between">
                            @if(\App\Models\Article\Artcl_category::findOrFail($category->id)->isFavorited())
                                <a href="javascript:void(0)" class="add-to-fav articleCat-fav" data-id="{{$category->id}}">
                                    <i class="fa fa-heart"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="add-to-fav articleCat-fav" data-id="{{$category->id}}" >
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            @endif
{{--                            <a href="" class="new-product-label"><label class="badge badge-primary">جديد</label></a>--}}
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
                            <a href="{{ url('article_cat', $category->id) }}" @if($browser == 'safari') style="display: block !important" @endif>
                                <img src=" @if(is_file(public_path('uploads/artcl_category/'.$category->id.'/'.$category->img_url)))
                                            {{asset('uploads/artcl_category/'.$category->id.'/'.$category->img_url)}}
                                        @else  {{asset('uploads/artcl_category/'.$category->source_id.'/'.$category->img_url)}} @endif"
                                        alt="{{_i('Article Category Image')}}" class="img-fluid ">
                            </a>
                        </div>

                        <h3 class="title"><a href="{{ url('article_cat', $category->id) }}">
                                <b> {{ $category->title }} </b></a>
                        </h3>
                        <div class="price-rate-purchase d-flex justify-content-between mt-auto">

                        </div>
                    </div>
                </div>

                    @endforeach
                @else
                    <div class="col-md-12" style="margin: 2em ;">
                        <div class="alert alert-info text-center">
                            {{ _i('No Categories') }}
                        </div>
                    </div>
                @endif

            </div>


            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item ">
                            {{$categories->links()}}
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>



@endsection
