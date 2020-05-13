@extends('front.layout.app')

@section('title')
    {{_i('Add Course')}}
@endsection


@section('content')

    <div class="flash-message text-center">
{{--        @foreach (['danger', 'warning', 'success', 'info' ,'flash_message'] as $msg)--}}
            @if(Session::has('flash_message'))
                <br />
                <h6 class="alert alert-info" > <b>   {{ Session::get('flash_message') }} </b></h6>
            @endif
{{--        @endforeach--}}
    </div>

    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> {{_i('Course Information')}} </h3>
                </div>
                <br />

    <form method="POST" action="{{ url('/user/course/' . $course->id . '/edit') }}" class="form-horizontal" enctype="multipart/form-data" id="demo-form" data-parsley-validate="">
        @csrf

        <div class="box-body">
            <!-- ============================================= Title ===========================            == -->

            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i('Course Name') }}</label>

                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$course->title}}"  placeholder=" Title" required="" />

                    @if ($errors->has('title'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <!-- ============================================= sart date ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label"> {{_i(' Start Date :')}} </label>

                <div class="col-md-10">
                    <input type="date" name="start_date" class="form-control" value="{{$course->start_date}}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('start_date'))
                    <strong>{{$errors->first('start_date')}}</strong>
                    @endif
                </div>
            </div>

            <!--========================================== end Date =======================================-->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label"> {{_i(' End Date :')}} </label>

                <div class="col-md-10">
                    <input type="date" name="end_date" class="form-control" value="{{$course->end_date}}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('end_date'))
                    <strong>{{$errors->first('end_date')}}</strong>
                    @endif
                </div>
            </div>

            <!-- ============================================= duration ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label" >{{ _i(' Duration :') }}</label>

                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{$course->duration}}" placeholder=" Duration" required="">

                    @if ($errors->has('duration'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= cost ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label" >{{ _i(' Cost :') }}</label>

                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{$course->cost}}" placeholder=" Cost" required="">

                    @if ($errors->has('cost'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= currency ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i(' Currency :') }}</label>
                <div class="col-md-10">
                    <select data-live-search="true" title="Choose one of the following..." class="selectpicker form-control{{ $errors->has('currency_id') ? ' is-invalid' : '' }}" name="currency_id">
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}" {{ $currency->id == $course->currency_id ? 'selected' : ''}} > {{$currency->title}}</option>
                        @endforeach
                        @if ($errors->has('currency_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('currency_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>

            <!-- ============================================= Country ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i(' Country :') }}</label>

                <div class="col-md-10">
                    <select multiple class="select2 select2-hidden-accessible form-control{{ $errors->has('country_id') ? ' is-invalid' : '' }}" style="width:100%" name="country_id[]">

                        @foreach($countries as $country)
                            <option value="{{$country->id}}" @foreach($course_country as $item) {{ $country->id ==  $item->country_id  ? 'selected' : ''}} @endforeach > {{$country->title}}</option>
                        @endforeach

                        @if ($errors->has('country_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>

            <!-- ============================================= language ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i(' Language :') }}</label>

                <div class="col-md-10">
                    <select data-live-search="true" title="Choose one of the following..." class="selectpicker form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id">
                        @foreach($langs as $lang)
                            <option value="{{$lang->id}}" {{ $lang->id == $course->lang_id ? 'selected' : ''}} > {{$lang->title}}</option>
                        @endforeach

                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lang_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>
            <!-- ============================================= Course Category ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i('Course Category') }}</label>
                <div class="col-md-10">
                    <select data-live-search="true" title="Choose Multiple of the following..." class="selectpicker form-control{{ $errors->has('co_category_id') ? ' is-invalid' : '' }}" name="co_category_id">

                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id==$category_id ? 'selected' : ''}} > {{$category->cat_name}}</option>

                        @endforeach

                        @if ($errors->has('co_category_id'))
                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('co_category_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>

            <!-- ============================================= Is Active ============================= -->
{{--            @if(auth()->user()->can('course-activation'))--}}
{{--                <div class="form-group row">--}}

{{--                    <label for="gender" class="col-xs-2 control-label">{{_i('Status')}}</label>--}}

{{--                    <div class="col-xs-6">--}}

{{--                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="1"{{$course->is_active==1 ? 'checked' :''}} >--}}
{{--                        <label  class="form-check-label" for="type"> {{_i('Active')}} </label>--}}

{{--                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="0"{{$course->is_active==0 ? 'checked' :''}}>--}}
{{--                        <label  class="form-check-label" for="ype"> {{_i('Not Active')}} </label>--}}

{{--                    </div>--}}
{{--                    @if ($errors->has('is_active'))--}}
{{--                    <span class="text-danger invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('is_active') }}</strong>--}}
{{--                    </span>--}}
{{--                    @endif--}}

{{--                </div>--}}
{{--            @endif--}}

            <!-- ================================== Attachments =================================== -->
            <div class="form-group row">
                <label class="col-md-2 control-label">{{_i('Upload photo')}}</label>
                <div class="col-md-8">
                    <input type="file" name="file" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                    <strong>{{$errors->first('file')}}</strong>
                </div>
                <div class="col-md-3 pull-left">   <!-- Photo -->
                    <img class="" id="course_img" src="{{ asset('uploads/courses/' . $course->id . '/' . $course->img) }}"  style="margin-top: -50px">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-2 control-label">{{_i('Upload Video')}}</label>
                <div class="col-md-10">
                    <input type="file" name="video" id="filev"  class="btn btn-default" >
                    <strong>{{$errors->first('file')}}</strong>
                </div>
            </div>
            <!--========================================== Description =======================================-->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label" >{{ _i('Description') }}</label>

                <div class="col-md-10">
                    <textarea id="editor1" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"  required=""
                              value="{{old('description')}}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place some text here"
                              >{{$course->description}}</textarea>
                    @if($errors->has('description'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif

                </div>
            </div>
            <!--========================================== File=======================================-->
            <div class="form-group row">

                <label for="name" class="col-md-2 control-label">{{_i('Add Media files')}}</label>

                <div class="col-md-5">
                    <input type="file" name="files[]" id="fileUploader" style="display: inline" class=" btn btn-default" >
                </div>

                <div class="col-md-5">
                    <button class="btn btn-success btn-sm" type="button" id="add" title='{{_i("Add new file")}}' onclick="Add()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add New Media File")}}</button>
                </div>


                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div id="files" class="files"></div>
                </div>

            </div>

{{--            @dd($course->getMediaAttachments())--}}
            <!--========================================== Attachments=======================================-->
            @if(count($urls = $course->getMediaAttachments())>0)
{{--                @dd($course)--}}
                <div class="form-group">
                    <label for="title" class="col-xs-4 control-label">{{ _i("Course Attachments") }}</label>
                    <div class="col-xs-8">
                        @foreach ($urls as $url)
{{--                            @dd($url)--}}
                            <div class="col-xs-8">
                                <a type="button" href="{{$url}}" class="btn btn-info pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-download"></i> {{pathinfo($url,PATHINFO_FILENAME)}}
                                </a>
                                <a type="button" onclick="delete_attach(this,'{{$url}}')" class="btn btn-danger pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-delete"></i>Delete
                                </a>
                            </div>
                            <br> <br>
                        @endforeach

                    </div>

                </div>
            @else
                <div class="form-group row">
                    <label class="col-xs-5 col-form-label text-md-right">{{ _i("Attachments")}} :</label>
                    <div class="col-xs-5"></div>
                    <div class="col-xs-6">
                        <label class="col-xs-10 col-form-label text-md-right">{{ _i("No Attachments")}}</label>
                    </div>

                </div>
            @endif

        <!--========================================== Attachments=======================================-->
                @if(count($files) > 0)
                    <div class="form-group">
                        <label for="title" class="col-xs-4 control-label">{{ _i("Media Attachments") }}</label>
                        <div class="col-xs-8">
                            @foreach ($files as $file)
{{--                                @dd($file)--}}
                                <div class="col-xs-8">
                                    <a type="button" href="{{ url('/uploads/') . '/' .  $file }}" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> {{pathinfo($file,PATHINFO_FILENAME)}}
                                    </a>
                                    <a type="button" onclick="delete_attach(this,'{{$file}}')" class="btn btn-danger pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-delete"></i>{{_i('Delete')}}
                                    </a>
                                </div>
                                <br> <br>
                            @endforeach

                        </div>

                    </div>
                @else
                    <div class="form-group row">
                        <label class="col-xs-5 col-form-label text-md-right">{{ _i("Attachments")}} :</label>
                        <div class="col-xs-5"></div>
                        <div class="col-xs-6">
                            <label class="col-xs-10 col-form-label text-md-right">{{ _i("No Attachments")}}</label>
                        </div>

                    </div>
                @endif

        </div>

        <!-- /.box-body -->
        <div class="box-footer">

            <button type="submit" class="btn btn-info "> {{ _i(' Save') }}</button>
        </div>


    </form>
                <br />


            </div>

        </div>
    </div>


@endsection






@push('js')

<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        showImage();
    });
    function showImage() {
        $.getJSON(
                '{{route("course_getAttachment")}}?id={{$course->id}}'
                ).done((data) => {
            $('#attachment_img').attr('href', data[0]);
            $('#course_img').attr('src', data[0]).width(250).height(250);

        });
    }

</script>

<script type="text/javascript">
    function Add() {
        $("#files").append('<div ><input name="files[]" type="file" style="display: inline" class="btn btn-default" /><button type="button" class="btn btn-danger btn-sm" name="delete" onclick="Delete(this)" title="Delete file"><?= _i("delete file") ?></button></div>');
    }

    function Delete(obj) {

        $(obj).closest('div').remove();
    }
    function delete_attach(e,url){
        $(e).closest('div').remove();
        console.log(e);
        $.ajax(
                {
                    url:`{{route('course.attach.destroy')}}?id={{$course->id}}&url=${url}`
    }
    ).done(function(data){
        console.log(data);
    })
    }
</script>


@endpush
