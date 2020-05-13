@extends('master.layout.index',[
'title' => _i('Add Chat'),
'subtitle' => _i('Edit Chat'),
'activePageName' => _i('Chat'),
'additionalPageUrl' => url('/master/chat') ,
'additionalPageName' => _i('Edit Chat'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Chat') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ route('chat.update', $chat->id) }}" class="form-horizontal"  id="demo-form" data-parsley-validate="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body card-block">


                            <!-- ================================== Attachments =================================== -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{_i('Image')}}<span style="color: #F00;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" name="avatar" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*"
                                           value="{{old('avatar')}}">
                                    <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-responsive pad" src="{{ asset('images/' . $chat->avatar) }}" id="article_img" style="margin:-50px 10px ;display: block;max-width: 250px;">
                                </div>
                                <!-- Photo -->
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{_i('Video')}}<span style="color: #F00;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" name="video"  class="btn btn-default" accept="video/*"
                                           value="{{old('video')}}">
                                    <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                                </div>
                            </div>

                            <!--========================================== Script =======================================-->
                            <div class="form-group row">

                                <label for="name" class="col-sm-2 col-form-label">{{_i('script')}} <span style="color: #F00;">*</span> </label>
                                <div class="col-sm-10">
                                    <textarea required="" class="form-control " name="script"   style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write script here..."> {{ $chat->script }} </textarea>
                                    @if($errors->has('script'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('script')}}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button class="btn btn-primary col-sm-6">{{_i('Save')}}</button>

                        </div>
                        <!-- /.box-footer -->


                    </form>

                </div>


            </div>
        </div>

    </div>

@endsection

@push('js')

    <script>
        $(function () {
            CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton,colordialog',
                filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master')}}",
                filebrowserUploadMethod: 'form'
            });
        });

    </script>

    <script>

        $('#language_addform').change(function(){
            languageID = $(this).val();
            console.log(languageID);
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/get_categories')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_category").empty();
                            $("#get_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
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

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#article_img').attr('src', e.target.result).width(270).height(220);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

    </script>

@endpush








