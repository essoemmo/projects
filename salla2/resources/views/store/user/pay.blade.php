@extends('front.layout.inner')

@push('css')
    <style>
        .register-form .form-control{
            margin: 0;
        }
    </style>
@endpush

@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('store.home' ,app()->getLocale())}}">{{_i('Home')}}</a></li>
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
                <form action="{{route('execute_payment',app()->getLocale())}}" method="post" data-parsley-validate="">

                    @csrf
                    <?php
                  //  dd($user);
                    ?>
                    @foreach ($user as $key=>$user_details)
                        <input type="hidden" name="{{$key}}" value="{{ $user_details }}">
                    @endforeach


                    <div class="row">
<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                                <input type="number" class="form-control{{ $errors->has('customer_civil_id') ? ' is-invalid' : '' }}"
                                name="customer_civil_id" id="customer_civil_id" placeholder="{{_i('Customer Identity')}}" maxlength="191"
                                data-parsley-maxlength="191" required="" value="{{old('customer_civil_id')}}">
                                @if ($errors->has('customer_civil_id'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('customer_civil_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->


<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('user_defined_field') ? ' is-invalid' : '' }}"
                                    name="user_defined_field" id="user_defined_field" placeholder="{{_i('User Defined Field')}}" maxlength="191"
                                    data-parsley-maxlength="191" required="" value="{{old('user_defined_field')}}">
                                @if ($errors->has('user_defined_field'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_defined_field') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->

<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('block') ? ' is-invalid' : '' }}"
                                    name="block" id="block" placeholder="{{_i('Block')}}" maxlength="191"
                                    data-parsley-maxlength="191" required="" value="{{old('block')}}">
                                @if ($errors->has('block'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('block') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->


<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}"
                                    name="street" id="street" placeholder="{{_i('Street')}}" maxlength="191"
                                    data-parsley-maxlength="191" required="" value="{{old('Street')}}">
                                @if ($errors->has('Street'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Street') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->


<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                            <input type="text" class="form-control{{ $errors->has('house_building_no') ? ' is-invalid' : '' }}"
                                name="house_building_no" id="house_building_no" placeholder="{{_i('House Building No')}}" maxlength="191"
                                data-parsley-maxlength="191" required="" value="{{old('house_building_no')}}">
                                @if ($errors->has('house_building_no'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('house_building_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->


<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                name="address" id="address" placeholder="{{_i('Address')}}" maxlength="191"
                                data-parsley-maxlength="191" required="" value="{{old('address')}}">
                                @if ($errors->has('address'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->


<!--                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                            <input type="text" class="form-control{{ $errors->has('address_instructions') ? ' is-invalid' : '' }}"
                                name="address_instructions" id="address_instructions" placeholder="{{_i('Address Instructions')}}" maxlength="191"
                                data-parsley-maxlength="191" required="" value="{{old('address_instructions')}}">
                                @if ($errors->has('address_instructions'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address_instructions') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>-->




                        <div class="row">
                            {{-- dd($resultInitPaymentdecode->Data->PaymentMethods) --}}
                            @foreach ($resultInitPaymentdecode->Data->PaymentMethods as $paymentMethod)
                             <div class="col-sm-3">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                                                   <img src="{{ $paymentMethod->ImageUrl }}" width="80px;" alt="">

                                  <input type="radio" name="paymentmethod_id" class="" value="{{ $paymentMethod->PaymentMethodId }}">



                                </label>
                            </div>
                        </div>




                           @endforeach
                        </div>


                        <div class="text-center my-4 mr-1 col-md-12">
                            <button type="submit" class="btn btn-pink btn-block rounded-0">{{_i('Pay')}}</button>
                       </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@endsection
