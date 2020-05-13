@extends('admin.AdminLayout.index')

@section('title')
    {{_i('edit')}} {{$store->title}}
@endsection

@section('page_header_name')
    {{_i('edit')}} {{$store->title}}
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}


    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('edit')}} {{$store->title}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('edit')}} {{$store->title}}</a>
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
            {!! Form::model($store,['route'=>['store.update',$store->id],'class'=>'form-group','files'=>true]) !!}
            <div class="form-group row">
                <div class="col-md-6">
                    {{Form::label('title',null,['class'=>'control-label'])}}
                    {{Form::text('title',$store->title,['class'=>'form-control'])}}
                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-6">
                    {{Form::label('domain',null,['class'=>'control-label'])}}
                    {{Form::text('domain',$store->domain,['class'=>'form-control'])}}
                    @if ($errors->has('domain'))
                        <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('domain') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{Form::label('memberships',null,['class'=>'control-label'])}}
                    {{Form::select('membership_id',$memberships,$store->membership_id,['class'=>'form-control','placeholder'=>'select ...'])}}
                    @if($errors->has('memberships'))
                        <span class="text-danger invalid-feedback" role="alert">
                            {{$errers->first('memberships')}}
                        </span>
                    @endif
                </div>
                <div class="col-md-4">
                    {{Form::label('users',null,['class'=>'control-label'])}}
                    {{Form::select('owner_id',$users,$store->owner_id,['class'=>'form-control','placeholder'=>'select ...'])}}
                    @if($errors->has('users'))
                        <span class="text-danger invalid-feedback" role="alert">
                            {{$errers->first('users')}}
                        </span>
                    @endif
                </div>
                <div class="col-sm-4">
                    <label class="control-label" for="image">{{_i('image')}}</label>
                    <div class="form-control">
                        <input type="file" name="image" style="width: 100%;" id="image" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png,image/jpg"
                               value="{{old('image')}}">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>
                    </div>
                    <!-- Photo -->
                    <img class="img-responsive pad" value="{{$store->image}}" id="setting_img" style="margin-top: 20px">
                </div>
            </div>

            {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        </div>
    </div>
    @push('js')
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

@endsection