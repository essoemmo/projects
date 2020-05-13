@extends('store.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}"> {{_i('Home')}} </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Products')}} </li>
            </ol>
        </div>
    </nav>



    <div class="sections-wrapper products-wrapper common-wrapper">
        <div class="container">

            <div class="row">

                @if(!empty($products))
                    @foreach($products as  $product)
                        @php

                            if($product->currency_code == null) {
                                $currency = \App\Bll\Constants::defaultCurrency;
                            } else {
                                $currency = $product->currency_code;
                            }

                        @endphp
                        <div class="col-lg-3 col-md-6 d-flex ">
                            <div class="single-full-product text-center d-flex flex-column">
                                <div class="top-floating-icons d-flex justify-content-between">
                                    @if(\App\Models\product\products::findOrFail($product->product_id)->isFavorited())
                                        <a href="javascript:void(0)" class="add-to-fav"
                                           data-id="{{$product->product_id}}"><i
                                                class="fa fa-heart"></i></a>
                                    @else
                                        <a href="javascript:void(0)" class="add-to-fav"
                                           data-id="{{$product->product_id}}"><i
                                                class="fa fa-heart-o"></i></a>
                                    @endif
                                </div>

                                <div class="product-thumbnail">
                                    <a href="{{route('product_url',[app()->getLocale(),$product->id])}}"><img
                                            data-src="{{asset($product->photo)}}" alt="" class="img-fluid lazy"></a>
                                </div>
                                <h3 class="title"><a
                                        href="{{route('product_url', [app()->getLocale(),$product->id])}}"> {{$product->title}} </a></h3>
                                <div class="rate mb-3 w-100">
                                    <div class="star-ratings-sprite"><span style="width:88%"
                                                                           class="star-ratings-sprite-rating"></span>
                                    </div>
                                </div>
                                <div class="price-rate-purchase d-flex justify-content-center mt-auto">
                                    <div class="add-to-cart">
                                        <a class="addcart" href="javascript:void(0)" style="cursor: pointer">
                                            <input type="hidden" name="product_id" class="product_id"
                                                   value="{{$product->product_id}}">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span
                                                class="price">@if($product->discount == null){{checkDiscountPrice($product->product_id)}} {{ $currency }} @else
                                                    <strike
                                                        style="display: inline-block">{{$product->price}} {{ $currency }}</strike>{{checkDiscountPrice($product->product_id)}} {{ $currency }}@endif  </span>
                                        </a>
                                        </a>
                                    </div>

                                </div>
                                <div class="shop-owner">{{ _i('Store Owner') }}</div>

                            </div>
                        </div>

                    @endforeach
                @else

                    <div class="col-lg-12">
                        <div class="alert alert-danger text-center" role="alert">
                            {{ _i('No Products') }}
                        </div>
                    </div>

                @endif
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    {{$products->links()}}
                </ul>
            </nav>
        </div>
    </div>


@endsection
