@extends('admin.layout.layout')

@section('title')
    {{_i('Edit Article')}}
@endsection

@section('box-title')
    {{_i('Edit Article')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Edit Articles')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/adminpanel/article/all')}}">{{_i('All')}}</a></li>
            <li ><a href="{{url('/admin/article/create')}}">{{_i('Add')}}</a></li>
            <li class="active"><a href="#">{{_i('Edit')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/article/'.$article->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{$article->title}}" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== language =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="lang_id">
                            {{_i('Language')}} </label>

                        <div class="col-xs-6">
                            <select id="language" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{$article->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                                @endforeach

                                @if ($errors->has('lang_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="saved_lang_id" value="{{$article->lang_id}}" >
                    <input type="hidden" id="cat_value" value="{{$cat_val}}" >
                    <!----==========================  category name==========================--->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="name">
                            {{_i('Category')}} </label>

                        <div class="col-xs-6">
                            <select id="article_category" class="form-control{{ $errors->has('trainer_id') ? ' is-invalid' : '' }}" name="category_id" required="">

                                <!-- <option disabled selected> {{_i('Choose')}}</option> -->

{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->id}}" {{$article->category_id == $category->id ? 'selected' : '' }}> {{$category->title}} </option>--}}
{{--                                @endforeach--}}

{{--                                @if ($errors->has('category_id'))--}}
{{--                                    <span class="text-danger invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('category_id') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
                            </select>
                        </div>
                    </div>
                    <!----==========================  created ==========================--->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="date">
                            {{_i('Date ')}} </label>
                        <div class="col-xs-6">
                            <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{$article->created}}">

                        </div>
                    </div>

                    <!----==========================  published ==========================--->

                    <!-- checkbox -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label text-md-right" for="checkbox">
                            {{_i('Publish')}}
                        </label>
                        <div class="col-xs-6">

                            <label>
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$article->published == 1 ? 'checked' : ''}} >
                            </label>

                        </div>

                    </div>

                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label">{{_i('Image')}}</label>
{{--                        <div class="col-xs-6">--}}
{{--                            <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">--}}
{{--                            <span class="text-danger invalid-feedback">--}}
{{--                                <strong>{{$errors->first('img_url')}}</strong>--}}
{{--                            </span>--}}
{{--                        </div>--}}
                        <!-- Photo -->
                        @if(is_file(public_path('uploads/articles/'.$article->id.'/'.$article->img_url)))

                            <div class="col-xs-6">
                                <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                            </div>

                            <div class="bs-example bs-example-images">
                                <img src="{{ asset('uploads/articles/'.$article->id.'/'.$article->img_url) }}" id="old_img"  style="margin-top: -200px; width: 300px; height: 250px;" class="img-thumbnail">
                            </div>
                        @else
                            <div class="col-xs-6">
                                <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                            </div>

                        <img class="img-responsive pad" id="article_img" hidden style="margin-top: -200px; width: 300px; height: 250px;">
                        @endif
                    </div>

                    <!--========================================== Content =======================================-->
                    <div class="form-group">

                        <label for="name" class="col-xs-4 col-form-label">{{_i('Content')}}</label>
                        <div class="col-xs-10">
                            <textarea id="editor1" class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required=""  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here...">{{$article->content}}</textarea>
                            @if($errors->has('content'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content')}}</strong>
                                </span>
                            @endif
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Save')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>


@endsection

@section('footer')
    <script>

        $(function() {
            CKEDITOR.replace('editor1',{
                height: 250,
                extraPlugins: 'colorbutton,colordialog',
                filebrowserUploadUrl: "{{asset('admin/bower_components/ckeditor/ck_upload.php')}}",
            });
        });

        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(300).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

        function apperImage(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#article_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

    </script>

    <script>

        // edit form
        var cat = $("#cat_value").val();
        var saved_lang = $("#saved_lang_id").val();

        // category saved and all categories with same lang_id
        var html = $("#article_category").append('<option selected> ' + cat + '</option>');
        $.ajax({
            type:"GET",
            url:"{{url('admin/artcle_category/list')}}?lang_id="+saved_lang,
            dataType:'json',
            success:function(res){
                if(res){
                    html = $("#article_category").empty();
                    html += $("#article_category").append('<option disabled >{{ _i('Choose') }}</option>');
                    $.each(res,function(key,value){
                        // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                       html += $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                    $("#article_category").empty();
                }
            }
        });


        // select change
        $('#language').click(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/artcle_category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#article_category").empty();
                            $("#article_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#article_category").append('<option value="'+key+'">'+value+'</option>'); //cat_value
                            });

                        }else{
                            $("#article_category").empty();
                        }
                    }
                });
            }else{
                $("#article_category").empty();
            }
        });

    </script>

@endsection
