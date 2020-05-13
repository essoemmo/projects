
@extends('admin.layout.index',[
'title' => _i('Attribute Groups'),
'subtitle' => _i('All Attribute Groups'),
'activePageName' => _i('Attribute Groups'),
'additionalPageUrl' => url('/admin/panel/attributegroups/create') ,
'additionalPageName' => _i('Add'),
] )

@section('content')
<div class="row">
    <div class="col-sm-12 mbl">
        <span class="pull-right">
            <a href="{{ route("attributegroups.create") }}" class="btn btn-primary">  <i class="ti-plus"></i> {{ _i('Add Attribute Group') }}</a>
        </span>
    </div>

    <div class="col-sm-12">
        <div class="card">
    <div class="card-header">
        <h5 class="box-title">{{ _i('Attribute Groups List') }}</h5>
        <div class="card-header-right">
            <i class="icofont icofont-rounded-down"></i>
            <i class="icofont icofont-refresh"></i>
            <i class="icofont icofont-close-circled"></i>
        </div>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive text-center">
        <table class="table table-striped table-bordered nowrap text-center" id="list-table">
            <thead>
                <tr>
                    <th>{{_i('ID')}}</th>
                    <th>{{_i('Name')}}</th>
                    <th>{{_i('Sort Order')}}</th>
                    <th>{{_i('Status')}}</th>
                    <th></th>
                    <th class="lasttd"></th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
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
            url: '{!! route('get-attributegroups-datatable') !!}',
            type: 'get',
            {{--headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }--}}
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name', orderable: true, searchable: true },
            { data: 'sort_order', name: 'sort_order', orderable: true, searchable: false },
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
                        growl("{{ _i('Attribute Group has been deleted successfully.') }}", "success");
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