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
                    {{--<h3 class="box-title"> Course Form</h3>--}}
                </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> {{_i('Course Information')}} </h3>
            <div>
                <label class="col-md-2 control-label">{{$course->title}}</label>

                <label class="col-md-1 control-label">{{_i('Start :')}}</label>
                <label class="col-md-2 control-label">{{$course->start_date}}</label>

                <label class="col-md-1 control-label">{{_i('End :')}}</label>
                <label class="col-md-3 control-label">{{$course->end_date}}</label>

                <label class="col-md-1 control-label">{{_i('Duration')}}</label>
                <label class="col-md-2 control-label">{{$course->duration}}</label>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form method="POST" action="{{ url('/user/course/video/'.$video->id.'/update') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">

            @csrf
            <div class="form-group"> </div>

            <!-- ============================================= cost ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label" >{{ _i(' Cost :') }}</label>

                <div class="col-md-10">
                    <input type="text" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{$video->cost}}" placeholder=" Cost" required="">

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
                    <select class="form-control{{ $errors->has('currency_id') ? ' is-invalid' : '' }}" name="currency_id">

                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}" {{ $currency->id == $video->currency_id ? 'selected' : ''}} > {{$currency->title}}</option>

                        @endforeach

                        @if ($errors->has('currency_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('currency_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>


        <!-- ================================== video image =================================== -->
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="logo">{{_i('Video Image')}}</label>
                <div class="col-md-10">
                    <input type="file" name="img" id="img" onchange="apperImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png,image/jpg"
                           value="{{old('img')}}" >
                    <span class="text-danger invalid-feedback">
                           <strong>{{$errors->first('img')}}</strong>
                    </span>
                </div>
                <!-- img -->
                <img  src="{{ asset('uploads/course/course_videos/'.$course->id.'/'.$video->img) }}" class="img-thumbnail" id="video_img" hidden style="margin-top: -150px; width: 300px; height: 250px;" >
            </div>


            <!--========================================== upload video =======================================-->
            <div class="form-group row">

                <label for="file" class="col-md-2 control-label">{{_i('Video')}}</label>

                <div class="col-md-10">
                    <input type="file" name="file" id="fileUploader" style="display: inline" class=" btn btn-default" >
                </div>

            </div>


            <div class="row" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 20px; margin: 1.3rem !important; display: block;">

{{--                <div class="form-group row" >--}}
{{--                    <a href="#tab_1" class=" active" data-toggle="tab" >--}}
{{--                        <button type="button" class="btn  btn-default col-xs-2 " >{{_i('EN')}}</button>--}}
{{--                    </a>--}}
{{--                    <a href="#tab_2"  data-toggle="tab">--}}
{{--                        <button type="button" class="btn  btn-default col-xs-2 ">{{_i('AR')}}</button>--}}
{{--                    </a>--}}

{{--                </div>--}}


                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1"  data-toggle="tab" >
                                <button type="button" class="btn  btn-blue btn-lg " >{{_i('EN')}}</button>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2"  data-toggle="tab" >
                                <button type="button" class="btn  btn-blue btn-lg " >{{_i('AR')}}</button>
                            </a>
                        </li>

                    </ul>
                </div>


                <div class="tab-content">
                    <!--- ========================================  english section course media tags  =========================================== ----->
                    <div class="tab-pane active" id="tab_1">
                        <!-- ============================================= Title ============================= -->
                        <div class="form-group row">
                            <label for="name" class="col-md-2 control-label"> Title <span style="color: #ff3960;">*</span></label>

                            <div class="col-md-10">
                                <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" value="{{$course_data_en->title}}" placeholder="English Title" required="">
                                @if ($errors->has('title_en'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ============================================= description ============================= -->
                        <div class="form-group row">

                            <label for="name" class="col-md-2 control-label"> Description </label>
                            <div class="col-md-10">
                                <textarea id="editor1" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description_en"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          placeholder="Place some text here">{{$course_data_en->description}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag english files =======================================-->

                        <div class="form-group row" >
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label"> Tag </label>
                            <span class="col-xs-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label">  Sound </label>
                        </div>


                        @if(!empty($course_tags_en))
                        @foreach($course_tags_en as $item)
                            <div class="form-group row "  style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px 5px 0px 20px; margin-left: 1.3rem; !important; display: block; ">
                                <div class="col-md-5" >
                                    <label type="text" class="form-control" > {{$item->tag}} </label>
                                </div>

                                <div class="col-md-5">
{{--                                    <a type="button" href="{{asset('uploads/course_media_tags/'.$video->id.'/en/'.$item->url)}}" class="btn btn-primary pull-right" style="margin-left: 5px;">--}}
{{--                                        <i class="fa fa-download"></i> {{$item->url}}--}}
{{--                                    </a>--}}
{{--                                    <a type="button" onclick="deleteTagFile(this,'{{$item->id}}')" class="btn btn-danger pull-right" title='{{_i("delete English Sound file")}}' style="margin-right: 5px;">--}}
{{--                                        <i class="fa fa-trash"></i> {{_i("delete")}}--}}
{{--                                    </a>--}}

                                    <audio controls style=" margin-top: -7px;">
                                        <span> {{$item->url}} </span>
                                        <source src="{{asset('uploads/course_media_tags/'.$video->id.'/en/'.$item->url)}}" type="audio/ogg">
                                    </audio>
                                    <a type="button" onclick="deleteTagFile(this,'{{$item->id}}')" class="btn btn-danger pull-left" title='{{_i("delete English Sound file")}}' style="margin-right: 5px;">
                                        <i class="fa fa-trash"></i> {{_i("delete")}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @endif


                        <div class="form-group row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="tag_en[]" placeholder="English Title">
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="tag_en_files[]" id="fileUploader" style="display: inline" class=" btn btn-default" accept="audio/*" >
                                <button class="btn btn-success btn-sm" type="button" id="add" title='{{_i("Add English Sound files")}}' onclick="Add()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add new sound file")}}</button>
                            </div>
                        </div>

                        <div  id="files" >

                        </div>
                    </div>

                    <!--- ========================================  arabic section course media tags  =========================================== ----->
                    <div class="tab-pane " id="tab_2">
                        <!-- ============================================= Title ============================= -->
                        <div class="form-group">
                            <label for="name" class="col-xs-2 control-label">{{ _i('Title') }}<span style="color: #ff3960;">*</span></label>

                            <div class="col-xs-5">
                                <input type="text" class="form-control{{ $errors->has('title_ar') ? ' is-invalid' : '' }}" name="title_ar" value="{{$course_data_ar->title}}" placeholder="{{_i('Arabic Title')}}" required="">
                                @if ($errors->has('title_ar'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ============================================= description ============================= -->
                        <div class="form-group">

                            <label for="name" class="col-xs-2 control-label">{{_i('Description')}}</label>
                            <div class="col-xs-8">
                                <textarea id="editor2" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description_ar"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          placeholder="{{_i('Place some text here')}}">{{$course_data_ar->description}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag arabic files =======================================-->

                        <div class="form-group row" >
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label">{{_i('Tag')}}</label>
                            <span class="col-md-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label">{{_i('Sound')}}</label>
                        </div>


                        @if(!empty($course_tags_ar))
                        @foreach($course_tags_ar as $item)
                        <div class="form-group row " style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px 5px 0px 20px; margin-left: 1.3rem; !important; display: block; ">
                            <div class="col-md-5">
                                <label type="text" class="form-control" > {{$item->tag}} </label>
                            </div>

                            <div class="col-md-5" >

{{--                                <a type="button" href="{{asset('uploads/course_media_tags/'.$video->id.'/ar/'.$item->url)}}" class="btn btn-primary pull-right" style="margin-left: 5px;">--}}
{{--                                    <i class="fa fa-download"></i> {{$item->url}}--}}
{{--                                </a>--}}
{{--                                <a type="button" onclick="deleteTagFile(this,'{{$item->id}}')" class="btn btn-danger pull-right" title='{{_i("delete Arabic Sound file")}}' style="margin-right: 5px;">--}}
{{--                                    <i class="fa fa-trash"></i> {{_i("delete")}}--}}
{{--                                </a>--}}
                                <!--style=" margin-top: -10px;" -->
                                <audio controls style=" margin-top: -7px;">
                                    <span> {{$item->url}} </span>
                                    <source src="{{asset('uploads/course_media_tags/'.$video->id.'/ar/'.$item->url)}}" type="audio/ogg">
                                </audio>

                                <a type="button" onclick="deleteTagFile(this,'{{$item->id}}')" class="btn btn-danger pull-left" title='{{_i("delete Arabic Sound file")}}' style="margin-right: 5px;">
                                    <i class="fa fa-trash"></i> {{_i("delete")}}
                                </a>

                            </div>
                        </div>
                        @endforeach
                        @endif

                        <div class="form-group row ">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="tag_ar[]" placeholder="{{_i('Arabic Title')}}" >
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="tag_ar_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*" >
                                <button class="btn btn-success btn-sm" type="button"  title='{{_i("Add Arabic Sound files")}}' onclick="AddTagAr()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add new sound file")}}</button>
                            </div>
                        </div>

                        <div  id="tag_ar_files" >

                        </div>

                    </div>
                </div>


            </div>

<br />
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-left "> {{ _i('Save') }}</button>
            </div>
            <!-- /.box-footer -->


        </form>


            <br />
            <div class="container">

                <div class="col-sm-6" >
                    <div class="video "  >
                        <video  controls >
                            <source src="{{asset('uploads/course/course_videos/'.$course->id.'/'.$video->file)}}" >
                        </video>

                        <div class="text-center">
                            <a  href="https://www.bigbuckbunny.org/" target="_blank"> {{$video->title}} </a>
                        </div>

                    </div>
                </div>

            </div>

    </div>
    </div>

            </div>

        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">

        function deleteTagFile(e,tag_id){
           $(e).parent().parent().remove();
            //console.log(tag_id);
            //console.log(`{{route('tag.destroy')}}?id=${tag_id}`);
            $.ajax(
                {
                    url:`{{route('teacherTag.destroy')}}?id=${tag_id}`
                }
            )
        }

        function Add()
        {
            $("#files").append('<div class="form-group row " id="fileUploader" >  <div class="col-md-5">  <input type="text" class="form-control" name="tag_en[]" placeholder="English Title" required="">' +
                ' </div>  <div class="col-md-5">  <input type="file" name="tag_en_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*" >'+
                '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="Delete(this)" title="Delete file"> <?=_i("delete row")?> </button> </div> </div>'
            );
        }

        function Delete(obj)
        {
            $(obj).closest('#fileUploader').remove();
        }

        function AddTagAr()
        {
            $("#tag_ar_files").append('<div class="form-group row" id="fileUploaderAr" >  <div class="col-md-5">  <input type="text" class="form-control" name="tag_ar[]" placeholder="{{_i('Arabic Title')}}" required="">' +
                ' </div>  <div class="col-md-5">  <input type="file" name="tag_ar_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*">'+
                '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="DeleteTagAr(this)" title="Delete file"> <?=_i("delete row")?> </button> </div> </div>'
            );
        }

        function DeleteTagAr(obj)
        {
            $(obj).closest('#fileUploaderAr').remove();
        }

    </script>

    <script>
        $("#msg_video").css("display", "none");


        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor2');
            //bootstrap WYSIHTML5 - text editor
           // $('.textarea').wysihtml5()
        });

        $(function() {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            //$('.textarea').wysihtml5();
        });

    </script>


    <script>
        var figure = $(".video").hover( hoverVideo, hideVideo );

        function hoverVideo(e) {
            $('video', this).get(0).play();
        }

        function hideVideo(e) {
            $('video', this).get(0).pause();
        }
    </script>

    <script>
        function apperImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#video_img").attr('src', e.target.result).width(300).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }
    </script>


@endpush
