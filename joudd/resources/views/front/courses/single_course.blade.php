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

    @push('css')
        <style>
            .comments-card .card{
                margin-bottom: 20px;
            }
            .btn-dark:hover{
                color: #000 !important;
            }
        </style>
    @endpush
    @push('js')
        <script>
            $(function () {
                'use strict';
                $('input[name="stars"]').click(function () {
                    var stars = $(this).val();
                    var course = '{{$course->id}}';
                    var user = '{{auth()->guard('web')->id()}}';
                    console.log(user);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'{{url('/rating')}}',
                        type:'post',
                        dataType:'json',
                        data:{stars: stars,course: course,user: user},
                        success:function (res) {
                            var html = '<div class="star-ratings-css" style="margin: 0 0 30px;display:inline-flex">\n' +
                                '<div class="star-ratings-css-top" style="width: '+res.rating * 20 +'%;display:inline-flex"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>\n' +
                                '<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>\n' +
                                '<br><br></div>';
                            $('#rating').empty();
                            $('#rating').append(html);
                            $('.send').attr('type','submit');
                        }
                    })
                })
            });

            $(function () {
                'use strict';
                $('.qty').on('change', function () {
                    var qty = $(this).val();
                    $('.new_qty').val(qty);
                });
            });
        </script>
    @endpush


    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('categories') }}">{{ _i('Categories') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('category', $category->co_category_id) }}">{{ $category->cat_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{url('course' ,$course->id)}}"> {{ $course->title }} </a> </li>
            </ol>
        </div>
    </nav>


    <div class="single-course-page pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-md-flex align-content-md-stretch ">
                    <div class="single-course-wrapper">
                        <div class="course-thumbnail d-flex">

                            @if($course->video != null)
{{--                                @dd($course->video)--}}
                                <video width="100%" height="100%" src="{{ asset('uploads/courses/' . $course->id. '/' . $course->video) }}" controls></video>
                            @else
                                <img data-src="{{ asset('uploads/courses/' . '/' . $course->id. '/' . $course->img) }}" alt=""
                                     class="img-fluid lazy align-self-center">
{{--                                <i class="fa fa-play"></i>--}}
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="single-course-meta">
                        <h3 class="title"><a href="{{ url('course', $course->id) }}">{{ $course->title }}</a></h3>
                        <p class="description">{!! $course->description !!}</p>
                        <div class="single-course-information">
                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="single-info">
                                        <p>{{ _i('Trainer Name') }}</p>
                                        <span>
                                            <a href="">{{ $course->user->first_name }} {{ $course->user->last_name }}</a>
                                        </span>
                                        <span>
                                            <a href="" class="btn btn-default btn-rounded get_id" data-toggle="modal" data-target="#modalContactForm">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="single-info">
                                        <p>{{ _i('Categories') }}</p>
                                        <span><a href="{{ url('category', $category->co_category_id) }}">{{ $category->cat_name }}</a></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="single-info">
                                        <p>{{ _i('Review') }}</p>
                                        <div class="star-ratings-css">
                                            <div class="star-ratings-css-top" style="width: {{couseRating($course->id) == null ? 0 : couseRating($course->id)}}%">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                            <div class="star-ratings-css-bottom">
                                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="single-info">
                                        <p>{{ _i('Price') }}</p>
                                        @if($course->cost == 0)
                                            <span>{{ _i('Free') }}</span>
                                        @else
                                            <span>{{ round($course->cost * $convert->rate) }} {{ $convert->code }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


            <div class="course-features wide-title-box mt-4">
                <div class="title">{{ _i(' Course Attachment') }}</div>
                <div class="wide-box-content-wrapper">
                    <div class="course-lectures common-wrapper">
                        <div class="container">
                            @if($course_owned == true)
                                @if(count($files) != 0)
                                <div class="course-lectures-slider">
                                    @foreach($files as $item)
                                        <div class="single-course-lecture-slide current-lecture-playing">
                                            <h3 class="lecture-title">
                                                <a href="{{ url('/uploads/') . '/' .  $item }}" style="cursor: pointer" class="showVideo">
                                                    {{ pathinfo($item,PATHINFO_FILENAME) }}
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
                                            {{ _i('Enroll in Course') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-features wide-title-box mt-4">
                <div class="title">{{ _i('Course Lectures') }}</div>

{{--                @dd(count($media))--}}
                @if(count($media) != 0)
                <div class="wide-box-content-wrapper">
                    <div class="feature-title">{{ _i('Start In') }} <span>{{ date('d F Y',strtotime( $course->start_date)) }}</span></div>

                    <div class="divider"></div>

                    <div class="feature-title">{{ _i('Lectures Number') }}<span> {{ count($media) }} {{ _i('Lectures') }}</span></div>

                    @foreach($media as $item)
                    <div class="lecture-list">
                        <div class="single-lecture-info">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="lecture-number">{{ $item->title }}</div>
                                </div>

                                <div class="col-md-8">
                                    <div class="lecture-brief">{!! $item->description !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
{{--                                    <div class="lecture-length">10:00 MIN.</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="divider"></div>

                    <div class="feature-title">{{ _i('Quizes') }}
                        <span>{{ _i('Quiz After Every Lecture') }}</span>
                        @if($course_owned == true)
                            @if($quiz != null)
                                <a href="{{ url('user/quiz', $quiz->id) }}" class="btn btn-blue">{{ _i('Go To Quiz') }}</a>
                            @endif
                        @endif
                    </div>

                    <div class="divider"></div>

                    <div class="feature-title">{{ _i('Students Number') }} <span>{{ $applicants_count }} {{ _i('Student') }}</span></div>

                    @if(auth()->id() != null)
                        @if(auth()->user()->type == 'applicant')
                            <div class="text-center">
                                @if($course->cost == 0)
                                    <a href="{{ url('subscribe', $course->id) }}" class="btn btn-blue">{{ _i('Enroll in Course') }}</a>
                                @else
                                    <a href="{{ route('buy', ["type" =>'course',$course->id]) }}" class="btn btn-blue">{{ _i('Buy Now') }}</a>
                                @endif
                            </div>
                        @else
                            <div class="alert text-center alert-danger"> {{ _i('Can\'t Join') }}</div>
                        @endif
                    @else
                        <div class="text-center">
                            @if($course->cost == 0)
                                <a href="{{ url('subscribe', $course->id) }}" class="btn btn-blue">{{ _i('Enroll in Course') }}</a>
                            @else
                                <a href="{{ route('buy', ["type" =>'course',$course->id]) }}" class="btn btn-blue">{{ _i('Buy Now') }}</a>
                            @endif
                        </div>
                    @endif

                </div>
                @else
                    <div class="wide-box-content-wrapper">
                        <div class="text-center alert alert-danger">
                            {{ _i('No Media') }}
                        </div>
                    </div>
                @endif
            </div>

            @if($course->cost != 0)
                <div class="course-features wide-title-box mt-4">
                    <div class="title">{{ _i(' Course Content') }}</div>
                    <div class="wide-box-content-wrapper">
                        <div class="course-lectures common-wrapper">
                            <div class="container">

                                <div class="course-lectures-slider">
                                    @foreach($media as $item)
                                        <div class="single-course-lecture-slide current-lecture-playing">

                                            <div class="top-floating-icons d-flex justify-content-between left">

                                                @if(\App\Models\Admin\CourseMedia::findOrFail($item->media_id)->isFavorited())
                                                    <a href="javascript:void(0)" class="add-to-fav media-course" data-id="{{$item->media_id}}">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="add-to-fav media-course" data-id="{{$item->media_id}}">
                                                        <i class="fa fa-heart-o"></i>
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="course-thumbnail">
                                                <a href="">
                                                    @if($item != null)
                                                        <img data-lazy="{{ asset('uploads/course/course_videos/' . $course->id. '/' . $item->img) }}" alt=""
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
                                                    <input type="hidden" name="showVideo" class="video_id" value="{{ $item->media_id }}">
                                                </a>
                                            </h3>
                                            <br>
                                            @if($item->cost == 0)
                                                <a href="{{ url('subscribe_media', $item->media_id) }}" class="btn btn-blue">{{ _i('Enroll in Media') }}</a>
                                            @else
                                                <a href="{{ route('buy', ["type" =>'media',$item->media_id]) }}" class="btn btn-blue">{{ _i('Buy Now') }}</a>
                                            @endif
                                        </div>

                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="add-comment wide-title-box">

                <div class="title"> @if(Rate(auth()->id(),$course->id)) {{_i('Your Review')}} @else {{_i('Write a Review')}} @endif </div>

                @if(!existRate(auth()->guard('web')->id(),$course->id) && auth()->check())

                <div class="wide-box-content-wrapper">
                    <div class="course-register-form">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="feature-title">{{_i('Leave a review before commenting')}} <span></span></div>
                                    <div class="divider"></div>
                                </div>


                                <div class="col-md-4" id="rating">

                                    @if(!Rate(auth()->id(),$course->id))

                                    <form>
                                        <div class="col-md-12"  id="rating">
                                            <br />

                                            <div class="rat">
                                                <label>
                                                    <input type="radio" name="stars" value="1" />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars" value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars" value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars" value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars" value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>
                                        </div>
                                    </form>

                                    @else
                                        <div class="star-ratings-css" style="margin: 0 0 30px;display: inline-flex">
                                            <div class="star-ratings-css-top" style="width: {{\App\Models\rating\userRating::where('user_id',auth()->guard('web')->id())->first()['rating'] * 20}}%;display: inline-flex"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                            <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                        </div>
                                    @endif

                                </div>

                            </div>

                            <form action="{{route('sendcomment')}}"  method="post" data-parsley-validate="">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="id" value="{{$course->id}}">

                            <div class="col-md-12">
                                <div class="field">
                                  <textarea rows="6" class="form-control"  id="comment_txt" name="comment"
                                            placeholder="{{_i('Write your comment here')}}"></textarea>
                                    <label for="comment_txt"> {{_i('Your comment')}}</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn register-btn" value="{{_i('Send Comment')}}">
                            </div>

                        </form>

                    </div>

                </div>
                    {{--             @elseif(userRating($course->id , auth()->id())->user_id === auth()->id() && userRating($course->id , auth()->id())->approve == 1 && userRating($course->id , auth()->id())->comment != null)--}}
                @elseif(Rate(auth()->id(),$course->id))
                    <div class="star-ratings-css" style="margin: 20px; display: inline-flex">
                        <div class="star-ratings-css-top" style="width: {{\App\Models\rating\userRating::where('user_id',auth()->guard('web')->id())->first()['rating'] * 20}}%;">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>

{{--                    <div class="star-ratings-css">--}}
{{--                        <div class="star-ratings-css-top" style="width: {{\App\Models\rating\userRating::where('user_id',auth()->guard('web')->id())->first()['rating'] }}%;display: inline-flex">--}}
{{--                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>--}}
{{--                        <div class="star-ratings-css-bottom">--}}
{{--                            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>--}}

{{--                    </div>--}}

                @else
                    <div class="alert text-center alert-info" style=" margin: 10px;"> {{ _i('Comment Awaiting Approval') }} </div>
                @endif

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
                            <div class="alert text-center alert-info title" style="min-width: 100%;">  {{ _i('Comment Awaiting Approval') }}</div>
{{--                        @else--}}
{{--                            <div class="alert text-center alert-info title" style="min-width: 100%;"> لا يوجد تعليقات</div>--}}
                        @endif

                    @endforeach

                </div>

            </div>

            @else
                <div class="alert text-center alert-info title" style="min-width: 100%;"> {{ _i('No Comments') }}</div>
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
                                            <img data-src="{{asset('front/images/no-img40x40.jpg')}}" class="align-self-center img-fluid ml-3 lazy" alt="...">
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
                        <div class="col-md-12">

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
{{--    @dd($trainer->id)--}}
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
            $('a.get_id').click(function (e) {
                var to_id = '{{ $trainer->id }}';
                $('#to_id').val(to_id);
            });
        })
    </script>


@endpush
