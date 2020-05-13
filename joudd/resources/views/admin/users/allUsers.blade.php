

@extends('admin.layout.layout')


@section('title')

    {{_i('Control In All Users')}}

@endsection


@section('box-title' , 'Roles')


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Users')}}
            {{--<small>{{_i('Control panel')}}</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/user/create')}}">{{_i('Add User')}}</a></li>
            <li ><a href="{{url('/admin/user/all')}}">{{_i('All Users')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data User With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="users-table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" > {{_i('ID')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('First Name')}}</th>
                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i('Last Name')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" > {{_i('Email')}} </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('Created At')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i('Updated At')}}</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" > {{_i('Controll')}}</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>


@endsection




@section('footer')



    <script  type="text/javascript">

        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/users/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
//                    {
//                        "mData": "id",
//                        "mRender": function (data, type, row) {
//                            return '<a  class="tooltip-error" data-rel="tooltip" title="Delete" href="javascript:remove(' + data + ')"><i class="ace-icon red fa fa-trash-o bigger-130"></i></a>' +
//                                    ' <a  class="green" data-rel="tooltip" title="Edit" name="aedit" href="javascript:show(' + data + ',' + "'" + row.title + "'" + ')"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
//                        }},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection





