

@extends('admin.layout.layout')

@section('title')
    {{_i('Edit Slider')}}
@endsection

@section('header')

@endsection



@section('page_url')
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/admin/settings')}}">{{_i('Settings')}}</a></li>
    <li class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')

    <h2 class="page-header">{{_i('Edit Slider')}}</h2>

    <div class="box box-default">

        <div class="box-body">

            <form  action="{{url('/adminpanel/settings/slider/'.$slider->id.'/update')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>


                    <!-- ================================== Title =================================== -->
                    <div class="form-group row ">

                        <label for="name" class="col-xs-2 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span> </label>

                        <div class="col-xs-6">
                            <input  type="text" class="form-control" name="title" placeholder="{{_i('Slider Title')}}"
                                    value="{{$slider->title}}" data-parsley-length="[3, 191]" required="">

                            <span class="text-danger invalid-feedback">
                             <strong>{{$errors->first('title')}}</strong>
                        </span>

                        </div>
                    </div>

                    <!-- ================================== url =================================== -->
                    <div class="form-group row">

                        <label for="name" class="col-xs-2 col-form-label"> {{_i('Url')}} <span style="color: #F00;">*</span> </label>

                        <div class="col-xs-6">
                            <input class="form-control" name="url" placeholder="{{_i('Url')}}"
                                   value="{{$slider->url}}" type="url" data-parsley-type="url" required="">

                            <span class="text-danger invalid-feedback">
                               <strong>{{$errors->first('url')}}</strong>
                        </span>

                        </div>
                    </div>

                    <!----==========================  published ==========================--->

                    <!-- checkbox -->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="checkbox">
                            {{_i('Publish')}}
                        </label>
                        <div class="col-xs-6">

                            <label>
                                <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$slider->published == 1 ? 'checked' : ''}} >
                            </label>

                        </div>

                    </div>

                    <!-- ================================== description =================================== -->
                    <div class="form-group row">

                        <label for="description" class=" col-xs-2 col-form-label"> {{_i('Description')}} </label>

                        <div class="col-xs-6">
                         <textarea id="description" class="form-control" name="description" placeholder="{{_i('Slider description')}}&hellip;"
                                   minlength="10" data-parsley-minlength="10"  >{{$slider->description}}</textarea>
                        </div>

                    </div>


                    <!-- ================================== image =================================== -->
                    <div class="form-group">
                        <label class="col-xs-2 col-form-label" for="image">{{_i('Image')}} <span style="color: #F00;">*</span> </label>

                        @if(asset('uploads/settings/sliders/'.$slider->id.'/'.$slider->image))
                            <div class="col-xs-6">
                                <input type="file" name="image" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>
                            </div>

                            <div class="bs-example bs-example-images">
                                <img src="{{ asset('uploads/settings/sliders/'.$slider->id.'/'.$slider->image) }}" id="old_img"  style=" width: 300px; height: 250px;" class="img-thumbnail">
                            </div>
                        @else
                            <div class="col-xs-6">
                                <input type="file" name="image" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png" required="">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>
                            </div>

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
                $('#slider_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }


    </script>

@endsection
