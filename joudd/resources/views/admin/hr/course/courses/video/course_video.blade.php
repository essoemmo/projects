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

<div class="flash-message" id="msg_video" style="display: none;">
    <p class="alert alert-success"><strong>Successfully !</strong> video deleted.</p>
</div>
    <form method="POST" action="{{ url('/admin/course/'.$course->id.'/video') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">

                @csrf
<div class="box box-info">
    <div class="box-header">
        <div class="row">
            <div class="col-md-12">
                <h3 class="box-title"> {{_i('Course Information')}} </h3></div>
            <div class="col-md-1">
                <label class=" control-label">{{_i('Title :')}}</label>
            </div>
            <div class="col-md-2">
                <label class=" control-label">{{$course->title}}</label>
            </div>
            <div class="col-md-1">
                <label class="control-label">{{_i('Start :')}}</label>
            </div>
            <div class="col-md-2">
                <label class=" control-label">{{$course->start_date}}</label>
            </div>
            <div class="col-md-1">
                <label class="control-label">{{_i('End :')}}</label>
            </div>
            <div class="col-md-2">
                <label class="control-label">{{$course->end_date}}</label></div>
            <div class="col-md-1">
                <label class="col-md-1 control-label">{{_i('Duration:')}}</label></div>
            <div class="col-md-1">
                <label class="col-md-1 control-label">{{$course->duration}}</label></div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            @foreach ($errors->all() as $error)

            <div class="col-12">
                <div class="text-danger"> {{ $error }}</div>
            </div>
            @endforeach


                <!-- ============================================= cost ============================= -->
                <div class="col-md-1">
                    <label for="name" class="">{{ _i(' Cost') }} <span style="color: #ff3960;">*</span></label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{old('cost')}}" placeholder=" Cost" required="">
                    @if ($errors->has('cost'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>





                <!-- ============================================= Is Active ============================= -->

                <div class="col-md-1">
                    <label for="gender" class=" col-form-label">{{_i('Status')}}</label>
                </div>
                <div class="col-md-8">

                    <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="1">
                    <label class="form-check-label" for="optionsRadios1"> {{_i('Active')}} </label>

                    <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios2" value="0">
                    <label class="form-check-label" for="optionsRadios2"> {{_i('Not Active')}} </label>

                </div>


                <!-- /.box-body -->
             
                <!-- /.box-footer -->
          


    </div>

</div>
  </div>
@include("admin.hr.course.courses.video.include.tabs")
   <div class="row">
   <div class="col-md-12 ">
                    <button type="submit" class="btn btn-info btn-block "> {{ _i('Save') }}</button>
   </div></div>
    </form>
  @if(count($course_videos) > 0)
  <p>
       
  </p>
   <div class="box box-info">

       
        <!-- /.box-header -->
        <div class="box-body">
      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                                <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}" >
                                <table id="video_table" class="text-center" cl role="grid" aria-describedby="example1_info">
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
                    </div>

            @endif
            
  

@endsection

@push('js')




<script type="text/javascript">
    function Add(code, target)
    {
        
    $("#"+target).append("<div>"+$('#'+code).html()+ '<div class="col-2">    <button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="Delete(this)" title="Delete file"> <?= _i("delete row") ?> </button></div></div>');
//            append('<div class="col-xs-6 " id="fileUploader_'+code+'" >   <input type="text" class="form-control" name="tag_en[]" placeholder="English Title" required="">' +
//            ' </div>  <div class="col-xs-6">  <input type="file" name="tag_en_files[]"  style="display: inline" class=" btn btn-default" accept="audio/*">' +
//            '<button type="button" class="btn btn-danger btn-sm" name="delete" title="delete" onclick="Delete(this)" title="Delete file"> <?= _i("delete row") ?> </button> </div> '
//            );
    }

    function Delete(obj)
    {
        alert($(obj).parent("div").parent('div').html());
  $(obj).parent("div").parent('div').remove();
    }


    

    function DeleteTagAr(obj)
    {
        $(obj).closest('#fileUploaderAr').remove();
    }



        var table;
        $(function() {
                        var course_id = $("#course_id").val();
        console.log(course_id);
        table = $('#video_table').DataTable({
        pageLength : 3,
                lengthMenu: [[3, 5, 10, 20, - 1], [3, 5, 10, 20, 'All']],
                ajax: "{{url('/admin/course/videos/')}}/" + course_id,
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
                url: "{{url('/admin/course/video/delete/')}}/" + id,
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


     <script>
     $("#msg_video").css("display", "none");
                        $(function () {
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace('editor1');
                        //bootstrap WYSIHTML5 - text editor
                        //   $('.textarea').wysihtml5()
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

                        function showImg(input) {
                        var filereader = new FileReader();
                        filereader.onload = (e) => {
                        console.log(e);
                        $('#video_img').attr('src', e.target.result).width(250).height(250);
                        };
                        console.log(input.files);
                        filereader.readAsDataURL(input.files[0]);
          }

  

                        $(".deleteVideo").on('click', function(){
                        var id = $(this).data("id");
                        console.log(id);
                        var token = $("meta[name='csrf-token']").attr("content");
                        $.ajax(
                        {
                        url: "{{url('/admin/course/video/delete/')}}/" + id,
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


@endpush
