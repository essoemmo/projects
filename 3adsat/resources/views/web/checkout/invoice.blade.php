@extends('web.layout.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Products') }}</li>
            </ol>
        </div>
    </nav>
<!--    --><?php //$currency = \App\Models\Settings\Currency::where('lang_id','=',getLang(session('lang')))->where('show','=',1)->value('title'); ?>


    <div class="invoice-wrapper common-wrapper print-ready">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-title">
                        <h2>{{ _i('Payment Receipt') }}</h2>
                        <h3>{{ _i('Order Number') }} # {{ $order->ordernumber }}</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>{{ _i('User Order Details') }} : </strong><br>
                                {{ auth()->user()->name }} {{ auth()->user()->last_name }}<br>
                                {{ $address->Neighborhood }}, {{ $address->street }}<br>
                                {{ $address->address }} <br>
                                {{ $address->city->title }}, {{ $address->country->title }}
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>{{ _i('Shipping To') }} :</strong><br>
                                {{ auth()->user()->name }} {{ auth()->user()->last_name }}<br>
                                {{ $address->Neighborhood }}, {{ $address->street }}<br>
                                {{ $address->address }} <br>
                                {{ $address->city->title }}, {{ $address->country->title }}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>{{ _i('Payment Method') }} : </strong><br>
                                {{ $payment->type->title }}<br>
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>{{ _i('Order Date') }} :</strong><br>
                                {{ date('M j Y', strtotime($order->created_at)) }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            @include("web.checkout.order_details")

{{--            <button  onclick="javascript:window.print()" class="btn-print btn btn-blue">Print</button>--}}
            <a href="{{ url('confirm') }}" class="btn btn-success">{{ _i('confirm') }}</a>
        </div>

    </div>
@endsection



