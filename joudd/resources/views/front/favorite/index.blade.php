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

@section("find-course")
    <section class="find-course " style="margin-top: 0">
        <div class="container">
            <div class="form-wrapper">
                <form class="form-inline d-flex justify-content-lg-between justify-content-sm-around align-content-center">
                    <span class="find-course-title">{{ _i('Search For Course') }}</span>
                    <select class="custom-select my-1 form-control ">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <select class="custom-select my-1 form-control ">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <input type="search" class="form-control search-input" placeholder="{{ _i('Search For Course') }}">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section("content")

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('My Favourites') }}</li>
            </ol>
        </div>
    </nav>



    <div class="popular-courses common-wrapper">
        <div class="container">

            <div class="section-title text-center">
                {{_i('Courses')}}
            </div>

            <div class="row">
                <?php foreach($courses as $course) { ?>
                <div class="col-lg-4 col-md-6 d-flex ">

                    <div class="single-course-wrapper text-center d-flex flex-column">

                        <div class="top-floating-icons d-flex justify-content-between left">

                            @if(\App\Hr\Course\Course::findOrFail($course->id)->isFavorited())
                                <a href="javascript:void(0)" class="add-to-fav" data-id="{{$course->id}}" style="margin-right:300px;">
                                    <i class="fa fa-heart"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="add-to-fav" data-id="{{$course->id}}" style="margin-right:300px;">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            @endif
                        </div>


                        <div class="course-thumbnail">
                            <div class="course-price"> {{$course->cost}}$</div>
                            <span class="offer">10% <span>OFF</span></span>
                            <?php
                            $path = ("courses/{$course->id}");
                            $files = \Illuminate\Support\Facades\Storage::files($path);
                            $img = "front/images/demo.png";
                            if (count($files) > 0)
                                $img = "uploads/" . $files[0];
                            ?>
                            <a href="">
                                <img data-src="{{$img}}" alt="" class="img-fluid lazy">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>

                        <h3 class="title"><a href="{{ url('course', $course->id) }}">{{$course->title}}</a></h3>
                        <p class="description"><?=  implode( " ",array_slice(explode(" ",strip_tags( $course->description),20),0,2));?></p>
                        <div class="d-flex justify-content-center">
                            <div class="star-ratings-css">
                                <div class="star-ratings-css-top" style="width: @if(couseRating($course->id) != null){{couseRating($course->id)}}% @else 0% @endif">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-css-bottom">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>

                            </div>
                            <a href="" class="btn btn-light btn-more">{{ _i('More') }}</a>
                        </div>

                    </div>
                </div>
                <?php } ?>

            </div>
            <div class="text-center">
                <a href="{{ url('courses') }}" class="btn btn-blue-outlined mt-4">{{ _i('See All Courses') }}</a>
            </div>
        </div>
    </div>

    <div class="courses-categories common-wrapper bg-gray">
        <div class="container">


            <div class="section-title text-center">
                 {{_i('Categories')}}
            </div>

            <div class="row">
                @if($categories)
                    @foreach($categories as $category)
                        <div class="col-lg-4 col-md-6 d-flex ">
                            <div class="single-category-box text-center d-flex flex-column">

                                <div class="top-floating-icons d-flex justify-content-between left">

                                    @if(\App\Front\Category::findOrFail($category->id)->isFavorited())
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
                                        <img data-src="/front/images/a-clinician-works-with-patients-in-a-health-setting.png" alt=""
                                             class="img-fluid lazy">
                                        <i class="fa fa-play"></i>
                                    </a>
                                    <div class="caption">
                                        <h3 class="title"><a href="{{ url('category', $category->id) }}">{{ $category->cat_name }}</a></h3>
                                        <div class="courses-counter">{{ $count = App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count() }} {{ _i('Course') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-4 col-md-6 d-flex ">
                        <div class="alert alert-danger text-center">
                            {{ _i('No Categories') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="text-center">
                <a href="{{ url('categories') }}" class="btn btn-blue-outlined">{{ _i('See All Categories') }}</a>
            </div>
        </div>
    </div>





    <div class="popular-courses common-wrapper">

        <div class="container">

            <div class="section-title text-center">
                {{_i('Courses Media')}}
            </div>

            <div class="course-lectures-slider">
                @foreach($course_media as $item)
                    <div class="single-course-lecture-slide current-lecture-playing">

                        <div class="top-floating-icons d-flex justify-content-between left">

                            @if(\App\Models\Admin\CourseMedia::findOrFail($item->id)->isFavorited())
                                <a href="javascript:void(0)" class="add-to-fav media-course" data-id="{{$item->id}}" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="add-to-fav media-course" data-id="{{$item->id}}" >
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            @endif
                        </div>

                        <div class="course-thumbnail">
                            <a href="">
                                @if($item != null)
                                    <img data-lazy="{{ asset('uploads/course/course_videos/' . $item->course_id. '/' . $item->img) }}" alt=""
                                         class="img-fluid lazy">
                                @else
                                    <img data-lazy="images/ayurveda-is-an-ancient-healing-art.png" alt=""
                                         class="img-fluid lazy">
                                @endif
                            </a>
                        </div>
                        <h3 class="lecture-title">
                            <a href="javascript:void(0)" style="cursor: pointer" class="showVideo">
                                {{ $item->title }}
                                <input type="hidden" name="showVideo" class="video_id" value="{{ $item->id }}">
                            </a>
                        </h3>
                        <span class="lecture-length">10:00 MIN.</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>






@endsection
