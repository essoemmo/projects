@extends('front.layout.app')

@section("content")

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('quizzes') }}</li>
            </ol>
        </div>
    </nav>


    <div class="popular-courses common-wrapper">
        <div class="container">
            <div class="section-title text-center">{{ _i('all quizzes') }}</div>

            <div class="row">
                @foreach($exams as $exam)
                    <div class="col-lg-4 col-md-6 d-flex ">
                        <div class="single-quiz single-course-wrapper text-center d-flex flex-column">
                            <div class="course-thumbnail">
                                <a href="">
                                    <img data-src="{{asset('uploads/courses/'. $exam->type_id .'/'. $exam->img )}}" alt="" class="img-fluid lazy">
                                </a>
                            </div>

                            <h3 class="title"><a href="{{ url('course', $exam->type_id) }}">{{ $exam->title }}</a></h3>
                            <div class="quiz-info-1 d-flex justify-content-between">
                                <a href="#">{{ $exam->course->user->first_name }} {{ $exam->course->user->last_name }}</a>
{{--                                <a href="">المحاضرة 1</a>--}}
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
{{--                                     style="width: 25%;" --}}
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="quiz-info-2 d-flex justify-content-between">
                                <a href="{{ url('user/quiz', $exam->id) }}">{{ _i('Start Quiz') }}</a>
                                <a href="#">{{{ $exam->duration }}}  {{ _i('Remaining') }}</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>


            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item ">
                            {{$exams->links()}}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
