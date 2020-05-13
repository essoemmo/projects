@extends('front.layout.app')

@section("content")

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/user/quizzes') }}">{{ _i('quizzes') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('quizzes') }}</li>
            </ol>
        </div>
    </nav>


    <div class="popular-courses common-wrapper">
        <div class="container">
            <div class="section-title text-center">{{ _i('quizzes') }}</div>

{{--            <form action="{{url('/user/quiz/check')}}" method="POST">--}}
                @csrf
                @foreach($quizzes as $quiz)
                    <div class="single-quiz-question">
                        <h5 class="question-text">{{ $quiz->title }}</h5>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1-[{{ $quiz->id }}]" name="customRadioInline[{{ $quiz->id }}]" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadioInline1-[{{ $quiz->id }}]">{{ _i('true') }}</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2-[{{ $quiz->id }}]" name="customRadioInline[{{ $quiz->id }}]" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="customRadioInline2-[{{ $quiz->id }}]">{{ _i('false') }}</label>
                        </div>
                    </div>
                @endforeach
{{--            </form>--}}

            <div class="col-md-4 offset-md-4">
                <div class="quiz-result-box">
                    <div class="single-line d-flex justify-content-between">
                        <span>{{ _i('total score') }}</span>
                        <span>{{ $user_answer_score }}</span>
                    </div>
                    <div class="single-line d-flex justify-content-between">
                        <span>{{ _i('correct answers') }}</span>
                        <span>{{ $user_answer_correct }}</span>
                    </div>
                    <div class="single-line d-flex justify-content-between">
                        <span>{{ _i('wrong answers') }}</span>
                        <span>{{ $user_answer_wrong }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
{{--                    <a href="" class="btn btn-blue rounded-0 ">{{ _i('print Certificate') }}</a>--}}
{{--                    <a href="" class="btn btn-blue rounded-0 ">{{ _i('test again') }}</a>--}}
                </div>
            </div>

        </div>
    </div>

@endsection
