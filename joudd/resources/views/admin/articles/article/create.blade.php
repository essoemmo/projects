@extends('admin.layout.layout')

@section('title')
    {{_i('Add Article')}}
@endsection

@section('box-title' )
    {{_i('Add Articles')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Add Articles')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/article/all')}}">{{_i('All')}}</a></li>
            <li class="active"><a href="{{url('/admin/article/create')}}">{{_i('Add')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/article/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{old('title')}}" id="txtUser" required="" class="form-control">
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
                                    <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                                @endforeach

                                @if ($errors->has('lang_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!----==========================  category name==========================--->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="name">
                            {{_i('Category')}} </label>

                        <div class="col-xs-6">
                            <select id="article_category" class="form-control{{ $errors->has('trainer_id') ? ' is-invalid' : '' }}" name="category_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : '' }}> {{$category->title}} </option>--}}
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
                            <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{old('created')}}">

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
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{old('published') == 1 ? 'checked' : ''}} >
                            </label>

                        </div>

                    </div>
                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label">{{_i('Image')}}</label>
                        <div class="col-xs-6">
                            <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                   value="{{old('img_url')}}">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                        </div>
                        <!-- Photo -->
                        <img class="img-responsive pad" id="article_img" hidden style="margin-top: -180px">
                    </div>
                    <!--========================================= Content =======================================-->
                    <div class="form-group">
                        <label for="name" class="col-xs-4 col-form-label">{{_i('Content')}}</label>
                        <div class="col-xs-10">
                            <textarea id="editor1" class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required=""  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here...">{{old('content')}}</textarea>
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
                        {{_i('Add')}}
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
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

    <script>

      //  $("#article_category").append('<option value>{{ _i('select') }}</option>');
        $('#language').change(function(){
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
                                $("#article_category").append('<option value="'+key+'">'+value+'</option>');
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
