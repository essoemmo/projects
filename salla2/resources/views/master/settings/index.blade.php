@extends('master.layout.index',[
'title' => _i('Settings'),
'subtitle' => _i('Settings'),
'activePageName' => _i('Settings'),

] )

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Site Settings') }} </h5>
                    <div class="card-header-right ">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
{{--                        <select class="col-sm-3" name="lang_id">--}}
{{--                            <option selected disabled="">{{_i('CHOOSE')}}</option>--}}
{{--                            @foreach($langs = \App\Models\Language::get() as $lang)--}}
{{--                                <option value="{{$lang->id}}">{{$lang->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
            <!-- form start -->

                    <form method="POST" action="{{ url('/master/settings') }}" class="form-horizontal"  id="demo-form" enctype="multipart/form-data" data-parsley-validate="" >
                        @csrf

                        <div class="">
                              <!-- ================================== Attachments =================================== -->
                            @if($setting != null)
                                <div class="form-group row">

                                    <label class="col-sm-2 col-form-label">{{_i('Logo')}}</label>
                                    <div class="col-sm-4">
                                         <div class="">
{{--                                        <img class="img-responsive pad"  src="{{ asset($setting->logo) }}" style=" margin-left:190px; margin-top:-170px;">--}}
                                        <img class="img-responsive pad"  src="@if($setting != null) {{ asset($setting->logo) }} @endif" style="max-width: 150px; max-height: 150px; !important;">
                                    </div>
                                        <input type="file" name="logo" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*"
                                               value="{{old('logo')}}">
                                        <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                                    </div>

                                    <!-- Photo -->
                                </div>

                            @else
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{_i('Logo')}}</label>
                                <div class="col-sm-4">
                                    <input type="file" name="logo" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*"
                                           value="{{old('logo')}}">
                                    <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-responsive pad" id="setting_img" style="max-width: 150px; max-height: 150px; !important;" >
{{--                                    <img class="img-responsive pad" id="setting_img" style="width: 150px; margin-left:190px; margin-top:-170px;">--}}
                                </div>
                                <!-- Photo -->
                            </div>
                            @endif
                        <!----============================== language =============================-->
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="lang_id" required="">
                                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                                        @foreach($languages as $lang)
                                            <option value="{{$lang->id}}" @if($setting != null) {{$setting['lang_id']==$lang->id?"selected":""}} @endif>{{_i($lang->title)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!----============================== title =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Website Name')}} </label>

                                <div class="col-sm-6">
                                    <input type="text"  placeholder="title" name="title"  value="@if($setting != null) {{$setting['title']}} @endif"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required="" >
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('title') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>
                            <!----============================== Email =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Email')}} </label>

                                <div class="col-sm-6">
                                    <input type="email"  placeholder="Email" name="email"  value="@if($setting != null) {{$setting['email']}} @endif" data-parsley-type="email"
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
                                <label for="phone" class="col-sm-2 control-label "> {{_i('Phone')}} </label>

                                <div class="col-sm-6">
                                    <input id="phone" type="number" placeholder="{{_i('Phone')}}" name="phone1"  value="@if($setting != null){{$setting['phone1']}}@endif"
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
                                <label for="phone2" class="col-sm-2 control-label "> {{_i('Another Phone')}} </label>

                                <div class="col-sm-6">
                                    <input type="text" type="number" id="phone2" placeholder="{{_i('Another Phone')}}" name="phone2"  value="@if($setting != null) {{$setting['phone2']}} @endif"
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
                                <label for="facebook_url" class="col-sm-2 control-label "> {{_i('Facebook Url')}} </label>

                                <div class="col-sm-6">
                                    <input type="text" id="facebook_url" placeholder="{{_i('Facebook Url')}}" name="facebook_url"  value="@if($setting != null){{$setting['facebook_url']}}@endif"
                                           class="form-control{{ $errors->has('facebook_url') ? ' is-invalid' : '' }}" data-parsley-type="url"  >
                                    @if ($errors->has('facebook_url'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('facebook_url') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>

                            <!----============================== YouTube Url =============================-->
{{--                            <div class="form-group row">--}}
{{--                                <label for="youtube_url" class="col-sm-2 control-label "> {{_i('YouTube Url')}} </label>--}}

{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="text" id="youtube_url" placeholder="YouTube Url " name="youtube_url"  value="{{$setting['youtube_url']}}"--}}
{{--                                           class="form-control{{ $errors->has('youtube_Url') ? ' is-invalid' : '' }}"  >--}}
{{--                                    @if ($errors->has('youtube_Url'))--}}
{{--                                        <span class="text-danger invalid-feedback" >--}}
{{--                                    <strong>{{ $errors->first('youtube_Url') }}</strong>--}}
{{--                                 </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!----============================== Twitter Url =============================-->
                            <div class="form-group row">
                                <label for="twitter_url" class="col-sm-2 control-label"> {{_i('Twitter Url')}} </label>

                                <div class="col-sm-6">
                                    <input type="text" id="twitter_url" placeholder="{{_i('Twitter Url')}} " name="twitter_url"  value="@if($setting != null){{$setting['twitter_url']}}@endif"
                                           class="form-control{{ $errors->has('twitter_url') ? ' is-invalid' : '' }}" data-parsley-type="url" >
                                    @if ($errors->has('twitter_url'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('twitter_url') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>
                            <!----============================== Instagram Url =============================-->
                            <div class="form-group row">
                                <label for="instagram_url" class="col-sm-2 control-label"> {{_i('Instagram Url')}} </label>

                                <div class="col-sm-6">
                                    <input type="text" id="instagram_url" placeholder="{{_i('Instagram Url ')}}" name="instagram_url"  value="@if($setting != null){{$setting['instagram_url']}}@endif"
                                           class="form-control{{ $errors->has('instagram_url') ? ' is-invalid' : '' }}"  data-parsley-type="url">
                                    @if ($errors->has('instagram_url'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('instagram_url') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>

                            <!----============================== Instagram Url =============================-->
{{--                            <div class="form-group row">--}}
{{--                                <label for="snapchat_url" class="col-sm-2 control-label"> {{_i('Snapchat Url')}} </label>--}}

{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="text" id="snapchat_url" placeholder="Snapchat Url " name="snapchat_url"  value="{{$setting['snapchat_url']}}"--}}
{{--                                           class="form-control{{ $errors->has('snapchat_url') ? ' is-invalid' : '' }}"  >--}}
{{--                                    @if ($errors->has('snapchat_url'))--}}
{{--                                        <span class="text-danger invalid-feedback" >--}}
{{--                                    <strong>{{ $errors->first('snapchat_url') }}</strong>--}}
{{--                                 </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <!----============================== work time =============================-->
                            <div class="form-group row">
                                <label for="work_time" class="col-sm-2 control-label "> {{_i('Work Time')}} </label>

                                <div class="col-sm-6">
                                    <input type="text" id="work_time" placeholder="Work Time " name="work_time"  value="@if($setting != null) {{$setting['work_time']}} @endif"
                                           class="form-control{{ $errors->has('work_time') ? ' is-invalid' : '' }}" >
                                    @if ($errors->has('work_time'))
                                        <span class="text-danger invalid-feedback" >
                                    <strong>{{ $errors->first('work_time') }}</strong>
                                 </span>
                                    @endif
                                </div>
                            </div>

                            <!----============================== close time =============================-->
{{--                            <div class="form-group row">--}}
{{--                                <label for="close_time" class="col-sm-2 control-label "> {{_i('Close Time')}} </label>--}}

{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="text" id="close_time" placeholder="Close Time " name="close_time"  value="{{$setting['close_time']}}"--}}
{{--                                           class="form-control{{ $errors->has('close_time') ? ' is-invalid' : '' }}" required="" >--}}
{{--                                    @if ($errors->has('close_time'))--}}
{{--                                        <span class="text-danger invalid-feedback" >--}}
{{--                                    <strong>{{ $errors->first('close_time') }}</strong>--}}
{{--                                 </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!----============================== address =============================-->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label"> {{_i('Address')}} </label>

                                <div class="col-sm-6">
                                    <textarea id="address"  class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address">@if($setting != null) {{$setting['address']}} @endif</textarea>
                                    @if($errors->has('address'))
                                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <!----============================== description =============================-->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label"> {{_i('Description')}} </label>

                                <div class="col-sm-6">
                                    <textarea id="description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"  >@if($setting != null) {{$setting['description']}} @endif</textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!----============================== translation =============================-->
                            @if($setting != null)
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 control-label"> {{_i('Translate To')}} : </label>


                                    <div class="col-sm-6" >
                                       @foreach($langs as $lang)
                                       <button class="btn btn-primary create add-permissiont" type="button" value="{{$lang->id}}" name="lang_id" id="trans_select"
                                               data-toggle="modal" data-target="#exampleModal">
                                       <span><i class="ti-plus"></i> {{$lang->title}} </span>
                                      </button>
                                        @endforeach
                                    </div>



                                    {{-- <div class="col-sm-6" >
                                        <select class="form-control lang_ex" id="trans_select" name="lang_id" >
                                            <option selected disabled="">{{_i('CHOOSE')}}</option>
                                            @foreach($langs as $lang)
                                                <option  value="{{$lang->id}}">{{$lang->title}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                            @endif


                        </div>


                         <div class="form-group row text-center">

                                    <div class="col-sm-10" >
                                        <button type="submit" class="btn btn-primary col-sm-10 "> {{ _i('Save') }}</button>
                                    </div>
                             </div>
                        <!-- /.box-body -->

                        <!-- /.box-footer -->

                    </form>


                </div>

            </div>
        </div>

    </div>

    <!--------------------------------------------- modal trans start ----------------------------------------->
        <div class="modal fade modal_create" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="header"> {{_i('Trans To')}} : </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{url('/master/settings/lang/store')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">

                        {{method_field('post')}}
                        {{csrf_field()}}

                        <input type="hidden" name="id" id="id_data" value="@if($setting != null) {{$setting['id']}} @endif">
                        <input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

                        <div class="box-body">
                            <!----============================== title =============================-->
                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label "> {{_i('Website Name')}} </label>

                                <div class="col-md-10">
                                    <input type="text"  placeholder="{{_i('Website Title')}}" name="title"  value=""
                                           class="form-control" required="" id="titletrans" >
                                </div>
                            </div>

                            <!----============================== description =============================-->
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label"> {{_i('Description')}} </label>

                                <div class="col-sm-10">
                                    <textarea id="descriptiontrans"  class="form-control" name="description" placeholder="{{_i('Website Description')}}"  ></textarea>

                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

                            <button type="submit" class="btn btn-primary" >
                                {{_i('Add')}}
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------------------------- modal trans end ------------------------------->

@endsection

@push('js')
    <script>


        $(function () {
            'use strict';
            $('body').on('click','#trans_select',function(e){
                e.preventDefault();
                var lang_id = $(this).val();

                var modal = $('#exampleModal');
                    modal.modal('show');
                // end show modal

             // get row translation
                var transRowId = `@if($setting != null) {{$setting['id']}} @endif`;

                $.ajax({
                    url: '{{ url('master/settings/get/lang/value') }}',
                    method: "get",
                    data: {
                        lang_id: lang_id,
                        transRowId: transRowId,
                    },
                    success: function (response) {
                        if (response.data == 'false'){
                            $('#titletrans').val('');
                            $('#descriptiontrans').val('');
                        }else{
                            // console.log(response.data.title);
                            $('#titletrans').val(response.data.title);
                            $('#descriptiontrans').val(response.data.description);
                        }

                    }
                }); // end get translation values

            // get lang title
                $.ajax({
                    url: '{{ url('master/get/lang') }}',
                    method: "get",
                    data: {
                        lang_id: lang_id,
                    },
                    success: function (response) {
                        $('#header').empty();
                        $('#header').text('Translate to : '+response);

                        $('#lang_id_data').val(lang_id);
                    }
                }); // end get language title

            });


        });

        // submit translate lang && save translation
        $('body').on('submit','#lang_submit',function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                url: url,
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Translated Successfully')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        $('.modal.modal_create').modal('hide');
                    }
                },
            });

        })


    </script>
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
    </script>

@endpush




