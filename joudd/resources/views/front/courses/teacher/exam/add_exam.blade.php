@extends('front.layout.app')


@section('content')
    <div class="flash-message text-center">
            @if(Session::has('flash_message'))
                <br />
                <h6 class="alert alert-info" > <b>   {{ Session::get('flash_message') }} </b></h6>
            @endif
    </div>

    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">
            <div class="box box-info">


        <div class="box-header with-border">
            <h3 class="box-title"> {{_i('Course Information')}} </h3>
            <br>
            <div>
                <label class="col-md-2 control-label">{{$course->title}}</label>

                <label class="col-md-1 control-label">{{_i('Start :')}}</label>
                <label class="col-md-2 control-label">{{$course->start_date}}</label>

                <label class="col-md-1 control-label">{{_i('End :')}}</label>
                <label class="col-md-2 control-label">{{$course->end_date}}</label>

                <label class="col-md-1 control-label">{{_i('Duration')}}</label>
                <label class="col-md-2 control-label">{{$course->duration}}</label>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="{{ url('/user/course/'.$course->id.'/course_exam/store') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">
                @csrf

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#en"  data-toggle="tab" >
                                    <button type="button" class="btn  btn-blue btn-lg " >{{_i('EN')}}</button>
                                </a>
                            </li>
                            <li>
                                <a href="#ar"  data-toggle="tab" >
                                    <button type="button" class="btn  btn-blue btn-lg " >{{_i('AR')}}</button>
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content">

                        <div class="tab-pane active" id="en">

                            <!-- ============================================= Title ============================= -->
                            <div class="form-group row">
                                <label for="title" class="col-md-2 control-label"> Title </label>

                                <div class="col-md-10">

                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="en_title" value="{{old('en_title')}}" placeholder="{{ _i('English Title') }}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ============================================= Description ============================= -->
                            <div class="form-group row">
                                <label for="name" class="col-md-2 control-label">  Description </label>

                                <div class="col-md-10">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="en_description" placeholder="{{ _i('English Description') }}" required=""></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- ============================================= arabic section ============================= -->

                        <div class="tab-pane" id="ar">

                            <!-- ============================================= Title ============================= -->
                            <div class="form-group row">
                                <label for="title" class="col-md-2 control-label">{{ _i('Title') }}</label>

                                <div class="col-md-10">

                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="ar_title" value="{{old('en_title')}}" placeholder="{{ _i('Arabic Title') }}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ============================================= Description ============================= -->
                            <div class="form-group row">
                                <label for="name" class="col-md-2 control-label">{{ _i('Description') }}</label>

                                <div class="col-md-10">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="ar_description" placeholder="{{ _i('Arabic Description') }}" required=""></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>

                <!-- ============================================= duration ============================= -->
                <div class="form-group row">
                    <label for="name" class="col-md-2 control-label">{{ _i(' Duration :') }}</label>

                    <div class="col-md-10">
                        <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{old('duration')}}" placeholder=" Duration" required="">

                        @if ($errors->has('duration'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>


                <!-- ============================================= sart date ============================= -->
                <div class="form-group row">
                    <label for="name" class="col-md-2 control-label"> {{_i(' Start Date :')}} </label>

                    <div class="col-md-10">
                        <input type="date" name="start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                        @if($errors->has('start_date'))
                            <strong>{{$errors->first('start_date')}}</strong>
                        @endif
                    </div>
                </div>

                <!--========================================== end Date =======================================-->
                <div class="form-group row">

                    <label for="name" class="col-md-2 control-label"> {{_i(' End Date :')}} </label>

                    <div class="col-md-10">
                        <input type="date" name="end" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                        @if($errors->has('end_date'))
                            <strong>{{$errors->first('end_date')}}</strong>
                        @endif
                    </div>
                </div>

                <!----==========================  published ==========================--->
                <!-- iCheck -->

                <!-- checkbox -->
                <div class="form-group row" >

                    <label class="col-md-1 col-form-label" for="checkbox">
                        {{_i('Publish')}}
                    </label>
                    <div class="col-md-6 col-form-label">

                        <label>
                            <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1">
                        </label>

                    </div>

                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">{{ _i('Save') }}</button>
                </div>
                <br />
                <!-- /.box-footer -->

            </form>

        </div>

    </div>

            </div>

        </div>
    </div>


@endsection

