@extends('admin.layout.layout')
@section('title')
    {{_i('Add Course Exam')}}
@endsection

@section('header')

@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Course Exam')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/course/all')}}"> {{_i('All Courses')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> {{_i('Course Information')}} </h3>
            <br>
            <br>
            <div>
                <label class="col-xs-2 control-label">{{$course->title}}</label>

                <label class="col-xs-1 control-label">{{_i('Start :')}}</label>
                <label class="col-xs-2 control-label">{{$course->start}}</label>

                <label class="col-xs-1 control-label">{{_i('End :')}}</label>
                <label class="col-xs-3 control-label">{{$course->end}}</label>

                <label class="col-xs-1 control-label">{{_i('Duration')}}</label>
                <label class="col-xs-2 control-label">{{$course->duration}}</label>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="{{ url('/admin/competition/'.$course->id.'/competition/store') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">
                @csrf

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#en" data-toggle="tab">{{ _i('EN') }}<i class="fa"></i></a></li>
                        <li><a href="#ar" data-toggle="tab">{{ _i('AR') }}<i class="fa"></i></a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="en">

                            <!-- ============================================= Title ============================= -->
                            <div class="form-group">
                                <label for="title" class="col-xs-2 control-label">{{ _i('Title') }}</label>

                                <div class="col-xs-5">

                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="en_title" value="{{old('en_title')}}" placeholder="{{ _i('Title') }}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ============================================= Description ============================= -->
                            <div class="form-group">
                                <label for="name" class="col-xs-2 control-label">{{ _i('Description') }}</label>

                                <div class="col-xs-5">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="en_description" placeholder="{{ _i('Description') }}" required=""></textarea>
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
                            <div class="form-group">
                                <label for="title" class="col-xs-2 control-label">{{ _i('Title') }}</label>

                                <div class="col-xs-5">

                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="ar_title" value="{{old('en_title')}}" placeholder="{{ _i('Title') }}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ============================================= Description ============================= -->
                            <div class="form-group">
                                <label for="name" class="col-xs-2 control-label">{{ _i('Description') }}</label>

                                <div class="col-xs-5">
                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="ar_description" placeholder="{{ _i('Description') }}" required=""></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- ============================================= duration ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-2 control-label">{{ _i(' Duration :') }}</label>

                    <div class="col-xs-5">
                        <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{old('duration')}}" placeholder=" Duration" required="">

                        @if ($errors->has('duration'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>


                <!-- ============================================= sart date ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-2 control-label"> {{_i(' Start Date :')}} </label>

                    <div class="col-xs-5">
                        <input type="date" name="start" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                        @if($errors->has('start_date'))
                            <strong>{{$errors->first('start_date')}}</strong>
                        @endif
                    </div>
                </div>

                <!--========================================== end Date =======================================-->
                <div class="form-group">

                    <label for="name" class="col-xs-2 control-label"> {{_i(' End Date :')}} </label>

                    <div class="col-xs-5">
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

                    <label class="col-xs-2 col-form-label" for="checkbox">
                        {{_i('Publish')}}
                    </label>
                    <div class="col-xs-6">

                        <label>
                            <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1">
                        </label>

                    </div>

                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ _i('Save') }}</button>
                </div>
                <!-- /.box-footer -->

            </form>

        </div>

    </div>

@endsection

