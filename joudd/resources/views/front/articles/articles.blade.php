@extends('front.layout.app')

@push('css')

    <style>
        .pagination a {
            margin: 0 !important;
            border: none !important;
            color: #000;
            background: #0AAACE;
        }
        .pagination li.active span {
            background: #282828 !important;
            border-color: #282828 !important;
        }
    </style>

@endpush


@section("content")
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('/article_cat/'.$category->id)}}">{{ $category->title }}</a></li>
            </ol>
        </div>
    </nav>


    <div class="courses-categories common-wrapper ">
        <div class="container">


            <div class="row">
                @if(count($articles) > 0)
                    @foreach($articles as $article)

                        <div class="col-lg-4 col-md-6 d-flex ">
                            <div class="single-category-box text-center d-flex flex-column">

                                <div class="course-thumbnail">
                                    <a href="{{ url('article', $article->id) }}">
                                        <img data-src="{{asset('uploads/articles/'.$article->id.'/'.$article->img_url)}}" alt=""
                                             class="img-fluid lazy">
                                    </a>
                                    <div class="caption">
                                        <h3 class="title"><a href="{{ url('article', $article->id) }}">{{ $article->title }}</a></h3>

                                        <div class="courses-counter"> </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
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
