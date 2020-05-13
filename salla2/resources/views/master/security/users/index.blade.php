
@extends('master.layout.index',[
'title' => _i('All Users'),
'subtitle' => _i('All Users'),
'activePageName' => _i('All Users'),
] )

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <span class="pull-left">
                          <a href="{{url('master/role/add')}}"  class="btn btn-primary create add-permission">
                                <i class="ti-plus"></i>{{_i('create new role')}}
                            </a>

                    </span>
        </div>

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('All Users')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        <table id="admin_table" class="table table-bordered table-striped dataTable text-center">

                            <thead>
                            <tr role="row">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting" > {{_i('Name')}}</th>
                                <th class="sorting" > {{_i('Email')}}</th>
                                <th class="sorting" > {{_i('Phone')}}</th>
                                <th class="sorting" > {{_i('Created At')}}</th>
                                <th class="sorting" > {{_i('Show')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script  type="text/javascript">
        $(function() {
            $('#admin_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/master/user/all')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                ]
            });
        });

    </script>

@endpush