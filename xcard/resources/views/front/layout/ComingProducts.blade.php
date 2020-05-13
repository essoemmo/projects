@foreach(waiting_products() as $product)
    <div class="box-wrapper">
        <div class="single-item-wrapper mb-2">
            <div class="item-img h-auto">
                <div class="item-img">
                    <a href="{{url('/product/'.$product['id'])}}"><img src="{{asset($product['main_image'])}}" alt="{{_i('Product Image')}}" class="img-fluid"></a>
                </div>
                <div class="item-details  ">
                    <h3 class="title">
                        <a href="{{url('/product/'.$product['id'])}}">
                            {{$product->translate(\app()->getLocale())->title}}
                        </a>
                    </h3>

                </div>
            </div>

        </div>
    </div>
@endforeach
