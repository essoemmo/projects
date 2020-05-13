@extends('admin.layout.master')
@section('content')

    <div class="wrap">
        <section class="app-content">

            <h3>اضافة ملفات</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">رفع الملفات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اضافة ملف</li>
                </ol>
            </nav>
        </section><!-- #dash-content -->
    </div><!-- .wrap -->


    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget p-lg">

                        @include('admin.layout.message')
                        <form action="{{route('uploads.store')}}" method="post" style="padding: 20px">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <div class="box-body">

                                  <input type="hidden" name="upload_id" value="{{$upload->id}}" class="form-control">
                                <div class="form-group">
                                    <label for="">الاسم</label>
                                    <input type="text" class="form-control" id="" name="name" value="{{old('name')}}"
                                           placeholder="الاسم">
                                </div>

                                <div class="form-group">
                                    <label for="">الرقم التسلسلي</label>
                                    <input type="text" class="form-control" id="" name="uploadNumber" value="{{old('uploadNumber')}}"
                                           placeholder="الرقم التسلسلي">
                                </div>

                                <div class="form-group">
                                    <label for="">القسم الرئيسي</label>
                                 <select class="form-control select2" name="category_id" id="category_id">
                                     <option>اختار القسم الرئيسي....</option>

                                     @foreach($categories as $category)
                                         <option value="{{$category->id}}">{{$category->name}}</option>
                                     @endforeach
                                 </select>
                                </div>


                                <div class="form-group" id="showSub" style="display: none">
                                    <label for="">القسم الفرعي</label>
                                    <select class="form-control select2" name="sub_category_id" id="sub_category_id">
                                        <option value=" ">اختار القسم الفرعي....</option>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>رفع الملفات </label>
                                    <div class="dropzone options" id="dropzonefield" style="border: 1px solid #452A6F;margin: 10px"></div>
                                    {{--                                    <button class="btn btn-success btn-sm" onclick="uploadFiles()" style="cursor: pointer" type="button"> {{_i('Save Images')}} </button>--}}
                                </div>



                                <div class="box-footer" style="padding: 50px">
                                    <button type="submit" class="btn btn-primary btn-block">اضافة</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div>
        </section><!-- #dash-content -->
    </div>


@endsection
@push('js')
    <script>
        // samer
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('change','#category_id',function (e) {
                e.preventDefault();

                var id = $(this).val();
                // alert('asdasd');
                $.ajax({
                    url: '{{ route('get-category') }}',
                    method: "get",
                    data: {
                        id : id
                    },
                    dataType: 'json',


                    success: function (response) {

                        if(response.status == 'success'){
                            $('#showSub').show();
                            $( "#sub_category_id" ).empty();
                            jQuery.each( response.data, function( i, val ) {
                                $( "#sub_category_id" ).append( `<option value="${val.id}">${val.name}</option>` );
                            });
                        }else{
                            $('#showSub').hide();
                            $( "#sub_category_id" ).empty();
                        }

                    },

                });
            });


            Dropzone.autoDiscover = false;
            var drop;
            $(document).ready(function () {
                'use strict';
                var acceptFilesList = ".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .xls, .xlsx, .ppt, .pptx, .txt, .rar, .zip";
                drop = $('#dropzonefield').dropzone({
                    url: "{{route('upload-files',$upload->id)}}",
                    paramName:'file' ,
                    uploadMultiple:true ,
                    maxFiles:30,
                    maxFilesize:50,
                    dictDefaultMessage:"اضغط هنا لرفع الملفات",
                    dictRemoveFile:"حذف",
                    acceptedFiles:acceptFilesList,
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
                                url:'{{route('delete-file',$upload->id)}}',
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
                    @foreach($upload->files->where('main',0) as $photo)
                var file = { id: '{{$photo->id}}', name: '{{$photo->tag}}', type: acceptFilesList };
                var url = '{{ asset($photo->files) }}';
                drop[0].dropzone.emit("addedfile", file);
                drop[0].dropzone.emit("thumbnail", file, url);
                drop[0].dropzone.emit("complete", file);
                @endforeach
            });

            function uploadFiles(){
                drop[0].dropzone.processQueue();
            }

        })
    </script>


    @endpush
