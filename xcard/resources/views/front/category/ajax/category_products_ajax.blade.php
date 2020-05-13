<div class="row">

    <input type="hidden" name="category_id" class="category_id" value="{{ $id }}">

    @if(count($category_products) > 0)
        @foreach($category_products as $item)

            <div class="col-md-4 d-flex">
                <div class="single-item-wrapper small-item">
                    @php
                        $product_details = \App\Models\Product::where('id' , $item['product_id'] )->first();
                    @endphp

                    <div class="item-img">
                        <a href="{{url('/product/'.$item['product_id'])}}"><img src="{{asset($product_details['main_image'])}}" alt="{{_i('Product Image')}}" class="img-fluid"></a>
                    </div>
                    <div class="item-details  ">
                        <h3 class="title">
                            <a href="{{url('/product/'.$item['product_id'])}}">
                                {{$product_details->translate(\app()->getLocale())->title}}
                            </a>
                        </h3>
                        <p class="description">
                            {{\Illuminate\Support\Str::limit($product_details->translate(\app()->getLocale())->description),20}}
                        </p>
                        <div class="price"> {{round($product_details->price * getRate(country_code())->rate)}}  {{ currency()->code }}</div>
                        <div class="buy-now"><a href="javascript:void(0)" class="addcart btn btn-dark">
                                <input type="hidden" class="product_id" value="{{ $product_details->id }}" name="product_id">
                                <input type="hidden" class="max_count" value="{{ $product_details->quantity }}" name="max_count">
                                {{_i('Buy Now')}}
                            </a>
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
