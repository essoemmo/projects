
@extends('master.layout.index',[
'title' => _i('Contacts'),
'subtitle' => _i('Contacts'),
'activePageName' => _i('Contacts'),

] )


@section('content')

    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
            @include('admin.AdminLayout.message')
            {!! $dataTable->table([
                'class'=> 'table table-striped table-bordered   text-center'
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
    </style>
@endsection
