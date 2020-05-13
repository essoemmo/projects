{{--@extends('admin.layout.productLayout')--}}
@extends('admin.AdminLayout.index')
@section('title')
    {{_i('orders')}}
@endsection

@section('page_header_name')
    {{_i('orders')}}
@endsection



@push('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
        .dropdown-item {
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

    {{--    <div class="box box-info">--}}

    {{--        <div class="box-body">--}}
    {{--            --}}{{--                        <edit-order-list :getaddress="{{$address}}" :getorder="{{$order}}" :transactions="{{$transactions}}" :ordernumber="{{$number}}" :product_type="{{$product_type}}" :users="{{$users}}" :countries="{{$countries}}" :products="{{$products}}" :transtransaction_types="{{$transtransaction_types}}"></edit-order-list>--}}
    {{--            test--}}
    {{--            --}}{{--            @dd($order,$transactions,$number,$address,$users,$countries,$product_type,$products,$transtransaction_types)--}}


    {{--        </div>--}}
    {{--    </div>--}}

    <div class="orderList">
        <div class="card order-info-panel">
            <div class="card-body text-center row">
                <div class="col-sm-4">
                    <span class="order-top-line">
                        {{_i("order_no")}}
                    </span>
                    <div class="order-second-line">
                        {{$number}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        {{_i("date")}}
                    </span>
                    <div class="order-second-line">
                        {{ date('d M y h:i A', strtotime($order->created_at)) }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        {{_i("order_status")}}
                    </span>
                    <div class="order-second-line">
                        {{ _i($order->status) }}
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('myfatoorah_admin') }}" target="_blank" method="POST" id="myfatoorah_form">
            @csrf
        </form>
        <form method="post" id="prod-form">
            @csrf
            @method('post')
            <input type="hidden" form="prod-form" name="order_id" value="{{ $order->id }}">
            <input type="hidden" form="prod-form" name="user_id" value="{{ $order->user_id }}">
            <div class="row order-column">


                @include('admin.orders.includes.edit.orderuser')
                @include('admin.orders.includes.edit.shipping')
                @include('admin.orders.includes.edit.payment')
                @include('admin.orders.includes.edit.ordertable')


            </div>
        </form>

    </div>

@endsection


@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function () {
            'use strict';
            $('.selectpicker').on('change', function (e) {
                $(this).next().next().addClass('show');
            });
            $('body').click(function () {
                $('.selectpicker').next().next().removeClass('show');
            })
        });

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit', '#prod-form', function (e) {
                e.preventDefault();

                var orderNumber = $('.order-second-line').html();
                var totalprice = $('.total').html();

                var formData = new FormData(this);
                formData.append('ordernumber', orderNumber);
                formData.append('totalprice', totalprice);

                $.ajax({
                    url: "{{route('update-Product')}}",
                    method: "post",
                    data: formData,
                    dataType: 'json',

                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (response) {

                        if (response.status == 'success') {
                            Swal.fire({
                                position: 'top-end',
                                title: "{{_i('done')}}",
                                showConfirmButton: false,
                                timer: 3000
                            });
                            window.location.reload();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                title: "{{_i('You shoud complete data')}}",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }

                    },

                });

            })
        })
    </script>
@endpush
