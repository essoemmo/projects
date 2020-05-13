@extends('admin.AdminLayout.index')
@section('title')
    {{_i('Myfatoorah Pay')}}
@endsection

@section('page_header_name')
    {{_i('Myfatoorah Pay')}}
@endsection

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
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
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
                    <form action="{{ route('execute_payment_admin') }}" method="post" data-parsley-validate="">
                        @csrf


                        {{--                        @foreach ($user as $key => $user_details)--}}
                        <input type="hidden" name="user" value="{{ $user }}">
                        {{--                        @endforeach--}}


                        <div class="row">
                            <div class="row form-radio">
                                @foreach ($resultInitPaymentdecode->Data->PaymentMethods as $paymentMethod)
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="paymentmethod_id" class=""
                                                   value="{{ $paymentMethod->PaymentMethodId }}">
                                            <i class="helper"></i>
                                            <img src="{{ $paymentMethod->ImageUrl }}" width="80px;" alt="">
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="price" value="{{ $price }}">

                            <input type="hidden" name="currency" value="{{ $currency }}">

                            <div class="text-center mt-3 col-md-12">
                                <button type="submit"
                                        class="btn btn-primary btn-block rounded-0">{{_i('Pay')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
