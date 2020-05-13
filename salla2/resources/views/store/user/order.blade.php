@extends('store.layout.master')

@section('content')

    @push('css')
        <style>
            .nowrap {
                width: 100% !important;
            }
        </style>

    @endpush
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home' ,app()->getLocale())}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Order Details')}}</li>
            </ol>
        </div>
    </nav>


    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info' ] as $msg)
            @if(Session::has($msg))
                <br/>
                <h6 class="alert alert-{{ $msg }}"><b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
        @if(Session::has('flash_message'))
            <br/>
            <h6 class="alert alert-success"><b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>

    <div class="user-page common-wrapper">
        <div class="container">
            <div class="row profile">
                @include('store.user.showprofile',$user)
                <div class="col-md-9">

                    <div class="card shadow-sm">
                        <div class="card-header">{{_i('order details')}}</div>
                        <div class="card-body">
                            <div class="order-details">
                                <ul class="list-inline">
                                    <li><strong>{{_i('Order no')}}</strong>{{ $order->ordernumber }}</li>
                                    <li><strong>{{_i('date of order')}}</strong>{{ $order->created_at }}</li>
                                    <li>
                                        <strong>{{_i('method payment')}}</strong>
                                        @if($order->gettransactions->type == 'bank' && $order->gettransactions->type_id == null)
                                            {{ _i('Pay By Bank') }}
                                        @elseif($order->gettransactions->type == 'delivery' && $order->gettransactions->type_id == null)
                                            {{ _i('Pay On Delivery') }}
                                        @elseif($order->gettransactions->type == 'online' && $order->gettransactions->type_id != null)
                                            {{ _i('Pay with') }} {{ $order->gettransactions->transaction_type->title }}
                                        @endif


                                    </li>
                                    <li>
                                        <strong>{{_i('recipient')}}</strong>{{ $order->user->name .' '. $order->user->last_name }}
                                    </li>
                                    <li><strong>{{_i('recipient address')}}</strong>{{ $order->shipping['address'] }}
                                    </li>
                                    <li><strong>{{_i('order status')}}</strong> {{ $order->status }}</li>
                                    <li><strong>{{_i('email')}}</strong> {{ $order->user->email }}</li>
                                    <li><strong>{{_i('phone')}}</strong> {{ $order->user->phone }}</li>
                                    @php
                                        $currency = \App\Bll\Constants::defaultCurrency;
                                        if($order->discount != null && $order->discount_id != null) {
                                            $discount = $order->discount;
                                        } else {
                                            $discount = 0;
                                        }
                                    @endphp


                                    <li>
                                        <strong>{{_i('total of order')}}</strong>{{ $order->total + $order->shipping_cost - $discount }} {{ $currency }}
                                    </li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>{{_i('name of product')}}</th>
                                        <th>{{_i('count')}}</th>
                                        <th>{{_i('price')}}</th>
                                        <th>{{_i('total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderProducts as $orderpro)
                                        <tr>
                                            <td>{{$orderpro->product->product_details[0]->title}}</td>
                                            <td>{{$orderpro->count}}</td>
                                            <td>{{$orderpro->price}} {{ $currency }}</td>
                                            <td>{{$orderpro->price * $orderpro->count}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ _i('Shipping Cost') }}</th>
                                        <th>{{ $order->shipping_cost }} {{ $currency }}</th>
                                    </tr>
                                    @if($order->discount != null && $order->discount_id != null)
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>{{ _i('Discount') }}</th>
                                            <th>{{ $order->discount }} {{ $currency }}</th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ _i('Total') }}</th>
                                        <th>{{ $order->shipping_cost + $order->total - $order->discount }} {{ $currency }}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
