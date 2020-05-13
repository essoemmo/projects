
@extends('admin.AdminLayout.index')

@section('title')
{{_i('Edit Slider')}}
@endsection

@section('header')

@endsection



@section('page_url')
<li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
<li ><a href="{{url('/adminpanel/settings')}}">{{_i('Settings')}}</a></li>
<li class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Edit Slider')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Edit Slider')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">

        <form  action="{{url('/adminpanel/settings/slider/'.$slider->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

            @csrf
            <div class="box-body">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                    <div class="col-sm-6">
                        <select class="form-control" name="lang_id" id="language_addform" required="">
                            <option selected disabled="">{{_i('CHOOSE')}}</option>
                            @foreach($langs as $lang)
                                <option value="{{$lang->id}}" {{$slider_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                            @endforeach
                        </select>
                        <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                    </div>
                </div>

                <!-- ================================== Title =================================== -->
                <div class="form-group row ">

                    <label for="name" class="col-md-2 col-form-label"> {{_i('Name')}} <span style="color: #F00;">*</span> </label>

                    <div class="col-md-10">
                        <input  type="text" class="form-control" name="name" placeholder="{{_i('Slider Name')}}"
                                value="{{$slider_data->name}}" data-parsley-length="[3, 191]" required="">

                        <span class="text-danger invalid-feedback">
                             <strong>{{$errors->first('Name')}}</strong>
                        </span>

                    </div>
                </div>

                <!-- ================================== url =================================== -->
                <div class="form-group row">

                    <label for="name" class="col-md-2 col-form-label"> {{_i('Url')}} <span style="color: #F00;">*</span> </label>

                    <div class="col-md-10">
                        <input class="form-control" name="link" placeholder="{{_i('link')}}"
                               value="{{$slider->link}}" type="url" data-parsley-type="url" required="">

                        <span class="text-danger invalid-feedback">
                               <strong>{{$errors->first('link')}}</strong>
                        </span>

                    </div>
                </div>

                <!----==========================  published ==========================--->

                <!-- checkbox -->
                <div class="form-group row" >

                    <label class="col-form-label  col-md-2" for="checkbox">
                        {{_i('Publish')}}
                    </label>

                    <div class="col-md-10">

                        <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$slider->published == 1 ? 'checked' : ''}} >

                    </div>

                </div>

                <!-- ================================== description =================================== -->
                <div class="form-group row">

                    <label for="description" class=" col-md-2 col-form-label"> {{_i('Description')}} </label>

                    <div class="col-md-10">
                         <textarea id="editor1" class="form-control" name="description" placeholder="{{_i('Slider description')}}&hellip;"
                                minlength="20" data-parsley-minlength="20"  >{{$slider_data->description}}</textarea>
                    </div>

                </div>


                <!-- ================================== image =================================== -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="image">{{_i('Image')}} <span style="color: #F00;">*</span> </label>

                    @if(is_file(public_path('uploads/settings/sliders/'.$slider->id.'/'.$slider->image)))

                        <input type="file" name="image" id="filex" onchange="showImg(this)" class="col-md-10 btn btn-default" accept="image/gif, image/jpeg, image/png">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>

                        <div class="bs-example bs-example-images">
                            <img src="{{ asset('uploads/settings/sliders/'.$slider->id.'/'.$slider->image) }}" id="old_img"  style=" width: 300px; height: 250px; margin: 100px 362px;" class="img-thumbnail">
                        </div>
                    @else
                        <input type="file" name="image" id="filex" onchange="apperImage(this)" class="col-md-10 btn btn-default" accept="image/gif, image/jpeg, image/png" required="">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>

                        <img class="img-responsive pad" id="slider_img" hidden style="margin-top: -200px; width: 300px; height: 250px;" >
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
</div>


@endsection

@push('js')
<script>


                $(function () {

                CKEDITOR.editorConfig = function (config) {
                config.baseFloatZIndex = 102000;
                config.FloatingPanelsZIndex = 100005;

                };
                CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton,colordialog',
                filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master')}}",
                filebrowserUploadMethod: 'form'
                });


                });

</script>

@endpush
