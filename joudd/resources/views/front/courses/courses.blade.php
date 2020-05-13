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
                <li class="breadcrumb-item active" aria-current="page">{{ _i(' Courses ') }}</li>
            </ol>
        </div>
    </nav>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
    </div>

    <div class="popular-courses common-wrapper">
        <div class="container">


{{--            <div class="section-title text-center">--}}
{{--                كورسات شائعة--}}
{{--            </div>--}}

            <div class="row">
                @if(count($courses) > 0 )
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
                            @if($course->cost == 0)
                                <div class="course-price"> {{ _i('free') }}</div>
                            @else
                                <div class="course-price"> {{ round($course->cost * $convert->rate) }} {{ $convert->code }} </div>
                            @endif
{{--                            <span class="offer">10% <span>OFF</span></span>--}}
                            <?php
                            $path = ("courses/{$course->id}");
                            $files = \Illuminate\Support\Facades\Storage::files($path);
                            $img = "front/images/demo.png";
                            if (count($files) > 0)
                                $img = "uploads/" . $files[0];
                            ?>
                            <a href="{{ url('course', $course->id) }}">
                                <img data-src="{{$img}}" alt="" class="img-fluid lazy">
{{--                                    <i class="fa fa-play"></i>--}}
                            </a>
                        </div>

                        <h3 class="title"><a href="{{ url('course', $course->id) }}">{{$course->title}}</a></h3>
                        <p class="description"><?=  implode( " ",array_slice(explode(" ",strip_tags( $course->description),20),0,2));?></p>
                        <div class="d-flex justify-content-center">
                            <div class="star-ratings-css">
                                <div class="star-ratings-css-top" style="width: {{couseRating($course->id) == null ? 0:couseRating($course->id)}}%">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-css-bottom">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>

                            </div>
                            <a href="{{ url('course', $course->id) }}" class="btn btn-light btn-more">{{ _i('More') }}</a>
                        </div>

                    </div>
                </div>
                <?php } ?>

                @else

                    <div class="col-lg-12">
                        <div class="alert alert-info text-center" role="alert">
                            {{_i('Not Found Courses')}}
                        </div>
                    </div>
                @endif

            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item ">
                            {{$courses->links()}}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
