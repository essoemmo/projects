                <label class="col-md-3 col-form-label " for="discount_code">{{_i('Discount Code : ')}} </label>

<div class="col-sm-9">
        <input type="text" name="discount_code" id="discount_code" class="discount_code form-control" placeholder="{{_i('Discount Code')}}">
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
@if(!empty($shippingOption))
    @foreach($shippingOption as $option)
    <div class="column-data ship_{{ $option->shipping_option_id }}">
        <table class="table table-striped table-light">
            <tr>
                <td>
                    <input type="radio" id="{{ $option->shipping_option_id }}" class="ship_id" value="{{ $option->shipping_option_id }}" name="shippingOption">
                    <input type="hidden" value="{{ $option->cash_delivery_commission }}" class="cash_delivery_commission" name="cash_delivery_commission">
                    <input type="hidden" value="{{ $option->cost }}" class="cost" name="cost">
                    <input type="hidden" value="{{ $option->id }}" class="id">                </td>
                <td>
                    @if($option->logo != null)
                        <img class="img-responsive" style="width: 100px;" src="{{ $option->logo }}" alt=" {{ $option->title }}"><br>
                    @else
                        <img class="img-responsive" style="width: 100px;" src="https://via.placeholder.com/100x50.png" alt=" {{ $option->title }}"><br>
                    @endif
                </td>
                <td>
                    cost: {{ $option->cash_delivery_commission + $option->cost }} | delay : {{ $option->delay }} | company: {{ $option->title }}
                </td>
            </tr>
        </table>
        </div>
    @endforeach

@else
    <div class="col-sm-4">
        <div class="alert alert-danger">
           {{_i("There is no shipping to this city")}}
        </div>
    </div>
@endif

<script>
    $(function () {
        'use strict';
        $(".discount_code").on('change', function () {
            var discount = $(this).val();
            // console.log(discount);
            $('.error').css("display","none");
            $('.empty').css("display","none");
            if(discount) {
                $.ajax({
                    url: '/getDiscount',
                    type:'post',
                    DataType:'json',
                    data:{discount: discount},
                    success:function (res) {
                        // console.log(res);
                        if(res != 0) {
                            $('.error').css("display","none");
                            $('.empty').css("display","none");
                            if(res.type != 0) {
                                var totalbefore = '{{ \Cart::getTotal() }}';
                                var discount_amount = res.discount;
                                var new_total = parseInt(totalbefore) - (parseInt(totalbefore) * parseInt(discount_amount) / 100);
                                $('.totalBefore').text(new_total);
                                $('.total_after').val(new_total);
                                $('.overAllTotal').text(new_total);
                            } else {
                                $('.error').css("display","block");
                            }
                        } else {
                            $('.empty').css("display","block");
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
            var ship_id = $('.column-bank').find('.ship_'+id).find('.ship_id').val();
            var payment = $('#payment').val();
            // console.log(id);
            $.ajax({
                url: '/getShipCost',
                type:'post',
                DataType:'json',
                data:{ship_id: ship_id,payment: payment},
                success:function (res) {
                    // console.log(res);
                    $('.ship_cost').text(res);
                    var ship_cost = $('.ship_cost').text();
                    var total = $('.totalBefore').text();
                    // console.log(total);
                    var overAllTotal = parseInt(ship_cost) + parseInt(total);
                    $('.overAllTotal').text(overAllTotal);
                }
            })
        })
    })
</script>



