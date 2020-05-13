@extends('admin.layout.layout')


@section('title')

     {{_i('All Roles')}}

@endsection


@section('box-title' )
    {{_i('Roles')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Roles')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/group/add')}}">{{_i('Add Role')}}</a></li>
            <li ><a href="{{url('/admin/allRoles')}}">{{_i('All Roles')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')



    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data Rolles With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="role_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row"><th class="sorting" > {{_i('ID')}}</th>
                                <th class="sorting_desc"  > {{_i('Role Name')}}</th>
                                <th class="sorting" > {{_i('Created At')}}</th>
                                <th class="sorting"  > {{_i('Updated At')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
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
            $('#role_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/roles/get_datatable')}}',
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
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection