@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Countries')}}
@endsection

@section('page_header_name')
    {{_i('Countries')}}
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

        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Countries')}}</a>
                </li>
            </ul>
        </div>

        <div style="clear:both;"></div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->

        <div class="card blog-page" id="blog">
            <div class="card-title">
                <h5>{{_i('Countries')}}</h5>
            </div>
            <div class="card-block">
            @include('admin.AdminLayout.message')
            {!! $dataTable->table([
                'class'=> 'table table-bordered table-striped table-responsive text-center'
            ],true) !!}
        </div>
    </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
    <style>
        .table{
            display: table !important;
        }
        td img{
            width: 50px;
            height: 50px;
        }

        .dataTables_length{

            float: right;
            margin-top: -67px;
            margin-right: -261px;

            }


            .dataTables_filter{
                margin-top: -65px;
            }

    </style>
@endsection
