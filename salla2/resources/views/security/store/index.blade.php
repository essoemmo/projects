@extends('admin.AdminLayout.index')

@section('title')
    {{_i('stores')}}
@endsection

@section('page_header_name')
    {{_i('stores')}}
@endsection


@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{_i('stores')}}</h3>
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