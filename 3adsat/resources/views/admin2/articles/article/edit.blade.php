@extends('admin.layout.master', [
'title' => _i('Edit Article'),
'subtitle' => _i('Edit Article'),
'breadcrumb' => [ _i('Edit Article') => _i('Edit Article'), _i('Edit Article')]])

@section('content')

    <form  action="{{url('/admin/panel/article/'.$article->id.'/update')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
        @csrf
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/panel/article/all')}}" class="btn btn-default">{{ _i('All Articles') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a  >
                                    <button type="submit" class="btn btn-info">  <i class="fa fa-save "></i>
                                        {{ _i('Save') }}
                                    </button>
                                </a>
                            </li>
                        </ol>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ _i('Edit Article') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Title') }}</label>
                                    <div class="col-sm-10">
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
                                    <label class="col-sm-2 control-label " for="lang_id">
                                        {{_i('Language')}} </label>

                                    <div class="col-sm-10">
                                        <select id="language" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                            <option disabled selected> {{_i('Choose')}}</option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}" {{$article->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->name)}} </option>
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
                                <input type="hidden" id="cat_id" value="{{$cat_id}}" >
                                <!----==========================  category name ==========================--->
                                <div class="form-group row" >
                                    <label class="col-sm-2 control-label  " for="name">
                                        {{_i('Category')}} </label>
                                    <div class="col-sm-10">
                                        <select id="article_category" class="form-control" name="category_id" required="">
{{--                                            <option disabled selected >{{_i('Choose')}}</option>--}}

                                        </select>
                                    </div>
                                </div>
                                <!----==========================  created ==========================--->
                                <div class="form-group row" >
                                    <label class="col-sm-2 control-label  " for="date">
                                        {{_i('Date ')}} </label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{$article->created}}">

                                    </div>
                                </div>
                                <!----==========================  published ==========================--->
                                <!-- checkbox -->
                                <div class="form-group row" >
                                    <label class="col-sm-2 control-label " for="checkbox">
                                        {{_i('Publish')}}
                                    </label>
                                    <div class="col-sm-6">
                                        <label>
                                            <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$article->published == 1 ? 'checked' : ''}} >
                                        </label>
                                    </div>
                                </div>
                                <!-- ================================== Attachments =================================== -->
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{_i('Image')}}</label>

                                    @if(is_file(public_path('uploads/articles/'.$article->id.'/'.$article->img_url)))

                                        <div class="col-sm-6">
                                            <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('img_url')}}</strong>
                                            </span>
                                        </div>

                                        <div class="bs-example bs-example-images">
                                            <img src="{{ asset('uploads/articles/'.$article->id.'/'.$article->img_url) }}" id="old_img"  style="margin-top: -60px; width: 300px; height: 250px;" class="img-thumbnail">
                                        </div>
                                     @elseif(is_file(public_path('uploads/articles/'.$article->source_id.'/'.$article->img_url)))
                                        <div class="col-sm-6">
                                            <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('img_url')}}</strong>
                                            </span>
                                        </div>

                                        <div class="bs-example bs-example-images">
                                            <img src="{{ asset('uploads/articles/'.$article->source_id.'/'.$article->img_url) }}" id="old_img"  style="margin-top: -60px; width: 300px; height: 250px;" class="img-thumbnail">
                                        </div>
                                    @else
                                        <div class="col-sm-6">
                                            <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('img_url')}}</strong>
                                            </span>
                                        </div>

                                        <img class="img-responsive pad" id="article_img"  style="margin-top: -60px; width: 300px; height: 250px;">
                                    @endif
                                </div>
                                <!--========================================== Content =======================================-->
                                <div class="form-group">
                                    <label for="name" class="col-sm-2  control-label">{{_i('Content')}}</label>
                                    <div class="col-sm-12">
                                        <textarea id="editor1" class="textarea form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required=""  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here...">{{$article->content}}</textarea>
                                        @if($errors->has('content'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

    </form>

@endsection

@push('js')
    <script>

        $(function() {
            CKEDITOR.replace('editor1');
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
        var cat_id = $("#cat_id").val();
        var saved_lang = $("#saved_lang_id").val();

        // category saved and all categories with same lang_id
        var html = $("#article_category").append('<option value='+cat_id+' > ' + cat + '</option>');

        // select change
        $('#language').click(function(){

            $.ajax({
                type:"GET",
                url:"{{url('/admin/panel/artcle_category/list')}}?lang_id="+saved_lang,
                dataType:'json',
                success:function(res){
                    if(res){
                        html = $("#article_category").empty();
                        html += $("#article_category").append('<option disabled >{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            // $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            html += $("#article_category").append('<option value="'+key+'" >'+value+'</option>');
                        });

                    }else{
                        $("#article_category").empty();
                    }
                }
            });




            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/panel/artcle_category/list')}}?lang_id="+languageID,
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

@endpush
