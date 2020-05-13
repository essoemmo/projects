@extends('admin.index')

@section('title')
    {{_i('All Roles')}}
@endsection

@section('page_header_name')
    {{_i('All Roles')}}
@endsection

@section('page_url')
    <li><a href="{{url('/admin')}}" class="btn btn-default"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/admin/role/all')}}" class="btn btn-success">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/admin/role/add')}}" class="btn btn-primary">{{_i('Add')}}</a></li>
@endsection
@section('css')
@endsection

@section('content')



    <div class="box box-info">

        <div class="box-header">

            {{--<h3 class="box-title">Data Rolles With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <table id="role_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting_desc" > {{_i('Role Name')}}</th>
                                <th class="sorting" > {{_i('Created At')}}</th>
                                <th class="sorting" > {{_i('Updated At')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
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
    <script  type="text/javascript">

        $(function() {
            $('#role_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/role/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endsection