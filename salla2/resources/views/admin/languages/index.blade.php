@extends('admin.AdminLayout.index')

@section('title')
    {{_i('languages')}}
@endsection

@section('page_header_name')
    {{_i('languages')}}
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('languages')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('languages')}}</a>
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
                'class'=> 'table table-striped table-bordered nowrap dataTable text-center'
            ],true) !!}
        </div>
    </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection