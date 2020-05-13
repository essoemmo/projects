@extends('admin.index')
@section('title', $title)
@section('css')
    <style>
        .account_setting {
            width: 100%;
            background: #ddd;
            text-align: left;
        }
        .account_setting p {
            font-size: 30px;
            font-style: oblique;
        }

    </style>
@endsection
@section('content')

    <div class="col-lg-12 col-md-12 ">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">{{_i('main edit')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="true">{{_i('album managment')}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                        <section class="content">
                            <div class="container-fluid">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">{{_i('edit member')}}</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <form method="post" action="{{route('members.update',$user->id)}}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    {{method_field('put')}}

                                                    <div class="form-group">
                                                        <label>{{_i('member ship')}}</label>
                                                        <select class="form-control select2" style="width: 100%;" name="memberShip">
                                                            <option value="">{{_i('All member ship')}}</option>

                                                            @foreach($members as $member)
                                                                <option value="{{$member->id}}" {{$membership == $member->id ? 'selected' :'' }}>{{$member->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->

                                                    <div class="form-group">
                                                        <label>{{_i('Department')}}</label>
                                                        <select class="form-control select2" style="width: 100%;" name="category">
                                                            <option value=" ">{{_i('All Category')}}</option>
                                                            @foreach(\App\Models\Category::get() as $category)
                                                                <option value="{{$category->id}}" {{$department == $category->id ? 'selected' :'' }}>{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->


                                                    <div class="form-group" style="display: inline-flex;position: relative; right: 487px;">
                                                        <div class="male"  style="    position: relative;left: 80px;}">
                                                            <input type="radio" class="gender" name="gendar" value="male" {{$user->gender == 'male' ? 'checked':''}}><label>{{_i('male')}}</label>
                                                        </div>
                                                        <div class="female" style="    position: relative; right: 80px;}" >
                                                            <input type="radio"  class="gender" name="gendar" value="female" {{$user->gender == 'female' ? 'checked':''}}><label>{{_i('female')}}</label>
                                                        </div>

                                                    </div>


                                                    <div class="form-group">
                                                        <label>{{_i('material_status')}}</label>
                                                        <select class="form-control status" style="width: 100%;" name="material_status_id">
                                                            @if($user->gender == 'male')
                                                                @foreach(\App\Models\Material_status::where('gender','male')->where('lang_id',session('language'))->get() as $matiral)
                                                                    <option value="{{$matiral->id}}" {{$user->material_status_id == $matiral->id ? 'selected': ''}} >{{$matiral->name}}</option>
                                                                @endforeach

                                                            @else
                                                                @foreach(\App\Models\Material_status::where('gender','female')->where('lang_id',session('language'))->get() as $matiral)
                                                                    <option value="{{$matiral->id}}" {{$user->material_status_id == $matiral->id ? 'selected': ''}} >{{$matiral->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label for="photo">
                                                                {{_i('photo')}} <span style="color: #F00;">*</span>
                                                            </label>
                                                            <input type="file" name="photo" class="form-control image">
                                                            @if ($errors->has('photo'))
                                                                <span class="text-danger invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                     </span>
                                                            @endif

                                                            <img src="{{asset('uploads/users/'.$user->photo)}}" style="width: 200px" class="image-preview">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>{{_i('Age')}}</label>
                                                            <input type="text" name="age" class="form-control" value="{{$user->age}}">
                                                        </div>
                                                    </div>
                                                    {{--Account setting--}}
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="account_setting">
                                                        <p>{{_i('account_setting')}}</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('User name')}}</label>
                                                        <input type="text" name="username" class="form-control" value="{{$user->username}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('email')}}</label>
                                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                                    </div>


                                                    {{--                                <div class="form-group">--}}
                                                    {{--                                    <label>{{_i('password')}}</label>--}}
                                                    {{--                                    <input type="password" name="password" class="form-control" value="">--}}
                                                    {{--                                </div>--}}


                                                    {{--                                <div class="form-group">--}}
                                                    {{--                                    <label>{{_i('Password_confirmation')}}</label>--}}
                                                    {{--                                    <input type="password" name="password_confirmation" class="form-control">--}}
                                                    {{--                                </div>--}}

                                                    {{--Address--}}

                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="account_setting">
                                                        <p>{{_i('Address')}}</p>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>{{_i('nationalty')}}</label>
                                                        <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                                                            @php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); @endphp
                                                            @foreach ($nationName as $namenat)
                                                                <option value="{{$namenat->nationalty_id}}" {{$user->nationalty_id == $namenat->nationalty_id ? 'selected':''}}>{{$namenat->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('Country')}}</label>
                                                        <select class="form-control country" name="country" style="width: 100%;">
                                                            @foreach ($nationName as $namenat)
                                                                <option value="{{$namenat->id}}" {{$namenat->id == $user->resident_country_id ?'selected'  : ''}}>{{$namenat->county_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('City')}}</label>
                                                        <select class="form-control city" id="city" name="city" data-id="{{$user->city_id}}" style="width: 100%;">
                                                            {{--                                        <option value="0">0</option>--}}
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('Address')}}</label>
                                                        <textarea type="text" name="address" class="form-control">{{$user->address}}</textarea>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <hr>

                                                    @php

                                                        $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
                                                    @endphp
                                                    {{--                                {{dd(session('language'))}}--}}
                                                    @foreach($group as $gro)

                                                        <div class="account_setting">
                                                            <p>{{_i($gro->title)}}</p>
                                                        </div>
                                                        <div class="row">
                                                            @if($gro->source_id == null)
                                                                @foreach(\App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get() as $option)
                                                                    {{--                                            @foreach($new as $option)--}}
                                                                    <div class="col-md-6">
                                                                        <label>{{_i($option->title)}}</label>
                                                                        <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                                                            @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)
                                                                                <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endforeach

                                                            @else

                                                                @foreach(\App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get() as $option)
                                                                    <div class="col-md-6">
                                                                        <label>{{_i($option->title)}}</label>
                                                                        <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                                                            @if($option->source_id == null)

                                                                                @foreach(\App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get() as $val)
                                                                                    <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
                                                                                @endforeach

                                                                            @else

                                                                                @foreach(\App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get() as $val)
                                                                                    <option value="{{$val->id}}" {{in_array($val->id,$optionValue) ? 'selected' : ''}}>{{$val->title}}</option>
                                                                                @endforeach

                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                @endforeach


                                                            @endif

                                                        </div>



                                                    @endforeach


                                                    <div class="form-group">
                                                        <label>{{_i('About the partener')}}</label>
                                                        <textarea type="text" name="partener" class="form-control ckeditor">{!! $user->partener_info !!}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{_i('About me')}}</label>
                                                        <textarea type="text" name="about_me" class="form-control ckeditor">{!! $user->about_me !!}</textarea>
                                                    </div>


                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-info btn-sm">{{(_i('edit Member'))}}</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->

                                </div>

                                <!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </section>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                        <div class="col-lg-12 col-md-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                        @foreach(\App\Models\Language::get() as $index =>$lang)
                                        <li class="nav-item">
                                            <a class="nav-link {{$index == 0 ? 'active' : ''}}"  data-toggle="pill" href="#{{$lang->code}}" role="tab" aria-controls="{{$lang->code}}" aria-selected="false">{{$lang->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="card-body">

                                    @if($albumm->count() > 0)
                                        <form action="{{route('album-category')}}" method="post" >
                                            {{csrf_field()}}
                                            {{method_field('post')}}

                                            <div class="tab-content">
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                @foreach(\App\Models\Language::get() as $index =>$lang)
                                                    <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$lang->code}}" role="tabpanel-{{$index+1}}" aria-labelledby="custom-tabs-two-home-tab">
                                                    @if(in_array($lang->id,$album))
                                                         @foreach($albumm as $alb)
                                                              @if($lang->id == $alb->lang_id)
                                                                <label>{{_i('category name')}}</label>
                                                                <input type="text" name="{{$lang->code}}_title" value="{{$alb->category}}" class="form-control">
                                                                  <input type="hidden" name="lang_id[]" value="{{$alb->lang_id}}">
                                                            @endif
                                                        @endforeach

                                                        @else

                                                         <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$lang->code}}" role="tabpanel-{{$index}}" aria-labelledby="custom-tabs-two-home-tab">
                                                            <label>{{_i('category name')}}</label>
                                                            <input type="text" name="{{$lang->code}}_title" class="form-control">

                                                          </div>

                                                    @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-6">{{_i('publish')}}</label>
                                                <div class="col-md-6">
                                                    <input type="radio" name="publish" {{$albumCat->published == 'true' ? 'checked' : ''}} value="true">{{_i('true')}}
                                                    <input type="radio" name="publish" {{$albumCat->published == 'false' ? 'checked' : ''}} value="false">{{_i('false')}}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-6">{{_i('block')}}</label>
                                                <div class="col-md-6">
                                                    <input type="radio" name="block" {{$albumCat->block == 'true' ? 'checked' : ''}} value="true">{{_i('true')}}
                                                    <input type="radio" name="block" {{$albumCat->block == 'false' ? 'checked' : ''}}  value="false">{{_i('false')}}
                                                </div>
                                            </div>

                                            <div class="footer">
                                                <button type="submit" class="btn btn-info btn-sm">{{_i('enter')}}</button>
                                            </div>
                                        </form>
                                        @else
                                        <form action="{{route('album-category')}}" method="post" >
                                            {{csrf_field()}}
                                            {{method_field('post')}}
                                            <input type="hidden" name="user_id" value="{{$user->id}}">

                                            <div class="tab-content">

                                                @foreach(\App\Models\Language::get() as $index =>$lang)

                                                    <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$lang->code}}" role="tabpanel-{{$index}}" aria-labelledby="custom-tabs-two-home-tab">
                                                        <label>{{_i('category name')}}</label>
                                                        <input type="text" name="{{$lang->code}}_title" class="form-control">

                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <label>{{_i('publish')}}</label>
                                                <div class="col-md-12">
                                                    <input type="radio" name="publish" value="true">{{_i('true')}}
                                                    <input type="radio" name="publish"  value="false">{{_i('false')}}
                                                </div>
                                                <label>{{_i('block')}}</label>
                                                <div class="col-md-12">
                                                    <input type="radio" name="block"  value="true">{{_i('true')}}
                                                    <input type="radio" name="block" value="false">{{_i('false')}}
                                                </div>
                                            </div>

                                            <div class="footer">
                                                <button type="submit" class="btn btn-info btn-sm">{{_i('enter')}}</button>
                                            </div>
                                        </form>
                                        @endif

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group">
                            <label>{{_i('album')}}</label>
                            <div class="dropzone options" id="dropzonefield" style="border: 1px solid #452A6F;margin: 10px">

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {



            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('getCity') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        if (response.status){
                            $('.city').empty();
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{_i('Sorry not found city to this country')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }

                        $('.city').empty();

                        for (var i = 0; i < response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                            $('.city').val({{$user->city_id}});

                        }

                    }
                });

            });

            $('.country').trigger('change');

            // $('.gender').trigger('click');


            $('body').on('click','input[type=radio]',function (e) {
                // e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '{{ route('statue-user') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        console.log(response.data);
                        $('.status').empty();
                        for (var i = 0; i < response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });

            });

        });
        Dropzone.autoDiscover = false;
        var drop;
        $(document).ready(function () {
            'use strict';
            drop = $('#dropzonefield').dropzone({
                url: "{{url('admin/members/upload/image/'.$user->id)}}",
                paramName:'file' ,
                uploadMultiple:true ,
                maxFiles:10,
                maxFilesize:5,
                dictDefaultMessage:"{{_i('Click here to upload files or drag and drop files here')}}",
                dictRemoveFile:"{{ _i('Delete') }}",
                acceptedFiles:'image/*',
                autoProcessQueue: true,
                parallelUploads:1,
                removeType: "server",
                params:{
                    _token: '{{csrf_token()}}' ,
                },
                addRemoveLinks:true,
                removedfile: function (file) {
                    if(drop[0].dropzone.options.removeType == "server") {
                        $.ajax({
                            dataType:'json',
                            type:'POST',
                            url:'{{url('admin/members/delete/image/'.$user->id)}}',
                            data:{file:file.name,_token:'{{csrf_token()}}'},
                        });
                        var fmock;
                        return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                    }else{
                        file.previewElement.remove();
                    }
                },
                success:function (file,response) {
                    file.id = response.id;
                }
            });
                    @foreach($user->files->where('main',0) as $photo)
            var file = { id: '{{$photo->id}}', name: '{{$photo->tag}}', type: "image/*" };
            var url = '{{ asset($photo->image) }}';
            drop[0].dropzone.emit("addedfile", file);
            drop[0].dropzone.emit("thumbnail", file, url);
            drop[0].dropzone.emit("complete", file);
            @endforeach
        });

        function uploadFiles(){
            drop[0].dropzone.processQueue();
        }
    </script>
@endpush
