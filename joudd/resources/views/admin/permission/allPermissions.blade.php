

@extends('admin.layout.layout')


@section('title')

    Control In All Roles

@endsection


@section('box-title' , 'All Permissions')


@section('page_header')

    <section class="content-header">
        <h1>
            Permissions
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{url('/admin/permission/create')}}">Add Permission</a></li>
            <li ><a href="{{url('/admin/permissions')}}">All Permissions</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">

            <h3 class="box-title">Data Permissions With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-xs-12">
                    <table id="permission_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;"> ID</th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" style="width: 224px;"> Permission Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;"> Created At</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;"> Updated At</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;"> Controll</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
    </div>


@endsection



@section('footer')

    {{--<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>--}}
    {{--<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>--}}

    <script  type="text/javascript">

        $(function() {
            $('#permission_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/permissions/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
//                    {
//                        "mData": "id",
//                        "mRender": function (data, type, row) {
//                            return '<a  class="tooltip-error" data-rel="tooltip" title="Delete" href="javascript:remove(' + data + ')"><i class="ace-icon red fa fa-trash-o bigger-130"></i></a>' +
//                                    ' <a  class="green" data-rel="tooltip" title="Edit" name="aedit" href="javascript:show(' + data + ',' + "'" + row.title + "'" + ')"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
//                        }},
                    {data: 'action', name: 'action', orderable: true, searchable: true}

                ]
            });
        });

    </script>

@endsection

























