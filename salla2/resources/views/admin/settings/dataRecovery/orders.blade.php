@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Orders Data Recovery')}}
@endsection


@push('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>

        .product-desc .dropdown-menu {
            position: static !important;
        }

        .dropdown-menu.open {
            left: 70px;
            overflow: visible;
        }

        input {
            padding-right: 30px !important;
        }

        .btn.btn-tiffany {
            cursor: pointer;
        }


        .dropdown-menu.open {
            left: -70px;
            overflow: visible;
            /*left: 0;*/
        }


        .product-desc .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 0 .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: right;
            white-space: nowrap;
            background: 0 0;
            border: 0;
        }

        .type .dropdown-item {
            text-align: right;
        }

        .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
            margin-left: 34px;
        }

        .dropdown-menu {
            z-index: 9999;
        }
    </style>

    <!--<link rel="stylesheet" href="{{asset('css/custom.css')}}">-->
    <link rel="stylesheet" href="{{asset('admin/dropzone.css')}}">

    <style>
        .product-desc .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 0 .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: right;
            white-space: nowrap;
            background: 0 0;
            border: 0;
        }

        .type .dropdown-item {
            text-align: right;
        }

        .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
            margin-left: 34px;
        }

        .dropdown-menu {
            z-index: 9999;
        }
    </style>

@endpush

@section('content')

    <div class="products-lists">

        <div class="content">

            <div class="row">
                @if(count($orders) > 0)
                    @foreach($orders as $order)
                        <div class="col-md-4 col-sm-3">
                            <div class="product-box">
                                <div class="frm_product">
                                    <div class="product-img-details">
                                        <img src="{{ asset('/images/placeholder.png') }}" alt="#" class="product-img">
                                    </div>
                                    <div class="inputs-product-body">
                                        <div class="form-group mt-2">
                                            <span class="addon-tag"><i class="ti-shopping-cart-full"></i></span>
                                            <input type="text" class="form-control product_name input"
                                                   value="{{ ($order->user->name != null) ? $order->user->name : "" }}"
                                                   name="product_name" placeholder="{{_i("Order Number")}}" disabled
                                            >
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <span class="addon-tag"><i class="ti-money"></i></span>
                                                <input type="number" min="1" max="1000000"
                                                       class="form-control price"
                                                       value="{{ $order->ordernumber }}" name="price"
                                                       placeholder="{{_i("Order Status")}}" disabled>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col">
                                                <span class="addon-tag"><i class="ti-tag"></i></span>
                                                <input type="number" min="1" max="1000000"
                                                       class="form-control product_count"
                                                       value="{{ $order->total }}" name="count"
                                                       placeholder="{{_i("Order Total")}}"
                                                       disabled>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="order_id" class="order_id"
                                                   value="{{$order->id}}">

                                            <button class="btn btn-block btn-tiffany resotre-order"
                                                    type="button">{{_i("Restore")}}</button>
                                        </div>


                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="col-12" id='no-items'>
                        <div class="alert alert-danger text-center">
                            <p class="lead">{{ _i('No Orders') }}</p>
                        </div>
                    </div>

                @endif

            </div>


        </div>

    </div>

@endsection


@push('js')

    <script>
        $('.resotre-order').on('click', function () {
            var that = $(this);
            var id = that.closest('.frm_product').find('.order_id').val();
            var token = '{{ csrf_token() }}';
            if (id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('dataRecovery.restoreOrder') }}',
                    type: "POST",
                    data: {id: id, token: token},
                    dataType: 'json',

                    success: function (response) {
                        if (response.status == 'success') {
                            that.closest('.col-md-4').remove();
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: "{{_i('Restored Successfully')}}",
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    },
                });
            }
        })
    </script>

@endpush

