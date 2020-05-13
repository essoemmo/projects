@if(count($shippingOption) > 0)

    @php
        $currency = \App\Bll\Constants::defaultCurrency;
    @endphp

    <div class="col-sm-6">
        <input type="text" name="discount_code" class="discount_code form-control"
               placeholder="{{_i('Discount Code')}}">
        <div class="error" style="display: none">
            <div class="alert alert-danger">
                {{ _i('Discount Code Used Before') }}
            </div>
        </div>
        <div class="empty" style="display: none">
            <div class="alert alert-danger">
                {{ _i('Discount Code Doesn\'t Exists') }}
            </div>
        </div>
    </div>
    <br>
    @foreach($shippingOption as $option)
        <div class="column-data ship_{{ $option->id }}">
            <table class="table table-striped table-light">
                <tr>
                    <td>
                        <input type="radio" id="{{ $option->id }}" class="ship_id"
                               value="{{ $option->shipping_option_id }}" name="shippingOption">
                        <input type="hidden" value="{{ $option->cash_delivery_commission }}"
                               class="cash_delivery_commission" name="cash_delivery_commission">
                        <input type="hidden" value="{{ $option->cost }}" class="cost" name="cost">
                        <input type="hidden" value="{{ $option->id }}" class="id"></td>
                    <td>
                        @if($option->logo != null)
                            <img class="img-responsive" style="width: 100px;" src="{{ asset($option->logo) }}"
                                 alt=" {{ $option->title }}"><br>
                        @else
                            <img class="img-responsive" style="width: 100px;"
                                 src="https://via.placeholder.com/100x50.png" alt=" {{ $option->title }}"><br>
                        @endif
                    </td>
                    <td>
                        {{ _i('Shipping charges') }}
                        : {{ $option->cash_delivery_commission + $option->cost }} {{ $currency }}
                        | {{ _i('Delivery time') }} : {{ $option->delay }} | {{ _i('Shipping company') }}
                        : {{ $option->title }}
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

@else
    <div class="col-sm-12">
        <div class="alert alert-danger text-center">
            {{ _i('There is no shipping to this city or country') }}
        </div>
    </div>
@endif

<script>
    $(function () {
        'use strict';
        $(".discount_code").on('change', function () {
            var code = $(this).val();
            // console.log(discount);
            $('.error').css("display", "none");
            $('.empty').css("display", "none");
            if (code) {
                $.ajax({
                    url: '/store/getDiscount',
                    type: 'post',
                    DataType: 'json',
                    data: {code: code},
                    success: function (res) {
                        if (res != 0) {
                            $('.error').css("display", "none");
                            $('.empty').css("display", "none");
                            if (res.status != 0 && res.count != 0) {
                                if (res.type == 0) {
                                    var totalbefore = $('.totalBefore').text();
                                    var discount_amount = res.discount;
                                    var new_total = (parseInt(totalbefore) - ((parseInt(discount_amount) * parseInt(totalbefore)) / 100)).toFixed(0);
                                    $('.totalBefore').text(new_total + ' ' + '{{ $currency }}');
                                    $('.total_after').val(new_total + ' ' + '{{ $currency }}');
                                    $('.overAllTotal').text(new_total);
                                } else {
                                    var totalbefore = $('.totalBefore').text();
                                    var discount_amount = res.discount;
                                    var new_total = (parseInt(totalbefore) - parseInt(discount_amount)).toFixed(0);
                                    $('.totalBefore').text(new_total + ' ' + '{{ $currency }}');
                                    $('.total_after').val(new_total + ' ' + '{{ $currency }}');
                                    $('.overAllTotal').text(new_total);
                                }

                            } else {
                                $('.error').css("display", "block");
                            }
                        } else {
                            $('.empty').css("display", "block");
                        }
                    }
                })
            }
        })
    });
    $(function () {
        'use strict';
        $(".column-data").on('change', function () {
            var id = $(this).find('.ship_id').attr('id');
            var ship_id = $('.column-bank').find('.ship_' + id).find('.ship_id').val();
            var payment = $('#payment').val();
            // console.log(id,ship_id,payment);
            $.ajax({
                url: '/store/getShipCost',
                type: 'post',
                DataType: 'json',
                data: {ship_id: ship_id, payment: payment},
                success: function (res) {
                    $('.ship_cost').text(res);
                    var ship_cost = $('.ship_cost').text();
                    var total = $('.totalBefore').text();
                    var overAllTotal = parseInt(ship_cost) + parseInt(total.replace(',', ''));
                    $('.overAllTotal').text(overAllTotal);
                }
            })
        })
    })
</script>



