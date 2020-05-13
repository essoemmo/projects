@extends('admin.AdminLayout.index')



@section('title')
    {{_i('Site Settings')}}
@endsection

@section('page_header_name' )
    {{_i('Site Settings')}}
@endsection


@section('page_url')
    <li><a href="/"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/role/add')}}">{{_i('Add')}}</a></li>
@endsection


@section('content')


    <div class="box box-info" >

        <div class="box-body">
            <!-- form start -->
            <form  action="{{url('/adminpanel/settings')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf
                <div class="form-group row">

                </div>
                <div class="box-body">

                    <!----============================== Email =============================-->
                    <div class="form-group row">
                        <label for="" class="col-xs-2 col-form-label text-md-right "> {{_i('Email')}} </label>

                        <div class="col-xs-6">
                            <input type="email"  placeholder="Email" name="email"  value="{{$setting['email']}}" data-parsley-type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required="" >
                            @if ($errors->has('email'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== phone 1 =============================-->
                    <div class="form-group row">
                        <label for="phone" class="col-xs-2 col-form-label text-md-right "> {{_i('Phone')}} </label>

                        <div class="col-xs-6">
                            <input id="phone" type="text" placeholder="Phone" name="phone"  value="{{$setting['phone']}}"
                             class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" required=""   >
                            @if ($errors->has('phone'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('phone') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== phone 2 =============================-->
                    <div class="form-group row">
                        <label for="phone2" class="col-xs-2 col-form-label text-md-right "> {{_i('Another Phone')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="phone2" placeholder="Another Phone" name="phone2"  value="{{$setting['phone2']}}"
                                   class="form-control{{ $errors->has('phone2') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('phone2'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('phone2') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== facebook url  =============================-->
                    <div class="form-group row">
                        <label for="facebook_url" class="col-xs-2 col-form-label text-md-right "> {{_i('Facebook Url')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="facebook_url" placeholder="Facebook Url " name="facebook_url"  value="{{$setting['facebook_url']}}"
                                   class="form-control{{ $errors->has('facebook_url') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('facebook_url'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('facebook_url') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== YouTube Url =============================-->
                    <div class="form-group row">
                        <label for="youtube_url" class="col-xs-2 col-form-label text-md-right "> {{_i('YouTube Url')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="youtube_url" placeholder="YouTube Url " name="youtube_url"  value="{{$setting['youtube_url']}}"
                                   class="form-control{{ $errors->has('youtube_Url') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('youtube_Url'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('youtube_Url') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <!----============================== Twitter Url =============================-->
                    <div class="form-group row">
                        <label for="twitter_url" class="col-xs-2 col-form-label text-md-right "> {{_i('Twitter Url')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="twitter_url" placeholder="Twitter Url " name="twitter_url"  value="{{$setting['twitter_url']}}"
                                   class="form-control{{ $errors->has('twitter_url') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('twitter_url'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('twitter_url') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <!----============================== Instagram Url =============================-->
                    <div class="form-group row">
                        <label for="instagram_url" class="col-xs-2 col-form-label text-md-right "> {{_i('Instagram Url')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="instagram_url" placeholder="Instagram Url " name="instagram_url"  value="{{$setting['instagram_url']}}"
                                   class="form-control{{ $errors->has('instagram_url') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('instagram_url'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('instagram_url') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== Instagram Url =============================-->
                    <div class="form-group row">
                        <label for="snapchat_url" class="col-xs-2 col-form-label text-md-right "> {{_i('Snapchat Url')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="snapchat_url" placeholder="Snapchat Url " name="snapchat_url"  value="{{$setting['snapchat_url']}}"
                                   class="form-control{{ $errors->has('snapchat_url') ? ' is-invalid' : '' }}"  >
                            @if ($errors->has('snapchat_url'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('snapchat_url') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== work time =============================-->
                    <div class="form-group row">
                        <label for="work_time" class="col-xs-2 col-form-label text-md-right "> {{_i('Work Time')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="work_time" placeholder="Work Time " name="work_time"  value="{{$setting['work_time']}}"
                                   class="form-control{{ $errors->has('work_time') ? ' is-invalid' : '' }}" required="" >
                            @if ($errors->has('work_time'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('work_time') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

                    <!----============================== close time =============================-->
                    <div class="form-group row">
                        <label for="close_time" class="col-xs-2 col-form-label text-md-right "> {{_i('Close Time')}} </label>

                        <div class="col-xs-6">
                            <input type="text" id="close_time" placeholder="Close Time " name="close_time"  value="{{$setting['close_time']}}"
                                   class="form-control{{ $errors->has('close_time') ? ' is-invalid' : '' }}" required="" >
                            @if ($errors->has('close_time'))
                                <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('close_time') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <!----============================== address =============================-->
                    <div class="form-group row">
                        <label for="address" class="col-xs-2 col-form-label text-md-right "> {{_i('Address')}} </label>

                        <div class="col-xs-6">
                            <textarea id="address"  class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required="" >{{$setting['address']}}</textarea>
                            @if($errors->has('address'))
                                <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>




                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    {{--<button type="submit" class="btn btn-info pull-left" >--}}
                        {{--Add--}}
                    {{--</button>--}}

                    <button class="btn btn-app"  name="submit" type="submit"  >
                        <i class="fa fa-save" > {{_i('Save')}}</i>

                    </button>
                </div>

                <!-- /.box-footer -->

            </form>

        </div>
    </div>




@endsection



