@extends('admin.layout.index',[
'title' => _i('All Members'),
'subtitle' => _i('All Members'),
'activePageName' => _i('All Members'),
] )

@section('content')

    <div class="row">
        {{--        <div class="col-sm-12 ">--}}
        {{--           <span class="pull-left">--}}
        {{--               <a href="{{url('admin/user/add')}}"  class="btn btn-primary create add-permission">--}}
        {{--                   <i class="ti-plus"></i>{{_i('create new user')}}--}}
        {{--               </a>--}}
        {{--           </span>--}}
        {{--        </div>--}}

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('All Members')}}</h5>
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
                                <th class="print"> {{_i('Membership No')}}</th>
                                <th class="print"> {{_i('Name')}}</th>
                                <th class="print"> {{_i('Email')}}</th>
                                <th> {{_i('Image')}}</th>
                                <th class="print" style="display: none"> {{_i('Social Links')}}</th>
                                <th class="print" style="display: none"> {{_i('Gender')}}</th>
                                <th class="print" style="display: none"> {{_i('Phone')}}</th>
                                <th> {{_i('Status')}}</th>
                                <th> {{_i('Created At')}}</th>
                                <th> {{_i('Edit')}}</th>
                                <th> {{_i('Delete')}}</th>
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

    <script type="text/javascript">

        $(function () {
            $('#admin_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ['.print'],
                            stripHtml: false
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/user/all')}}',
                columns: [
                    {data: 'membership_number', name: 'membership_number'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'user_social', name: 'user_social', visible: false, orderable: false, searchable: false},
                    {data: 'gender', name: 'gender', visible: false, orderable: false, searchable: false},
                    {data: 'phone', name: 'phone', visible: false, orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endpush
