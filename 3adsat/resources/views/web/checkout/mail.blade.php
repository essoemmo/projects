@extends('web.layout.email')

@section('content')

<div class="invoice-wrapper common-wrapper print-ready">
    <div class="container">
        <div class="row">
            <div class="col-6">{{_i("Welcome")}}  {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            <div class="col-6">{{_i("Order Number")}} # {{ $order->ordernumber }}</div>
            <div class="col-12">
                <p>
                    {{_i("Thanks for your shopping with QeyeQ.com")}}
                </p>
                <p>
                    {{_i("You can find your order details here")}}
                </p>
                <p>
                    {{_i("We will send an email when your order is ready.")}}
                </p>


            </div>
            <div class="col-3">
                {{_i("Order Number")}} </div>
            <div class="col-9">
                # {{ $order->ordernumber }}
            </div>
            <div class="col-3">
                {{_i("Order Date")}} </div>
            <div class="col-9">
              {{ date('M j Y', strtotime($order->created_at)) }}
            </div>

            <div class="col-12">

                <div class="row">
                   
                    <div class="col-6 text-right">
                        <address>
                            <strong>{{ _i('Shipping To') }} :</strong><br>
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}<br>
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


        
        
    </div>

</div>
@endsection



