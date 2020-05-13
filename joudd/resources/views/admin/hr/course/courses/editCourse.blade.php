@extends('admin.layout.layout')
@section('title')
{{_i('Edit Course')}}
@endsection

@section('page_header')
<section class="content-header">
    <h1>
        {{_i('Course')}}

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
        <li ><a href="{{url('/admin/course/all')}}"> {{_i('Courses')}} </a></li>
        <li ><a href="{{url('/admin/course/create')}}"> {{_i('Add Course')}}</a></li>
        <li class="active"><a href="{{url('/admin/course/create')}}"> {{_i('Edit Course')}} {{$course->title}}</a></li>
    </ol>
</section>

@endsection

@section('content')


<div class="box box-info">
    <div class="box-header with-border" style="margin-bottom: 2%;">

    </div>
    <!-- /.box-heade    r -->


    <form method="POST" action="{{ url('/admin/course/'.$course->id.'/edit') }}" class="form-horizontal" enctype="multipart/form-data" id="demo-form" data-parsley-valid        ate="">
        @csrf

        <div class="box-body">
            <!-- ============================================= Title ===========================            == -->

            <div class="form-group">
                <label for="name" class="col-xs-2 control-label">{{ _i('Course Name') }}</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$course->title}}"  placeholder=" Title" required="" />

                    @if ($errors->has('title'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <!-- ============================================= sart date ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label"> {{_i(' Start Date :')}} </label>

                <div class="col-xs-5">
                    <input type="date" name="start_date" class="form-control" value="{{$course->start_date}}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('start_date'))
                    <strong>{{$errors->first('start_date')}}</strong>
                    @endif
                </div>
            </div>

            <!--========================================== end Date =======================================-->
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label"> {{_i(' End Date :')}} </label>

                <div class="col-xs-5">
                    <input type="date" name="end_date" class="form-control" value="{{$course->end_date}}" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('end_date'))
                    <strong>{{$errors->first('end_date')}}</strong>
                    @endif
                </div>
            </div>

            <!-- ============================================= duration ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label" >{{ _i(' Duration :') }}</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{$course->duration}}" placeholder=" Duration" required="">

                    @if ($errors->has('duration'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= cost ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-2 control-label" >{{ _i(' Cost :') }}</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{$course->cost}}" placeholder=" Cost" required="">

                    @if ($errors->has('cost'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-2 control-label" for="language_addform">
                    {{_i('Language')}} </label>
                <div class="col-xs-5">
                    <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                        <option disabled selected> {{_i('Choose')}}</option>
                        @foreach($langs as $language)
                            <option value="{{$language->id}}" {{$course->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                        @endforeach

                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lang_id') }}</strong>
                            </span>
                        @endif
                    </select>
                </div>
            </div>

            <!-- ================================== country =================================== -->
            <div class="form-group " >
                <label class="col-xs-2 col-form-label " for="get_country">
                    {{_i('Country')}} </label>
                <div class="col-xs-5">
                    <select multiple required="" id="get_country" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="country_id[]" >
                        <option disabled> {{_i('Choose')}}</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" @foreach($course_country as $item) {{$item->country_id == $country->id ? 'selected' : '' }} @endforeach> {{_i($country->title)}} </option>
                        @endforeach

                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= currency ============================= -->

            <div class="form-group row">

                <label for="name" class="col-xs-4 col-form-label">{{ _i(' Currency') }}</label>

                <div class="col-xs-5">
                    <?php

                    ?>
                    {{$currencies->title}}
                    <input type="hidden" name="currency_id" readonly="" value="{{$currencies->id}}" />

                </div>
            </div>

            <!-- ============================================= Course Category ============================= -->

            <div class="form-group " >
                <label class="col-xs-2 col-form-label " for="get_category">
                    {{_i('Category')}} </label>
                <div class="col-xs-5">
                    <select required="" id="get_category" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="category_id" >

                        <option disabled> {{_i('Choose')}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @foreach($course_category as $item) {{$item->co_category_id == $category->id ? 'selected' : '' }} @endforeach> {{_i($category->cat_name)}} </option>
                        @endforeach

                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= Is Active ============================= -->
            @if(auth()->user()->can('CourseRequest-Controll'))
                <div class="form-group row">

                    <label for="gender" class="col-xs-2 control-label">{{_i('Status')}}</label>

                    <div class="col-xs-6">

                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="1"{{$course->is_active==1 ? 'checked' :''}} >
                        <label  class="form-check-label" for="type"> {{_i('Active')}} </label>

                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="0"{{$course->is_active==0 ? 'checked' :''}}>
                        <label  class="form-check-label" for="ype"> {{_i('Not Active')}} </label>

                    </div>
                    @if ($errors->has('is_active'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('is_active') }}</strong>
                    </span>
                    @endif

                </div>
            @endif

            <!-- ================================== Attachments =================================== -->
            <div class="form-group">
                <label class="col-xs-2 control-label">{{_i('Upload photo')}}</label>
                <div class="col-xs-5">
                    <input type="file" name="file" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                    <strong>{{$errors->first('file')}}</strong>
                </div>
                <div class="col-xs-3">   <!-- Photo -->
                    <img alt="{{ $course->title }}" class="" id="" src="{{ asset('uploads/courses/' . $course->id . '/' . $course->img) }}"  style="margin-top: -250px">
                    <!--<img alt="{{ $course->title }}" class="" id="course_img" src="{{ URL::to('/uploads/courses/' . $course->id . '/' . $course->img) }}"  style="margin-top: -250px">-->
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-2 control-label">{{_i('Upload Video')}}</label>
{{--                <div class="col-xs-5">--}}
{{--                    <input type="file" name="video" id="filev" class="btn btn-default">--}}
{{--                    <strong>{{$errors->first('file')}}</strong>--}}
{{--                </div>--}}

                <div class="col-xs-5">
                    <div class="content">
                        <div class="dropzone options" id="dropzonefield2" style="border: 1px solid #452A6F;margin: 10px"></div>
{{--                        <button class="btn btn-tiffany mt-4 ml-4 mb-4" onclick="uploadFiles2()" style="cursor: pointer" type="button"> {{_i('Save Videos')}} </button>--}}
                        <div class="text-center">
                        </div>
                    </div>
                </div>
            </div>

            <!--========================================== Description =======================================-->

            <div class="form-group">
                <label for="name" class="col-xs-2 control-label" >{{ _i('Description') }}</label>

                <div class="col-xs-10">


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

                <label for="name" class="col-xs-2 control-label">{{_i('Add Media files')}}</label>

                <div class="col-xs-5">
                    <input type="file" name="files[]" id="fileUploader" style="display: inline" class=" btn btn-default" >
                </div>

                <div class="col-xs-5">
                    <button class="btn btn-success btn-sm" type="button" id="add" title='{{_i("Add new file")}}' onclick="Add()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add New Media File")}}</button>
                </div>

                <div class="col-xs-4"></div>
                <div class="col-xs-8">
                    <div id="files" class="files"></div>
                </div>

            </div>

{{--            @dd($course->getMediaAttachments())--}}
            <!--========================================== Attachments=======================================-->
<!--            @if(count($urls = $course->getMediaAttachments())>0)
{{--                @dd($course)--}}
                <div class="form-group">
                    <label for="title" class="col-xs-4 control-label">{{ _i("Course Attachments") }}</label>
                    <div class="col-xs-8">
                        @foreach ($urls as $url)
{{--                            @dd($url)--}}
                            <div class="col-xs-8">
                                <a type="button" href="{{$url}}" class="btn btn-primary pull-right" style="margin-right: 5px;">
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
            @endif-->

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

        </div>

        <!-- /.box-body -->
        <div class="box-footer">

            <button type="submit" class="btn btn-info "> {{ _i(' Save') }}</button>
        </div>


    </form>

</div>

@endsection

@section('footer')

<script>
    $(function () {
        CKEDITOR.replace('editor1',{
            height: 250,
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('admin/bower_components/ckeditor/ck_upload.php')}}",
        });

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


@endsection

@push('js')

    <script>
        Dropzone.autoDiscover = false;

        function uploadFiles2(){
            drop[0].dropzone.processQueue();
        };

        var drop;
        drop = $('#dropzonefield2').dropzone({
            url: "{{url('admin/course/video/upload/'.$course->id)}}", // $video->id => mediaID
            paramName:'videoCourse' ,
            uploadMultiple:false ,
            maxFiles:1,
            maxFilesize:15,
            dictDefaultMessage:"{{_i('Click here to upload files or drag and drop files here')}}",
            dictRemoveFile:"{{ _i('Delete') }}",
            acceptedFiles:'video/*',
            autoProcessQueue: true,
            removeType: "server",
            params:{
                _token: '{{csrf_token()}}' ,
            },
            addRemoveLinks:true,
            removedfile: function (file) {
                if(drop[0].dropzone.options.removeType == "server") {
                    $.ajax({
                        dataType:'json',
                        type:'POST',
                        url:'{{url('admin/course/video/delete')}}',
                        data:{file:file.name,_token:'{{csrf_token()}}',courseId:'{{$course->id}}' },
                    });
                    var fmock;
                    return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                }else{
                    file.previewElement.remove();
                }
            },
            success:function (file,response) {
                file.id = response.id;
            },

        });

        @if( is_file(public_path('uploads/courses/'.$course->id.'/'.$course->video)))
            var file = { id: '{{$course->id}}', name: '{{$course->video}}', type: "video/*"};
            var url = '{{asset('uploads/courses/'.$course->id.'/'.$course->video)}}';
            drop[0].dropzone.emit("addedfile", file);
            drop[0].dropzone.emit("thumbnail", file, url);
            drop[0].dropzone.emit("complete", file);
        @endif

    </script>


    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/country/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_country").empty();
                            $("#get_country").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_country").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_country").empty();
                        }
                    }
                });
            }else{
                $("#get_country").empty();
            }
        });

    </script>
    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/currency/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_currency").empty();
                            $("#get_currency").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_currency").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_currency").empty();
                        }
                    }
                });
            }else{
                $("#get_currency").empty();
            }
        });

    </script>
    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/course/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_category").empty();
                            $("#get_category").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_category").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_category").empty();
                        }
                    }
                });
            }else{
                $("#get_category").empty();
            }
        });

    </script>

@endpush

