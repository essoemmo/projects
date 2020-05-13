@extends('web.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{ _i('Home') }}</a></li>

                <li class="breadcrumb-item active" aria-current="page">{{$catname->name}}</li>
            </ol>
        </div>
    </nav>

    <div class="products-wrapper py-4">
        <div class="container">

                <div class="row">

                    @foreach($newProducts as $prod4)
                        <div class="col-lg-4 col-md-6 d-flex ">
                            <div class="single-full-product text-center d-flex flex-column">
                                <div class="top-floating-icons d-flex justify-content-between">
                                    @if(\App\Models\Product::findOrFail($prod4->id)->isFavorited())
                                        <a href="javascript:void(0)" class="add-to-fav product-fav" data-id="{{$prod4->id}}">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="add-to-fav product-fav" data-id="{{$prod4->id}}" >
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    @endif
                                    @if(stockStatus($prod4->id) != null)
                                        <a href="" class="new-product-label"><label class="badge badge-primary">{{ stockStatus($prod4->id)->name }}</label></a>
                                    @else
                                        <a href="" class="new-product-label"><label class="badge badge-primary">{{ _i('New') }}</label></a>
                                    @endif
                                </div>

                                <?php

                                    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                                    // you can add different browsers with the same way ..
                                    if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
                                        $browser = 'chromium';
                                    elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
                                        $browser = 'chrome';
                                    elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
                                        $browser = 'safari';
                                    elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
                                        $browser = 'opera';
                                    elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
                                        $browser = 'msie';
                                    elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
                                        $browser = 'mozilla';

                                    preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

                                ?>

                                <div class="product-thumbnail">
                                    <a href="{{route('productDetailsByName',$prod4->namedesc)}}" @if($browser == 'safari') style="display: block !important" @endif>
                                        <img src="{{ asset('images/products/'.$prod4->main_image) }}" src="{{ asset('images/products/'.$prod4->main_image) }}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="product-available-colors ">
                                    <ul class="list-inline">

                                        <?php

                                        $color = \Illuminate\Support\Facades\DB::table('product_colors')
                                            ->where('product_id',$prod4->id)
                                            ->where('deleted_at', null)
                                            ->get();
                                        ?>

{{--                                        @dd($color)--}}
                                        @foreach($color as $index=>$col4)
                                            <li class="list-inline-item"><a href="" class="color{{$index}}" style="background: {{$col4->color}};"></a>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                                <h3 class="title"><a href="{{route('productDetailsByName',$prod4->namedesc)}}">{{$prod4->namedesc}}</a></h3>
                                <div class="price-rate-purchase d-flex justify-content-between mt-auto">
                                    <div class="add-to-cart">
                                        <a href="javascript:void(0)" class="">
                                            <input type="hidden" class="product_id" value="{{ $prod4->id }}" name="product_id">
                                            <input type="hidden" class="max_count" value="{{ $prod4->quantity }}" name="max_count">
                                            <i class="fa fa-shopping-cart"></i>
                                            <?php

                                            $pricee = \Illuminate\Support\Facades\DB::table('product_price')
                                                ->where('country_id',$country->id)->where('product_id',$prod4->id)->first();

                                            ?>
                                            {{--                                        {{dd($pro->discount)}}--}}

                                            @if(!empty($pricee->discount))

                                                @if($pricee != null)
                                                    <strike class="price">{{$pricee->price}} {{ $convert->code }}</strike>
                                                @endif
                                                <?php
                                                $discou = intval($pricee->price) - intval($prod4->discount);
                                                //                                                dd($discou)
                                                ?>
                                                <span class="price">{{$discou}} {{ $convert->code }}</span>

                                            @else
                                                @if($pricee != null)
                                                    <span class="price">{{$pricee->price}} {{ $convert->code }}</span>
                                                @endif

                                            @endif
                                        </a>
                                    </div>
                                    <div class="rate">
                                        <?php
                                        $rating = \Illuminate\Support\Facades\DB::table('ratings')
                                            ->where('product_id',$prod4->id)
                                            ->value('rating');
                                        ;
                                        //                                    dd($percent);

                                        ?>
                                        <div class="star-ratings-sprite"><span style="width:{{!empty($rating) ?$rating :0}}%"
                                                                               class="star-ratings-sprite-rating"></span></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>


        </div>
    </div>

    @if(!empty($manufacturers))

        <div class="sponsors common-wrapper">
            <div class="container">
                <div class="sponsors-slider owl-carousel">
                    @foreach($manufacturers as $item)
                        <div class="single-sponsor">
                            <a href="{{ url('/manufacturers/'. $item->id) }}"><img data-src="{{ asset('images/manufacturers/'.$item->image) }}" alt="{{ $item->name }}" class="owl-lazy"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
