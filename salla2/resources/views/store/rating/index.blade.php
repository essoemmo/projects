@extends('store.layout.master')

@section('content')

@push('css')
<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .clearfix {
        clear: both;
    }

    .text-center {
        text-align: center;
    }

    a {
        color: tomato;
        text-decoration: none;
    }

    a:hover {
        color: #2196f3;
    }

    pre {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.42857143;
        color: #333;
        word-break: break-all;
        word-wrap: break-word;
        background-color: #F5F5F5;
        border: 1px solid #CCC;
        border-radius: 4px;
    }

    .header {
        padding: 20px 0;
        position: relative;
        margin-bottom: 10px;

    }

    .header:after {
        content: "";
        display: block;
        height: 1px;
        background: #eee;
        position: absolute;
        left: 30%;
        right: 30%;
    }

    .header h2 {
        font-size: 3em;
        font-weight: 300;
        margin-bottom: 0.2em;
    }

    .header p {
        font-size: 14px;
    }



    #a-footer {
        margin: 20px 0;
    }

    .new-react-version {
        padding: 20px 20px;
        border: 1px solid #eee;
        border-radius: 20px;
        box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);

        text-align: center;
        font-size: 14px;
        line-height: 1.7;
    }

    .new-react-version .react-svg-logo {
        text-align: center;
        max-width: 60px;
        margin: 20px auto;
        margin-top: 0;
    }





    .success-box {
        margin: 50px 0;
        padding: 10px 10px;
        border: 1px solid #eee;
        background: #f9f9f9;
    }

    .success-box img {
        margin-right: 10px;
        display: inline-block;
        vertical-align: top;
    }

    .success-box>div {
        vertical-align: top;
        display: inline-block;
        color: #888;
    }



    /* Rating Star Widgets Style */
    .rating-stars ul {
        list-style-type: none;
        padding: 0;
        margin-left: -368px;

        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
        display: inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
        font-size: 2.5em;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
        color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
        color: #FF912C;
    }

</style>
@endpush



@push('js')


<script>
    $(function () {
        'use strict'

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.star', function () {
            var stars = $(this).data('value');
            var product = $(this).data('pro');
            var user = "{{auth()->guard('web')->id()}}";
            var store = "{{\App\Bll\Utility::getStoreId()}}"


            $.ajax({
                url: "{{route('rating' ,app()->getLocale())}}",
                type: 'post',
                dataType: 'json',
                data: {
                    stars: stars,
                    product: product,
                    user: user,
                    store: store
                },
                success: function (res) {

                    console.log(res.rating_id);


                }
            })
        })
    })

</script>
@endpush



<div class="products-wrapper ">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 order-lg-0 order-1">
                <div class="top-product-helper mb-3">
                    <div class="row">
                        <div class="col-6 d-flex align-self-center my-1">
                            <div class="page-title"> {{_i('Product Rating List')}}</div>
                        </div>
                    </div>
                </div>
                @if (!empty($products_orders))
                @foreach($products_orders as $product)

                <div class="single-full-product wide-product mb-4 p-3">

                    <div class="media">
                        <div class="product-thumbnail">
                            <img src="{{asset($product->image)}}" alt="" class="img-fluid">
                        </div>

                        <div class="media-body">
                            <div class="d-md-flex justify-content-between align-items-center mb-2">
                                <h2 class="title"><a href="{{route('product_url',[app()->getLocale(),$product->id])}}">
                                        {!!$product->productname!!}</a>
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

                            </div>
                            <p>
                                {!!$product->description!!}
                            </p>
                            {{-- @dd(\App\Bll\Utility::GetRating(auth()->user()->id,$product->id)); --}}
                            @php

                         $userrate = \App\Bll\Utility::GetRating(auth()->user()->id,$product->id);

                            @endphp
                            <div class='rating-stars text-center'>
                                @if(!isset($userrate))
                                <ul class="list-inline" id="stars">
                                    <span style="display:inline-block" class="pro" data-pro=""></span>
                                    <li class='star' title='Poor' data-value='1' data-pro="{{$product->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2' data-pro="{{$product->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3' data-pro="{{$product->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4' data-pro="{{$product->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5' data-pro="{{$product->id}}">
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                                @else
                                <ul class="list-inline">
                                    @for($i = 0; $i < $userrate->rating; $i++)
                                  <li class='star selected'><i class='fa fa-star fa-fw'></i></li>
                                    @endfor
                                </ul>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif
            </div>

        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function () {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });


    });


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

</script>
@endpush

@endsection
