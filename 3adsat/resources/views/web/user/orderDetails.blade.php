@extends('web.layout.master')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="profile">


                <div class="section-title">{{ _i('Order details') }}</div>

                <div class="card card--lg" style="padding: 15px;">
                    <div class="card__header">
                        <h4>{{ _i('OrderId') }} # {{ $order->ordernumber }}</h4>
                    </div>
                    <div class="card__content">

                        <div class="row">
                            <div class="col-lg-9 col-sm-12 mb-4">
                                <h6>{{ _i('Order information') }}</h6>
                                <span>{{ _i('Id') }} # {{ $order->ordernumber }}</span><br>
                                <span>{{ date('d-m-Y g:i A', strtotime($order->created_at)) }}</span><br>
                                <span>{{ $order->status }}</span>
                            </div>
                            <div class="col-lg-3 col-sm-12 text-xl-right">
                                <h6 class="">{{ _i('Contact information') }}</h6>
                                <span>{{ $user->first_name }} {{ $user->last_name }}</span><br>
                                <span>{{ $user->mobile }}</span><br>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                        <hr>
                        <h6 class="mt-5">{{ _i('Order items') }}</h6>
                        <div class="table-responsive">
                            <table class="table shop-table table-hover">
                                <thead>
                                <tr>
                                    <th class="pl-0">{{ _i('Product') }}</th>
                                    <th>{{ _i('Price') }}</th>
                                    <th>{{ _i('Quantity') }}</th>
                                    <th class="text-right pr-0">{{{ _i('Total') }}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($orderItems as $item)
                                    <tr>
                                        <td class="pl-0">{{ $item->product->productDescriptions[0]->name }}</td>
                                        <td class="pr-0">{{ $item->price }}</td>
                                        <td class="pr-0">{{ $item->count }}</td>
                                        <td class="text-right pr-0">{{ $item->price * $item->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end pr-0"><b>{{ _i('Total') }} &nbsp; &nbsp;</b> {{ $order->total }}
                                        {{ $convert->code }}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

