@extends('store.layout.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home') }}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Invoice') }}</li>
            </ol>
        </div>
    </nav>

    @php

        $currency = \App\Bll\Constants::defaultCurrency;

    @endphp


    <div class="invoice-wrapper common-wrapper print-ready">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-title">
                        <h2>{{_i('payment receipt')}}</h2>
                        <h3>{{_i('order number')}} # {{ $order->ordernumber }}</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>{{_i('order information')}} : </strong><br>
                                {{ auth()->user()->name }} {{ auth()->user()->last_name }}<br>
                                {{ $address->Neighborhood }}, {{ $address->street }}<br>
                                {{ $address->address }} <br>
                                {{ $address->city->title }}, {{ $address->country->title }}
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>{{_i('is shipped to')}}:</strong><br>
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
                                <strong>{{_i('payment method')}} : </strong><br>
                                {{ $payment->type['title'] }}<br>
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>{{_i('date of order')}}:</strong><br>
                                {{ date('M j Y', strtotime($order->created_at)) }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>{{_i('Application Summary')}}</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-active">
                                    <thead>
                                    <tr>
                                        <td><strong>{{_i('product')}}</strong></td>
                                        <td class="text-center"><strong>{{_i('price')}}</strong></td>
                                        <td class="text-center"><strong>{{_i('count')}}</strong></td>
                                        <td class="text-right"><strong>{{_i('total')}}</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0 ?>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach($order->orderProducts as $item)
                                        <?php $data = json_decode($item->description) ?>
                                        <tr>
                                            <td>
                                                {{ $item->product->product_details[0]->title }}
                                                @if(collect($data->features)->count() > 0)
                                                    @foreach($data->features as $index => $item_feature_option)
                                                        <div class="mt-2 mr-3">
                                                            {{ \App\Bll\Utility::getFeature($index)->title }}
                                                            : {{  \App\Bll\Utility::getFeatureOption($item_feature_option,$index)->title }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->price }} {{ $currency }}</td>
                                            <td class="text-center">{{ $item->count }}</td>
                                            <?php $total += $item->price * $item->count?>
                                            <td class="text-right">{{ $item->price * $item->count }} {{ $currency }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>{{_i('total')}}</strong></td>
                                        <td class="thick-line text-right">{{ $order->total }} {{ $currency }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>{{_i('shipping cost')}}</strong></td>
                                        <td class="no-line text-right">{{ $order->shipping_cost }} {{ $currency }}</td>
                                    </tr>
                                    <?php
                                    $overAllTotal = $order->shipping_cost + $order->total;
                                    ?>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>{{_i('total')}}</strong></td>
                                        <td class="no-line text-right">{{ $overAllTotal }} {{ $currency }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--            <button  onclick="javascript:window.print()" class="btn-print btn btn-blue">Print</button>--}}
            <a href="{{ url('store/confirm') }}" class="btn btn-success">{{ _i('confirm') }}</a>
        </div>

    </div>
@endsection



