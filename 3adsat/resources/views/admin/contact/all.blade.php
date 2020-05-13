
@extends('admin.layout.index',[
'title' => _i('Contacts'),
'subtitle' => _i('Contacts'),
'activePageName' => _i('Contacts'),
'additionalPageUrl' => url('/admin/panel/contact/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')
    <div class="row">
        <div class="col-sm-12 mbl">
{{--        <span class="pull-right">--}}
{{--            <a href="{{ route("manufacturers.create") }}" class="btn btn-primary">{{ _i('Add Manufacturer') }}</a>--}}
{{--        </span>--}}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="box-title">{{ _i('Contacts List') }}</h5>
        </div>
        <div class="card-block">
            <table id="contact_table" class="table table-striped table-hover va-middle" >
                <thead>
                <tr>
                    <th>{{_i('ID')}}</th>
                    <th>{{_i('Name')}}</th>
                    <th>{{_i('Email')}}</th>
                    <th>{{_i('Phone')}}</th>
                    <th>{{_i('Country')}}</th>
                    <th>{{_i('Sent Time')}}</th>
                    <th>{{_i('Controll')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection



@push('js')

    <script  type="text/javascript">

        $(function() {
            $('#contact_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/panel/contact/all/getDatatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'country_id', name: 'country_id'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

@endpush