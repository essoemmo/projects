@extends('admin.AdminLayout.index')

@section('title')
edit {{$brand->name}}
@endsection

@section('page_header_name')
edit {{$brand->name}}
@endsection


@section('content')

<!-- Page-header start -->
<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('Brands')}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">{{_i('Brands')}}</a>
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
            @include('admin.AdminLayout.message')
            {!! Form::model($brand,['route'=>['brands.update',$brand->id],'class'=>'form-group','files'=>true, 'method'
            => 'PATCH']) !!}


            <div class="form-group row">
                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" name="lang_id" id="language_addform" required="">
                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                        @foreach($langs as $lang)
                            <option value="{{$lang->id}}" {{$brand_data->lang_id == $lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                        @endforeach
                    </select>
                    <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                </div>

            </div>


            <div class="form-group row">
                {{Form::label('name',null,['class'=>'col-sm-1 col-form-label'])}}
                <div class="col-sm-11">
                {{Form::text('name',$brand_data->name,['class'=>'form-control'])}}
                @if ($errors->has('name'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
                <label for="link" class="col-sm-1 col-form-label"> {{_i('link')}} <span style="color: #F00;">*</span>
                </label>

                <div class="col-sm-11">
                    <input class="form-control" name="link" placeholder="{{_i('link')}}" value="{{$brand->link}}"
                        type="url" data-parsley-type="link" required="">

                    <span class="text-danger invalid-feedback">
                        <strong>{{$errors->first('link')}}</strong>
                    </span>

                </div>
            </div>

            <div class="form-group row">

                <div class="col-sm-1">
                    <label for="description" class="control-label"> {{_i('Description')}} </label>
                </div>
                <div class="col-sm-11">
                <textarea id="editor1" class="form-control col-md-10" name="description" style="height: 150px;"
                    minlength="20" placeholder="{{_i('Brand description')}}"
                    required="">{{ $brand_data->description }}</textarea>
                </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{_i('Image')}}</label>
                    <div class="col-sm-4">
                        <input type="file" name="image" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                               value="{{old('image')}}">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>
                    </div>
                </div>

            <div class="form-group row">

                <label class="col-sm-1 col-form-label text-md-right" for="checkbox">
                    {{_i('Publish')}}
                </label>

                <label class="col-sm-11">
                    <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1"
                        {{ $brand->published == 1 ? 'checked' : ''}}>
                </label>

            </div>

            {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
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
