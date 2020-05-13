@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Edit Country')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Edit Country')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/country/all')}}">{{_i('All')}}</a></li>
    <li ><a href="{{url('/adminpanel/country/create')}}">{{_i('Add')}}</a></li>
    <li class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/adminpanel/country/'.$country->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Title')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="title" value="{{$country->title}}" id="txtUser" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== Attachments =================================== -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="code">
                            {{_i('Code')}} </label>
                        <div class="col-xs-6">
                            <input type="number" name="code" value="{{$country->code}}" id="code" required="" class="form-control">
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

                        @if(is_file(public_path('uploads\\countries\\'.$country->id.'\\'.$country->logo)))
                            <div class="col-xs-6">
                                <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                            </div>

                            <div class="bs-example bs-example-images">
                                <img src="{{ asset('uploads/countries/'.$country->id.'/'.$country->logo) }}" id="old_img"  style="margin-top: -130px; width: 300px; height: 250px;" class="img-thumbnail">
                            </div>
                        @else

                            <div class="col-xs-6">
                                <input type="file" name="logo" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong> </span>
                            </div>
                            <!-- Photo -->
                            <img class="img-responsive pad" id="new_img" hidden style="margin-top: -130px; width: 300px; height: 250px;">
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
                $("#old_img").attr('src', e.target.result).width(300).height(250);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }



        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#new_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

    </script>

@endsection
