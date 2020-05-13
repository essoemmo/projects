
@extends('admin.layout.index',[
'title' => _i('Products'),
'subtitle' => _i('Products'),
'activePageName' => _i('Products'),
'additionalPageUrl' => url('/admin/panel/products/create') ,
'additionalPageName' => _i('Add'),
] )

@section('content')

    <div class="row">
        <div class="col-sm-12 mbl">
            <span class="pull-right">
                <a href="{{ route("products.create") }}" class="btn btn-primary"><i class="ti-plus"></i>{{ _i('Add Product') }}</a>
            </span>
        </div>

        <div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="box-title">{{ _i('Products List') }}</h5>
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
                    <th>{{_i('Price')}}</th>
                    <th title="{{_i('Quantity')}}">{{_i('Q.')}}</th>
                    <th>{{_i('Status')}}</th>
                    <th>{{_i('Type')}}</th>
                    <th>{{_i('Created')}}</th>
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
                url: '{!! route('get-product-datatable') !!}',
                type: 'get',
                {{--headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}--}}
            },
            columns: [
                {data: 'products_id', name: 'products.id'},
                {data: 'product_name', name: 'product_descriptions.name', orderable: true, searchable: true },
                {data: 'products_price', name: 'product_price.price', orderable: true, searchable: true },
                {data: 'products_quantity', name: 'product_price.quantity', orderable: true, searchable: true },
                {data: 'status', name: 'status', searchable: true},
                {data: 'product_type', name: 'products.product_type', searchable: true},
                {data: 'created_at', name: 'created_at', searchable: true},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
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
                         alert(data);
                        if (data == "success") {
                            oTable.ajax.reload();
                            growl("{{ _i('Product has been deleted successfully.') }}", "success");
                        } else {
                            growl(data, "error");
                        }
                    }
                });
            });
        });
    });
</script>
    <style>
        .lasttd {
            width: 150px !important;
        }
    </style>
@endpush


