
@extends('admin.layout.layout')

@section('title')
    {{_i('index')}}
@endsection
@push('css2')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

@endpush


@section('content')


    <section class="content">

        <!-- START CUSTOM TABS -->
        <h2 class="page-header">{{_i('Settings')}}</h2>

        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="  active"><a href="#tab_1" data-toggle="tab">{{_i('Site Settings')}}</a></li>

                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        <li class="pull-left header" ><i class="fa fa-th"></i>  </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="box-body">

                                @if($site_settings == null)
                                    <form  action="{{url('/admin/settings/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                                        @csrf
                                        <div class="box-body">
                                            <div class="form-group row">
                                            </div>



                                            <!-- ================================== email =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="email">
                                                    {{_i('Email')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="email" value="{{old('email')}}" id="email" class="form-control" placeholder="{{_i('Website Email')}}"
                                                            type="email" data-parsley-type="email">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== phone 1 =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="phone1">
                                                    {{_i('Main Phone')}} <span style="color: #F00;">*</span></label>
                                                <div class="col-xs-6">
                                                    <input type="number" name="phone1" value="{{old('phone1')}}" id="phone1" required="" class="form-control"  placeholder="{{_i('Website Main Phone')}}"
                                                           maxlength="20" data-parsley-maxlength="20">
                                                    @if ($errors->has('phone1'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('phone1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== phone 2 =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="phone2">
                                                    {{_i('Another Phone')}} </label>
                                                <div class="col-xs-6">
                                                    <input type="number" name="phone2" value="{{old('phone2')}}" id="phone2" class="form-control" placeholder="{{_i('Second Phone')}}"
                                                           maxlength="20" data-parsley-maxlength="20">
                                                    @if ($errors->has('phone2'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('phone2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== Attachments =================================== -->
                                            <div class="form-group">
                                                <label class="col-xs-2 col-form-label" for="logo">{{_i('Logo')}}</label>
                                                <div class="col-xs-6">
                                                    <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png,image/jpg"
                                                           value="{{old('logo')}}">
                                                    <span class="text-danger invalid-feedback">
                                                    <strong>{{$errors->first('logo')}}</strong>
                                                </span>
                                                </div>
                                                <!-- Photo -->
                                                <img class="img-responsive pad" id="setting_img" hidden style="margin-top: -180px">
                                            </div>

                                            <!-- ================================== facebook_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="facebook_url">
                                                    {{_i('Facebook Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input name="facebook_url" value="{{old('facebook_url')}}" id="facebook_url" class="form-control" placeholder="{{_i('Website Facebook Url')}}"
                                                           maxlength="191"	data-parsley-maxlength="191" type="url" data-parsley-type="url">
                                                    @if ($errors->has('facebook_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('facebook_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== instagram_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="instagram_url">
                                                    {{_i('Instagram Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="instagram_url" value="{{old('instagram_url')}}" id="instagram_url" class="form-control" placeholder="{{_i('Website Instagram Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url" data-parsley-type="url">
                                                    @if ($errors->has('instagram_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('instagram_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== twitter_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="twitter_url">
                                                    {{_i('Twitter Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="twitter_url" value="{{old('twitter_url')}}" id="twitter_url" class="form-control" placeholder="{{_i('Website Twitter Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url" data-parsley-type="url">
                                                    @if ($errors->has('twitter_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('twitter_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== youtube_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="youtube_url">
                                                    {{_i('Youtube Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="youtube_url" value="{{old('twitter_url')}}" id="youtube_url" class="form-control" placeholder="{{_i('Website Youtube Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url" data-parsley-type="url">
                                                    @if ($errors->has('youtube_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('youtube_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== work_time =================================== -->
                                            <div class="form-group row">

                                                <label for="work_time" class="col-xs-2 col-form-label" >{{_i('Work Time')}}</label>

                                                <div class="col-xs-6">
                                                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                                                    <textarea id="work_time"  class="form-control" name="work_time" placeholder="{{ _i('Enter Website Work Time ...')}}" >{{old('work_time')}}</textarea>
                                                    @if ($errors->has('work_time'))
                                                        <span class="text-danger invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('work_time') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== address =================================== -->
                                            <div class="form-group row">

                                                <label for="address" class="col-xs-2 col-form-label" >{{_i('Website Address')}}</label>

                                                <div class="col-xs-6">
                                                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                                                    <textarea id="address"  class="form-control" name="address" placeholder="{{ _i('Enter Website Address ...')}}" >{{old('address')}}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
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


                                @else


                                    <form  action="{{url('/admin/settings/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                                        @csrf
                                        <div class="box-body">
                                            <div class="form-group row">
                                            </div>

                                            <!-- ================================== email =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="email">
                                                    {{_i('Email')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="email" value="{{$site_settings->email}}" id="email" class="form-control" placeholder="{{_i('Website Email')}}"
                                                            type="email" data-parsley-type="email">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== phone 1 =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="phone1">
                                                    {{_i('Main Phone')}} <span style="color: #F00;">*</span></label>
                                                <div class="col-xs-6">
                                                    <input type="number" name="phone1" value="{{$site_settings->phone1}}" id="phone1" required="" class="form-control"  placeholder="{{_i('Website Main Phone')}}"
                                                           maxlength="20" data-parsley-maxlength="20">
                                                    @if ($errors->has('phone1'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('phone1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== phone 2 =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="phone2">
                                                    {{_i('Another Phone')}} </label>
                                                <div class="col-xs-6">
                                                    <input type="number" name="phone2" value="{{$site_settings->phone2}}" id="phone2" class="form-control" placeholder="{{_i('Second Phone')}}"
                                                           maxlength="20" data-parsley-maxlength="20">
                                                    @if ($errors->has('phone2'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('phone2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== Attachments =================================== -->
                                            <div class="form-group">
                                                <label class="col-xs-2 col-form-label" for="logo">{{_i('Logo')}}</label>

                                                @if(asset('uploads/settings/site_settings/'.$site_settings->logo))
                                                    <div class="col-xs-6">
                                                        <input type="file" name="logo" id="logo" onchange="showOldImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                                        <span class="text-danger invalid-feedback">
                                                            <strong>{{$errors->first('logo')}}</strong>
                                                        </span>
                                                    </div>

                                                    <div class="bs-example bs-example-images">
                                                        <img src="{{ asset('uploads/settings/site_settings/'.$site_settings->logo) }}" id="old_img"  style="margin-top: -200px; width: 300px; height: 250px;" class="img-thumbnail">
                                                    </div>
                                                @else

                                                    <div class="col-xs-6">
                                                        <input type="file" name="logo" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png , image/jfif">
                                                        <span class="text-danger invalid-feedback">
                                                            <strong>{{$errors->first('logo')}}</strong> </span>
                                                    </div>
                                                    <!-- Photo -->
                                                    <img class="img-responsive pad" id="new_img" hidden style="margin-top: -200px; width: 300px; height: 250px;">
                                                @endif
                                            </div>


                                            <!-- ================================== facebook_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="facebook_url">
                                                    {{_i('Facebook Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input name="facebook_url" value="{{$site_settings->facebook_url}}" id="facebook_url" class="form-control" placeholder="{{_i('Website Facebook Url')}}"
                                                           maxlength="191"	data-parsley-maxlength="191"  type="url"data-parsley-type="url">
                                                    @if ($errors->has('facebook_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('facebook_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== instagram_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="instagram_url">
                                                    {{_i('Instagram Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="instagram_url" value="{{$site_settings->instagram_url}}" id="instagram_url" class="form-control" placeholder="{{_i('Website Instagram Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url"data-parsley-type="url">
                                                    @if ($errors->has('instagram_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('instagram_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== twitter_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="twitter_url">
                                                    {{_i('Twitter Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="twitter_url" value="{{$site_settings->twitter_url}}" id="twitter_url" class="form-control" placeholder="{{_i('Website Twitter Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url"data-parsley-type="url">
                                                    @if ($errors->has('twitter_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('twitter_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== youtube_url =================================== -->
                                            <div class="form-group row" >

                                                <label class="col-xs-2 col-form-label " for="youtube_url">
                                                    {{_i('Youtube Url')}} </label>
                                                <div class="col-xs-6">
                                                    <input  name="youtube_url" value="{{$site_settings->youtube_url}}" id="youtube_url" class="form-control" placeholder="{{_i('Website Youtube Url')}}"
                                                            maxlength="191"	data-parsley-maxlength="191"  type="url" data-parsley-type="url">
                                                    @if ($errors->has('youtube_url'))
                                                        <span class="text-danger invalid-feedback">
                                                        <strong>{{ $errors->first('youtube_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- ================================== work_time =================================== -->
                                            <div class="form-group row">

                                                <label for="work_time" class="col-xs-2 col-form-label" >{{_i('Work Time')}}</label>

                                                <div class="col-xs-6">
                                                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                                                    <textarea id="work_time"  class="form-control" name="work_time" placeholder="{{ _i('Enter Website Work Time ...')}}" >{{$site_settings->work_time}}</textarea>
                                                    @if ($errors->has('work_time'))
                                                        <span class="text-danger invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('work_time') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- ================================== address =================================== -->
                                            <div class="form-group row">

                                                <label for="address" class="col-xs-2 col-form-label" >{{_i('Website Address')}}</label>

                                                <div class="col-xs-6">
                                                    {{--<input type="hidden" id="description_1" name="description" value="">--}}

                                                    <textarea id="address"  class="form-control" name="address" placeholder="{{ _i('Enter Website Address ...')}}" >{{$site_settings->address}}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
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
                                @endif

                            </div>

                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->


    </section>



@endsection


@section('footer')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <script>



        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#setting_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function showOldImg(input) {

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
