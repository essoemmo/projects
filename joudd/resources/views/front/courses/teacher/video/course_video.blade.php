@extends('front.layout.app')

@section('content')


    <div class="flash-message text-center">
        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-info" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>


<div class="flash-message" id="msg_video" style="display: none;">
    <p class="alert alert-success"><strong>Successfully !</strong> video deleted.</p>
</div>

    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">
            <div class="box box-info">
                <div class="box-header with-border">
                    {{--<h3 class="box-title"> Course Form</h3>--}}
                </div>
                <!-- /.box-header -->

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"> {{_i('Course Information')}} </h3>
        <div>
            <label class="col-md-1 control-label">{{_i('Title :')}}</label>
            <label class="col-md-2 control-label">{{$course->title}}</label>

            <label class="col-md-1 control-label">{{_i('Start :')}}</label>
            <label class="col-md-2 control-label">{{$course->start_date}}</label>

            <label class="col-md-1 control-label">{{_i('End :')}}</label>
            <label class="col-md-2 control-label">{{$course->end_date}}</label>

            <label class="col-md-1 control-label">{{_i('Duration:')}}</label>
            <label class="col-md-1 control-label">{{$course->duration}}</label>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        @foreach ($errors->all() as $error)

        <div class="text-danger"> {{ $error }}</div>

        @endforeach
        <form method="POST" action="{{ url('/user/course/'.$course->id.'/video') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">

            @csrf
            <div class="form-group"> </div>
            <!-- ============================================= cost ============================= -->
            <div class="form-group row">
                <label for="name" class="col-md-2 control-label">{{ _i(' Cost') }} <span style="color: #ff3960;">*</span></label>
                <div class="col-md-10">
                    <input type="number" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{old('cost')}}" placeholder=" Cost" required="">
                    @if ($errors->has('cost'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <!-- ============================================= currency ============================= -->
            <div class="form-group row">

                <label for="name" class="col-md-2 control-label">{{ _i(' Currency') }}<span style="color: #ff3960;">*</span></label>

                <div class="col-md-10">
                    <select class="form-control{{ $errors->has('currency_id') ? ' is-invalid' : '' }}" name="currency_id" required="">
                        <option disabled selected>{{_i('Choose')}}</option>
                        @foreach($currencies as $currency)
                        <option value="{{$currency->id}}"> {{$currency->title}}</option>
                        @endforeach
                        @if ($errors->has('currency_id'))
                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('currency_id') }}</strong>
                        </span>
                        @endif
                    </select>
                </div>
            </div>


            <!-- ============================================= Is Active ============================= -->
{{--            <div class="form-group ">--}}

{{--                <label for="gender" class="col-xs-2 control-label">{{_i('Status')}}</label>--}}

{{--                <div class="col-xs-5">--}}
{{--                    <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="1">--}}
{{--                    <label class="form-check-label" for="optionsRadios1"> {{_i('Active')}} </label>--}}

{{--                    <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios2" value="0">--}}
{{--                    <label class="form-check-label" for="optionsRadios2"> {{_i('Not Active')}} </label>--}}

{{--                </div>--}}
{{--            </div>--}}
            <!-- ================================== video image =================================== -->
            <div class="form-group row">
                <label class="col-md-2 col-form-label" for="logo">{{_i('Video Image')}}<span style="color: #ff3960;">*</span></label>
                <div class="col-md-1-">
                    <input type="file" name="img" id="img" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png,image/jpg"
                           value="{{old('img')}}" required="">
                    <span class="text-danger invalid-feedback">
                        <strong>{{$errors->first('img')}}</strong>
                    </span>
                </div>
                <!-- img -->
                <img class="img-thumbnail" id="video_img" hidden style="margin-top: -150px; width: 300px; height: 250px;">
            </div>

            <!--========================================== upload video =======================================-->
            <div class="form-group row">
                <label for="file" class="col-md-2 control-label">{{_i('Video')}}<span style="color: #ff3960;">*</span></label>

                <div class="col-md-10">
                    <input type="file" name="file" id="fileUploader" style="display: inline" class=" btn btn-default" required="">
                </div>
            </div>

            {{--                <br />--}}
            <div class="row" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 20px; margin: 1.3rem !important; display: block;">

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
                        <br />
                        <div class="form-group row">
                            <label for="name" class="col-md-2 control-label"> Title <span style="color: #ff3960;">*</span></label>

                            <div class="col-md-10">
                                <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" value="{{old('title_en')}}" placeholder="English Title" >
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
                                          placeholder="Place some text here">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag english files =======================================-->

                        <div class="form-group row " >
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label"> Tag </label>
                            <span class="col-md-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label"> Sound </label>
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="tag_en[]" placeholder="English Title" >
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="tag_en_files[]" id="fileUploader" style="display: inline" class=" btn btn-default" accept="audio/*">
                                <button class="btn btn-success btn-sm" type="button" id="add" title="Add English Sound files" onclick="Add()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add new sound file")}}</button>
                            </div>
                        </div>

                        <div  id="files" >

                        </div>
                    </div>

                    <!--- ========================================  arabic section course media tags  =========================================== ----->
                    <div class="tab-pane " id="tab_2">
                        <br />
                        <!-- ============================================= Title ============================= -->
                        <div class="form-group row">
                            <label for="name" class="col-md-2 control-label">{{ _i('Title') }}<span style="color: #ff3960;">*</span></label>

                            <div class="col-md-10">
                                <input type="text" class="form-control{{ $errors->has('title_ar') ? ' is-invalid' : '' }}" name="title_ar" value="{{old('title_ar')}}" placeholder="{{_i('Arabic Title')}}" required="">
                                @if ($errors->has('title_ar'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title_ar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- ============================================= description ============================= -->
                        <div class="form-group row">

                            <label for="name" class="col-md-2 control-label">{{_i('Description')}}</label>
                            <div class="col-md-10">
                                <textarea id="editor2" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description_ar"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          placeholder="{{_i('Place some text here')}}">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!--========================================== upload tag arabic files =======================================-->

                        <div class="form-group row " >
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label">{{_i('Tag')}}</label>
                            <span class="col-md-1"></span>
                            <label style="background-color: #c2c2c2;" for="name" class="col-md-4 control-label">{{_i('Sound')}}</label>
                        </div>

                        <div class="form-group row">
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

            <!--========================================== upload video =======================================-->
            {{--                <div class="form-group footer">--}}

            {{--                    <label for="file" class="col-xs-2 control-label">{{_i('Video')}}<span style="color: #ff3960;">*</span></label>--}}

            {{--                    <div class="col-xs-5">--}}
            {{--                        <input type="file" name="file" id="fileUploader" style="display: inline" class=" btn btn-default" required="">--}}
            {{--                    </div>--}}
            {{--                    <button type="submit" class="btn btn-info "> {{ _i('Save') }}</button>--}}
            {{--                </div>--}}
{{--            <br />--}}

            <!-- /.box-body -->
            <div class="box-footer ">
                <button type="submit" class="btn btn-info pull-left "> {{ _i('Save') }}</button>
            </div>
            <!-- /.box-footer -->
            <br />
            <br />
        </form>


    </div>

</div>

{{--                @if(count($course_videos) > 0)--}}

{{--                    <br />--}}

{{--                    <div class="container">--}}
{{--                        <div class="box-body">--}}
{{--                            <div  class="dataTables_wrapper form-inline dt-bootstrap">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}" >--}}
{{--                                        <table id="video_table" class="text-center" role="grid" aria-describedby="example1_info">--}}
{{--                                            <thead>--}}
{{--                                            <tr role="row">--}}
{{--                                                <th class="sorting text-center"  >{{_i('video no')}} </th>--}}
{{--                                                <th class="sorting text-center"  > {{_i('video')}} </th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            --}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                @endif--}}



            </div>

        </div>
    </div>


    @if(count($course_videos) > 0)
    <div class="single-course-page after-enroll-page pt-5">
        <div class="container">
            <div class="box box-info">

                <div class="box-body">

                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-md-12">

                                <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}" >
                                <table id="video_table" class="table table-bordered table-striped dataTable text-center" role="grid">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting text-center"  >{{_i('video no')}} </th>
                                        <th class="sorting text-center"  > {{_i('video')}} </th>
                                    </tr>
                                    </thead>

                                </table>


                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    @endif



@endsection

@section('script')

    <script  type="text/javascript">

        var table;
        $(function() {
            $.noConflict();
            var course_id = $("#course_id").val();
            console.log(course_id);
            table = $('#video_table').DataTable({
                pageLength : 3,
                lengthMenu: [[3, 5, 10, 20, - 1], [3, 5, 10, 20, 'All']],
                ajax: "{{url('/user/course/videos/')}}/" + course_id,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'video', name: 'video'},
                ],
                initComplete : function(){

                    $(".deleteVideo").on('click', function(){
                        var id = $(this).data("id");
                        console.log(id);
                        var token = $("meta[name='csrf-token']").attr("content");
                        $.ajax(
                            {
                                url: "{{url('/user/course/video/delete/')}}/" + id,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function (response)
                                {
                                    var div_delete = $("#video_div").val("#video_id");
                                    console.log(response);
                                    div_delete.hide();
                                    // $("#msg_video").show();
                                    $("#msg_video").css("display", "block");
                                    table.ajax.reload();
                                },
                                error: function(xhr) {
                                    console.log(xhr.responseText);
                                }
                            });
                    });<!--------------------- hover video -------------------------------------------->
                    var figure = $(".video").hover( hoverVideo, hideVideo );

                    function hoverVideo(e) {
                        $('video', this).get(0).play();
                    }

                    function hideVideo(e) {
                        $('video', this).get(0).pause();
                    }


                },
            });
        });

    </script>

@endsection

@push('js')

    <script type="text/javascript">
        function Add()
        {
            $("#files").append('<div class="form-group row" id="fileUploader" >  <div class="col-md-5">  <input type="text" class="form-control" name="tag_en[]" placeholder="English Title" required="">' +
                ' </div>  <div class="col-md-6">  <input type="file" name="tag_en_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*">' +
                '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="Delete(this)" title="Delete file"> <?= _i("delete row") ?> </button> </div> </div>'
            );
        }

        function Delete(obj)
        {
            $(obj).closest('#fileUploader').remove();
        }


        function AddTagAr()
        {
            $("#tag_ar_files").append('<div class="form-group row" id="fileUploaderAr" >  <div class="col-md-5">  <input type="text" class="form-control" name="tag_ar[]" placeholder="{{_i('Arabic Title')}}" required="">' +
                ' </div>  <div class="col-md-6">  <input type="file" name="tag_ar_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*" >' +
                '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="DeleteTagAr(this)" title="Delete file"> <?= _i("delete row") ?> </button> </div> </div>'
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
            //   $('.textarea').wysihtml5()
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
        var figure = $(".video").hover(hoverVideo, hideVideo);
        function hoverVideo(e) {
            $('video', this).get(0).play();
        }

        function hideVideo(e) {
            $('video', this).get(0).pause();
        }
    </script>

    <script>
        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#video_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

    </script>

    <script>

        $(".deleteVideo").on('click', function(){
            var id = $(this).data("id");
            console.log(id);
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
                {
                    url: "{{url('/user/course/video/delete/')}}/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response)
                    {
                        var div_delete = $("#video_div").val("#video_id");
                        console.log(response);
                        div_delete.hide();
                        // $("#msg_video").show();
                        $("#msg_video").css("display", "block");
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
        });


    </script>

    <!--    <script>
        /*==================== PAGINATION =========================*/
        $(window).on('hashchange',function(){
            page = window.location.hash.replace('#','');
            getVideos(page);
        });
        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            // getProducts(page);
            location.hash = page;
        });
        function getVideos(page){
            var course_id = $("#course_id").val();
            console.log(course_id);
            $.ajax({
                url: "{{url('/admin/course/')}}/" +course_id+ '/video?page=' + page,
                type: "get",
                headers: {"Authorization" : "<?= request()->session()->get("access_token") ?>"},
            }).done(function(data){
                $('.content').html(data);
            });
        }
    </script>
                                -->


@endpush
