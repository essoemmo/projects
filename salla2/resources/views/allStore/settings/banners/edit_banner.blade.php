@extends('admin.AdminLayout.index')

@section('title')
{{_i('Edit Banner')}}
@endsection

@section('header')

@endsection



@section('page_url')
<li class="breadcrumb-item"><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
<li class="breadcrumb-item" ><a href="{{url('/adminpanel/settings')}}">{{_i('Settings')}}</a></li>
<li class="breadcrumb-item" class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')


<div class="card">

    <div class="card-header">
        <h5 class="card-title">
            {{_i('Edit Banner')}}
        </h5>
    </div>

    <!-- Blog-card start -->

    <div class="card-block">

        <div class="box-body">


            <form  action="{{url('/adminpanel/settings/banner/'.$banner->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="lang_id" id="language_addform" required="">
                                <option selected disabled="">{{_i('CHOOSE')}}</option>
                                @foreach($langs as $lang)
                                    <option value="{{$lang->id}}" {{$banner_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                                @endforeach
                            </select>
                            <small  class="form-text text-muted">{{_i('Please select language')}}</small>
                        </div>
                    </div>

                    <!-- ================================== lang =================================== -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>
                                <input type="checkbox" class="js-single" id="checkbox" name="published" value="1" {{$banner->published == 1 ? 'checked' : ''}} >
                                {{_i('Publish')}}
                            </label>
                        </div>
                    </div>
                    <!-- ================================== Title =================================== -->
                    <div class="form-group row ">

                        <label for="name" class="col-sm-2 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span> </label>

                        <div class="col-md-10">
                            <input  type="text" class="form-control" name="name" placeholder="{{_i('Banner Title')}}"
                                    value="{{$banner_data->name}}" data-parsley-length="[3, 191]" required="">

                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('name')}}</strong>
                            </span>

                        </div>
                    </div>

                    <!-- ================================== url =================================== -->
                    <div class="form-group row">

                        <label for="link" class="col-sm-2 col-form-label"> {{_i('link')}} <span style="color: #F00;">*</span> </label>

                        <div class="col-md-10">
                            <input class="form-control" name="link" placeholder="{{_i('link')}}"
                                   value="{{$banner->link}}" type="url" data-parsley-type="link" required="">

                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('link')}}</strong>
                            </span>

                        </div>
                    </div>

                    <!----==========================  published ==========================--->



                    <div class="form-group row ">

                        <label for="name" class="col-sm-2 col-form-label"> {{_i('Sort Order')}} </label>

                        <div class="col-md-10">
                            <input  type="number" class="form-control" name="sort_order" placeholder="{{_i('Banner Sort Order')}}"
                                    value="{{ $banner->sort_order }}"  required="">

                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('sort_order')}}</strong>
                            </span>

                        </div>
                    </div>

                    <!-- ================================== description =================================== -->
                    <div class="form-group row">

                        <label for="description" class="col-sm-2 col-form-label"> {{_i('Description')}} <span style="color: #F00;">*</span> </label>

                        <div class="col-md-10">
                            <textarea id="editor1" class="form-control" name="description" placeholder="{{_i('Slider description')}}&hellip;"
                                      >{{$banner_data->description}}</textarea>
                        </div>

                    </div>




                    <!-- ================================== image =================================== -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="image">{{_i('Image')}} <span style="color: #F00;">*</span> </label>

                        @if(is_file(public_path('uploads/settings/banners/'.$banner->id.'/'.$banner->image)))

                        <div class="col-md-10">
                            <input type="file" name="image" id="filex" onchange="showBannerImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>

                            <br/>                                              
                            <img src="{{ asset('uploads/settings/banners/'.$banner->id.'/'.$banner->image) }}" id="banner_img"  style="max-width: 350px" class="img-thumbnail">
                        </div>

                        @else
                        <div class="col-md-10">
                            <input type="file" name="image" id="filex" onchange="showBannerImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png" required="">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>

                            <br/>                    
                            <img class="img-responsive pad" id="banner_img" hidden style="max-width: 350px" >
                        </div>

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
function showBannerImage(input)
    {

    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('#banner_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

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
