@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Edit Blog')}}
@endsection

@section('page_url')
    <li class="breadcrumb-item">
        <a href="{{url('adminpanel')}}">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item"><a href="{{url('adminpanel/articles')}}">{{_i('Blogs')}}</a>
    </li>
@endsection


@section('content')

    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                <form method="POST" action="{{ url('/adminpanel/articles/'.$article->id.'/update') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body card-block">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="lang_id" id="language_addform" required="">
                                    <option selected disabled="">{{_i('CHOOSE')}}</option>
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->id}}" {{$article_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                                    @endforeach
                                </select>
                                <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                            </div>

                        </div>
                        <!----==========================  category name==========================--->
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label " for="name">
                                {{_i('Category')}} </label>

                            <div class="col-sm-6">
                                <select class="form-control{{ $errors->has('trainer_id') ? ' is-invalid' : '' }}" name="category_id" required="" id="get_category">
                                    <div id="category_selected">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$article->category_id == $category->id ? 'selected' : '' }}> {{$category->title}} </option>
                                        @endforeach
                                    </div>

                                </select>
                            </div>
                        </div>
                        <!----==========================  title ==========================--->

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 control-label" >{{ _i('Title') }} <span style="color: #F00;">*</span></label>

                            <div class="col-sm-6">
                                <input  type="text"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$article_data->title }}"  placeholder=" {{_i('Article Title')}}" required="">
                                @if ($errors->has('title'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <!----==========================  created ==========================--->
                        <div class="form-group row" >

                            <label class="col-sm-2 col-form-label " for="date">
                                {{_i('Date')}} </label>
                            <div class="col-sm-6">
                                <input type="date" id="date" name="created" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{$article->created}}">

                            </div>
                        </div>

                        <!----==========================  published ==========================--->

                        <!-- checkbox -->
                        <div class="form-group row" >

                            <label class="col-sm-2 col-form-label" for="checkbox">
                                {{_i('Publish')}}
                            </label>

                            <div class="checkbox-fade fade-in-primary col-sm-6">
                                <label>
                                    <input type="checkbox"  id="checkbox" name="published" value="1" {{$article->published == 1 ? 'checked' : ''}}>
                                    <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                </label>
                            </div>

                        </div>

                        <!-- ================================== Attachments =================================== -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{_i('Image')}}</label>




                            @if(is_file(public_path($article->img_url)))

                                <div class="col-sm-4">
                                    <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*">
                                    <span class="text-danger invalid-feedback">
                                        <strong>{{$errors->first('img_url')}}</strong>
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <img src="{{ asset($article->img_url) }}" id="old_img"  style="margin: 0 auto; width: 300px; height: 250px;display: block" class="img-thumbnail">
                                </div>
                            @else
                                <div class="col-sm-4">
                                    <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/*">
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('img_url')}}</strong>
                                </span>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-responsive pad" id="article_img" style="margin: 0 auto;display: block;">
                                </div>
                            @endif

                        </div>

                        <!--========================================== Content =======================================-->
                        <div class="form-group row">

                            <label for="name" class="col-sm-2 col-form-label">{{_i('Content')}} <span style="color: #F00;">*</span> </label>
                            <div class="col-sm-10">
                                <textarea required=""  id="editor1" class="form-control " name="content"   style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here...">{{$article_data->content}}</textarea>
                                @if($errors->has('content'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content')}}</strong>
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


@endsection

<?php
// Start the session
global $store_id;
session_start();
$_SESSION['store_id'] = session()->get("StoreId");
//dd($_SESSION['store_id']);
?>

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
        //category_selected
        $('#language_addform').change(function(){
            var langID = `{{$article_data->lang_id }}`;
            languageID = $(this).val();
            //console.log(languageID);
            if(languageID == langID ){
                $("#get_category").empty();
                // $("#category_selected").show();
                var html='';
                html +='<option disabled selected>{{ _i('Choose') }}</option>';
                @foreach($categories as $category)
                    html += '<option value="{{$category->id}}" {{$article->category_id == $category->id ? 'selected' : '' }}> {{$category->title}} </option>';
                @endforeach
                $("#get_category").prepend(html);
            }else {

                if (languageID) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('adminpanel/get_categories')}}?lang_id=" + languageID,
                        dataType: 'json',
                        success: function (res) {
                            if (res) {
                                $("#get_category").empty();
                                $("#get_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
                                $.each(res, function (key, value) {
                                    $("#get_category").append('<option value="' + key + '">' + value + '</option>');
                                });

                            } else {
                                $("#get_category").empty();
                            }
                        }
                    });
                } else {
                    $("#get_category").empty();
                }
            }
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

@endpush
