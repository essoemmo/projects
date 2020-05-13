
@extends('admin.layout.layout')

@section('title')
    {{_i('Edit Article')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Edit Article Category')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/artcle_category/all')}}">{{_i('All')}}</a></li>
            <li ><a href="{{url('/admin/artcle_category/create')}}">{{_i('Add')}}</a></li>
            <li class="active"><a href="#">{{_i('Edit')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/artcle_category/'.$artcl_category->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{$artcl_category->title}}" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
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
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$artcl_category->published == 1 ? 'checked' : ''}} >
                            </label>

                        </div>

                    </div>

                    <!-- ================================== language =================================== -->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label " for="lang_id">
                            {{_i('Language')}} </label>

                        <div class="col-xs-6">
                            <select class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{$artcl_category->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                                @endforeach

                                @if ($errors->has('lang_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                  <!--- =============================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label">{{_i('Image')}}</label>
{{--                        <div class="col-xs-6">--}}
{{--                            <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">--}}
{{--                            <span class="text-danger invalid-feedback">--}}
{{--                                <strong>{{$errors->first('img_url')}}</strong>--}}
{{--                            </span>--}}
{{--                        </div>--}}
                        <!-- Photo -->
                        @if(is_file(public_path('uploads/artcl_category/'.$artcl_category->id.'/'.$artcl_category->img_url)))
                            <div class="bs-example bs-example-images">
                                <div class="col-xs-6">
                                    <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                    <span class="text-danger invalid-feedback">
                                        <strong>{{$errors->first('img_url')}}</strong>
                                    </span>
                                </div>

                                <img src="{{ asset('uploads/artcl_category/'.$artcl_category->id.'/'.$artcl_category->img_url) }}" id="old_img"  style="margin-top: -95px; width: 300px; height: 250px;" class="img-thumbnail">
                            </div>
                        @else
                            <div class="col-xs-6">
                                <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('img_url')}}</strong>
                                </span>
                            </div>

                            <img class="img-responsive pad" id="article_img" hidden style="margin-top: -95px">
                        @endif
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

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(270).height(220);

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
@endsection

