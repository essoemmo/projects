@extends('store.layout.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' ,app()->getLocale()) }}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Invoice') }}</li>
            </ol>
        </div>
    </nav>

    @php

        $currency = \App\Bll\Constants::defaultCurrency;

    @endphp


    <div class="order-status">
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-square"></i>{{ _i('Shipping Address') }}</li>
                <li class="list-inline-item"><i class="fa fa-square"></i> {{ _i('Payment') }}</li>
                <li class="list-inline-item"><i class="fa fa-square"></i>{{ _i('order placed') }}</li>
            </ul>
        </div>
    </div>
    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">
                        <a href=""><img src="{{ asset('perpal/images/order-accepted.png') }}" alt=""
                                        class="img-fluid"></a>
                        <div class="welcome-head-2">{{ _i('Congratulations, your request has been accepted') }}</div>
                        {{--                        <div class="color-purple">سيتم تسليم الطلب يوم الثلاثاء 1 أكتوبر--}}
                        {{--                            في العنوان الموضح بالطلب--}}
                        {{--                        </div>--}}
                        <a href="{{ route('myorders' ,app()->getLocale()) }}"
                           class="btn btn-mainColor btn-block my-3">{{ _i('Go to your orders') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection



