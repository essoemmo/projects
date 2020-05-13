@extends('admin.layout.layout')
@section('title')
    {{_i('Add Media')}}
@endsection

@section('header')

@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Course Media')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/course/all')}}"> {{_i('All Courses')}}</a></li>
            <li class="active"><a href="{{url('/admin/course/create')}}"> {{_i('Add Course')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> {{_i('Course Information')}} </h3>
            <div>
                <label class="col-xs-2 control-label">{{$course->title}}</label>

                <label class="col-xs-1 control-label">{{_i('Start :')}}</label>
                <label class="col-xs-2 control-label">{{$course->start_date}}</label>

                <label class="col-xs-1 control-label">{{_i('End :')}}</label>
                <label class="col-xs-3 control-label">{{$course->end_date}}</label>

                <label class="col-xs-1 control-label">{{_i('Duration')}}</label>
                <label class="col-xs-2 control-label">{{$course->duration}}</label>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form method="POST" action="{{ url('/admin/course/video/'.$video->id.'/update') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">

            @csrf
            <div class="form-group"> </div>

            <!-- ============================================= cost ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-2 col-form-label" >{{ _i(' Cost :') }} $</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{$video->cost}}" placeholder=" Cost" required="">

                    @if ($errors->has('cost'))
                        <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= currency ============================= -->
            <input type="hidden" name="currency_id" value="<?=$video->currency_id?>"/>
          

        <!-- ============================================= Is Active ============================= -->
            <div class="form-group ">

                <label for="gender" class="col-xs-2  col-form-label">{{_i('Status')}}</label>

                <div class="col-xs-6">

                    <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="1"{{$video->is_active==1 ? 'checked' :''}} >
                    <label  class="form-check-label" for="type"> {{_i('Active')}} </label>

                    <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="0"{{$video->is_active==0 ? 'checked' :''}}>
                    <label  class="form-check-label" for="ype"> {{_i('Not Active')}} </label>

                </div>

            </div>

        <!-- ================================== video image =================================== -->
            <div class="form-group">
                <label class="col-xs-2 col-form-label" for="logo">{{_i('Video Image')}}</label>
                <div class="col-xs-6">
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
            <div class="form-group ">

                <label for="file" class="col-xs-2 col-form-label">{{_i('Video')}}</label>

{{--                <div class="col-xs-5">--}}
{{--                    <input type="file" name="file" id="fileUploader" style="display: inline" class=" btn btn-default" >--}}
{{--                </div>--}}

                <div class="col-xs-5">
                    <div class="content">
                        <div class="dropzone options" id="dropzonefield2" style="border: 1px solid #452A6F;margin: 10px"></div>
                        <button class="btn btn-tiffany mt-4 ml-4 mb-4" onclick="uploadFiles2()" style="cursor: pointer" type="button"> {{_i('Save Videos')}} </button>
                        <div class="text-center">
                            {{--                <button type="submit" name="submitButton" value="tests" class="btn btn-primary waves-effect waves-light m-r-20 m-t-20">{{ _i('Save') }}</button>--}}
{{--                            <a href="javascript:void(0)" id="edit-cancel-btn-video" class="btn btn-default waves-effect mb-4">{{ _i('Cancel') }}</a>--}}
                        </div>
                    </div>
                </div>

            </div>


            <div class="row" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 20px; margin: 1.3rem !important; display: block;">

                <div class="form-group row" >
                    <a href="#tab_1" class=" active" data-toggle="tab" >
                        <button type="button" class="btn  btn-default col-xs-2 " >{{_i('EN')}}</button>
                    </a>
                    <a href="#tab_2"  data-toggle="tab">
                        <button type="button" class="btn  btn-default col-xs-2 ">{{_i('AR')}}</button>
                    </a>

                </div>

                <div class="tab-content">
                    <!--- ========================================  english section course media tags  =========================================== ----->
                    <div class="tab-pane active" id="tab_1">
                        <!-- ============================================= Title ============================= -->
                        <div class="form-group">
                            <label for="name" class="col-xs-2 control-label"> {{ _i('Title') }} <span style="color: #ff3960;">*</span></label>

                            <div class="col-xs-5">
                                <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" value="{{$course_data_en['title']}}" placeholder="English Title" required="">
                                @if ($errors->has('title_en'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ============================================= description ============================= -->
                        <div class="form-group">

                            <label for="name" class="col-xs-2 control-label"> {{ _i('Description') }} </label>
                            <div class="col-xs-8">
                                <textarea id="editor1" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description_en"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          placeholder="Place some text here">{{$course_data_en['description']}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag english files =======================================-->

                        <div class="form-group " >
                            <label style="background-color: #c2c2c2;" for="name" class="col-xs-4 control-label"> {{ _i('Tag') }} </label>
                            <span class="col-xs-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-xs-4 control-label">  {{ _i('Sound') }} </label>
                        </div>


                        @if(!empty($course_tags_en))
                        @foreach($course_tags_en as $item)
                            <div class="form-group "  style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px 5px 0px 20px; margin-left: 1.3rem; !important; display: block; ">
                                <div class="col-xs-5" >
                                    <label type="text" class="form-control" > {{$item->tag}} </label>
                                </div>

                                <div class="col-xs-5">
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


                        <div class="form-group ">
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="tag_en[]" placeholder="English Title">
                            </div>

                            <div class="col-xs-6">
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
                                <input type="text" class="form-control{{ $errors->has('title_ar') ? ' is-invalid' : '' }}" name="title_ar" value="{{$course_data_ar['title']}}" placeholder="{{_i('Arabic Title')}}" required="">
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
                                          placeholder="{{_i('Place some text here')}}">{{$course_data_ar['description']}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag arabic files =======================================-->

                        <div class="form-group " >
                            <label style="background-color: #c2c2c2;" for="name" class="col-xs-4 control-label">{{_i('Tag')}}</label>
                            <span class="col-xs-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-xs-4 control-label">{{_i('Sound')}}</label>
                        </div>


                        @if(!empty($course_tags_ar))
                        @foreach($course_tags_ar as $item)
                        <div class="form-group " style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px 5px 0px 20px; margin-left: 1.3rem; !important; display: block; ">
                            <div class="col-xs-5">
                                <label type="text" class="form-control" > {{$item->tag}} </label>
                            </div>

                            <div class="col-xs-5" >

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

                        <div class="form-group ">
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="tag_ar[]" placeholder="{{_i('Arabic Title')}}" >
                            </div>

                            <div class="col-xs-6">
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

@endsection

@push('js')

    <script>
        Dropzone.autoDiscover = false;

        function uploadFiles2(){
            drop[0].dropzone.processQueue();
        };

        var drop;
        drop = $('#dropzonefield2').dropzone({
            url: "{{url('admin/course/video/upload/'.$video->id)}}", // $video->id => mediaID
            paramName:'file' ,
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
                        data:{file:file.name,_token:'{{csrf_token()}}' ,mediaId:'{{$video->id}}'},
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



        @if( is_file(public_path('uploads/course/course_videos/'.$course->id.'/'.$video->file)))
            var file = { id: '{{$video->id}}', name: '{{$video->file}}', type: "video/*"};
            var url = '{{asset('uploads/course/course_videos/'.$course->id.'/'.$video->file)}}';
            drop[0].dropzone.emit("addedfile", file);
            drop[0].dropzone.emit("thumbnail", file, url);
            drop[0].dropzone.emit("complete", file);
        @endif

    </script>


    <script type="text/javascript">

        function deleteTagFile(e,tag_id){
           $(e).parent().parent().remove();
            console.log(tag_id);
            //console.log(`{{route('tag.destroy')}}?id=${tag_id}`);
            $.ajax(
                {
                    url:`{{route('tag.destroy')}}?id=${tag_id}`
                }
            )
        }

        function Add()
        {
            $("#files").append('<div class="form-group " id="fileUploader" >  <div class="col-xs-5">  <input type="text" class="form-control" name="tag_en[]" placeholder="English Title" required="">' +
                ' </div>  <div class="col-xs-5">  <input type="file" name="tag_en_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*" >'+
                '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="Delete(this)" title="Delete file"> <?=_i("delete row")?> </button> </div> </div>'
            );
        }

        function Delete(obj)
        {
            $(obj).closest('#fileUploader').remove();
        }

        function AddTagAr()
        {
            $("#tag_ar_files").append('<div class="form-group " id="fileUploaderAr" >  <div class="col-xs-5">  <input type="text" class="form-control" name="tag_ar[]" placeholder="{{_i('Arabic Title')}}" required="">' +
                ' </div>  <div class="col-xs-5">  <input type="file" name="tag_ar_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*">'+
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
