@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Users Memberships')}}
@endsection

@section('page_header_name')
    {{_i('Users Memberships')}}
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{_i('Users Memberships')}}</h3>
        </div>
        <div class="box-body">
            @include('admin.AdminLayout.message')
            {!! $dataTable->table([
                'class'=> 'table table-bordered table-striped table-responsive'
            ],true) !!}
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection