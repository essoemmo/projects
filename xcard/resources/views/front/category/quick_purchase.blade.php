@extends('front.layout.index')

@section('content')

    @push('css')

        <style>
            .background-product_image {
                opacity: 1;
                border-radius: 18px;
                background-color: #e8e8e8;
                box-shadow: 0 1px 10px 0 rgba(0, 0, 0, .35);
                width: 250px;
                display: block;
                margin: 0 auto;
                height: 326px;
                /* margin: 34px auto; */
                margin-top: 30px;
            }

            .order-btn {
                width: 350px;
                height: 40px;
                border: none;
                display: block;
                background: #F4941C;
                border-radius: 20px;
                padding: 0 15px;
                color: #fff;
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 15px;
                outline: 0;
            }
        </style>

    @endpush



    <div class="payment-methods">
        <div class="container">
            <div class="wrapper">

                <div class="section-title"> {{_i('Quick purchase')}} </div>


                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="background-product_image">
                            <img src="" alt="" class="img_product">
                        </div>

                    </div>


                    <div class="col-sm-4">
                        <h6 class="text-white text-center my-4">  {{_i('Choose the card information')}} </h6>
                        <!-- Main Categories -->
                        <select name="main_cat_id" class="form-control main_cat_id">
                            <option selected disabled> {{_i('Choose')}}</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat['id']}}">{{$cat->translate(\app()->getLocale())->title}}</option>
                            @endforeach
                        </select>

                        <!-- Sub Categories -->

                        <select name="sub_cat_id" class="form-control sub_cat_id" id="sub_cat_id"  style="display: none; margin-top: 20px;">
                        </select>

                        <!-- Final ( sub ) sub Categories -->
                        <select name="final_cat_id" class="form-control final_cat_id" id="countryselector" style="display: none; margin-top: 20px;">
                        </select>

                        <!-- Products List -->
                        <select name="product_list_id" class="form-control product_list_id" id="priceselector" style="display: none; margin-top: 20px;" >
                        </select>
                        <br />
                        <a href="" class="order-now-btn" style="display: none; margin-top: 20px;" ><button type="button" class="order-btn" style=""> {{_i('Buy Now')}}</button></a>

                    </div>

                    </div>



                </div>
            </div>
        </div>

    @endsection
    @push('js')

        <script>
            $('.main_cat_id').bind('change', function () {
                cat_id = $('.main_cat_id option:selected').val();

                // Resting
                $('.sub_cat_id').fadeOut(100);
                //$('.background-product_image').html("");
                $('.final_cat_id').fadeOut(100);
                $('.product_list_id').fadeOut(100);
                $('.order-now-btn').fadeOut(100);
                $(".img_product").attr("src", "" );

                $.ajax({
                    dataType: 'json',
                    url: '{{url('/cat_list')}}',
                    data: 'cat_id=' + cat_id,
                    type: 'get',
                    success: function (result) {

                        html = '';
                        if (result.length) {
                            html +=
                                '<option  disabled selected>' + '{{_i('Choose')}}' +
                                '</option>';
                            $.each(result, function (key, val) {
                                html += '<option value="' + val.id + '" >' + val.title + '</option>';
                            });
                            if (html) {
                                $('.sub_cat_id').html(html);
                                $('.sub_cat_id').fadeIn(300);
                            }
                        }else{

                            // if not found categories where parent_id => cat_id;
                            // Products List
                            $('.product_list_id').fadeOut(100);
                            $.ajax({
                                dataType: 'json',
                                url: '{{url('/products_list')}}',
                                data: 'cat_id=' + cat_id,
                                type: 'get',
                                success: function (result) {

                                    if (result.length) {
                                        html +=
                                            '<option value="0" disabled selected>' + '{{_i('Choose')}}' +
                                            '</option>';
                                        $.each(result, function (key, val) {
                                            html += '<option value="' + val.id + '">' + val.title + '</option>';
                                        });
                                    }
                                    if (html) {
                                        $('.product_list_id').html(html);
                                        $('.product_list_id').fadeIn(300);

                                        $('.product_list_id').bind('change', function () {
                                            prod_id = $('.product_list_id option:selected').val();
                                            //console.log(prod_id);
                                            $.ajax({
                                                dataType: 'json',
                                                url: '{{url('/product_details')}}',
                                                data: 'product_id=' + prod_id,
                                                type: 'get',
                                                success: function (result) {
                                                    // console.log(img);

                                                    $('.order-now-btn').fadeIn(300);
                                                    $('.order-now-btn').attr("href", "{{url('buyNow')}}/"+result.id );
                                                    var img = "{{url('/')}}"+ result.main_image ;
                                                    $(".img_product").attr("src", img );

                                                }
                                            });

                                        });
                                    }
                                }
                            });

                        }

                    }
                });
            });

            $('.sub_cat_id').bind('change', function () {
                $('.add_br').show();
                $('.final_cat_id').fadeOut(100);
                $('.product_list_id').fadeOut(100);
                $('.order-now-btn').fadeOut(100);
                $(".img_product").attr("src", "" );


                subCat_id = $('.sub_cat_id option:selected').val();

                $.ajax({
                    dataType: 'json',
                    url: '{{url('/cat_list')}}',
                    data: 'cat_id=' + subCat_id,
                    type: 'get',
                    success: function (result) {
                        html = '';
                        if (result.length) {
                            html +=
                                '<option value="0" disabled selected>' + '{{_i('Choose')}}' +
                                '</option>';
                            $.each(result, function (key, val) {
                                html += '<option value="' + val.id + '" >' + val.title + '</option>';
                            });

                        }else {
                            // if not found categories where parent_id => cat_id;
                            // Products List
                            // console.log('here');
                            $('.product_list_id').fadeOut(100);
                            $.ajax({
                                dataType: 'json',
                                url: '{{url('/products_list')}}',
                                data: 'cat_id=' + subCat_id,
                                type: 'get',
                                success: function (result) {

                                    if (result.length) {
                                        html +=
                                            '<option value="0" disabled selected>' + '{{_i('Choose')}}' +
                                            '</option>';
                                        $.each(result, function (key, val) {
                                            html += '<option value="' + val.id + '">' + val.title + '</option>';
                                        });
                                    }
                                    if (html) {
                                        $('.product_list_id').html(html);
                                        $('.product_list_id').fadeIn(300);

                                        $('.product_list_id').bind('change', function () {
                                            prod_id = $('.product_list_id option:selected').val();
                                            //console.log(prod_id);
                                            $.ajax({
                                                dataType: 'json',
                                                url: '{{url('/product_details')}}',
                                                data: 'product_id=' + prod_id,
                                                type: 'get',
                                                success: function (result) {
                                                    // console.log(img);

                                                    $('.order-now-btn').fadeIn(300);
                                                    $('.order-now-btn').attr("href", "{{url('buyNow')}}/"+result.id );
                                                    var img = "{{ url('/') }}"+ result.main_image ;
                                                    $(".img_product").attr("src", img );

                                                }
                                            });

                                        });
                                    }
                                }
                            });

                        }}
                });
            });


        </script>

    @endpush

