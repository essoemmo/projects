
@extends('admin.layout.index',[
'title' => _i('NewsLetters'),
'subtitle' => _i('NewsLetters'),
'activePageName' => _i('NewsLetters'),
'additionalPageUrl' => url('/admin/panel/newsletters/all') ,
'additionalPageName' => _i('All'),
] )


@section('content')
    <div class="row">
        <div class="col-sm-12 mbl">
                    <span class="pull-right">
                        <a href="{{ url("admin/panel/newsletters/export") }}" class="btn btn-primary">
                            <i class="ti-download"></i> {{ _i('Export') }}</a>
                    </span>
        </div>
    </div>
    <div class="card box-info">
        <div class="card-header">
            <h5 class="box-title">{{ _i('NewsLetters') }}</h5>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
                <i class="icofont icofont-refresh"></i>
                <i class="icofont icofont-close-circled"></i>
            </div>
        </div>
        <div class="card-body">
            <table id="contact_table" class="table table-striped table-hover va-middle" >
                <thead>
                <tr>
                    <th>{{_i('ID')}}</th>
                    <th>{{_i('Email')}}</th>
                    <th>{{_i('Sent Time')}}</th>
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
                ajax: '{{url('/admin/panel/newsletters/get_datatable')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        });

    </script>

@endpush



