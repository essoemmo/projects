@extends('front.layout.index')
@push('css')

<!--<link href="{{ asset('front/css/flexslider-rtl-min.css') }}" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">-->
<style>
    .product-gallery .flexslider .slides img {
        opacity: 1;
    }
</style>
@endpush
@section('breadcrumb')

<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('homepage', [$currCountry->iso_code, $currCountry->code]) }}">{{ _i('Home') }}</a></li>
            @if(!empty($product))
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{ route('category', [$currCountry->iso_code, $currCountry->code, $product->id]) }}"> {{ $product->name }} </a>
            </li>
            @endif
        </ol>
    </div>
</nav>
@endsection
@section('section1')
<div class="single-product-page-wrapper common-wrapper">
    <div class="container ">
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
            <div class="col-md-6">
                <h1 class="main-title">{{ $product->name }}</h1>
                @if(empty($product->ratingPercentage)) <a href="#form-review"> {{_i("Be the first to review this product")}} </a>
                @else
                <div class="rate small-rate">
                    <div class="star-ratings-sprite">
                        <span style="width:{{ $product->ratingPercentage }}%"  class="star-ratings-sprite-rating"></span>
                    </div>
                </div>
                @endif
                <div class="price">
                    @if($product->discount == null)
                        <span id="price"> {{ $product->price()}} </span>
                        @if(LaravelGettext::getLocale() == "ar")
                        {{ $currentCountryCurrencyRight  }}
                        @else {{  $currentCountryCurrencyLeft }} @endif
                        <input type="hidden" id="product_price" value="{{ $product->price() }}">
                    @else
                        <s id="old" style="margin-left: 8px; display: inline-block"> {{ $product->price()}} </s>
                        <span id="price"> {{ ($product->price() - $product->discount) }} </span>
                        @if(LaravelGettext::getLocale() == "ar")
                            {{ $currentCountryCurrencyRight  }}
                        @else {{  $currentCountryCurrencyLeft }} @endif
                        <input type="hidden" id="product_price" value="{{ ($product->price() - $product->discount) }}">
                    @endif

                </div>

                <div class="deliver">
                    <span>@if(!empty($product->stockStatusName))
                        {{ $product->stockStatusName }}
                        @endif</span>
                </div>



                <form id="productsForm" class="custom-number-input" action="{{ route('cart.add', [$currCountry->iso_code, $currCountry->code]) }}" method="POST" >
                    @csrf
                    <input type="hidden" name="new_price" id="new_price" value="">
                    @if(!empty($product->productColors))
                    <div  id="trigger-color-imgs" class="product-available-colors ">

                        <ul class="list-inline ">
                            @foreach($product->productColors as $color)
                            <?php

                             $colorData = ($color->Description($language_id));
                                $title = "";
                                if ($colorData !== null) {
                                    $title = $colorData->name;
                                }
                            ?>
                            <li class="list-inline-item showImage" style="color: {{ $color->color }};" >
                                <a title="{{$title}}" data-toggle="tooltip" href="#" target="_self" onclick="javascript:selectColor(this);location.href = '#color_image{{ $color->id }}'" style="background: {{ $color->color }};" data-img="{{ asset('images/products/'.$color->image) }}"></a>
                                <input required=""  type="radio" name="radioColor" style="left: 18px;    z-index: -8;    position: relative;color: {{ $color->color }};" data-img="{{ asset('images/products/'.$color->image) }}" value="{{$color->id}}" />
{{--                                <input class="color_id" type="hidden" value="{{ $color->id }}"/>--}}
{{--                                <input class="product_id" type="hidden" value="{{ $product->id }}" />--}}
                            </li>
                            @endforeach
                        </ul>



                    </div>
                    @endif
                    @if(count($product->productColors)>0)
                    <input type="hidden" name="there_is_color" id="there_is_color" @if(!$product->color_id) required="" value="1" @endif>
                           <input type="hidden" name="color_id" id="color_id"  @if(!$product->color_id) required="" value="{{ $product->color_id }}" @endif>
                           @endif
                           <div id="product" class="input-group">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="10" step="1" class="spinner"/>  </div>
                    <button type="submit" <?= ($product->price() == 0) ? "disabled" : "" ?>  class="btn btn-blue my-1" data-loading-text="Loading..."  id="button-cart"> {{_i("Add To Cart")}}</button>


                    <hr class="rule">

                    {{--loader spinner--}}

                    @if($product->product_type=="glasses")
                    @include("front.products.partial.glasses")
                    @elseif($product->product_type=="lenses")
                    @include("front.products.partial.lenses")

                    @endif

                </form>


                <div class="head-title"> {{ _i('Description') }}</div>
                <p class="description">
{{--                    @dd($product->description)--}}
                    {!! $product->description !!}
                </p>


                @if(!empty($product->atributeGroups))

                @foreach($product->atributeGroups as $attributeGroup)
                @if(!empty($attributeGroup->productAttributes))
                {{--                <div class="head-title"> {{ $attributeGroup->name }}</div>--}}
            <div class="head-title"> {{ _i('More Information') }} </div>
            <div class="description">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <?php
                        $data = \App\Models\PrAttributeDescription::join("pr_attributes", "pr_attributes.id", "pr_attribute_descriptions.pr_attribute_id")
                                ->join("product_attributes", "product_attributes.pr_attribute_id", "pr_attributes.id")
                                ->where("product_attributes.language_id", $language_id)
                                ->where("pr_attribute_descriptions.language_id", $language_id)
                                ->where("pr_attributes.attribute_group_id", $attributeGroup->id)
                                ->where("product_attributes.product_id", $product->id)
                                ->get();
                        //   dd($data)         ;
                        ?>
                        @foreach($data as $attribute)
                        <?php
                        $attribute2 = App\Models\PrAttributeDescription::where("language_id", "=", session()->get("language_id"))
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
</div>
@endsection
@include('front.home.banner3')
@section('section2')
@if(!empty($product->relatedProducts))
<div class="products-wrapper common-wrapper bg-white ">
    <div class="container">
        <div class="section-title">{{ _i('Similar Products') }}</div>
        <div class="row">
            @foreach($product->relatedProducts as $related)
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="single-feature-product d-flex">
                    <div class="media">
                        <a href="{{ route('product', [$currCountry->iso_code, $currCountry->code, $related->id]) }}" class="img-wrapper-anchor align-self-stretch">
                            <img src="{{ asset('images/products/'.$related->main_image) }}" class="align-self-center" alt="{{ $related->name }}">
                        </a>
                        <div class="media-body align-self-center">
                            <h3 class="title"><a href="{{ route('product', [$currCountry->iso_code, $currCountry->code, $related->id]) }}">{{ $related->name }}</a></h3>
                            <div class="small-rate rate">
                                <div class="star-ratings-sprite">
                                    @if(!empty($related->ratingPercentage))
                                    <span style="width:{{ $related->ratingPercentage }}%" class="star-ratings-sprite-rating"></span>
                                    @else
                                    <span style="width:0%" class="star-ratings-sprite-rating"></span>
                                    @endif
                                </div>
                            </div>
                            <div class="price-rate-purchase d-flex justify-content-between mt-auto">
                                <div class="price">@if(LaravelGettext::getLocale() == "ar") {{ $currentCountryCurrencyRight .' '. $related->price }}  @else  {{  $related->price . ' '. $currentCountryCurrencyLeft }} @endif</div>
                                <a href="{{ route('product', [$currCountry->iso_code, $currCountry->code, $related->id]) }}" class="add-to-cart"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
@section('reviews')

<div class="flash-message">
    <br>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <p class="alert alert-{{$msg}}">{{ Session::get($msg)}}</p>
    {{--<p class="alert alert-danger">jjhhjjk</p>--}}
    @endif
    @endforeach
</div>

<section class="review-section common-wrapper">
    <div class="container">
        <div class="section-title">{{ _i('Reviews') }}</div>
        <div class="current-review">
            {{ _i('You are now rating ') }}<strong><a href="">{{ $product->name }}</a></strong>
        </div>

        <form id="form-review" action="{{ route('review.add', [$currCountry->iso_code, $currCountry->code]) }}" method="POST" data-parsley-validate="">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div id="review"></div>

            <div class="rating mb-3">
                <input id="rating5" type="radio" name="rating" value="5" required="" @if(old('author') == 5) checked @endif>
                       <label for="rating5">5</label>
                <input id="rating4" type="radio" name="rating" value="4" @if(old('author') == 4) checked @endif>
                       <label for="rating4">4</label>
                <input id="rating3" type="radio" name="rating" value="3" @if(old('author') == 3) checked @endif>
                       <label for="rating3">3</label>
                <input id="rating2" type="radio" name="rating" value="2"  @if(old('author') == 2) checked @endif>
                       <label for="rating2">2</label>
                <input id="rating1" type="radio" name="rating" value="1" @if(old('author') == 1) checked @endif>
                       <label for="rating1">1</label>
            </div>
            <div class="form-row">
                <div class="col-md-5">
                    <input type="text" name="author" required="" minlength="3" maxlength="25" class="form-control" placeholder="{{ _i('Name') }}" value="{{ old('author') }}">
                </div>
                <div class="col-md-7">
                    <input type="text" name="review_text" required=""  minlength="25" maxlength="1000"  class="form-control" placeholder="{{ _i('Your Review') }}" value="{{ old('review_text') }}">
                </div>
                <div class="col-md-12">
                    <button type="submit" id="button-review" class="btn btn-blue">{{ _i('Review') }}</button>
                </div>
            </div>
        </form>

        @if(!empty($product->productReviews))
        <div class="users-reviews ">

            @foreach($product->productReviews as $review)
            <div class="single-comment">
                <div class="review-info">

                    <h5 class="review-author">  {{ $review->author }}</h5>
                    <span class="date-and-time"> {{ date('Y-m-d', strtotime($review->date_added)) }}  </span>
                    <div class="small-rate rate">
                        <div class="star-ratings-sprite">
                            <span style="width:{{ $review->ratingPercentage }}%" class="star-ratings-sprite-rating"></span>

                        </div>
                    </div>
                    <p> {!! $review->review_text !!}</p>
                </div>

                {{--    <ul class="list-inline comment-options">
                        <li class="list-inline-item"><a href="" data-toggle="tooltip" title="مفيد"><i class="fa fa-thumbs-o-up"></i></                        a></li>
                                <li class="list-inline-item"><a href="" data-toggle="tooltip" title="غير مفيد"><i class="fa fa-thumbs-o-down                                "></i></a></li>
                                </ul> --}}
            </div>
       @endforeach

        </div>
        @endif
    </div>
</section>
@endsection
@push('scripts')
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
                                <script type="text/javascript">
                                    function selectColor(obj)
                                    {
                                        // alert(9);
                                        //console.log(   $(obj));
                                        $(obj).next('input[type="radio"]').prop('checked', true);
                                      //  $(obj).next('input[type="radio"]').attr('style', 'left: -18px;    z-index: -8;    position: relative;');
                                    }

                                    $(function () {
                                        'use strict';
                                        // var price = $('#price').text();
                                        $(".sizePrice").on("change", function () {
                                            var sizePrice = $(this).children("option:selected").attr('price');
                                            var result = parseInt($('#price').text()) + parseInt(sizePrice);
                                            if (!isNaN(result)) {
                                                $('#price').text(result);
                                                $('#new_price').val(result);
                                            }
                                        });
                                    });

                                    $(function () {
                                        'use strict';
                                        // var price = $('#price').text();
                                        $(".sizePriceTwo").on("change", function () {
                                            var sizePrice = $(this).children("option:selected").attr('price');
                                            // console.log($('#price').text());
                                            var result = parseInt($('#price').text()) + parseInt(sizePrice);
                                            if (!isNaN(result)) {
                                                $('#price').text(result);
                                                $('#new_price').val(result);
                                            }
                                        });
                                    });

                                    $(function () {
                                        var radios = $('input[name=radio_perception]').change(function () {
                                            var value = radios.filter(':checked').val();
                                            if (value == "yes") {
                                                $("#div_glasses").show()
                                            } else {
                                                $("#div_glasses").hide()
                                            }
                                        });
                                        var radio = $('input[name=radio_perception_2]').change(function () {
                                            var value = radio.filter(':checked').val();
                                            console.log(value);
                                            if (value == "yes") {
                                                $("#div_lenses").show()
                                            } else {
                                                $("#div_lenses").hide()
                                            }
                                        });
                                        $(".diff").toggle();
                                        var chk = $('#chk_diff').change(function () {
                                            $(".diff").toggle();
//                            var value = chk.is("checked");
//                            if (value === true){$(".diff").show()} else {$(".diff").hide();alert("k")}
                                        });
                                        var cart_url = "{{ route('cart.add', [$currCountry->iso_code, $currCountry->code]) }}";
                                        var review_url = "{{ route('review.add', [$currCountry->iso_code, $currCountry->code]) }}";
                                        $('.single-product-page-wrapper').validator();
                                        var i = 1;
                                        function plus() {
                                            document.getElementById('quantity').value = ++i;
                                        }
                                        function minus() {
                                            document.getElementById('quantity').value = --i;
                                        }
                                        $(function () {
                                            'use strict';
                                            $(".buy-with-prescriptiopn").on("click", function () {
                                                $("#loadingmessage").css("display", "block");
                                                $(".column-form").css("display", "none");
                                                if (this) {
                                                    $.ajax({
                                                        url: '{{url('buy', [$currCountry->iso_code, $currCountry->code]) }}',
                                                        type: 'get',
                                                        dataType: 'html',
                                                        success: function (data) {
                                                            $("#loadingmessage").css("display", "none");
                                                            $('.column-form').css("display", "block").html(data);
                                                        }
                                                    });
                                                } else {
                                                    $('.column-form').html('');
                                                }
                                            });
                                        });

                                        {{--$(function () {--}}
                                        {{--    'use strict';--}}
                                        {{--    $(".showImage").on("click", function () {--}}
                                        {{--        var color_id = $(this).find('.color_id').first().val();--}}
                                        {{--        var product_id = $(this).find('.product_id').first().val();--}}
                                        {{--        console.log(color_id,product_id);--}}
                                        {{--        if (this) {--}}
                                        {{--            $.ajax({--}}
                                        {{--                url: '{{ route('product-image', [$currCountry->iso_code, $currCountry->code]) }}',--}}
                                        {{--                type: 'get',--}}
                                        {{--                dataType: 'json',--}}
                                        {{--                data:{_token: "{{ csrf_token() }}",color_id: color_id,product_id: product_id--}}
                                        {{--                },--}}
                                        {{--                success: function (data) {--}}
                                        {{--                    console.log(data['image']);--}}
                                        {{--                    // $(".main_image");--}}
                                        {{--                    $('.color_image').find('.image_color').attr('src', "{{ asset('images/products/') }}" + '/' + data['image'] +  '');--}}
                                        {{--                    --}}{{--$('.color_image').css("display", "block").append('<img src="{{ asset('images/products/') }}' + '/' + data['image'] + '" alt="">');--}}
                                        {{--                }--}}
                                        {{--            });--}}
                                        {{--        } else {--}}
                                        {{--            // $('.main_image').css("display", "block");--}}
                                        {{--        }--}}
                                        {{--    });--}}
                                        {{--});--}}
                                    })



                                </script>

    <!--<script src="{{asset('custom/product.js')}}"></script>-->
                                @endpush
