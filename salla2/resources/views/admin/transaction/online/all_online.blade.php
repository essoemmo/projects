
@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Online Transactions')}}
@endsection

@section('page_header_name')
    {{_i('Online Transactions')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
@endsection

@section('content')
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page " id="blog">
            <div class="card-block text-center">
                {!! $dataTable->table([
                    'class'=> 'table table-bordered table-striped  text-center'
                ],true) !!}
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection