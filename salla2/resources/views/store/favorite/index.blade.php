@extends('store.layout.master')

@section('content')

<div class="products-wrapper ">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 order-lg-0 order-1">
                <div class="top-product-helper mb-3">
                    <div class="row">
                        <div class="col-6 d-flex align-self-center my-1">
                        <div class="page-title"> {{_i('Favorite List')}}<span>( {{$products->count()}} {{_i('product')}} )</span></div>
                        </div>
                    </div>
                </div>
                @if (!empty($products))
                @foreach($products as $product)
                <div class="single-full-product wide-product mb-4 p-3">

                    <div class="media">
                        <div class="product-thumbnail">
                            <img src="<?= (($product->main_product_photo)!=null)? asset($product->main_product_photo->photo) : asset("/images")?>/placeholder.png"  alt="" class="img-fluid">
                        </div>

                        <div class="media-body">
                            <div class="d-md-flex justify-content-between align-items-center mb-2">
                                <h2 class="title"><a href="{{route('product_url',[app()->getLocale(),$product->id])}}">
                                    {!!$product->product_details[0]->title!!}</a>
                                </h2>
                                <div class="price">
                                    
                                    <?php $currency = \App\Models\Settings\Currency::where('lang_id','=',getLang(session('lang')))->where('show','=',1)->value('title'); ?>
                                    @if($product->discount ==
                                    null){{checkDiscountPrice($product->id)}} {{$currency}} @else
                                    <strike style="display: inline-block">{{$product->price}}
                                        {{$currency}}</strike>{{checkDiscountPrice($product->id)}}
                                    {{$currency}}
                                    @endif
                                </div>
<form class=" custom-number-input">
                                <div class="quantity">
                                    <label>{{_i('Quantity')}}</label>
                                    <input type="number" class="form-control d-inline-block w-auto qty"  value="1" min="1" max="{{ $product->max_count }}" step="1">
                                </div>

                            </div>
                            <p>
                                {!!$product->product_details[0]->description!!}
                            </p>
                            
                            <div class="cart-product-options">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        
                                        <a href="javascript:void(0)" class="addcart btn btn-mainColor"><i
                                            class="fa fa-shopping-basket"></i> {{_i('add to cart')}}
                                            <input type="hidden" name="product_id" class="product_id"
                                            value="{{$product->id}}">
                                        <input type="hidden" name="new_price" id="new_price"
                                            value="{{ checkDiscountPrice($product->id) }}">
                                        </a>
                                 
                                        </li>
                                    <li class="list-inline-item">
                                        @if(\App\Models\product\products::findOrFail($product->id)->isFavorited())
                                        <a href="javascript:void(0)" onClick="window.location.reload();" class=" btn btn-mainColor add-to-fav"
                                            data-id="{{$product->id}}">
                                            <i class="fa fa-heart"></i><span
                                                class="fav-o"> {{_i(' Remove')}}</span>
                                        </a>

                                        @endif
                                    </li>
                                </ul>
                            </div>
                               </form>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif
            </div>

        </div>
    </div>
</div>


@endsection
