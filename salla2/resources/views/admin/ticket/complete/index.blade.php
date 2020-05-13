@extends('admin.AdminLayout.index')

@section('title')
    {{_i('ticket system')}}
@endsection

@section('page_header_name')
    {{_i('ticket system')}}
@endsection


@section('content')

{{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
{{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

<!-- Page-header start -->
<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('ticket system')}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">{{_i('ticket system')}}</a>
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
        'class'=> 'table table-bordered table-striped table-responsive'
    ],true) !!}
    </div>
</div>
</div>

@push('js')
    {!! $dataTable->scripts() !!}
@endpush

@endsection