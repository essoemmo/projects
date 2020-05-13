@extends('web.layout.master')
@push('css')
    <link href="{{ asset('web/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/flexslider-rtl-min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
@endpush
{{--@section('breadcrumb')--}}
{{--    <style type="text/css">--}}
{{--        table.table-bordered>tbody>tr>td {--}}
{{--            border: 1px solid grey;--}}
{{--        }--}}

{{--    </style>--}}
{{--    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">--}}
{{--        <div class="container">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{ route('homepage', [$currCountry->iso_code, $currCountry->code]) }}">{{ _i('Home') }}</a></li>--}}
{{--                @if(!empty($product))--}}
{{--                    <li class="breadcrumb-item" aria-current="page">--}}
{{--                        <a href="{{ route('category', [$currCountry->iso_code, $currCountry->code, $product->id]) }}"> {{ $product->name }} </a>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--@endsection--}}
@section('section1')
    <div class="single-product-page-wrapper common-wrapper">
        <div class="container productContainer">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <div id="slider" class="flexslider shadow-sm">
                            <ul class="slides">
                                @if($product->color_image)
                                    <li>
                                        <img src="{{ asset('images/products/'.$product->color_image) }}" />
                                    </li>
                                @endif
                                <li>
                                    <img src="{{ asset('images/products/'.$product->main_image) }}" />
                                </li>
                                @if(!empty($product->productImages))
                                    @foreach($product->productImages as $image)
                                        <li><img src="{{ asset('images/products/'.$image->image) }}" /></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider shadow-sm">
                            <ul class="slides">
                                @if($product->color_image)
                                    <li>
                                        <img src="{{ asset('images/products/'.$product->color_image) }}" />
                                    </li>
                                @endif
                                <li><img src="{{ asset('images/products/'.$product->main_image) }}" /></li>
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
                    <div class="price" style="color: #696969;font-size: 20px;">
                        @if(LaravelGettext::getLocale() == "ar") {{ $product->price. " ". $currentCountryCurrencyRight  }} @else {{ $product->price . ' '. $currentCountryCurrencyLeft }} @endif
                    </div>
                    <div class="rate small-rate">
                        <span>Be the first to review this product</span>
                    </div>
                    <div class="deliver">
                        <span>Delivered in 2-4 days</span>
                    </div>
                    <div class="">
                        @if(!empty($product->stockStatusName))
                            {{ $product->stockStatusName }}
                        @endif
                    </div>
                    @if(!empty($product->productColors))
                        <div id="trigger-color-imgs" class="product-available-colors ">
                            <ul class="list-inline product-available-colors-ul">
                                @foreach($product->productColors as $color)
                                    <li class="list-inline-item" onclick="location.href='{{ route('product-color', [$currCountry->iso_code, $currCountry->code, $product->id, $color->id]) }}';">
                                        <a href="{{ route('product-color', [$currCountry->iso_code, $currCountry->code, $product->id, $color->id]) }}" style="background: {{ $color->color }};" data-img="{{ asset('images/products/'.$color->image) }}"></a>
                                    </li>
                                @endforeach
                            </ul>

                            @if($product->productColors)
                                <input type="hidden" name="there_is_color" id="there_is_color" @if(!$product->color_id) required="" value="1" @endif>
                                <input type="hidden" name="color_id" id="color_id"  @if(!$product->color_id) required="" value="{{ $product->color_id }}" @endif>
                            @endif

                        </div>
                    @endif

                    <form id="productsForm" action="{{ route('cart.add', [$currCountry->iso_code, $currCountry->code]) }}" method="POST" >
                        @csrf
                            <div class="fieldset">
                                <div class="field configurable required">
                                    <label class="label">
                                        <span>Package Size</span>
                                    </label>
                                    <div class="control">
                                        <select data-validate="{required:true}" class="super-attribute-select" aria-required="true" style="width: 80%">

                                            <option value="">Choose an Option...</option>
                                            <option value="">Pack of 30 lenses</option>
                                            <option value="">Pack of 90 lenses</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <br>
                                    <div class="is-need-prescription-form">
                                        <label for="yes" class="label yes">
                                            <input type="radio" id="yes" name="radio">
                                            <span class="radio"></span>
                                            <span>I need 2 different powers</span>
                                        </label>
                                    </div>
                                    <div id="eyes-container-right" class="different-lens right">
                                        <div class="head-title" style="display: none;">
                                            <div class="control">
                                                <label class="label">Right eye</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="field title right-sphere-power-box required">
                                                    <label class="label">
                                                        <span>Sphere (Power)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="field right-sphere-power-box required">
                                                    <div class="control">
                                                        <select class="product-custom-option validate-select">
                                                            <option value="">- Select -</option>
                                                            <option value="1773925" price="0.0000">+5.75</option>
                                                            <option value="1773926" price="0.0000">+6.00</option>
                                                            <option value="1773927" price="0.0000">+5.50</option>
                                                            <option value="1773928" price="0.0000">+5.25</option>
                                                            <option value="1773929" price="0.0000">+5.00</option>
                                                            <option value="1773930" price="0.0000">+4.75</option>
                                                            <option value="1773931" price="0.0000">+4.50</option>
                                                            <option value="1773932" price="0.0000">+4.25</option>
                                                            <option value="1773933" price="0.0000">+4.00</option>
                                                            <option value="1773934" price="0.0000">+3.75</option>
                                                            <option value="1773935" price="0.0000">+3.50</option>
                                                            <option value="1773936" price="0.0000">+3.25</option>
                                                            <option value="1773937" price="0.0000">+3.00</option>
                                                            <option value="1773938" price="0.0000">+2.75</option>
                                                            <option value="1773939" price="0.0000">+2.50</option>
                                                            <option value="1773940" price="0.0000">+2.25</option>
                                                            <option value="1773941" price="0.0000">+2.00</option>
                                                            <option value="1773942" price="0.0000">+1.75</option>
                                                            <option value="1773943" price="0.0000">+1.50</option>
                                                            <option value="1773944" price="0.0000">+1.25</option>
                                                            <option value="1773945" price="">+1.00</option>
                                                            <option value="1773946" price="">+0.75</option>
                                                            <option value="1773947" price="">+0.50</option>
                                                            <option value="1773948" price="">+0.25</option>
                                                            <option value="1773949" price="">-0.25</option>
                                                            <option value="1773950" price="">-0.50</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="field title number-of-boxes-title required">
                                                    <div class="control">
                                                        <label class="label">Number of boxes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <div class="field qty">
                                                            <label class="label" for="qty"><span>{{ _i('Quantity') }}</span></label>
                                                            <div class="control form-group">
                                                                <span class="edit-qty minus" onclick="minus()">-</span>
                                                                <input type="number" name="quantity" id="quantity" min="1" max="50" value="{{ $product->minimum_order_amount }}" title="Qty" class="input-text qty" step="1">

                                                                <span class="edit-qty plus" onclick="plus()">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div id="eyes-container-left" class="different-lens left" style="display: none;">
                                        <div class="head-title">
                                            <div class="control">
                                                <label class="label">Left eye</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="control">
                                                <select name="options[44319]" id="select_44319" class="product-custom-option" title="Sphere (Power) L" data-selector="options[44319]" disabled="">
                                                    <option value="" selected="selected">- Select -</option>
                                                    <option value="1773985" price="0.0000">+5.75</option>
                                                    <option value="1773986" price="0.0000">+6.00</option>
                                                    <option value="1773987" price="0.0000">+5.50</option>
                                                    <option value="1773988" price="0.0000">+5.25</option>
                                                    <option value="1773989" price="0.0000">+5.00</option>
                                                    <option value="1773990" price="0.0000">+4.75</option>
                                                    <option value="1773991" price="0.0000">+4.50</option>
                                                    <option value="1773992" price="0.0000">+4.25</option>
                                                    <option value="1773993" price="0.0000">+4.00</option>
                                                    <option value="1773994" price="0.0000">+3.75</option>
                                                    <option value="1773995" price="0.0000">+3.50</option>
                                                    <option value="1773996" price="0.0000">+3.25</option>
                                                    <option value="1773997" price="0.0000">+3.00</option>
                                                    <option value="1773998" price="0.0000">+2.75</option>
                                                    <option value="1773999" price="0.0000">+2.50</option>
                                                    <option value="1774000" price="0.0000">+2.25</option>
                                                    <option value="1774001" price="0.0000">+2.00</option>
                                                    <option value="1774002" price="0.0000">+1.75</option>
                                                    <option value="1774003" price="0.0000">+1.50</option>
                                                    <option value="1774004" price="0.0000">+1.25</option>
                                                    <option value="1774005" price="">+1.00</option>
                                                    <option value="1774006" price="">+0.75</option>
                                                    <option value="1774007" price="">+0.50</option>
                                                    <option value="1774008" price="">+0.25</option>
                                                    <option value="1774009" price="">-0.25</option>
                                                    <option value="1774010" price="">-0.50</option>
                                                    <option value="1774011" price="">-0.75</option>
                                                    <option value="1774012" price="">-1.00</option>
                                                    <option value="1774013" price="">-1.25</option>
                                                    <option value="1774014" price="">-1.50</option>
                                                    <option value="1774015" price="">-1.75</option>
                                                    <option value="1774016" price="">-2.00</option>
                                                    <option value="1774017" price="">-2.25</option>
                                                    <option value="1774018" price="">-2.50</option>
                                                    <option value="1774019" price="">-2.75</option>
                                                    <option value="1774020" price="">-3.00</option>
                                                    <option value="1774021" price="">-3.25</option>
                                                    <option value="1774022" price="">-3.50</option>
                                                    <option value="1774023" price="">-3.75</option>
                                                    <option value="1774024" price="">-4.00</option>
                                                    <option value="1774025" price="">-4.25</option>
                                                    <option value="1774026" price="">-4.50</option>
                                                    <option value="1774027" price="">-4.75</option>
                                                    <option value="1774028" price="">-5.00</option>
                                                    <option value="1774029" price="">-5.25</option>
                                                    <option value="1774030" price="">-5.50</option>
                                                    <option value="1774031" price="">-5.75</option>
                                                    <option value="1774032" price="">-6.00</option>
                                                    <option value="1774033" price="">-6.50</option>
                                                    <option value="1774034" price="">-7.00</option>
                                                    <option value="1774035" price="">-7.50</option>
                                                    <option value="1774036" price="">-8.00</option>
                                                    <option value="1774037" price="">-8.50</option>
                                                    <option value="1774038" price="">-9.00</option>
                                                    <option value="1774039" price="">-9.50</option>
                                                    <option value="1774040" price="">-10.00</option>
                                                    <option value="1774041" price="">-10.50</option>
                                                    <option value="1774042" price="">-11.00</option>
                                                    <option value="1774043" price="">-11.50</option>
                                                    <option value="1774044" price="">-12.00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field num-of-box">
                                            <div class="control">
                                                <span class="edit-num-of-box minus">-</span>
                                                <input type="number" name="options[number-of-box-left]" id="number-of-box-left" maxlength="12" value="1" title="Number of boxes" class="input-text num-of-box validate-number validate-greater-than-zero">
                                                <span class="edit-num-of-box plus">+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div id="subscription">
                                    <div class="grid is-need-prescription-form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="yes" class="label yes">
                                                    <input type="radio" id="yes" name="radio">
                                                    <span class="radio"></span>
                                                    <span>One time order</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="no" class="label">
                                                    <input type="radio" id="no" name="radio">
                                                    <span class="radio"></span>
                                                    <span>Subscription (Auto-Reorder)</span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr class="rule">
                                    </div>
                                        <div class="field">
                                            <label class="label" for="select_44825">
                                                <span>How Often?</span>
                                            </label>
                                            <div class="control">
                                                <select name="options[44825]" id="select_44825" class=" product-custom-option admin__control-select" title="" data-selector="options[44825]"><option value="">-- Please Select --</option><option value="1790881" price="0">Every 15 days</option><option value="1790882" price="0">Every 30 days</option><option value="1790883" price="0">Every 45 days</option><option value="1790884" price="0">Every 90 days</option></select> </div>
                                        </div>
                                    </div>
                            </div>
                    </form>
                    {{-- <a href="#collapseExample" class="btn btn-green" data-toggle="collapse">شراء مع العدسات الطبية</a>
                    <div id="collapseExample" class="collapse">
                    </div> --}}

                    {{--    <form class="form-inline custom-number-input">
                           <input type="number" value="1" min="1" step="1" class="spinner" id="productNum" name="productNum" />
                           <button type="submit" class="btn btn-blue my-1"> {{ _i('Add To Cart') }}</button>
                       </form> --}}

                    <div class="head-title"> {{ _i('Description') }}</div>
                    <p class="description">
                        {!! $product->description !!}
                    </p>


                    @if(!empty($product->atributeGroups))
                        @foreach($product->atributeGroups as $attributeGroup)
                            @if(!empty($attributeGroup->productAttributes))
{{--                                <div class="head-title"> {{ $attributeGroup->name }}</div>--}}
                                <div class="head-title"> {{ _i('More Inforamtion') }}</div>
                                <div class="description">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        @foreach($attributeGroup->productAttributes as $attribute)
                                            <tr>
                                                <td>{{ $attribute->attribute_name }}</th>
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
                                   <li class="list-inline-item"><a href="" data-toggle="tooltip" title="مفيد"><i class="fa fa-thumbs-o-up"></i></a></li>
                                   <li class="list-inline-item"><a href="" data-toggle="tooltip" title="غير مفيد"><i class="fa fa-thumbs-o-down"></i></a></li>
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
        {{--var pcop_data = {!! $product->optionJson !!};--}}
        var cart_url = "{{ route('cart.add', [$currCountry->iso_code, $currCountry->code]) }}"  ;
        var review_url = "{{ route('review.add', [$currCountry->iso_code, $currCountry->code]) }}"  ;
        $('.single-product-page-wrapper').validator();
        // function showColorImage(colorId)
        // {
        //      $.ajax({
        //             type: 'GET',
        //             url: ,
        //             data: {colorId: colorId},
        //             success: function (response) {
        //                 $('#product-main-image').html(response);
        //             }
        //         });
        // }
        // function incrementValue()
        // {
        //     var value = parseInt(document.getElementById('quantity').value, 10);
        //     value = isNaN(value) ? 1 : value;
        //     value++;
        //     document.getElementById('quantity').value = value;
        // }

        var i = 1;
        function plus() {
            document.getElementById('quantity').value = ++i;
        }
        function minus() {
            document.getElementById('quantity').value = --i;
        }
        $(function () {
            'use strict';

            $(".buy-with-prescriptiopn").on("click",function(){
                $("#loadingmessage").css("display","block");
                $(".column-form").css("display","none");
                if (this){
                    $.ajax({
                        url: '{{url('buy', [$currCountry->iso_code, $currCountry->code]) }}',
                        type:'get',
                        dataType:'html',
                        success: function (data) {
                            $("#loadingmessage").css("display","none");
                            $('.column-form').css("display","block").html(data);

                        }
                    });
                }else{
                    $('.column-form').html('');
                }
            });
        });
    </script>

    <script src="{{asset('custom/product.js')}}"></script>
@endpush
