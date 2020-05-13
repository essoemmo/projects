@extends('store.layout.master')

@section('content')
    @push('css')
        <style>
            .comments-card .card {
                margin-bottom: 20px;
            }

            .btn-dark:hover {
                color: #000 !important;
            }

        </style>
    @endpush

    @php

        if($product->currency_code == null) {
        $currency = \App\Bll\Constants::defaultCurrency;
        } else {
        $currency = $product->currency_code;
        }

    @endphp

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store.home' ,app()->getLocale()) }}">{{_i('Home')}}</a>
                </li>
                <li class="breadcrumb-item active"
                    aria-current="page"> {{$product_details->title ?? _i('Undefiend')}} </li>
            </ol>
        </div>
    </nav>

    @if(\App\Bll\Utility::getTemplateCode() == "purple")

        @if($product->max_count > 0)
            <div class="single-product-page-wrapper products-wrapper ">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6">
                            <ul id="vertical" class="single-product-carousel">

                                @foreach($product_photos as $photo)
                                    <li data-thumb="{{asset($photo->photo)}}">
                                        <img src="{{asset($photo->photo)}}"/>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="col-lg-6">

                            <div class="single-full-product   p-3">

                                <div class="media">

                                    <div class="media-body">
                                        <h2 class="title"><a
                                                href="#"> {{$product_details->title ?? _i('Undefined')}}</a></h2>
                                        <p>
                                            {!!$product->product_details[0]->description!!}
                                        </p>
                                        <div class="price">{{_i('Price :')}}
                                            @if($product->discount != null)
                                                <span id="price_discount" style="font-size: 21px">{{ checkDiscountPrice($product->id) }}
                                                    {{ $currency }}</span>
                                                <input type="hidden" id="product_price_discount"
                                                       value="{{ checkDiscountPrice($product->id) }}">

                                                {{_i('Instead Of')}}
                                                <span class="color-purple" id="price">
                                                    {{$product->price}} {{ $currency }}
                                                </span>
                                                <input type="hidden" id="product_price"
                                                       value="{{ $product->price }}">

                                            @else
                                                <span id="price"> {{$product->price}} {{ $currency }} </span>
                                                <input type="hidden" id="product_price" value="{{ $product->price }}">
                                            @endif
                                        </div>


                                        <form class=" custom-number-input">

                                            <div class="d-md-flex justify-content-between align-items-center my-4">
                                                <div class="quantity">
                                                    <label>{{_i('Quantity')}}</label>


                                                    <input class=" qty form-control  d-inline-block w-auto"
                                                           type="number" value="1"
                                                           min="1" max="{{ $product->max_count }}" step="1">


                                                </div>

                                            </div>

                                            @include('store.product.includes.features')

                                            <div class="cart-product-options ">
                                                <ul class="list-inline d-md-flex justify-content-center align-items-center my-4">

                                                    <li class="list-inline-item">
                                                        @if(auth()->check())
                                                            @if(\App\Models\product\products::findOrFail($product->id)->isFavorited())
                                                                <a href="javascript:void(0)"
                                                                   class=" btn btn-mainColor add-to-fav"
                                                                   data-id="{{$product->id}}">
                                                                    <i class="fa fa-heart"></i>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                   class=" btn btn-mainColor add-to-fav"
                                                                   data-id="{{$product->id}}">
                                                                    <i class="fa fa-heart-o"></i> <span
                                                                        class="fav-o">{{_i('add to favorites')}}</span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="#" class="dropdown-item btn btn-mainColor"
                                                               data-toggle="modal"
                                                               data-target="#loginModel">
                                                                <i class="fa fa-heart-o"></i> <span
                                                                    class="fav-o">{{_i('add to favorites')}}</span>
                                                            </a>
                                                        @endif
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)"
                                                           class="addcart btn btn-mainColor"><i
                                                                class="fa fa-shopping-basket"></i>
                                                            <input type="hidden" name="product_id" class="product_id"
                                                                   value="{{$product->id}}">
                                                            <input type="hidden" name="new_price" id="new_price"
                                                                   value="{{ checkDiscountPrice($product->id) }}">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </form>


                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        @endif


    @else
        <!-------------------------------- check for template ----------------------------------------------------------->
        @if($product->max_count > 0)
            <div class="single-product-page-wrapper common-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <div id="slider" class="flexslider shadow-sm">
                                    <ul class="slides">
                                        @foreach($product_photos as $photo)
                                            <li><img src="{{asset($photo->photo)}}"/></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="carousel" class="flexslider shadow-sm">
                                    <ul class="slides">
                                        @foreach($product_photos as $photo)
                                            <li><img src="{{asset($photo->photo)}}"/></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h1 class="main-title">{{$product_details->title ?? _i('Undefined')}}</h1>
                            @php
                                $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
                            @endphp
                            @if ($storeOptions != null)
                                @if ($storeOptions->product_rating == 1)
                                    <div class="rate small-rate">
                                        <div class="star-ratings-sprite"><span
                                                style="width: {{$product->rating ? $product->rating->rating != null ? $product->rating->rating : 0 : 0}}%"
                                                class="star-ratings-sprite-rating"></span></div>
                                    </div>
                                @endif
                            @endif


                            <div class="price">
                                <div class="price">
                                    @if($product->discount != null)
                                        <strike style="display: inline-block">
                                            <span id="price"> {{$product->price}} </span> {{ $currency }}
                                            <input type="hidden" id="product_price" value="{{ $product->price }}">
                                        </strike>
                                        <span
                                            id="price_discount">{{ checkDiscountPrice($product->id) }} {{ $currency }}</span>
                                        <input type="hidden" id="product_price_discount"
                                               value="{{ checkDiscountPrice($product->id) }}">
                                    @else
                                        <span id="price"> {{$product->price}} </span> {{ $currency }}
                                        <input type="hidden" id="product_price" value="{{ $product->price }}">
                                    @endif

                                </div>
                            </div>
                            <form class="form-inline custom-number-input">
                                <input type="number" value="1" min="1" max="{{ $product->max_count }}" step="1"
                                       class="spinner qty"/>

                                <a href="javascript:void(0)" class="addcart btn btn-blue my-1 btn-dark ">
                                    <input type="hidden" name="product_id" class="product_id"
                                           value="{{$product->id}}">
                                    <input type="hidden" name="new_price" id="new_price"
                                           value="{{ checkDiscountPrice($product->id) }}">
                                    {{ _i('Add To Cart') }}
                                </a>

                            </form>
                            <div class="head-title">{{ _i('Product Description') }}</div>
                            <p class="description">

                                <?php
                                //  dd($product->product_details->description);
                                ?>

                                {!!$product->product_details[0]->description!!}
                            </p>

                            @include('store.product.includes.features')

                        </div>
                    </div>
                </div>
            </div>

        @endif

    @endif


    <div class="products-wrapper common-wrapper bg-white">

        <div class="container">

            @php
                $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
            @endphp
            @if ($storeOptions != null)
                @if ($storeOptions->similar_products == 1)
                    <div class="section-title">
                        <figure>{{_i('similer products')}}</figure>
                    </div>
                    <div class="row">

                        @foreach($similar_products as $single)
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="single-feature-product d-flex">
                                    <div class="media">
                                        <a href="{{route('product_url',[app()->getLocale() , $product->id])}}"
                                           class="img-wrapper-anchor align-self-stretch">
                                            <img src="{{asset($single->photopro)}}" class="align-self-center" alt="">
                                        </a>
                                        <div class="media-body align-self-center">
                                            <h3 class="title"><a
                                                    href="{{route('product_url',[app()->getLocale() , $product->id])}}">{{$single->titlepro}}</a>
                                            </h3>
                                            @php
                                                $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
                                            @endphp
                                            @if ($storeOptions != null)
                                                @if ($storeOptions->product_rating == 1)
                                                    <div class="small-rate rate">
                                                        <div class="star-ratings-sprite"><span
                                                                style="width:{{productRate($single->id) == null ? 0 : productRate($single->id)}}%"
                                                                class="star-ratings-sprite-rating"></span></div>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="price-rate-purchase d-flex justify-content-between mt-auto">
                                                <div
                                                    class="price">{{$single->pricepro}} {{ $product->currency_code }}</div>
                                                <a href="javascript:void(0)" class="add-to-cart addcart"><i
                                                        class="fa fa-shopping-cart"></i>
                                                    <input type="hidden" name="product_id" class="product_id"
                                                           value="{{$single->id}}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach


                    </div>
                @endif
            @endif

        </div>

    </div>

    @include('store.layout.comments')

@endsection





