@extends('store.layout.master')

@push('css')
    <style>
        select#city, select#country {
            display: block !important;
        }

        .countries .form-control.nice-select, .cities .form-control.nice-select {
            display: none !important;
        }

        #saveOrder fieldset:not(:first-of-type) {
            display: none;
        }

    </style>
@endpush


@php
    $currency = \App\Bll\Constants::defaultCurrency;
@endphp

@section('content')
    <br>
    @if (\Session::has('success'))
        <div class="text-center alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    @if (\Session::has('failure'))
        <div class="text-center alert alert-danger">
            <p>{{ \Session::get('failure') }}</p>
        </div><br/>
    @endif
    @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content()) > 0)
        <form action="{{ route('myfatoorah' ,app()->getLocale()) }}" target="_blank" method="POST" id="myfatoorah_form">
            @csrf
        </form>
        <form action="{{ url(app()->getLocale().'/store/saveallorders') }}" id="saveOrder" enctype="multipart/form-data"
              data-parsely-validate method="POST">

            @csrf

            @include('store.checkout.includes.shipping')

            @include('store.checkout.includes.payment')

            @include('store.checkout.includes.orderDetails')

        </form>
    @else
        <div class="alert alert-danger">
            <h2 class="text-center">{{_i('There are no products in the cart')}}</h2>
        </div>
    @endif
@endsection

@push('js')

    <script>

        $('.next').click(function () {
            $('#form_one').parsley().validate();
            var current = 1, current_step, next_step, steps;
            steps = $("fieldset").length;
            current_step = $(this).closest("fieldset");
            next_step = $(this).closest("fieldset").next();
            if ($('[name="shippingOption"]').is(':checked') && $('#form_one').parsley().validate() == true) {
                next_step.show();
                current_step.hide();
                $(".previous").click(function () {
                    current_step = $(this).closest("fieldset");
                    next_step = $(this).closest("fieldset").prev();
                    next_step.show();
                    current_step.hide();
                });
            } else {
                $('.error-shipping').css('display', 'block');
            }
        });

        $("#city").append('<option value>{{ _i('select') }}</option>');
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url(app()->getLocale().'/store/get-city-list')}}?country_id=" + countryID,
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>{{ _i('select') }}</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            } else {
                $("#city").empty();
            }
        });

        $(function () {
            'use strict';
            $("#city,#country").on("change", function () {
                var city = $('#city').val();
                var country = $('#country').val();
                $(".column-bank").css("display", "none");
                if (this) {
                    $.ajax({
                        url: '{{url(app()->getLocale().'/store/getBankDetails')}}',
                        type: 'get',
                        dataType: 'html',
                        data: {city: city, country: country},
                        success: function (data) {
                            $('.column-bank').css("display", "block").html(data);
                        }
                    });
                } else {
                    $('.column-bank').html('');
                }
            });
        });
        $(function () {
            'use strict';
            var country = '{{auth()->user()->country_id}}';
            if (country != null) {
                $.ajax({
                    type: "GET",
                    url: "{{url(app()->getLocale().'/store/get-city-list')}}?country_id=" + country,
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>{{ _i('select') }}</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            }
        });

        $('.add_delivery_cost').on('click', function () {
            var ship_cost = $('.shipping-cost').text();
            var total_before = $('.subtotal').text();
            var currency = '{{ $currency }}';
            var delivery_commission = $('.delivery_commission').text();
            var discount = $('.discount').text();
            if (discount == '') {
                discount = 0;
            }
            $('.shipping-cost').text(parseInt(ship_cost) + parseInt(delivery_commission) + ' ' + currency);
            $('.shipping_cost').val(parseInt(ship_cost) + parseInt(delivery_commission));
            $('.all_total').text((parseInt(ship_cost) + parseInt(total_before) - parseInt(discount) + parseInt(delivery_commission)) + ' ' + currency);
            $('.choose_bank_show').css('display', 'none');
            $('.choose_myfatoorah_show').css('display', 'none');
        });

        $('.choose_bank').on('click', function () {
            var ship_cost = $("input[name='shippingOption']:checked").next().next('.cost').val();
            var total_before = $('.subtotal').text();
            var currency = '{{ $currency }}';
            $('.shipping-cost').text(parseInt(ship_cost) + ' ' + currency);
            $('.shipping_cost').val(parseInt(ship_cost));
            $('.all_total').text(parseInt(ship_cost) + parseInt(total_before) + ' ' + currency);
            $('.choose_bank_show').css('display', 'block');
            $('.choose_myfatoorah_show').css('display', 'none');
        });

        $('.myfatoorah_show').on('click', function () {
            var ship_cost = $("input[name='shippingOption']:checked").next().next('.cost').val();
            var total_before = $('.subtotal').text();
            var discount = $('.discount').text();
            if (discount == '') {
                discount = 0;
            }
            var currency = '{{ $currency }}';
            $('.shipping-cost').text(parseInt(ship_cost) + ' ' + currency);
            $('.shipping_cost').val(parseInt(ship_cost));
            $('.all_total').text((parseInt(ship_cost) + parseInt(total_before) - parseInt(discount)) + ' ' + currency);
            $('.choose_myfatoorah_show').css('display', 'block');
            $('.choose_bank_show').css('display', 'none');
        });

        $('.bank').on('change', function () {
            var bank_id = $(this).children("option:selected").val();
            $('.bank-details').css('display', 'none');
            if (bank_id != null) {
                $.ajax({
                    type: "GET",
                    url: "{{url(app()->getLocale().'/store/bank-details')}}",
                    dataType: 'html',
                    data: {bank_id: bank_id},
                    success: function (data) {
                        $('.bank-details').css('display', 'block').html(data);
                    }
                });
            }
        });

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }

        $(function () {
            'use strict';
            $(".discount_code").on('click', function () {
                var code = $('input[name=discount_code]').val();
                $('.error').css("display", "none");
                $('.empty').css("display", "none");
                $('.show_discount').css("display", "none !important");
                if (code) {
                    $.ajax({
                        url: '{{ route('getDiscount', app()->getLocale()) }}',
                        type: 'post',
                        DataType: 'json',
                        data: {code: code},
                        success: function (res) {
                            if ($.isArray(res)) {
                                res.map(function (data) {
                                    if (data.response == 0) {
                                        $('.empty').css("display", "block").children('.empty_text').text(data.message);
                                        $('.show_discount').css("display", "none !important");
                                    }
                                });
                            } else {
                                if (res.response != 0) {
                                    $('.error').css("display", "none");
                                    $('.empty').css("display", "none");
                                    $('.show_discount').css("display", "block");
                                    if (res.discount.status != 0 && res.discount.count != 0) {
                                        if (res.discount.type == 'perc') {
                                            var totalbefore = $('.subtotal').text();
                                            var shipping = $('.shipping-cost').text();
                                            var discount_amount = res.discount.discount;
                                            var discount = ((parseInt(discount_amount) * parseInt(totalbefore)) / 100).toFixed(0);
                                            var new_total = (parseInt(totalbefore) + parseInt(shipping)) - parseInt(discount);
                                            $('.discount').text(discount + ' ' + '{{ $currency }}');
                                            $('.all_total').text(new_total + ' ' + '{{ $currency }}');
                                            $('.discount_id').val(res.discount.id);
                                            $('.discount_cost').val(discount);
                                            $('.discount_cost_myfatoorah').val(discount);
                                        } else if (res.discount.type == 'fixed') {
                                            var totalbefore = $('.subtotal').text();
                                            var shipping = $('.shipping-cost').text();
                                            var discount_amount = res.discount.discount;
                                            var discount = parseInt(discount_amount).toFixed(0);
                                            var new_total = (parseInt(totalbefore) + parseInt(shipping)) - parseInt(discount);
                                            $('.discount').text(discount + ' ' + '{{ $currency }}');
                                            $('.all_total').text(new_total + ' ' + '{{ $currency }}');
                                            $('.discount_id').val(res.discount.id);
                                            $('.discount_cost').val(discount);
                                            $('.discount_cost_myfatoorah').val(discount);
                                        }
                                    } else {
                                        $('.error').css("display", "block");
                                        $('.show_discount').css("display", "none !important");
                                    }
                                } else {
                                    // $('.empty').css("display", "block").children('.empty_text').text(res[1]);
                                    $('.show_discount').css("display", "none !important");
                                }
                            }

                        }
                    })
                }
            })
        });

        $('.order_save').on('click', function () {
            $("#form_one :input").each(function () {
                $(this).attr('form', 'saveOrder');
            });
            document.getElementById("saveOrder").submit();
        });



        {{--$('.myfatoorah').on('click', function () {--}}
        {{--    var total = parseInt($('.price_myfatoorah').val()).toFixed(0);--}}
        {{--    var currency = $('.currency_myfatoorah').val();--}}
        {{--    var shipping_cost = parseInt($('.shipping_cost').val());--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: "{{ route('myfatoorah') }}",--}}
        {{--        dataType: 'json',--}}
        {{--        data: {total: total, currency: currency, shipping_cost: shipping_cost},--}}
        {{--        success: function (data) {--}}

        {{--        }--}}
        {{--    });--}}
        {{--});--}}


    </script>
@endpush


