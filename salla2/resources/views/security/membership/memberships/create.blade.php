
@extends('admin.AdminLayout.index')

@section('title')

    {{_i('Add User Membership')}}

@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Add User Membership')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/membership/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/membership/create')}}">{{_i('Add')}}</a></li>
@endsection



@section('content')


    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Add User Membership')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Add User Membership')}}</a>
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
        {!! Form::open(['url'=>'/adminpanel/membership/store','class'=>'form-horizontal']) !!}

            <div class="box-body">

                <!----------------------------------  user_id   --------------------------------------------->
                <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="col-sm-2">
                        {{Form::label('title',null,['class'=>'control-label'])}} <strong>:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{Form::text('title',old('title'),['class'=>'form-control'])}}
                        @if ($errors->has('title'))
                            <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('title') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <!----------------------------------  is_active  --------------------------------------------->
                <div class="form-group row {{ $errors->has('is_active') ? ' has-error' : '' }}">
                    <div class="col-sm-2">
                        {{Form::label('Status',null,['class'=>'form-control'])}} <strong>:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{Form::select('is_active',['0'=>'not active','1'=>'active'],old('is_active'),['class'=>'form-control'])}}
                        @if ($errors->has('is_active'))
                            <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('is_active') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <!----------------------------------  price  --------------------------------------------->
                <div class="form-group row {{ $errors->has('price') ? ' has-error' : '' }}">
                    <div class="col-sm-2">
                        {{Form::label('price',null,['class'=>'control-label'])}} <strong>:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{Form::number('price',old('price'),['class'=>'form-control'])}}
                        @if ($errors->has('price'))
                            <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('price') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>

                <!----------------------------------  price  --------------------------------------------->
                <div class="form-group row {{ $errors->has('duration') ? ' has-error' : '' }}">
                    <div class="col-sm-2">
                        {{Form::label('duration',null,['class'=>'control-label'])}} <strong>:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{Form::number('duration',old('duration'),['class'=>'form-control'])}}
                        @if ($errors->has('duration'))
                            <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! Form::submit('add',['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
    </div>


@endsection

