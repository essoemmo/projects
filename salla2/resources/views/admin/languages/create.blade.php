@extends('admin.AdminLayout.index')

@section('title')
    {{_i('create new language')}}
@endsection

@section('page_header_name')
    {{_i('create new language')}}
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('add new language')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('add new language')}}</a>
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
            {!! Form::open(['route'=>'languages.store','class'=>'form-group','files'=>true]) !!}
            <div class="form-group">
                {{Form::label(_i('title'),null,['class'=>'control-label'])}}
                {{Form::text('title',old('title'),['class'=>'form-control'])}}
                @if ($errors->has('title'))
                    <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label(_i('code'),null,['class'=>'control-label'])}}
                {{Form::text('code',null,['class'=>'form-control'])}}
                @if ($errors->has('code'))
                    <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('code') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label(_i('flag'),null,['class'=>'control-label'])}}
                {{Form::file('flag',null,['class'=>'form-control'])}}
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