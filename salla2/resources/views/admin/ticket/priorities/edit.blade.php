@extends('admin.AdminLayout.index')

@section('title')
    edit {{$priority->name}}
@endsection

@section('page_header_name')
    edit {{$priority->name}}
@endsection
@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('edit')}} {{$priority->name}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('edit')}} {{$priority->name}}</a>
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
            {!! Form::model($priority,['method'=>'PUT','route'=>['priority.update',$priority->id],'class'=>'form-group']) !!}
            <div class="form-group">
                {{Form::label('name',null,['class'=>'control-label'])}}
                {{Form::text('name',$priority->name,['class'=>'form-control'])}}
                @if ($errors->has('name'))
                    <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('color',null,['class'=>'control-label'])}}
                {{Form::color('color',$priority->color,['class'=>'form-control'])}}
                @if ($errors->has('color'))
                    <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('color') }}</strong>
                    </span>
                @endif
            </div>
            {!! Form::submit('update',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    </div>

@endsection