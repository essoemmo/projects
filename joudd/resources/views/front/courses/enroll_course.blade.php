@extends('front.layout.app')

@section("content")

    <div class="flash-message text-center">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
    </div>


    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('categories') }}">{{ _i('Categories') }}</a></li>
{{--                <li class="breadcrumb-item"><a href="{{ url('category', $category->co_category_id) }}">{{ $category->cat_name }}</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>--}}
            </ol>
        </div>
    </nav>

    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">

            <div class="single-course-video-wrapper">
                <div class="embed-responsive embed-responsive-21by9">
                    <video controls  class="embed-responsive-item appendVideo" src="{{ asset('uploads/courses/' . $course->id. '/' . $course->video) }}"></video>
                </div>


            </div>


            <div class="course-features wide-title-box mt-4">
                <div class="title">{{ _i('Course Lectures') }}</div>
                @if($pending != null)
                    @if($pending->is_paid == 0)
                        <div class="col-sm-12">
                            <div class="wide-box-content-wrapper">
                                <div class="text-center alert alert-danger">
                                    {{ _i('Awaiting Approval') }}
                                </div>
                                <div class="text-center">
                                    <a href="" class="btn btn-default btn-rounded get_id" data-toggle="modal" data-target="#modalContactForm">
                                        <i class="fa fa-comments-o" aria-hidden="true"></i> {{ _i('Message Instructor') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <div class="course-features wide-title-box mt-4">
                <div class="title">{{ _i(' Course Attachment') }}</div>
                <div class="wide-box-content-wrapper">
                    <div class="course-lectures common-wrapper">
                        <div class="container">
                            @if($applicant)
                                @if(count($files) != 0)
                                    <div class="course-lectures-slider">
                                        @foreach($files as $item)
                                            <div class="single-course-lecture-slide current-lecture-playing">
                                                <h3 class="lecture-title">
                                                    <a href="{{ url('/uploads/') . '/' .  $item }}" data-toggle="tooltip" data-placement="top" title="{{ $item }}" style="cursor: pointer" class="showVideo">
                                                        {{pathinfo(\Illuminate\Support\Str::limit($item, 20),PATHINFO_FILENAME)}}
                                                    </a>
                                                </h3>
                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <div class="wide-box-content-wrapper">
                                            <div class="text-center alert alert-danger">
                                                {{ _i('No attachments') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-sm-12">
                                    <div class="wide-box-content-wrapper">
                                        <div class="text-center alert alert-danger">
                                            {{ _i('Awaiting Approval') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($rating)

                <div class="students-comments my-4">
                    <div class="section-title smaller-title">
                        {{ _i('Students Reviews') }}
                    </div>

                    <div class="row">

                        @foreach($rating->userRating as  $userRating)

                            @if($userRating->user->id === auth()->id() && $userRating->approve == 1 && $userRating->comment != null)
                                <div class="col-md-4">
                                    <div class="single-comment single-achievement d-flex align-items-center">
                                        <div class="media "> <!--- {{ asset('uploads/courses/' . $course->course_id . '/' . $course->img) }} course_id -->
                                            <img data-src="{{asset('uploads/applicants/' .applicant_details($userRating->user_id)->image)}}" class="align-self-center img-fluid ml-3 lazy" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6> {{$userRating->user->first_name}} {{$userRating->user->last_name}}

                                                    <div class="star-ratings-css small-user-rating d-inline-block">
                                                        <div class="star-ratings-css-top" style="width: {{$userRating->rating * 10}}%;">
                                                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                                        <div class="star-ratings-css-bottom">
                                                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                                                    </div>

                                                </h6>
                                                <h5 class="mt-0 cat-name"> {{$course->title}} </h5>
                                                <p> {{$userRating->comment}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($userRating->user->id === auth()->id() && $userRating->approve == 0  && $userRating->comment != null)
                                <div class="alert text-center alert-info title" style="min-width: 100%;"> {{ _i('Comment Awaiting Approval') }} </div>
                                {{--                        @else--}}
                                {{--                            <div class="alert text-center alert-info title" style="min-width: 100%;"> لا يوجد تعليقات</div>--}}
                            @endif

                        @endforeach

                    </div>

                </div>

            @else
                <div class="alert text-center alert-info title" style="min-width: 100%;">{{ _i('No Comments') }}</div>
            @endif


            @include('front.layout.course-comment' , ['course_id' => $course->id ])

        </div>


        <div class="courses-you-may-need bg-gray common-wrapper">
            <div class="container">
                <div class="section-title smaller-title">
                    {{ _i('Courses You Might Need') }}
                </div>

                <div class="row">
                    @if(count($courses) > 0)
                        @foreach($courses as $course)
                            <div class="col-md-6">
                                <div class="single-achievement d-flex align-items-center">
                                    <div class="date">
                                        <span>{{ date('d',strtotime( $course->start_date)) }}</span>
                                        <span>{{ date('M',strtotime( $course->start_date)) }}</span>
                                        <span>{{ date('Y',strtotime( $course->start_date)) }}</span>
                                    </div>
                                    <div class="media ">
                                        @if($course->img != null)
                                            <img data-src="{{ asset('uploads/courses/' . $course->course_id . '/' . $course->img) }}" class="align-self-center img-fluid ml-3 lazy" alt="...">
                                        @else
                                            <img data-src="images/no-img40x40.jpg" class="align-self-center img-fluid ml-3 lazy" alt="...">
                                        @endif
                                        <div class="media-body align-self-center">

                                            <h5 class="mt-0 cat-name">{{ $course->course->title }}
                                                <span class="star-ratings-css small-user-rating d-inline-block">
                                                <div class="star-ratings-css-top" style="width: 0%">
                                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                                <div class="star-ratings-css-bottom">
                                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                                            </span>
                                            </h5>
                                            <p>{!! str_limit($course->course->description,50) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-6">
                            <div class="alert alert-danger text-center">
                                {{ _i('No Courses') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{--    model start    --}}
    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <form action="{{ url('/user/send_message') }}" method="POST" data-parsley-validate>
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input type="hidden" name="to_id" id="to_id" value="">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">{{ _i('Write to Trainer') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form">
                            <label data-error="wrong" data-success="right" for="form8">
                                {{ _i('Your Message') }}
                                <i class="fa fa-pencil prefix grey-text"></i>
                            </label>

                            <textarea type="text" id="form8" name="message" class="md-textarea form-control" rows="4" required  data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character"></textarea>

                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-unique">{{ _i('Send') }} <i class="fa fa-paper-plane-o ml-1"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{--    model end    --}}
@endsection


@push('js')

    <script>
        $(function () {
            'use strict';
            $('a.showVideo').click(function (e) {
                var video_id = $(this).children('.video_id').val();
                var asset = "{!! asset('uploads/course/course_videos/') !!}";
                // console.log(video_id);
                $.ajax({
                    url:'/showVideo',
                    DataType:'json',
                    type:'get',
                    data: {video_id: video_id},
                    success:function (res) {
                        console.log(res);
                        $('.appendVideo').removeAttr('src');
                        $('.appendVideo').attr('src',asset + '/' + res.course_id + '/' + res.file);
                    }
                })
            });
        })
    </script>

    <script>
        $(function () {
            'use strict';
            $('a.get_id').click(function (e) {
                var to_id = '{{ $trainer->id }}';
                $('#to_id').val(to_id);
            });
        })
    </script>

@endpush
