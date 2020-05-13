@extends('admin.layout.index',[
'title' => _i('All Roles'),
'activePageName' => _i('All Roles'),
'additionalPageUrl' => url('/admin/panel/role/add') ,
'additionalPageName' => _i('Add'),
] )

@section('content')

    <div class="row">

        <div class="col-sm-12 mbl">
            <span class="pull-left">
                  <a href="{{ url("admin/panel/role/add") }}"  class="btn btn-primary">
                     <i class="ti-plus"></i>{{ _i('create new role') }}
                 </a>
            </span>
        </div>
        <br />

        <!-- /.box-header -->
        <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">
                        <h5> {{ _i('Role List') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>

                    <div class="card-block">
                        <div class="dt-responsive table-responsive text-center">
                            <table id="role_table" class="table table-striped table-bordered nowrap text-center" >
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



        </div>
        <!-- /.box-body -->
    </div>


@endsection

@push('js')
    <script  type="text/javascript">

        $(function() {
            $('#role_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/role/get_datatable')}}',
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

@endpush