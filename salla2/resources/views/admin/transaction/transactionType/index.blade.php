@extends('admin.AdminLayout.index')

@section('title')
    {{_i('transactionType')}}
@endsection

@section('page_header_name')
    {{_i('transactionType')}}
@endsection


@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('transactionType')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('transactionType')}}</a>
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
                {!! $dataTable->table([
                    'class'=> 'table table-bordered table-responsive text-center'
                ],true) !!}
            </div>
        </div>
        {{--    ===========================create modal =============================--}}
        <div class="modal fade" id="create" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{_i('Create New transactionType')}}</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'transactionType.store','class'=>'form-group']) !!}
                        <div class="form-group">
                            {{Form::label('title',null,['class'=>'control-label'])}}
                            {{Form::text('title',old('title'),['class'=>'form-control'])}}
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label('code',null,['class'=>'control-label'])}}
                            {{Form::text('code',old('code'),['class'=>'form-control'])}}
                            @if ($errors->has('code'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label('main',null,['class'=>'control-label'])}}
                            {{Form::select('main',[0=>_i('backend'),1=>_i('frontend')],null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                            @if ($errors->has('main'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('main') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{Form::label('status',_i('transaction status'),['class'=>'control-label'])}}
                            {{Form::select('status',['myfatoorah'=>_i('myfatoorah'),'paypal'=>_i('paypal')],null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                            @if ($errors->has('status'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>
                        {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


        {{--    ============================edit modal=========================--}}
        <form action="" method="POST" class="edit-record-model" data-parsley-validate="">
            <div class="modal fade" id="modal-edit" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{_i('Edit transactionType')}}</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(function () {
                'use strict'
                $('.create').attr('data-toggle', 'modal').attr('data-target', '#create');
            })
        </script>
    @endpush

    <style>
        .table {
            display: inline-table !important;
        }
    </style>
@endsection
