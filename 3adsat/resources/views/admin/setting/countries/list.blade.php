@extends('admin.layout.master', [
'title' => _i('Countries'),
'subtitle' => "",
'breadcrumb' => [_i('Countries')]
])
@section('content')
<div class="row">
    <div class="col-sm-12 mbl">
        <span class="pull-right">
            <a href="{{ route("countries.create") }}" class="btn btn-primary">{{ _i('Add Country') }}</a>
        </span>
    </div>
</div>
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">{{ _i('Countries List') }}</h3>
    </div>
    <div class="box-body">
        <table class="table table-striped table-hover va-middle" id="list-table">
            <thead>
                <tr>
                    <th>{{_i('ID')}}</th>
                    <th>{{_i('Name')}}</th>
                    <th>{{_i('ISO Code')}}</th>
                    <th>{{_i('Status')}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(function() {
    oTable = $('#list-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: '{!! route('countries-datatable') !!}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name', orderable: true, searchable: true },
            { data: 'iso_code', name: 'iso_code', orderable: true, searchable: true },
            { data: 'status', name: 'status', searchable: false },
            { data: 'created_at', name: 'created_at', searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, width: '70px' }
        ]
    });

    $('#list-table').on('click', '.destroy', function(e) {
        e.preventDefault();

        var href = $(this).attr('href');

        bootbox.confirm("{{ _i('Are you sure you want to continue?') }}", function(result) {
            if (result === false) return;

            $.ajax({
                url: href,
                method: 'delete',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    if (data == "success") {
                        oTable.ajax.reload();
                        growl("{{ _i('Country has been deleted successfully.') }}", "success");
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