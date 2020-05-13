
@extends('admin.layout.index',[
'title' => _i('All Cylinder'),
'subtitle' => _i('All Cylinder'),
'activePageName' => _i('All Cylinder'),
'additionalPageUrl' => url('/admin/panel/cylinder/create') ,
'additionalPageName' => _i('Add'),
] )

@section('content')
    <div class="row">
        <div class="col-sm-12 mbl">
            <span class="pull-right">
                <a href="{{ route("cylinder.create") }}" class="btn btn-primary"><i class="ti-plus"></i>{{ _i('Add Cylinder') }}</a>
            </span>
        </div>

    <div class="col-sm-12">
        <div class="card">
        <div class="card-header">
            <h5 class="box-title">{{ _i('Cylinder List') }}</h5>
        </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive text-center">
            <table class="table table-striped table-bordered nowrap text-center" id="list-table">
                <thead>
                <tr>

                    <th>{{_i('ID')}}</th>
                    <th>{{_i('TITLE')}}</th>
                    <th>{{_i('PRICE')}}</th>
                    <th>{{_i('TYPE')}}</th>
                    <th class="lasttd"></th>
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
<script>
    $(function () {
        oTable = $('#list-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: '{!! route('get-cylinder-datatable') !!}',
                type: 'get',
                {{--headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}--}}
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title', orderable: true, searchable: true },
                {data: 'price', name: 'price', orderable: true, searchable: true },
                {data: 'type', name: 'type', orderable: true, searchable: true },
                {data: 'actions', name: 'actions', orderable: false, searchable: false, width : '70px'}
            ]
        });

        $('#list-table').on('click', '.destroy', function (e) {
            e.preventDefault();

            var href = $(this).attr('href');

            bootbox.confirm("{{ _i('Are you sure you want to continue?') }}", function (result) {
                if (result === false) return;

                $.ajax({
                    url: href,
                    method: 'delete',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                     success: function(data) {
                        if (data == "success") {
                            oTable.ajax.reload();
                            growl("{{ _i('Page has been deleted successfully.') }}", "success");
                        } else {
                            growl(data, "warning");
                        }
                    }
                });
            });
        });
    });
</script>
@endpush
<style>
    .lasttd {
        width: 150px !important;
    }
</style>