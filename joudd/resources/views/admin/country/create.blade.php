@extends('admin.layout.layout')

@section('title')

    {{_i('Add Country')}}

@endsection


@section('box-title' )
    {{_i('Add Country')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Add Country')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/country/create')}}">{{_i('Add')}}</a></li>
            <li ><a href="{{url('/admin/country/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/country/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

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
                    <!-- ================================== code =================================== -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="code">
                            {{_i('County Code')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="code" value="{{old('code')}}" id="code" required="" class="form-control" data-parsley-maxlength="5">
                            @if ($errors->has('code'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                   <!-- ================================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label" for="logo">{{_i('Logo')}}</label>
                        <div class="col-xs-6">
                            <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                   value="{{old('logo')}}">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                        </div>
                        <!-- Photo -->
                        <img class="img-responsive pad" id="article_img" hidden style="margin-top: -130px">
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

@endsection
