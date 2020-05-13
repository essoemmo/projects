@extends('store.layout.master')

@push('css')
    <style>
        .register-form .form-control {
            margin: 0;
        }
    </style>
@endpush

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' ,app()->getLocale()) }}">{{_i('Home')}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Register')}}</li>
            </ol>
        </div>
    </nav>

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 shadow mb-4">
                    <h1 class="head-title text-center pt-3">

                        {{_i('Complete Payment')}}

                    </h1>
                    <form action="{{route('execute_payment_cart' ,app()->getLocale())}}" method="post"
                          data-parsley-validate="">
                        @csrf


                        {{--                        @foreach ($user as $key => $user_details)--}}
                        <input type="hidden" name="user" value="{{ $user }}">
                        {{--                        @endforeach--}}


                        <div class="row">
                            <div class="row">
                                {{--                                @dd($resultInitPaymentdecode->Data->PaymentMethods)--}}
                                @foreach ($resultInitPaymentdecode->Data->PaymentMethods as $paymentMethod)
                                    <div class="col-sm-3">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <img src="{{ $paymentMethod->ImageUrl }}" width="80px;" alt="">

                                                <input type="radio" name="paymentmethod_id" class=""
                                                       value="{{ $paymentMethod->PaymentMethodId }}">


                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="price" value="{{ $price }}">

                            <input type="hidden" name="currency" value="{{ $currency }}">

                            <div class="text-center my-4 mr-1 col-md-12">
                                <button type="submit"
                                        class="btn btn-mainColor btn-block rounded-0">{{_i('Pay')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
