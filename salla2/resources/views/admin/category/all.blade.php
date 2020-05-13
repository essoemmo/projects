@extends('admin.AdminLayout.index')

@section('title')
    {{_i('All Categories')}}
@endsection

@section('page_header_name')
    {{_i('All Categories')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/adminpanel/category/create')}}">{{_i('Add')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/category/all')}}">{{_i('All')}}</a></li>
@endsection


@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('All Categories')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('All Categories')}}</a>
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

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="role_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('Name')}}</th>
                                <th class="sorting_desc" > {{_i('Sort')}}</th>
                                <th class="sorting" > {{_i('Created At')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <style>
        .table{
            display: table !important;
        }
    </style>
@endsection

@push('js')

    <script  type="text/javascript">

        $(function() {
            $('#role_table').DataTable({ //'id', 'title', 'description','number','store_id', 'parent_id', 'language_id', 'source_id'
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/category/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'number', name: 'number'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

    </script>
@endpush