@extends('admin.AdminLayout.index')

{{--@section('title')--}}
{{--    {{_i('Add Category')}}--}}
{{--@endsection--}}

@section('header')

@endsection

@section('page_header_name')
    {{_i('Add Category')}}
@endsection

{{--@section('page_url')--}}
{{--    <li ><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>--}}
{{--    <li ><a href="{{url('/adminpanel/category/all')}}">{{_i('All')}}</a></li>--}}
{{--    <li class="active"><a href="{{url('/adminpanel/category/create')}}">{{_i('Add')}}</a></li>--}}
{{--@endsection--}}
 @push('css')
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        @endpush
@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Add Category')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Add Category')}}</a>
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

                      @include("admin.products.products.partial.category_master")
            </div>



    </div>
    </div>


@endsection
