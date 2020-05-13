@extends('store.layout.master')

@push('css')
    <style>
        select#city, select#country {
            display: block !important;
        }

        .countries .form-control.nice-select, .cities .form-control.nice-select {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <br>
    @if (\Session::has('success'))
        <div class="text-center alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    @if (\Session::has('failure'))
        <div class="text-center alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
        </div><br/>
    @endif
    @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content()) > 0)

        <div class="container">
            <div class="row form-group">
                @csrf
                @if(auth()->user()->phone === null)
                    <div class="col-sm-4">
                        <input type="text" class="form-control" required="" id="phone" placeholder="{{_i('phone')}}"
                               name="phone" required="" value="{{old('phone')}}">
                        @if ($errors->has('phone'))
                            <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                        @endif
                    </div>
                @endif
                <div class="countries @if(auth()->user()->phone === null) col-sm-4 @else col-sm-6 @endif">
                    <select class="form-control" id="country" name="country_id">
                        <option value="" selected disabled>{{ _i('select') }}</option>
                        @foreach($countries as $key => $country)
                            <option value="{{$key}}"
                                    @if(auth()->user()->country_id == $key) selected @endif>{{$country}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="cities @if(auth()->user()->phone === null) col-sm-4 @else col-sm-6 @endif">
                    <select class="form-control" name="city_id" id="city" required="">
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="neighborhood" placeholder="{{_i('neighborhood')}}"
                           name="neighborhood" value="{{old('neighborhood')}}" required="">
                    @if ($errors->has('neighborhood'))
                        <strong style="color: red;">{{ $errors->first('neighborhood') }}</strong>
                    @endif
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="address" placeholder="{{_i('address')}}" name="address"
                           required="" value="{{auth()->user()->address}}">
                    @if ($errors->has('address'))
                        <strong style="color: red;">{{ $errors->first('address') }}</strong>
                    @endif
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="street" placeholder="{{_i('street')}}" name="street"
                           value="{{old('street')}}" required="">
                    @if ($errors->has('street'))
                        <strong style="color: red;">{{ $errors->first('street') }}</strong>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="code" placeholder="{{_i('postal code')}}" name="code"
                           value="{{old('code')}}" required="">
                    @if ($errors->has('code'))
                        <strong style="color: red;">{{ $errors->first('code') }}</strong>
                    @endif
                </div>
                <div class="col-sm-6">
                    <select class="form-control" id="payment" name="payment" required="">
                        <option value="" selected disabled>{{ _i('select') }}</option>
                        @foreach($payments as $payment)
                            <option value="{{$payment->id}}">{{$payment->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="column-bank">

            </div>
            @if ($errors->has('shippingOption'))
                <strong style="color: red;">{{ _i('Shipping details are required') }}</strong>
            @endif
            <div>
                <input type="hidden" name="user" value="{{ auth()->user()->id }}">

                <input type="hidden" name="ordernumber" value="{{ $number }}">

                @foreach(Cart::content() as $item)
                    <input type="hidden" name="product[]" value="{{ $item->id }}">
                    <input type="hidden" name="count_{{ $item->id }}" value="{{ $item->qty }}">
                    <input type="hidden" name="price_{{ $item->id }}" value="{{ $item->price }}">
                    <input class="total_after" type="hidden" name="total" value="{{ Cart::total() }}">
                @endforeach
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-active">
                    <thead>
                    <tr>
                        <td><strong>{{_i('Product')}}</strong></td>
                        <td class="text-center"><strong>{{_i('Price')}}</strong></td>
                        <td class="text-center"><strong>{{_i('Quantity')}}</strong></td>
                        <td class="text-right"><strong>{{_i('Total')}}</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                    @foreach(Cart::content() as $item)
                        @php

                            if($item->options->currency == null) {
                                $currency = \App\Bll\Constants::defaultCurrency;
                            } else {
                                $currency = $item->options->currency;
                            }

                        @endphp
                        <tr>
                            <td>
                                {{ $item->name }}
                                @if(collect($item->options->features)->count() > 0)
                                    @foreach($item->options->features as $index => $item_feature_option)
                                        <div class="mt-2 mr-3">
                                            {{ \App\Bll\Utility::getFeature($index)->title }}
                                            : {{  \App\Bll\Utility::getFeatureOption($item_feature_option,$index)->title }}
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">{{ $item->price }} {{ $currency }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-right">{{ $item->subtotal }} {{ $currency }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                        <td class="thick-line text-right"><span
                                class="totalBefore">{{ Cart::total() }}</span> {{ $currency }}</td>
                    </tr>
                    <tr>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center"><strong>{{_i('Shipping charges')}}</strong></td>
                        <td class="no-line text-right"><span class="ship_cost">0</span> {{ $currency }}
                        </td>
                    </tr>
                    <tr>
                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center"><strong>{{_i('Total')}}</strong></td>
                        <td class="no-line text-right"><span
                                class="overAllTotal">{{ Cart::total() }}</span> {{ $currency }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-block border-0" style="background: #c52117"
                        type="submit">{{ _i('next') }}</button>
                <br>
            </div>
        </div>

    @else
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2 class="text-center">{{_i('There are no products in the cart')}}</h2>
        <br>
        <br>
        <br>
        <br>
        <br>
    @endif
@endsection

@push('js')

    <script>
        $("#city").append('<option value>{{ _i('select') }}</option>');
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('store/get-city-list')}}?country_id=" + countryID,
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>{{ _i('select') }}</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            } else {
                $("#city").empty();
            }
        });

        $(function () {
            'use strict';

            $("#payment,#city,#country").on("change", function () {
                $('.ship_cost').text(0);
                $('.totalBefore').text('{{ str_replace(' ','',Cart::total()) }}');
                $('.overAllTotal').text('{{ str_replace(' ','',Cart::total()) }}');
            });

            $("#payment,#city,#country").on("change", function () {
                var payment = $('#payment').val();
                var city = $('#city').val();
                var country = $('#country').val();
                $(".column-bank").css("display", "none");
                if (this) {
                    $.ajax({
                        url: '{{url('store/getBankDetails')}}',
                        type: 'get',
                        dataType: 'html',
                        data: {payment: payment, city: city, country: country},
                        success: function (data) {
                            $('.column-bank').css("display", "block").html(data);
                        }
                    });
                } else {
                    $('.column-bank').html('');
                }
            });
        });
        $(function () {
            'use strict'
            var country = '{{auth()->user()->country_id}}';
            if (country != null) {
                $.ajax({
                    type: "GET",
                    url: "{{url('store/get-city-list')}}?country_id=" + country,
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>{{ _i('select') }}</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            }
        })
    </script>


    <style>
        .nice-select {
            width: 100% !important;
        }
    </style>
@endpush


