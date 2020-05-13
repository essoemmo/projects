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
            /*.dropdown-item {*/
            /*    display: block;*/
            /*    width: 100%;*/
            /*    padding: .25rem 0 .25rem 1.5rem;*/
            /*    clear: both;*/
            /*    font-weight: 400;*/
            /*    color: #212529;*/
            /*    text-align: right;*/
            /*    white-space: nowrap;*/
            /*    background: 0 0;*/
            /*    border: 0;*/
            /*}*/

            /*.type .dropdown-item {*/
            /*    text-align: right;*/
            /*}*/

            /*.product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {*/
            /*    margin-left: 34px;*/
            /*}*/

            .dropdown-menu {
                z-index: 9999;
            }
        </style>
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

@section('content')

    <div class="box box-info">

        <div class="box-body">

            <div class="orderList">
                <div class="card order-info-panel">
                    <div class="card-body text-center row">
                        <div class="col-sm-3">
                            <span class="order-top-line">
                                {{_i("Order No")}}
                            </span>
                            <div class="order-second-line">
                                {{$number}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span class="order-top-line">
                                {{_i("Date")}}
                            </span>
                            <div class="order-second-line">
                                {{$order->created_at->format('d/m/Y')}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span class="order-top-line">
                                {{_i("Order Status")}}
                            </span>
                            <div class="order-second-line">
                                {{$order->status}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span class="order-top-line">
                                {{_i("Change Status")}}
                            </span>
                            <div class="order-second-line">
                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#exampleModal">{{_i('wait preview')}}</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <div class="row order-column">

        <div class="col-md-4">
            <div class="card user">
                <div class="card-header">
                    <h5>{{_i('Client')}} </h5>
                </div>
                <div class="card-footer userIcon ">

                    <div class="card-block-big text-center">
                        <?php
                        $number = $order->user->phone;
                        $masked = str_pad(substr($number, -4), strlen($number), '*', STR_PAD_LEFT);
                        ?>
                        <span>{{$order->user->name}}</span>
                        <p>{{$order->user->email}}</p>
                        <p>{{$masked}}</p>


                    </div>

                </div>
            </div>

        </div>


        <div class="col-md-4">
            <div class="card user">
                <div class="card-header">
                    <h5>{{_i('Shipping Information')}} </h5>
                </div>
                <div class="card-footer userIcon ">

                    <div class="card-block-big text-center">
                        <p>{{$order->shipping_option->delay}}</p>
                        <p>{{$order->shipping->country->data->title}}</p>
                        <p>{{$order->shipping->city->data->title}}</p>
                    </div>

                </div>
            </div>

        </div>


        <div class="col-md-4">
            <div class="card user">
                <div class="card-header">
                    <h5>{{_i('paymentMethod')}}</h5>
                </div>
                <div class="card-footer userIcon ">

                    <div class="card-block-big text-center">
                        @if($order->gettransactions->count() > 0)

                            @if($order->gettransactions->type == 'online')

                                <p>{{_i('pay by the bank')}}</p>

                                <p>{{$order->gettransactions->transaction_type->title}}</p>

                            @elseif($order->gettransactions->type == 'delivery')

                                <p>{{_i('Payement when recieving')}}</p>

                            @else
                                <p>{{$order->gettransactions->bank->title}}</p>
                            @endif
                        @endif
                    </div>

                </div>
            </div>

        </div>


        <div class="order-table col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{_i("products")}}</h3>
                    <div class="heading-elements">
                        {{--                        <button data-toggle="modal" data-target="#ordertable" class="btn btn-tiffany" type="button"><i--}}
                        {{--                                class="fa fa-plus"></i>{{_i("adding")}}</button>--}}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">

                    @if($order->orderProducts->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{_i("product")}}</th>
                                <th>{{_i("price")}}</th>
                                <th>{{_i("qty")}}</th>
                                <th>{{_i("total")}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            {{--@dd($order)--}}

                            @foreach($order->orderProducts as $product)
                                <?php
                                $image = json_decode($product->description);
                                ?>

                                <tr class="productRowOne">
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs"><img src="{{$product->product->main_product_photo->photo}}"
                                                                                 width="100" height="100"
                                                                                 class="img-responsive"/></div>
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{$product->product->detailes->title}}</h4>
                                                <div style="display:none;" class="features">
                                                    <p class="feature__name">{{ _i('Feature Name') }}</p>
                                                    <p class="feature__option_name">{{ _i('Feature Option Name') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" class="price">{{$product->price}}</td>
                                    <td data-th="Quantity">
                                        <input type="text" class="form-control" disabled value="{{$product->count}}"/>
                                    </td>
                                    <td data-th="Subtotal"
                                        class="text-center">{{$product->count * $product->price}}</td>
                                </tr>

                            @endforeach

                            <tr class="productRowOne">
                                <td></td>
                                <td></td>
                                <td>{{_i("Cart Total")}}</td>
                                <td class="total__befor">{{$order->total}}</td>
                            </tr>
                            <tr class="productRowOne">
                                <td></td>
                                <td></td>
                                <td>{{_i("Shipping cost")}}</td>
                                <td class="Shipping__cost">{{$order->shipping_cost}}</td>
                            </tr>

                            <tr class="productRowOne">
                                <td></td>
                                <td></td>
                                <td>{{_i("Order Total")}}</td>
                                <td class="total">{{$order->total + $order->shipping_cost}}</td>
                            </tr>

                            </tbody>


                        </table>
                    @else
                        <h3>{{_i('dont find product this order')}}</h3>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$number}}#{{_i('order Status')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-sub" data-parsley-validate="">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="container">
                            <div class="row form-group">
                                <select name="status_id" required="" class="form-control selectpicker">
                                    <option value=" ">{{_i('Choose....')}}</option>
                                    @foreach($status as $stat)
                                        <option value="{{$stat->id}}">{{$stat->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <div class="row form-group">

                                <textarea name="comments" class="form-control" required=""
                                          placeholder="{{_i('note by client')}}"></textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{_i('Save')}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

        $(function () {
            $('body').on('submit', '#form-sub', function (e) {

                e.preventDefault();

                $.ajax({
                    url: '{{route('review-order')}}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (response) {



                        if (response == 'SUCCESS') {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added is Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();

                           $modal = $('#exampleModal');
                            $modal.find('form')[0].reset();

                            location.reload();
                        }

                        // table.ajax.reload();
                        // window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                        }

                });

            });
        })
    </script>

@endpush



