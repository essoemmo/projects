@extends('admin.AdminLayout.index')

@section('title')
    {{_i('add agent')}}
@endsection

@section('page_header_name')
    {{_i('add agent')}}
@endsection
@section('content')
    @push('js')
        <script>
            $(document).ready(function() {
                $(".e2").select2({
                    placeholderr: "choose users",
                    multiple:true
                });
            });
        </script>
    @endpush
     @push('app')
        <script src="{{asset('/js/app.js')}}"></script>
    @endpush
    @push('css')
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                color: #333;
            }
        </style>
    @endpush
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('add agent')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('add agent')}}</a>
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

            <list-users></list-users>
        </div>
    </div>
    </div>

  
@endsection
