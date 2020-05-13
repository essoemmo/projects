@extends('admin.layout.layout')

@section('title')
    {{_i('Product Features')}}
@endsection

@section('page_header_name')
    {{_i('Product Features')}}
@endsection

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{_i('Product Features')}}</h3>
        </div>
        <div class="box-body">
            @include('admin.AdminLayout.message')
            {!! $dataTable->table([
                'class'=> 'table table-bordered table-striped table-responsive text-center'
            ],true) !!}
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection