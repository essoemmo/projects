@extends('admin.AdminLayout.index')

@section('title')
    {{_i('create new priority')}}
@endsection

@section('page_header_name')
    {{_i('create new priority')}}
@endsection
@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('create new priority')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('create new priority')}}</a>
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
        {!! Form::open(['route'=>'priority.store','class'=>'form-group']) !!}
        <div class="form-group">
            {{Form::label('name',null,['class'=>'control-label'])}}
            {{Form::text('name',old('name'),['class'=>'form-control'])}}
            @if ($errors->has('name'))
                <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group">
            {{Form::label('color',null,['class'=>'control-label'])}}
            {{Form::color('color',null,['class'=>'form-control'])}}
            @if ($errors->has('color'))
                <span class="text-danger invalid-feedback" role="alert">
                          <strong>{{ $errors->first('color') }}</strong>
                    </span>
            @endif
        </div>
        {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    </div>
</div>

@endsection