@extends('front.layout.app')


@section("content")

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Sign Up') }}</li>
            </ol>
        </div>
    </nav>



    <div class="login-page common-wrapper">
        <div class="container">
            <div class="wide-title-box ">

                <div class="title bg-gray"> {{_i('Welcome, choose membership type')}} </div>

                <div class="wide-box-content-wrapper reversed-form-color">
                    <div class="course-register-form">
                        <form action="{{ url('signUp') }}" method="GET">

                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <form action="">
                                        <div class="img-radio-btns text-center">

                                            <div class="radio-img-btn-wrapper">
                                                <input id="instructor" type="radio" name="a" value="instructor"/>
                                                <label for="instructor" class="instructor-icon-img"></label>
                                                <label for="instructor" class="label-txt">{{_i('Teacher')}}</label>
                                            </div>

                                            <div class="radio-img-btn-wrapper">
                                                <input id="student" type="radio" name="a" value="student"/>
                                                <label for="student" class="student-icon-img"></label>
                                                <label for="student" class="label-txt">{{_i('Applicant')}}</label>
                                            </div>

                                            <div class="login-btn mt-4">
                                                <input type="submit" class="btn btn-blue " value="{{_i('Register')}}">
                                                <p><a href="{{ url('user/login') }}" class="w-100 text-muted">  {{_i('Already have a membership? Login here')}}</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>


                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
