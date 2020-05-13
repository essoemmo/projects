@extends('web.product.show')

@section('lencess')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">{{ _i('Home') }}</a></li>
                @if(!empty($product))
                    <li class="breadcrumb-item" aria-current="page">
                        <a href=""> {{ $product->name }} </a>
                    </li>
                @endif
            </ol>
        </div>
    </nav>


{{--        {{dd($product)}}--}}
    <div class="single-product-page-wrapper common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <div id="slider" class="flexslider shadow-sm">
                            <ul class="slides">
                                <li>
                                    <img id="main_image" src="{{ asset('images/products/'.$product->main_image) }}" />
                                </li>

                                @if($product->productColors)
                                    @foreach($product->productColors as $image)
                                        <li>
                                            <img id="color_image{{ $image->id }}" src="{{ asset('images/products/'.$image->image) }}" />
                                        </li>
                                    @endforeach
                                @endif

                                @if(!empty($product->productImages))
                                    @foreach($product->productImages as $image)
                                        <li><img src="{{ asset('images/products/'.$image->image) }}" /></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider shadow-sm">
                            <ul class="slides">
                                <li>
                                    <a  href="#" target="_self" onclick="location.href = '#main_image'">
                                        <img src="{{ asset('images/products/'.$product->main_image) }}" />
                                    </a>
                                </li>

                                @if($product->productColors)
                                    @foreach($product->productColors as $image)
                                        <li>
                                            <img src="{{ asset('images/products/'.$image->image) }}" />
                                        </li>
                                    @endforeach
                                @endif

                                @if(!empty($product->productImages))
                                    @foreach($product->productImages as $image)
                                        <li><img src="{{ asset('images/products/'.$image->image) }}" /></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <?php
                $rating = \Illuminate\Support\Facades\DB::table('ratings')
                    ->where('product_id',$product->id)
                    ->value('rating');
                ;

                ?>
                <div class="col-md-6">
                    <h1 class="main-title">{{ $product->name }}</h1>
                    @if(empty($rating)) <a href="#form-review"> {{_i("Be the first to review this product")}} </a>
                    @else
                        <div class="rate small-rate">
                            <div class="star-ratings-sprite">
                                <span style="width:{{ $rating }}%"  class="star-ratings-sprite-rating"></span>
                            </div>
                        </div>
                    @endif
                    <div class="price">

                        @if($product->discount == null)
                            <span id="price"> {{ $product->price()->price}} {{ $convert->code }}</span>
                            <input type="hidden" id="product_price" value="{{ $product->price()->price }}">
                            <input type="hidden" id="new_price" value="{{ $product->price()->price }}">
                        @else



                            <s id="old" style="margin-left: 8px; display: inline-block"> {{ $product->price()->price}} {{ $convert->code }}</s>
                            <span id="price"> {{ ($product->price()->price - $product->discount ) }} {{ $convert->code }}</span>
                            <input type="hidden" id="product_price" value="{{ ($product->price()->price - $product->discount) }}">
                        @endif

                    </div>

                    <div class="deliver">
                    <span>@if(!empty($product->stockStatusName))
                            {{ $product->stockStatusName }}
                        @endif</span>
                    </div>

                    <form id="productsForm" class="custom-number-input" action="" method="POST" >
                        @csrf
                        <input type="hidden" name="new_price" id="new_price" value="">
{{--                        @dd($product->productColors)--}}
                        @if(count($product->productColors) > 0)
                            <h4>{{ _i('Choose Color') }}</h4>
                            <div  id="trigger-color-imgs" class="product-available-colors ">

                                <ul class="list-inline ">
                                    @foreach($product->productColors as $color)
                                        <?php

                                        $colorData = ($color->Description(getLang(lang())));
                                        $title = "";
                                        if ($colorData !== null) {
                                            $title = $colorData->name;
                                        }
                                        ?>
                                        <li class="list-inline-item showImage" style="color: {{ $color->color }};" >
                                            <a title="{{$title}}" data-toggle="tooltip" class="color_select" href="#" target="_self" onclick="javascript:selectColor(this);location.href = '#color_image{{ $color->id }}'" style="background: {{ $color->color }};" data-img="{{ asset('images/products/'.$color->image) }}"></a>
                                            <input required=""  type="radio" name="radioColor" style="left: 18px;display: none;z-index: -8;position: relative;color: {{ $color->color }};" data-img="{{ asset('images/products/'.$color->image) }}" value="{{$color->id}}" />
                                        </li>
                                    @endforeach
                                </ul>



                            </div>
                        @endif
                        @if(count($product->productColors) > 0)
                            <input type="hidden" name="there_is_color" id="there_is_color" @if(!$product->color_id) required="" value="1" @endif>
                            <input type="hidden" name="color_id" id="color_id"  @if(!$product->color_id) required="" value="{{ $product->color_id }}" @endif>
                        @endif
                        {{_i("Quantity")}}
                        <div id="product" class="input-group">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" step="1" class="spinner new_qty"/>
                        </div>
                        @if($product->product_type == 'sunglasses' || $product->sphere_type == 1 || $product->axis_type == 1 || $product->cylinder_type == 1 || $product->product_type == 'glasses')
                            <a href="javascript:void(0)" class="addcart btn btn-blue my-1">
                                <input type="hidden" class="product_id" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" class="max_count" value="{{ $product->quantity }}" name="max_count">
                                <input type="hidden" class="product_type" value="{{ $product->product_type }}" name="product_type">
                                {{_i("Add To Cart")}}
                            </a>
                            <hr class="rule">
                        @endif

                        {{--loader spinner--}}

                        @if($product->product_type=="glasses")
                            @include("web.product.partial.glasses")
                        @elseif($product->product_type=="lenses")
                            @include("web.product.partial.lenses")

                        @endif

                    </form>


                    <div class="head-title"> {{ _i('Description') }}</div>
                    <div class="description">

                        <?= $product->description ?>
                    </div>


                    @if(!empty($product->atributeGroups))
                        <div class="head-title" id="atributeGroups" style="cursor: pointer"> {{ _i('More Information') }} </div>
                        @foreach($product->atributeGroups as $attributeGroup)
                            @if(!empty($attributeGroup->productAttributes))
                                {{--                <div class="head-title"> {{ $attributeGroup->name }}</div>--}}
                                <div class="description" style="display: none" id="atributeGroups_desc">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
<!--                                        --><?php
//                                        $data = \App\Models\PrAttributeDescription::join("pr_attributes", "pr_attributes.id", "pr_attribute_descriptions.pr_attribute_id")
//                                            ->join("product_attributes", "product_attributes.pr_attribute_id", "pr_attributes.id")
//                                            ->where("product_attributes.language_id", getLang(lang()))
//                                            ->where("pr_attribute_descriptions.language_id", getLang(lang()))
//                                            ->where("pr_attributes.attribute_group_id", $attributeGroup->id)
//                                            ->where("product_attributes.product_id", $product->id)
//                                            ->get();
//                                        //   dd($data)         ;
//                                        ?>
                                        @foreach($attributeGroup->productAttributes as $attribute)
                                            <?php
                                            $attribute2 = App\Models\PrAttributeDescription::where("language_id", "=", getLang(lang()))
                                                ->where("pr_attribute_id", "=", $attribute->pr_attribute_id)->first();
                                            ?>

                                            <tr>
                                                <td>{{ $attribute2->name }}</th>
                                                <td>{{ $attribute->text }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="two-ads middle-sections bg-white pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href=""><img src="images/shop-ad1.jpg" alt="" class="img-fluid "></a>
                </div>
                <div class="col-md-6">
                    <a href=""><img src="images/shop-ad2.jpg" alt="" class="img-fluid "></a>
                </div>
            </div>
        </div>
    </div>

{{--    @if(!empty($product->relatedProducts))--}}
{{--        <div class="products-wrapper common-wrapper bg-white ">--}}
{{--            <div class="container">--}}
{{--                <div class="section-title">{{ _i('Similar Products') }}</div>--}}
{{--                <div class="row">--}}
{{--                    @foreach($product->relatedProducts as $related)--}}

{{--                        <div class="col-lg-4 col-md-6 d-flex">--}}
{{--                            <div class="single-feature-product d-flex">--}}
{{--                                <div class="media">--}}
{{--                                    <a href="" class="img-wrapper-anchor align-self-stretch">--}}
{{--                                        <img src="{{ asset('images/products/'.$related->main_image) }}" class="align-self-center" alt="{{ $related->name }}">--}}
{{--                                    </a>--}}
{{--                                    <div class="media-body align-self-center">--}}
{{--                                        <h3 class="title"><a href="{{ route('productDetails',$related->id )}}">{{ $related->name }}</a></h3>--}}
{{--                                        <div class="small-rate rate">--}}
{{--                                            <div class="star-ratings-sprite">--}}
{{--                                                @if(!empty($related->ratingPercentage))--}}
{{--                                                    <span style="width:{{ $related->ratingPercentage }}%" class="star-ratings-sprite-rating"></span>--}}
{{--                                                @else--}}
{{--                                                    <span style="width:0%" class="star-ratings-sprite-rating"></span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="price-rate-purchase d-flex justify-content-between mt-auto">--}}
{{--                                            <div class="price">@if(LaravelGettext::getLocale() == "ar") {{$related->price }}  @else  {{  $related->price }} @endif</div>--}}
{{--                                            <a href="" class="add-to-cart"><i class="fa fa-shopping-cart"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}


{{--    <section class="review-section common-wrapper">--}}
{{--        <div class="container">--}}
{{--            <div class="section-title">{{ _i('Reviews') }}</div>--}}
{{--            <div class="current-review">--}}
{{--                {{ _i('You are now rating ') }}<strong><a href="">{{ $product->name }}</a></strong>--}}
{{--            </div>--}}

{{--            <form id="form-review" action="" method="POST" data-parsley-validate="">--}}
{{--                @csrf--}}

{{--                <input type="hidden" name="product_id" value="{{ $product->id }}">--}}
{{--                <div id="review"></div>--}}

{{--                <div class="rating mb-3">--}}
{{--                    <input id="rating5" type="radio" name="rating" value="5" required="" @if(old('author') == 5) checked @endif>--}}
{{--                    <label for="rating5">5</label>--}}
{{--                    <input id="rating4" type="radio" name="rating" value="4" @if(old('author') == 4) checked @endif>--}}
{{--                    <label for="rating4">4</label>--}}
{{--                    <input id="rating3" type="radio" name="rating" value="3" @if(old('author') == 3) checked @endif>--}}
{{--                    <label for="rating3">3</label>--}}
{{--                    <input id="rating2" type="radio" name="rating" value="2"  @if(old('author') == 2) checked @endif>--}}
{{--                    <label for="rating2">2</label>--}}
{{--                    <input id="rating1" type="radio" name="rating" value="1" @if(old('author') == 1) checked @endif>--}}
{{--                    <label for="rating1">1</label>--}}
{{--                </div>--}}
{{--                <div class="form-row">--}}
{{--                    <div class="col-md-5">--}}
{{--                        <input type="text" name="author" required="" minlength="3" maxlength="25" class="form-control" placeholder="{{ _i('Name') }}" value="{{ old('author') }}">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-7">--}}
{{--                        <input type="text" name="review_text" required=""  minlength="25" maxlength="1000"  class="form-control" placeholder="{{ _i('Your Review') }}" value="{{ old('review_text') }}">--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <button type="submit" id="button-review" class="btn btn-blue">{{ _i('Review') }}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--            @if(!empty($product->productReviews))--}}
{{--                <div class="users-reviews ">--}}

{{--                    @foreach($product->productReviews as $review)--}}
{{--                        <div class="single-comment">--}}
{{--                            <div class="review-info">--}}

{{--                                <h5 class="review-author">  {{ $review->author }}</h5>--}}
{{--                                <span class="date-and-time"> {{ date('Y-m-d', strtotime($review->date_added)) }}  </span>--}}
{{--                                <div class="small-rate rate">--}}
{{--                                    <div class="star-ratings-sprite">--}}
{{--                                        <span style="width:{{ $review->ratingPercentage }}%" class="star-ratings-sprite-rating"></span>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p> {!! $review->review_text !!}</p>--}}
{{--                            </div>--}}

{{--                            --}}{{--    <ul class="list-inline comment-options">--}}
{{--                                   <li class="list-inline-item"><a href="" data-toggle="tooltip" title="مفيد"><i class="fa fa-thumbs-o-up"></i></a></li>--}}
{{--                                   <li class="list-inline-item"><a href="" data-toggle="tooltip" title="غير مفيد"><i class="fa fa-thumbs-o-down"></i></a></li>--}}
{{--                               </ul> --}}
{{--                        </div>--}}
{{--                    @endforeach--}}


{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </section>--}}



@endsection

