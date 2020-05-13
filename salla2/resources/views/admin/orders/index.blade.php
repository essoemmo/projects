@extends('admin.AdminLayout.index')

{{--@section('title')--}}
{{--{{_i('Orders')}}--}}
{{--@endsection--}}

@section('page_header_name')
    {{_i('Orders')}}
@endsection


@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('orders')}}</h4>


        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('orders')}}</a>
                </li>

            </ul>

        </div>

    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->

    <div class="page-body">
        <div class="card blog-page">
            <div class="card-block ">
            @include('admin.AdminLayout.message')


            <!--            <div class="dropdown">

                            <select class="form-control" name="type" id="type_selected">
                                <option selected disabled><?= _i('Status') ?></option>

                            </select>
                        </div>-->

            <!--            <div class="dropdown">
                            <select class="form-control" name="type2" id="type_selected2">
                                <option selected disabled><?= _i('Transtransaction Types') ?></option>

                            </select>
                        </div>-->

            <!--            <div class="dropdown">
                            <select class="form-control" name="type3" id="type_selected3">
                                <option selected disabled><?= _i('shipping option') ?></option>

                            </select>
                        </div>-->

                <table class=" table table-bordered table-striped table-responsive text-center" id="order_data"
                       width="100%">
                    <thead>
                    <tr role="row">
                        <th>{{_i('ID')}}</th>
                        <th>{{_i('status')}}</th>
                        <th>{{_i('Order Number')}}</th>
                        <th>{{_i('shipping cost')}}</th>
                        <th>{{_i('action')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>

    @push('js')

        <script type="text/javascript">
            var table;

            function init(url = "{{route('admin.orders.index')}}") {
                table = $('#order_data').DataTable(
                    {
                        "dom": "Blfrtip",
                        "buttons":
                            [
                                {
                                    "text": "<i class=\"ti-plus\"><\/i> {{_i('Add Order')}}",
                                    "className": "btn btn-primary create",
                                    "action": function (e, dt, button, config) {
                                        window.location = "../orders";
                                    }
                                },
                                {
                                    "extend": "print",
                                    "className": "btn btn-primary",
                                    "text": "<i class=\"ti-printer\"><\/i>"
                                },
                                {
                                    "extend": "collection", "className": "btn btn-inverse", "text": "{{_i('Status')}}",
                                    buttons: [
                                            @foreach ($orderstatus as $order)
                                        {
                                            text: "{{$order}}",
                                            "className": "btn btn-inverse", action: function (e, dt, button, config) {
                                                filterByStatus(button.text())
                                            }
                                        },
                                        @endforeach

                                    ]
                                },
                                {
                                    "extend": "collection",
                                    "className": "btn btn-inverse",
                                    "text": "<?= _i('Transaction Types') ?>",
                                    buttons: [
                                            @foreach ($transtransaction_types as $type)
                                        {
                                            text: "{{$type->title}}",
                                            "className": "btn btn-inverse",
                                            action: function (e, dt, button, config) {
                                                filterByTransaction(button.text())
                                            }
                                        },
                                        @endforeach




                                    ]
                                },
                                {
                                    "extend": "collection",
                                    "className": "btn btn-inverse",
                                    "text": "<?= _i('Shipping Options') ?>",
                                    buttons: [
                                            @foreach ($shipping_option as $type)
                                        {
                                            text: "{{_i("$type->delay")}}",
                                            "className": "btn btn-inverse",
                                            action: function (e, dt, button, config) {

                                                filterByShipping('{{$type->id}}');
                                            }
                                        },
                                        @endforeach






                                    ]
                                },
                            ],
                        "responsive": true,
                        "processing": true,
                        "serverSide": true,
                        ajax: {
                            url: url,
                        },
                        columns: [{
                            data: 'id'
                        },
                            {
                                data: 'status'
                            },
                            {
                                data: 'ordernumber'
                            },
                            {
                                data: 'shipping_cost'
                            },
                            {
                                data: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ],
                        'drawCallback': function () {
//            $('#type_selected').change(type);
//            $('#type_selected2').change(type2);
//            $('#type_selected3').change(type3);
                            //$('body').on('change','#type_selected',type);
                            //  $('.sort_hight').click(sort_hight);
                            //  $('.sort_bottom').click(sort_bottom);
                        }

                    });
            }

            $(function () {
                init();
            });

            function filterByStatus(type) {
                //console.log(type);
                //$("#content_data").html("");
                table.destroy();
                init('{{route('admin.orders.index')}}?type=' + type);
//    return;
//    table = $('#order_data').DataTable({
//    processing: true,
//            serverSide: true,
//            ajax: "{{route('admin.orders.index')}}?type=" + type,
//            columns: [{
//            data: 'id'
//            },
//            {
//            data: 'status'
//            },
//            {
//            data: 'ordernumber'
//            },
//            {
//            data: 'shipping_cost'
//            },
//            {
//            data: 'action',
//                    orderable: false,
//                    searchable: false
//            }
//            ],
//    });
            }

            function filterByTransaction(type2) {
//    var type2 = $(this).val();
                //console.log(type);
                //$("#content_data").html("");
                table.destroy();
                init('{{route('admin.orders.index')}}?type2=' + type2);
//
//    table = $('#order_data').DataTable({
//    processing: true,
//            serverSide: true,
//            ajax: "{{route('admin.orders.index')}}?type2=" + val,
//            columns: [{
//            data: 'id'
//            },
//            {
//            data: 'status'
//            },
//            {
//            data: 'ordernumber'
//            },
//            {
//            data: 'shipping_cost'
//            },
//            {
//            data: 'action',
//                    orderable: false,
//                    searchable: false
//            }
//            ],
//    });
            }

            function filterByShipping(type3) {

                //console.log(type);
                //$("#content_data").html("");
                table.destroy();
                init('{{route('admin.orders.index')}}?type3=' + type3);
//    table = $('#order_data').DataTable({
//    processing: true,
//            serverSide: true,
//            ajax: "{{route('admin.orders.index')}}?type3=" + type3,
//            columns: [{
//            data: 'id'
//            },
//            {
//            data: 'status'
//            },
//            {
//            data: 'ordernumber'
//            },
//            {
//            data: 'shipping_cost'
//            },
//            {
//            data: 'action',
//                    orderable: false,
//                    searchable: false
//            }
//            ],
//    });
            }

        </script>

    @endpush


    <style>
        .table {
            display: table !important;
        }

        .row {
            width: 100% !important;
        }

    </style>



@endsection
