@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Blog Categories')}} </li>
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
{{--                        <div class="top-floating-icons d-flex justify-content-between">--}}
{{--                            @if(\App\Models\Article\ArticleCategory::findOrFail($category->id)->isFavorited())--}}
{{--                                <a href="javascript:void(0)" class="add-to-fav articleCat-fav" data-id="{{$category->id}}">--}}
{{--                                    <i class="fa fa-heart"></i>--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a href="javascript:void(0)" class="add-to-fav articleCat-fav" data-id="{{$category->id}}" >--}}
{{--                                    <i class="fa fa-heart-o"></i>--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        </div>--}}

                        <div class="product-thumbnail">
                            <a href="{{ url(app()->getLocale().'/store/blog_cat', $category->id) }}">
                                <img data-src=" {{asset($category['img_url'])}}" alt="{{_i('Blod Category Image')}}" class="img-fluid lazy">
                            </a>
                        </div>

                        <h3 class="title"><a href="{{ url(app()->getLocale().'/store/blog_cat', $category->id) }}">
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
                            {{ _i('No Blog Categories') }}
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