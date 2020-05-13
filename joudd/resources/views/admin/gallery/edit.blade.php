

@extends('admin.layout.layout')
@section('title')
        {{_i('Edit Gallery')}}
@endsection

@section('header')

{{--<!-- Select2 -->--}}
{{--<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">--}}

        <!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('admin/plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
@endsection

@section('page_header_name')
        {{_i('Edit Gallery')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Edit Gallery')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/gallery/all')}}">{{_i('All')}}</a></li>
            <li ><a href="{{url('/admin/gallery/create')}}">{{_i('Add')}}</a></li>
            <li class="active"><a href="{{url('/admin/gallery/'.$gallery->id.'/edit')}}">{{_i('Edit')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/gallery/'.$gallery->id.'/edit')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" id="txtUser" value="{{$gallery->title}}" required="" class="form-control">
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
                            <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                <option disabled selected> {{_i('Choose')}}</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{$gallery->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                                @endforeach

                                @if ($errors->has('lang_id'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!----==========================  link ==========================--->
                    <div class="form-group row" >
                        <label class="col-xs-2 col-form-label" for="link">
                            {{_i('Link')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="href" id="link" value="{{$gallery->href}}" required="" class="form-control">
                            @if ($errors->has('href'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('href') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!----==========================  published ==========================--->
                    <!-- iCheck -->

                    <!-- checkbox -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label" for="checkbox">
                            {{_i('Publish')}}
                        </label>
                        <div class="col-xs-6">

                            <label>
                                <input class="form-check-input"  type="checkbox" name="published" id="checkbox" value="1"{{$gallery->published == '1' ? 'checked' : ''}}>

                                {{--<input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$gallery->published == 1? 'checked': ''}}>--}}
                            </label>

                        </div>

                    </div>


                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-labelt">{{_i('Photo')}}</label>
                        <div class="col-xs-6">
                            <input type="file" name="file" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                            <strong>{{$errors->first('file')}}</strong>
                        </div>
                        <!-- Photo -->
                        <img class="img-responsive pad" id="course_img" hidden style="margin-top: -150px; margin-left:70%; margin-bottom: -1%;">
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
        $(function () {

            showImage();
        });
        function showImage(){
            $.getJSON(
                    '{{route("gallery_getAttachment")}}?id={{$gallery->id}}'
            ).done((data)=>{
                $('#attachment_img').attr('href',data[0]);
            $('#course_img').attr('src', data[0]).width(250).height(250);

        });
        }

    </script>

    <!-- iCheck 1.0.1 -->
    <script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>

    <script>

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    </script>
@endsection