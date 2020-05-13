
<div class="col-md-6">
    <div class="single-box">

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
        <span class="img-wrapper">
            <a href="{{route('product_url',[app()->getLocale(),$product->product_id ])}}">           
                <img src="{{asset($product->photo)}}" alt="" class="img-fluid">
            </a>
        </span>
        <p class="title">
            <a href="{{route('product_url',[app()->getLocale(),$product->product_id])}}"> {{$product->title}} </a>
        </p>
        @php
        $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
        @endphp
        @if ($storeOptions != null)
        @if ($storeOptions->product_rating == 1)
        <div class="rate mb-3 w-100">
            <div class="star-ratings-sprite"><span style="width:88%"
                                                   class="star-ratings-sprite-rating"></span>
            </div>
        </div>
        @endif
        @endif

        <div class="price price-rate-purchase d-flex justify-content-center mt-auto">
            <div class="add-to-cart">
                <a class="addcart" href="javascript:void(0)" style="cursor: pointer">
                    <input type="hidden" name="product_id" class="product_id"
                           value="{{$product->product_id}}">
                    <input type="hidden" name="new_price" id="new_price"
                           value="{{ checkDiscountPrice($product->product_id) }}">
                    <input type="hidden" name="qty" class="qty" value="1">
                    <i class="fa fa-shopping-cart"></i>
                    <span
                        class="price">@if($product->discount == null){{checkDiscountPrice($product->product_id)}} {{ $currency }} @else
                        <strike
                            style="display: inline-block">{{$product->price}} {{ $currency }}</strike>{{checkDiscountPrice($product->product_id)}} {{ $currency }}@endif  </span>
                </a>
            </div>

        </div>

    </div>
</div>

