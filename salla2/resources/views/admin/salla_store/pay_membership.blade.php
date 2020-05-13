@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Buy Template')}}
@endsection

@section('page_url')
    <li class="breadcrumb-item">
        <a href="{{url('adminpanel')}}">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item active"><a href="#">{{_i('Buy Template')}}</a>
    </li>
@endsection


@section('content')

    @push('css')
        <style>
            .register-form .form-control {
                margin: 0;
            }
        </style>
    @endpush
    <div class="card">
        <div class="card-header">
            <h5>
                <i class="ti-layout position-left"></i>
                {{ _i('Complete Payment') }}  </h5>
            <div class="card-header-right">
            </div>
        </div>
        <div class="card-block">
            <section class="register-form common-wrapper ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 shadow mb-4">
                            <h1 class="head-title text-center pt-3">

                                {{_i('Select Payment Method')}}

                            </h1>
                            <form action="{{ route('execute_payment_admin_membership') }}" method="post" data-parsley-validate="">
                                @csrf


                                <input type="hidden" name="user" value="{{ $user }}">
                                <input type="hidden" name="price" value="{{ $price }}">
                                <input type="hidden" name="currency" value="{{ $currency }}">
                                <input type="hidden" name="membership_id" value="{{ $membership_id }}">
                                <input type="hidden" name="expire_date" value="{{ $expire_date }}">

                                <div class="row">
                                    <div class="row form-radio">
                                        @foreach ($resultInitPaymentdecode->Data->PaymentMethods as $paymentMethod)
                                            <div class="card card-block-small b-l-success  business-info services col-md-5" style="margin-right: 20px; margin-left: 20px;">
                                                <div class="media" >
                                                    <div class="media-left" >
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="paymentmethod_id" class=""
                                                                       value="{{ $paymentMethod->PaymentMethodId }}">
                                                                <i class="helper"></i>
                                                                <img class="img-fluid img-thumbnail" src="{{ $paymentMethod->ImageUrl }}"  style="height:100px" alt="">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

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

        </div>
    </div>




@endsection

@push('js')
    <script>


    </script>

@endpush
