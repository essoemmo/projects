
@extends('admin.layout.index',[
    'title' => _i('All Lenses'),
    'subtitle' => _i('All Lenses'),
    'activePageName' => _i('All Lenses'),
    'additionalPageUrl' => url('/admin/panel/lens/create') ,
    'additionalPageName' => _i('Add'),
    ] )

    @section('content')
        <div class="row">
            <div class="col-sm-12 mbl">
                <span class="pull-right">
                    <a href="{{ route("lens.create") }}" class="btn btn-primary"><i class="ti-plus"></i>{{ _i('Add Lenses') }}</a>
                     @include("admin.translate_buttons",["table" => "tbl_lenses"])

                </span>
            </div>

        <div class="col-sm-12">
            <div class="card">
            <div class="card-header">
                <h5 class="box-title">{{ _i('Lenses List') }}</h5>
            </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive text-center">
                <table class="table table-striped table-bordered nowrap text-center" id="list-table">
                    <thead>
                    <tr>

                        <th>{{_i('ID')}}</th>
                        <th>{{_i('TITLE')}}</th>
                        <th>{{_i('SUB_TITLE')}}</th>
                        <th>{{_i('PRICE')}}</th>
                        <th class="lasttd">{{_i('Action')}}</th>

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
                    url: '{!! route('get-lens-datatable') !!}',
                    type: 'get',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'title', orderable: true, searchable: true },
                    {data: 'sub_name', name: 'sub_title', orderable: true, searchable: true },
                    {data: 'price', name: 'price', orderable: true, searchable: true },
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
