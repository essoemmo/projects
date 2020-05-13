{{--@extends('admin.layout.productLayout')--}}
@extends('admin.AdminLayout.index')
@section('title')
    {{_i('orders')}}
@endsection

@section('page_header_name')
    {{_i('orders')}}
@endsection
@section('content')

    @push('css')
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
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

            body .modal {
                z-index: 80000;
            }

            body .swal2-container {
                z-index: 999999999;
            }
        </style>
    @endpush
    @push("js")
        <script>
            $(function () {
                'use strict'
                $('.selectpicker').on('change', function (e) {
                    $(this).next().next().addClass('show');
                })
                $('body').click(function () {
                    $('.selectpicker').next().next().removeClass('show');
                })
            })
        </script>
    @endpush
    {{--<order-list :ordernumber="{{ordernumber($number)}}" :product_type="{{$product_type}}" :users="{{$users}}" :countries="{{$countries}}" :products="{{$products}}" :transtransaction_types="{{$transtransaction_types}}"></order-list>--}}


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
                        {{\Carbon\Carbon::now()->format('d/m/Y')}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        {{_i("order_status")}}
                    </span>
                    <div class="order-second-line">
                        {{_i("new")}}
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
            <div class="row order-column">


                @include('admin.orders.includes.create.orderuser')
                @include('admin.orders.includes.create.shipping')
                @include('admin.orders.includes.create.payment')
                @include('admin.orders.includes.create.ordertable')


            </div>
        </form>

    </div>

@endsection


@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }

        function saveall() {
            if (shipping_option_id == 'not_existed') {
                Swal.fire({
                    title: 'تنبيه',
                    text: "المنطقة التى قمت بإختيارها لا يوجد بها شحن",
                    type: 'warning',
                });
                return;
            }
            axios.post('../adminpanel/saveallorders', {
                //order: this.getorder,
                user: this.user,
                address: this.address,
                street: this.street,
                neighborhood: this.neighborhood,
                shippingOption: this.shipping_option_id,
                product: this.SavedProducts,
                ordernumber: {!! $number !!},
                totalprice: this.totalprice,
                cityId: this.cityId,
                country: this.country,
                //shippingOption: this.shippingOption,
                //payment: this.payment
                payment: this.paymentId
            }).then(function (data) {
                //_this.order = data.data;
                Swal.fire({
                    position: 'top-end',
                    title: "{{_i('done')}}",
                    showConfirmButton: false,
                    timer: 3000
                });
                //_this.ordervisible = false;
                // window.location.href = '../adminpanel/orders/all';
            });

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
                    url: "{{route('save-new-Product')}}",
                    method: "post",
                    data: formData,
                    dataType: 'json',

                   /* cache: false,
                    contentType: false,
                    processData: false,  */
                    processData: false,
                    contentType: false,
                    success: function (response) {

                        console.log('sss');

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

                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.status);
                        }

                });

            })
        })
    </script>
@endpush
