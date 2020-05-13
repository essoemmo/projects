@extends('admin.AdminLayout.index')

@section('title')
    {{_i('edit')}} {{$lang}}
@endsection

@section('page_header_name')
    {{_i('edit')}} {{$lang->title}}
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('edit')}} {{$lang->title}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('edit')}} {{$lang->title}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page">
            <div class="card-block">
            @include('admin.AdminLayout.message')
            {!! Form::model($lang,['route'=>['languages.update',$lang->id],'class'=>'form-group','files'=>true]) !!}
            <div class="form-group">
                {{Form::label(_i('title'),null,['class'=>'control-label'])}}
                {{Form::text('title',$lang->title,['class'=>'form-control'])}}
                @if ($errors->has('title'))
                    <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label(_i('code'),null,['class'=>'control-label'])}}
                {{Form::text('code',$lang->code,['class'=>'form-control'])}}
                @if ($errors->has('code'))
                    <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('code') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label(_i('flag'),null,['class'=>'control-label'])}}
                {{Form::file('flag',null,['class'=>'form-control'])}}
                <img src="{{url('/uploads/'.$lang->flag)}}" alt="{{$lang->title}}">
                @if ($errors->has('flag'))
                    <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('flag') }}</strong>
                </span>
                @endif
            </div>

            {!! Form::submit(_i('Save'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    </div>

@endsection