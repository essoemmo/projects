@extends('front.layout.index')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="profile">


                <div class="section-title">{{ _i('My Orders') }}</div>

                <div class="card">
                    <div class="card__header mt-4">
                        <h4>{{ _i('Your Orders History') }} ({{ count($orders) }})</h4>
                    </div>
                    <div class="card__content" style="padding: 15px">
                        <div class="table-responsive">


                            <table class="table shop-table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ _i('Order No') }}</th>
                                    <th>{{ _i('Date') }}</th>
                                    <th>{{ _i('Total') }}</th>
                                    <th>{{ _i('Status') }}</th>
                                    <th></th>
                                    <th class="text-center">{{ _i('Details') }}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->orderNumber }}</td>
                                        <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                        <td>{{ $order->total }} {{ currency()->code }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('orderDetails', $order->id) }}">{{ _i('Details') }}</a>
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

