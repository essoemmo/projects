@extends('front.layout.index')

@section('content')

    <div class="invoice-wrapper common-wrapper print-ready" style="color: #fff !important;">
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
                                @if(auth()->user()->first_name == null && auth()->user()->last_name == null)
                                    {{ auth()->user()->email }}<br>
                                @else
                                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}<br>
                                @endif
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>{{ _i('Payment Method') }} : </strong><br>
                                {{ $payment->payment_type }}<br>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>{{ _i('Order Details') }}</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-active">
                                    <thead>
                                    <tr>
                                        <td><strong>{{ _i('Product') }}</strong></td>
                                        <td class="text-center"><strong>{{ _i('Price') }}</strong></td>
                                        <td class="text-center"><strong>{{ _i('Quantity')}}</strong></td>
                                        <td class="text-right"><strong>{{ _i('Total') }}</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $total = 0 ?>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach($order->order_items as $item)

                                        <tr>
                                            <td>
                                                {{ $item->product->translate(app()->getLocale())->title }}
                                            </td>
                                            <td class="text-center">{{ round($item->price * getRate(country_code())->rate) }} {{ $payment->currency }} </td>
                                            <td class="text-center">{{ $item->count }}</td>
                                            <?php $total =  (round($item->price * getRate(country_code())->rate)) * $item->count?>
                                            <td class="text-right">{{ $total }} {{ $payment->currency }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>{{ _i('Total') }}</strong></td>
                                        <td class="thick-line text-right">{{ $order->total }} {{ $payment->currency }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('confirm') }}" class="btn btn-success">{{ _i('confirm') }}</a>
        </div>

    </div>

@endsection

