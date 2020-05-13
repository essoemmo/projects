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
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Categories') }}</li>
            </ol>
        </div>
    </nav>


    <div class="courses-categories common-wrapper ">
        <div class="container">


                <div class="row">
                    @if($categories)
                        @foreach($categories as $category)
                            @if(App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count() > 0)
                            <div class="col-lg-4 col-md-6 d-flex ">
                                <div class="single-category-box text-center d-flex flex-column">

                                    <div class="top-floating-icons d-flex justify-content-between left">

                                        @if(\App\Hr\Course\Co_category::findOrFail($category->id)->isFavorited())
                                            <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}"  style="margin-right:300px;">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}" style="margin-right:300px;">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        @endif
                                    </div>

                                    <div class="course-thumbnail">
                                        <a href="">
                                            <img data-src="front/images/a-clinician-works-with-patients-in-a-health-setting.png" alt=""
                                                 class="img-fluid lazy">
                                            <i class="fa fa-play"></i>
                                        </a>
                                        <div class="caption">
                                            <h3 class="title"><a href="{{ url('category/parent', $category->id) }}">{{ $category->cat_name }}</a></h3>

                                            <div class="courses-counter">{{ $count = App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count() }} {{_i(' Course ')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="col-lg-4 col-md-6 d-flex ">
                                    <div class="single-category-box text-center d-flex flex-column">

                                        <div class="top-floating-icons d-flex justify-content-between left">

                                            @if(\App\Hr\Course\Co_category::findOrFail($category->id)->isFavorited())
                                                <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}"  style="margin-right:300px;">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}" style="margin-right:300px;">
                                                    <i class="fa fa-heart-o"></i>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="course-thumbnail">
                                            <a href="">
                                                <img data-src="front/images/a-clinician-works-with-patients-in-a-health-setting.png" alt=""
                                                     class="img-fluid lazy">
                                                <i class="fa fa-play"></i>
                                            </a>
                                            <div class="caption">
                                                <h3 class="title"><a href="{{ url('category/parent', $category->id) }}">{{ $category->cat_name }}</a></h3>
                                                <div class="courses-counter"> {{ \App\Hr\Course\Co_category::where('parent_id', $category->id)->count() }} {{_i(' Category ')}}</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @else
                        <div class="col-md-12">
                           <div class="alert alert-danger text-center">
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
