@extends('admin.layout.index',[
'title' => _i('All Famous'),
'subtitle' => _i('All Famous'),
'activePageName' => _i('All Famous'),
] )

@section('content')

    <div class="row">


        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('All Famous')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        <table id="admin_table" class="table table-bordered table-striped dataTable text-center">
                            {{--                            <a href="{{ route('famousCreate') }}" class="btn btn-primary pull-left"><i--}}
                            {{--                                    class="fa fa-plus"></i>--}}
                            {{--                                {{ _i('Create New Famous User') }}--}}
                            {{--                            </a>--}}
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
            var text = '{{ _i('Create New Famous User') }}';
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
                    {
                        text: '<i class="ti-plus"></i> ' + text,
                        class: 'btn btn-primary create',
                        action: function (e, dt, node, config) {
                            window.location = "create";
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/famous/all')}}',
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
