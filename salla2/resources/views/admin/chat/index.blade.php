@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Chat Room')}}
@endsection

@section('page_header_name')
    {{_i('Chat Room')}}
@endsection


@section('content')



    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Chat Room')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Chat Room')}}</a>
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
            <chat-app :user="{{auth()->user()}}"></chat-app>
        </div>
    </div>
    </div>
@push('app')

    <script src="{{ asset('js/app.js') }}"></script>
    @endpush
@endsection
