@extends('front.layout.index')

@push('css')

    <style>
        #spinner{
            width: 50px;
            height: 50px;
            border: 2px solid #f3f3f3;
            border-top:3px solid #f25a41;
            border-radius: 100%;
            position: relative;
            top:0;
            bottom:0;
            left:0;
            right: 0;
            /*margin: auto;*/
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            } to {
                  transform: rotate(360deg);
              }
        }

    </style>

@endpush

@section('content')

    <section class="cart-page">
        <div class="container">
            <div class="section-title">
                {{ _i('Cart') }}
            </div>

            @if(count(\Cart::getContent()) > 0)
                @foreach($cart as $item)
                    <div class=" cart-item">
                    <div class="row">
                        <div class="col-md-3 d-flex">
                            <div class="item-img ">
                                <a href=""><img src="{{ $item->attributes->image }}" alt="" class="img-fluid"></a>
                            </div>
                        </div>

                        <div class="col-md-9 d-flex">
                            <div class="bg-white p-4 w-100 ">
                                <div class="row ">

                                    <div class="col-lg-5  d-flex align-self-center justify-content-center ">
                                        <div class="item-details ">
                                            <h3 class="title"><a href="">{{ $item->name }}</a></h3>
                                            <p class="description">{{ substr(strip_tags($item->attributes->description), 0, 50) }} {{ strlen(strip_tags($item->attributes->description)) > 50 ? "...." : "" }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5  d-flex align-self-center justify-content-center">
                                        <ul class="list-inline">
                                            <li class="list-inline-item" id="quantity_{{ $item->id }}">
                                                <span>{{ _i('Quantitiy') }}</span>
                                                <a class="updatecart"  href="javascript:void(0)">
                                                    <input type="number" min="1" max="{{ $item->attributes->max_count }}" id="{{ $item->id }}" class="form-control text-center qty" value="{{ $item->quantity }}">
                                                    <input type="hidden" id="{{ $item->attributes->max_count }}" class="form-control text-center max_count" value="{{ $item->attributes->max_count }}">
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>{{ _i('Price') }}</span>
                                                <cite>{{ round($item->price * getRate(country_code())->rate) }} {{ currency()->code }}</cite>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>{{ _i('Total') }}</span>
                                                <cite id="subTotal_{{ $item->id }}">{{ round($item->getPriceSum() * getRate(country_code())->rate) }} {{ currency()->code }}</cite>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-2   d-flex align-self-center justify-content-center">
                                        <div class="remove-item">
                                            <form class="form-inline" method="POST" action="{{ route('removeCart', ['id' => $item->id]) }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}"/>
                                                <button type="submit" class="btn btn-danger btn-sm" data-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                        <div style="display: none"> {{ $count++ }}</div>
                </div>
                @endforeach

                <div class="cart-total d-md-flex text-center justify-content-between mb-4">
                    <div class="coupon">
                        <input type="text" class="coupon-value" placeholder="{{_i('Do you have a Purchase coupon?')}}">
                        <input type="submit" class="coupon-btn" value="{{_i('Apply')}}"></div>
                    <div id="total">{{ _i('Total') }} : {{ round(\Cart::getTotal() * getRate(country_code())->rate) }} {{ currency()->code }}</div>
                </div>

                <div class="justify-content-end d-md-flex">
                    @if(auth()->check())
                        <a href="{{ route('payment') }}" class="btn btn-yellow w-25">{{ _i('To Payment') }}</a>
                    @else
                        <div id="spinner" style="display: none"></div>
                        <span class="text-danger" style='display:none' id="errors">{!! $errors->first('mandapName', ':message') !!} </span>
                        <div class="col-lg-5  d-flex align-self-center justify-content-center">
                            <input type="email" name="email" placeholder="{{ _i('Your Email') }}" class="form-control email">
                        </div>
                        <a href="javascript:void(0)" class="btn btn-yellow w-25 payment_register">{{ _i('To Payment') }}</a>
                    @endif
                </div>
            @else
                <div class="col-lg-12">
                    <div class="alert alert-danger text-center" role="alert">
                        {{_i('No Products In Cart')}}
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('js')

    <script>
        $(function () {
            'use strict';
            $('a.payment_register').click(function (e) {
                var email = $('.email').val();
                $("#spinner").css("display","block");
                $('#errors').css("display","none");
                $.ajax({
                    url:'{{ route('payment_register') }}',
                    method:'POST',
                    DataType:'json',
                    type:'post',
                    data: {_token: '{{ csrf_token() }}',email: email},
                    success:function (res) {
                        $("#spinner").css("display","none");
                        if(res[0] == true) {
                            window.location.href = res.url;
                        } else if(res[0] == false) {
                            window.location.href = res.url;
                        }

                    }
                })
            });
        })
    </script>

@endpush
