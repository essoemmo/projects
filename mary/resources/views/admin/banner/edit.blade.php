@extends('admin.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="alert alert-danger" id="masages_model" style="display: none">

                            </div>

                            <form  action="{{route('banner.update',$banner->id)}}" method="post" id="editForm" enctype="multipart/form-data" data-parsley-validate>
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>{{_i('language')}}</label>
                                    <select name="language" class="form-control">

                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                            <option value="{{$key}}" {{$banner->lang_id == $key ? "selected":""}}>{{$lang}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('sections')}}</label>
                                    <select name="section_id" class="form-control">

                                        @foreach($contentSectios As $val)
                                            <option value="{{$val->id}}" {{$val->id == $banner->section_id ? "selected": ""}}>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{_i('start date')}}</label>
                                    <input type="date" name="start_date" class="form-control" value="{{$banner->start_date}}" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('end date')}}</label>
                                    <input type="date" name="end_date" class="form-control" value="{{$banner->end_date}}" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label>{{_i('banner')}}</label>
                                    <div class="dropzone options" id="dropzonefield" style="border: 1px solid #452A6F;margin: 10px"></div>
{{--                                    <button class="btn btn-success btn-sm" onclick="uploadFiles()" style="cursor: pointer" type="button"> {{_i('Save Images')}} </button>--}}
                                </div>

                                <div class="form-group">
                                    <label>{{_i('main banner')}}</label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>


                                <div class="form-group" id="url_container">
                                    <img src="{{asset('uploads/banner/'.$banner->image)}}" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>

{{--                                <div class="dropzone options" id="dropzonefield" style="border: 1px solid #452A6F;margin: 10px"></div>--}}
{{--                                <button class="btn btn-success btn-sm" onclick="uploadFiles()" style="cursor: pointer" type="button"> {{_i('Save Images')}} </button>--}}


                                <div class="form-group">
                                    <label>{{_i('title')}}</label>
                                    <input type="text" name="title" class="form-control" value="{{$banner->title}}" data-parsley-required="true">
                                </div>


                                <div class="form-group">
                                    <label>{{_i('content')}}</label>
                                    <textarea name="conteent" class="form-control ckeditor">{{$banner->description}}</textarea>
                                </div>


                                <input type="submit" class="btn btn-info btn-sm" value="{{_i('save')}}">

                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@push('js')
    <script type="text/javascript">


        $('body').on('submit','#editForm',function (e) {
            e.preventDefault();

              var url = $(this).attr('action');
            $.ajax({
                url: url,
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('edited is Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                        $('#masages_model').hide();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });


        Dropzone.autoDiscover = false;
        var drop;
        $(document).ready(function () {
            'use strict';
            drop = $('#dropzonefield').dropzone({
                url: "{{url('admin/banner/upload/image/'.$banner->id)}}",
                paramName:'file' ,
                uploadMultiple:true ,
                maxFiles:10,
                maxFilesize:5,
                dictDefaultMessage:"{{_i('Click here to upload files or drag and drop files here')}}",
                dictRemoveFile:"{{ _i('Delete') }}",
                acceptedFiles:'image/*',
                autoProcessQueue: true,
                parallelUploads:1,
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
                            url:'{{url('admin/banner/delete/image/'.$banner->id)}}',
                            data:{file:file.name,_token:'{{csrf_token()}}'},
                        });
                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                    }else{
                        file.previewElement.remove();
                    }
                },
                success:function (file,response) {
                    file.id = response.id;
                }
            });
                    @foreach($banner->files->where('main',0) as $photo)
            var file = { id: '{{$photo->id}}', name: '{{$photo->tag}}', type: "image/*" };
            var url = '{{ asset($photo->image) }}';
            drop[0].dropzone.emit("addedfile", file);
            drop[0].dropzone.emit("thumbnail", file, url);
            drop[0].dropzone.emit("complete", file);
            @endforeach
        });

        function uploadFiles(){
            drop[0].dropzone.processQueue();
        }



        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('.image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>
@endpush