@extends('admin.layout.index',[
'title' => _i('All Catgeories'),
'subtitle' => _i('All Catgeories'),
'activePageName' => _i('All Catgeories'),
'additionalPageUrl' => url('/admin/panel/categories/create') ,
'additionalPageName' => _i('Add'),
] )

@section('content')
    <div class="row">
        <div class="col-sm-12 mbl">
            <span class="pull-left">
                <a href="{{ route("categories.create") }}" class="btn btn-primary"><i class="ti-plus"></i>{{ _i('Add Category') }}</a>
            </span>
        </div>
        <br />

        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Catgeories List') }} </h5>
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

                    <th class="text-center">{{_i('ID')}}</th>
                    <th class="text-center">{{_i("Parent")}}</th>
                    <th class="text-center">{{_i('Name')}}</th>

                    <th class="text-center">{{_i('Sort Order')}}</th>
                    <th class="text-center">{{_i('Status')}}</th>
                    <th class="text-center"></th>
                    <th class=" lasttd" >{{_i('Action')}}</th>
                </tr>
                </thead>
            </table>
                    </div>
                </div>
        </div>
        </div>
    </div>
@endsection

{{--@include('boilerplate::load.datatables')--}}

@push('js')
    <script>
        $('body').on('click','.delete',function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "{{_i('Are you sure ?')}}",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("{{_i('yes')}}", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("{{_i('no')}}", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete
    </script>

    <script>
    $(function () {
        oTable = $('#list-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: '{!! route('get-category-datatable') !!}',
                type: 'get',
                {{--headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}--}}
            },
            columns: [
                {data: 'id', name: 'id'},
                 {data: 'parent', name: 'parent', orderable: true, searchable: true },
                {data: 'name', name: 'name', orderable: true, searchable: true },
                
               
                {data: 'sort_order', name: 'sort_order', orderable: true, searchable: false },
                {data: 'status', name: 'status', searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', orderable: false, searchable: false, width : '70px'}
            ]
        });

        $('#list-table').on('click', '.destroy', function (e) {
            e.preventDefault();

            var href = $(this).attr('href');

            $.ajax({
                url: href,
                method: 'delete',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function(data) {
                    console.log(data)
                    if (data == "success") {
                        oTable.ajax.reload();
                        growl("{{ _i('Category has been deleted successfully.') }}", "success");
                    } else {
                        growl(data, "warning");
                    }
                }
            });
            {{--confirm("{{ _i('Are you sure you want to continue?') }}", function (result) {--}}
            {{--    if (result === false) return;--}}
            {{--    console.log('samer');--}}

            {{--});--}}
        });
    });
</script>
    <style>
        .lasttd {
            width: 150px !important;
        }
    </style>
@endpush
