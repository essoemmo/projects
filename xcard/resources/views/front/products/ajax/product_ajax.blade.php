<div class="row">

    @if(count($products) > 0)
        @foreach($products as $product)

            <div class="col-md-4 d-flex">
                <div class="single-item-wrapper small-item">


                    <div class="item-img">
                        <a href="{{url('/product/'.$product['id'])}}"><img src="{{asset($product['main_image'])}}" alt="{{_i('Product Image')}}" class="img-fluid"></a>
                    </div>
                    <div class="item-details  ">
                        <h3 class="title">
                            <a href="{{url('/product/'.$product['id'])}}">
                                {{$product->translate(\app()->getLocale())->title}}
                            </a>
                        </h3>
                        <p class="description">
                            {{\Illuminate\Support\Str::limit($product->translate(\app()->getLocale())->description),20}}
                        </p>
                        <div class="price"> {{round($product->price * getRate(country_code())->rate)}}  {{ currency()->code }}</div>
                        <div class="buy-now">
                            <a href="{{ route('buyNow', $product->id) }}" class="addcart btn btn-dark">
                                <input type="hidden" class="product_id" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" class="max_count" value="{{ $product->quantity }}" name="max_count">
                                {{_i('Buy Now')}}</a>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

    @else
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                {{ _i('No Products') }}
            </div>
        </div>
    @endif

</div>
