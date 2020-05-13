  @if(\App\Bll\Utility::getSetting()['show_all_button'] == 1)
        <div class="col-lg-12 col-md-12 d-flex" >
            <a class="button-more" href="{{route('products_all', app()->getLocale())}}" >{{_i('Show All')}}</a>
        </div>
        @endif
@foreach($products as  $product)
            <div class="col-lg-3 col-md-6 d-flex ">
                <div class="single-full-product text-center d-flex flex-column">

                    <div class="top-floating-icons d-flex justify-content-between">
                        @if(\App\Models\product\products::findOrFail($product->id)->isFavorited())
                        <a href="javascript:void(0)" class="add-to-fav"
                           data-id="{{$product->id}}"> <i class="fa fa-heart"></i></a>
                        @else
                        <a href="javascript:void(0)"
                           @if(auth()->guard('web')->check() && !auth()->guard('web')->guest())
                           class="add-to-fav"
                           @else
                           data-toggle="modal" data-target="#loginModel"
                           @endif
                           data-id="{{$product->id}}"> <i class="fa fa-heart-o"></i>
                        </a>
                        @endif
                    </div>

                    <div class="product-thumbnail">
                        <a href="{{route('product_url',[app()->getLocale(),$product->id])}}"><img
                                data-src="{{asset($product->mainPhoto())}}" alt=""
                                class="img-fluid lazy"></a>
                    </div>
                    <h3 class="title"><a
                            href="{{route('product_url',[app()->getLocale() ,$product->id])}}">{{$product->singleProductDetails()->title}}</a>
                    </h3>

                    <!---
                    <div class="rate mb-3 w-100">
                        <div class="star-ratings-sprite"><span style="width:88%" class="star-ratings-sprite-rating"></span></div>
                    </div>
                    ---->

                    @php

                    if($product->currency_code == null) {
                    $currency = \App\Bll\Constants::defaultCurrency;
                    } else {
                    $currency = $product->currency_code;
                    }

                    @endphp
                    <div class="price-rate-purchase d-flex justify-content-center mt-auto">
                        <div class="add-to-cart">
                            <a class="addcart" href="javascript:void(0)" style="cursor: pointer">
                                <input type="hidden" name="product_id" class="product_id"
                                       value="{{$product->id}}">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="price">
                                    @if($product->discount == null)
                                    {{checkDiscountPrice($product->id)}} {{ $currency }}
                                    <input type="hidden" name="new_price" id="new_price"
                                           value="{{ $product->price }}">
                                    <input type="hidden" name="qty" class="qty" value="1">
                                    @else
                                    {{checkDiscountPrice($product->id)}} {{ $currency }}
                                    <del>{{$product->price}} {{ $currency }}</del>
                                    <input type="hidden" name="new_price" id="new_price"
                                           value="{{ checkDiscountPrice($product->id) }}">
                                    <input type="hidden" name="qty" class="qty" value="1">
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach