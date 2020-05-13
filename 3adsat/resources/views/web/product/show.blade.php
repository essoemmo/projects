@extends('web.layout.master')
@push('css')
    <link href="{{ asset('web/css/flexslider.css') }}" rel="stylesheet">
    @if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "ar")
        <link href="{{asset('web/css/flexslider-rtl-min.css')}}" rel="stylesheet">

    @else
        <link href="{{asset('web/css/flexslider.css')}}" rel="stylesheet">
    @endif

    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">--}}
    <style>
        .product-gallery .flexslider .slides img {
            opacity: 1;
        }
        .nice-select.open .list {
            max-height: 300px;
            overflow-y: scroll;
        }
        a.active {
            /*pointer-events: none;*/
            cursor: default;
        }
    </style>
@endpush
@section('content')

        @yield('glassess')
        @yield('lencess')



        @if(!empty($product->relatedProducts))
            <div class="products-wrapper common-wrapper bg-white ">
                <div class="container">
                    <div class="section-title">{{ _i('Similar Products') }}</div>
                    <div class="row">
                        @foreach($product->relatedProducts as $related)
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="single-feature-product d-flex">
                                    <div class="media">
                                        <a href="{{route('productDetailsByName',$related->name)}}" class="img-wrapper-anchor align-self-stretch">
                                            <img src="{{ asset('images/products/'.$related->main_image) }}" class="align-self-center" alt="{{ $related->name }}">
                                        </a>
                                        <div class="media-body align-self-center">
                                            <h3 class="title"><a href="{{route('productDetailsByName',$related->name)}}">{{ $related->name }}</a></h3>
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
                                                <div class="price">
                                                    @if($related->discount == null)
                                                        <span id="price"> {{ $related->price}} {{ $convert->code }} </span>
                                                        @if(LaravelGettext::getLocale() == "ar")
                                                        @endif
                                                        <input type="hidden" id="product_price" value="{{ $related->price }}">
                                                    @else
                                                        <s id="old" style="margin-left: 8px; display: inline-block"> {{ $related->price}} </s>
                                                        <span id="price"> {{ ($related->discount - $related->price) }}  {{ $convert->code }}</span>
                                                        @if(LaravelGettext::getLocale() == "ar")
                                                        @endif
                                                        <input type="hidden" id="product_price" value="{{ ($related->price - $related->discount) }}">
                                                    @endif
                                                </div>
                                                <a href="" class="add-to-cart"><i class="fa fa-shopping-cart"></i></a>
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


        <section class="review-section common-wrapper">
            <div class="container">
                <div class="section-title">{{ _i('Reviews') }}</div>
                <div class="current-review">
                    {{ _i('You are now rating ') }}<strong><a href="">{{ $product->name }}</a></strong>
                </div>

                <form id="form-review" action="{{route('rate-review')}}" method="POST" data-parsley-validate="">
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
                            <input type="text" id="author" name="author" required="" minlength="3" maxlength="25" class="form-control" placeholder="{{ _i('Name') }}" value="{{ old('author') }}">
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="review_text" name="review_text" required=""  minlength="25" maxlength="1000"  class="form-control" placeholder="{{ _i('Your Review') }}" value="{{ old('review_text') }}">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" data-id="{{isset(auth()->user()->id)?auth()->user()->id:''}}" id="button-review" class="btn btn-blue">{{ _i('Review') }}</button>
                        </div>
                    </div>
                </form>

                <?php
                $productReviews =  \Illuminate\Support\Facades\DB::table('user_rating')
                    ->leftJoin('ratings','ratings.id','user_rating.rating_id')
                    ->select(['user_rating.*','ratings.product_id','ratings.rating as raRating'])
                    ->where('ratings.product_id',$product->id)
                    ->where('user_rating.approve',1)->get();



//                $productReviews = \Illuminate\Support\Facades\DB::table('user_rating')->where('approve', 1)->where('product_id', $id)->orderBy('date_added', 'asc')->get();
//                if (!empty($productReviews)) {
//                    foreach ($productReviews as $review) {
//                        //get rating percentage
//                        $review->ratingPercentage = 100 / 5 * $review->rating;
//                    }
//                    $product->productReviews = $productReviews;
//                }

                ?>

                @if($productReviews->count() > 0)
                    <div class="users-reviews ">

                        @foreach($productReviews as $review)
                            <div class="single-comment">
                                <div class="review-info">

                                    <h5 class="review-author">  {{ $review->author }}</h5>
                                    <span class="date-and-time"> {{ date('Y-m-d', strtotime($review->created_at)) }}  </span>
                                    <div class="small-rate rate">
                                        <div class="star-ratings-sprite">
                                            <span style="width:{{ $review->raRating }}%" class="star-ratings-sprite-rating"></span>

                                        </div>
                                    </div>
                                    <p> {!! $review->comment !!}</p>
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

@push('js')
    {{--    <script src="{{asset('web/js/jquery.flexslider-min.js')}}"></script>--}}
    <script type="text/javascript">
        $(function () {
            $('#form-review').parsley();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
    <script type="text/javascript">

            function selectColor(obj)
            {
                // alert(9);
                //console.log(   $(obj));
                $(obj).next('input[type="radio"]').prop('checked', true);
                //  $(obj).next('input[type="radio"]').attr('style', 'left: -18px;    z-index: -8;    position: relative;');
            }

            $('a#buy_with_perception').click(function () {
                    if ($(this).hasClass('active')) {
                    $('#choose_color').css('display','block');
                    $('#collapseExample').css('display','none');
                }
            });

        $(function () {
            $('li .color_select').on('click', function () {

                $('#choose_color').css('display','none');
                $('#collapseExample').css('display','block');
                $('#buy_with_perception').removeClass('active');

            });



            $('#atributeGroups').on('click', function () {
                $('#atributeGroups_desc').toggle();
            });
        })




        $(function () {
            var result = '';
            var result_2 = '';
            var result_3 = '';
            var result_4 = '';
            var result_5 = '';
            var result_6 = '';
            var result_7 = '';
            var result_8 = '';
            var result_9 = '';
            $('.old_price').on('change', function () {
                var packPrice = $(this).children("option:selected").attr('price');
                result = packPrice;
                $('#price').text(result);
                $('#new_price').val(result);
            });
            $('#chk_diff').on('change', function() {
                var product_price = parseInt($('#product_price').val());
                var max_count = $('.max_count').val();
                var spinner_qty = $('.new_qty').val();
                if(this.checked) {
                    if(max_count ==  $('.new_qty').val()) {
                        new Noty({
                            type: 'warning',
                            layout: 'topRight',
                            text: "{{ _i('You have reached the order limit') }}",
                            timeout: 3000,
                            killer: true
                        }).show();
                    } else {
                        $('.new_qty').val(spinner_qty * 2);
                        if(result != '') {
                            result_2 = parseInt(result) * 2;
                            $('#price').text(result_2);
                        } else {
                            result_2 = product_price;
                            $('#price').text(result_2);
                        }
                    }
                } else {
                    if(result != '') {
                        $('.new_qty').val(1);
                        $('#price').text(result);
                        $('#new_price').val(result);
                    } else {
                        $('.new_qty').val(1);
                        $('#price').text(product_price);
                        $('#new_price').val(product_price);
                    }
                }
            });
            $(".sizePrice").on("change", function () {
                var sizePrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                if(result != '') {
                    result_3 = parseInt(result) + parseInt(sizePrice);
                }
                if(result_2 != '') {
                    result_3 = parseInt(result_2) + parseInt(sizePrice);
                } else {
                    result_3 = parseInt(result_2) + parseInt(sizePrice);
                }
                if(result_2 == '' && result == '') {
                    result_3 = parseInt(product_price) + parseInt(sizePrice);
                }
                if (!isNaN(result_3)) {
                    $('#price').text(result_3);
                    $('#new_price').val(result_3);
                   $(this).children(".option:selected").setAttribute("disabled","");
                }
            });
            $(".sizePriceTwo").on("change", function () {
                var sizePrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                    result_4 = parseInt(result_3);
                if (!isNaN(result_4)) {
                    $('#price').text(result_4);
                    $('#new_price').val(result_4);
                }
            });
            $(".cylPrice").on("change", function () {
                var cylPrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                if(result != '') {
                    result_5 = parseInt(result) + parseInt(cylPrice);
                }
                if(result_2 != '') {
                    result_5 = parseInt(result_2) + parseInt(cylPrice);
                }
                if(result_3 != '') {
                    result_5 = parseInt(result_3) + parseInt(cylPrice);
                }
                if(result_4 != '') {
                    result_5 = parseInt(result_4) + parseInt(cylPrice);
                }
                if(result_3 == '' && result_2 == '' && result == '' && result_4 == '') {
                    result_5 = parseInt(product_price) + parseInt(cylPrice);
                }

                if (!isNaN(result_5)) {
                    $('#price').text(result_5);
                    $('#new_price').val(result_5);
                    $(this).children(".option:selected").setAttribute("disabled","");
                }
            });
            $(".cylPriceTwo").on("change", function () {
                var cylPrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                result_6 = parseInt(result_5);
                if (!isNaN(result_6)) {
                    $('#price').text(result_6);
                    $('#new_price').val(result_6);
                }
            });
            $(".axis").on("change", function () {
                var axisPrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                if(result != '') {
                    result_7 = parseInt(result) + parseInt(axisPrice);
                }
                if(result_2 != '') {
                    result_7 = parseInt(result_2) + parseInt(axisPrice);
                }
                if(result_3 != '') {
                    result_7 = parseInt(result_3) + parseInt(axisPrice);
                }
                if(result_4 != '') {
                    result_7 = parseInt(result_4) + parseInt(axisPrice);
                }
                if(result_5 != '') {
                    result_7 = parseInt(result_5) + parseInt(axisPrice);
                }
                if(result_6 != '') {
                    result_7 = parseInt(result_6) + parseInt(axisPrice);
                }
                if(result_6 == '' && result_5 == '' && result_4 == '' && result_3 == '' && result_2 == '' && result == '') {
                    result_7 = parseInt(product_price) + parseInt(axisPrice);
                }
                if (!isNaN(result_7)) {
                    $('#price').text(result_7);
                    $('#new_price').val(result_7);
                    $(this).children(".option:selected").setAttribute("disabled","");
                }
            });
            $(".axisPriceTwo").on("change", function () {
                var axisPrice = $(this).children("option:selected").attr('price');
                var product_price = parseInt($('#product_price').val());
                result_8 = parseInt(result_7);
                if (!isNaN(result_8)) {
                    $('#price').text(result_8);
                    $('#new_price').val(result_8);
                }
            });
            $('.glasses_lens').on('change', function () {
                var lensPrice = $(this).val();
                var product_price = parseInt($('#product_price').val());
                result_9 = parseInt(product_price) + parseInt(lensPrice);
                if (!isNaN(result_9)) {
                    $('#price').text(result_9);
                    $('#new_price').val(result_9);
                }
            })
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
            var cart_url = "";
            var review_url = "";
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
                            url: '',
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

    <script type="text/javascript">
                {{--var pcop_data = {!! $product->optionJson !!};--}}
        var cart_url = ""  ;
        var review_url = ""  ;
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
                        url: '',
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

            $('body').on('click','#button-review',function (e) {
                e.preventDefault();
                // alert();

                   var data = $('#form-review').serialize();
                   var url = $('#form-review').attr('action');
                   var review_text = $('#review_text').val();
                   var author = $('#author').val();
                   var id = $(this).data('id');

                   if (review_text.length <= 0){
                       new Noty({
                           type: 'warning',
                           layout: 'topRight',
                           text: "{{ _i('You should write the comment') }}",
                           timeout: 2000,
                           killer: true
                       }).show();
                   }

                   if (author.length <= 0){
                       new Noty({
                           type: 'warning',
                           layout: 'topRight',
                           text: "{{ _i('You should write the auther') }}",
                           timeout: 2000,
                           killer: true
                       }).show();
                   }
                   // alert(review_text);

                            // console.log(data['author']);
                   if (id.length <= 0){
                       new Noty({
                           type: 'warning',
                           layout: 'topRight',
                           text: "{{ _i('You should first login') }}",
                           timeout: 2000,
                           killer: true
                       }).show();
                   }

                    $.ajax({
                        url: url,
                        method: "post",
                        data: {_token: '{{ csrf_token() }}',
                            data:data,
                        },
                        success: function (response) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Done the rated is sended') }}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    });




            })

        });
    </script>

{{--    <script src="{{asset('web/custom/product.js')}}"></script>--}}


@endpush
