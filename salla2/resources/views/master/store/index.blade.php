
@extends('master.layout.index',[
'title' => _i('All Stores'),
'subtitle' => _i('All Stores'),
'activePageName' => _i('All Stores'),

] )

@section('content')

    <div class="row">

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('All Stores')}}</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        <table id="draw_datatable" class="table table-bordered table-striped dataTable text-center">
                            <thead>
                            <tr role="row " class="text-center">
                                <th class="sorting"  > {{_i('ID')}}</th>
                                <th class="sorting" > {{_i('Title')}}</th>
                                <th class="sorting" > {{_i('Domain')}}</th>
                                <th class="sorting" > {{_i('Package')}}</th>
                                <th class="sorting" > {{_i('Controll')}}</th>
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
            $('#draw_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/master/store/all')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'domain', name: 'domain'},
                    {data: 'membership_id', name: 'membership_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>

@endpush