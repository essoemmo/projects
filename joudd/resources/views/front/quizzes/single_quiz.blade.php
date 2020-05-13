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

            <form action="{{url('/user/quiz/check')}}" method="POST">
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
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-blue">{{ _i('send answer') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
