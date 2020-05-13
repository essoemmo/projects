<script>


    function showImg(input) {

        var filereader = new FileReader();
        filereader.onload = (e) => {
            console.log(e);
            $('#article_img').attr('src', e.target.result).width(250).height(250);
        };
        console.log(input.files);
        filereader.readAsDataURL(input.files[0]);

    }
</script>

@if(count($shippingOption) > 0)
<div class="row">
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

                            <label class="col-md-3 col-form-label " for="bank">{{_i('Bank :')}} </label>

    <div class="col-sm-9">
        <select class="form-control"  id="bank" name="bank">
            <option value="" selected disabled>{{ _i('select') }}</option>
            @foreach($banks as $key => $bank)
                <option value="{{ $key }}">{{ $bank }}</option>
            @endforeach
        </select>
    </div>
                            <label class="col-md-3 col-form-label " for="bank">{{_i('Sender Name :')}} </label>


    <div class="col-sm-9">

            <input type="text" class="form-control" name="holder_name" id="holder_name"
                   value="{{old('holder_name')}}" placeholder="{{ _i('Holder name') }}" required="">
            <span class="text-danger invalid-feedback">
                <strong>{{$errors->first('holder_name')}}</strong>
            </span>

    </div>
                            <label class="col-md-3 col-form-label " for="bank_transactions_num">{{_i('Transaction Number :')}} </label>

    <div class="col-sm-9">

            <input type="text" class="form-control" name="bank_transactions_num" id="bank_transactions_num"
                   value="{{old('bank_transactions_num')}}" placeholder="{{ _i('Bank Transactions number') }}" required="">
            <span class="text-danger invalid-feedback">
                <strong>{{$errors->first('bank_transactions_num')}}</strong>
            </span>

    </div>
                            <label class="col-md-3 col-form-label " for="logo">{{_i('Transaction Photo :')}} </label>

    <div class="col-sm-9">

            <input type="file" name="image" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                   value="{{old('image')}}" required="">
            <span class="text-danger invalid-feedback">
                <strong>{{$errors->first('image')}}</strong>
            </span>
            <img class="img-responsive pad" id="article_img">

    </div>
</div>



<div class="">

        @foreach($shippingOption as $option)
            <div class="column-data ship_{{ $option->shipping_option_id }}">
                <br>
                <table class="table table-striped table-light">
                    <tr>
                        <td>
                            <input type="radio" id="{{ $option->shipping_option_id }}" class="ship_id" value="{{ $option->shipping_option_id }}" name="shippingOption">
                            <input type="hidden" value="{{ $option->cost }}" name="cost">
                        </td>
                        <td>
                            @if($option->logo != null)
                                <img class="img-responsive" style="width: 100px;" src="{{ $option->logo }}" alt=" {{ $option->title }}"><br>
                            @else
                                <img class="img-responsive" style="width: 100px;" src="https://via.placeholder.com/100x50.png" alt=" {{ $option->title }}"><br>
                            @endif
                        </td>
                        <td>
                            cost: {{ $option->cost }} | deley : {{ $option->delay }} | company: {{ $option->title }}
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
</div>
<div class="clearfix"></div>

@elseif(count($shippingOption) == 0)
<div class="col-3">

</div>
    <div class="alert alert-danger col-9">
        {{_i('There is no shipping to this province or state')}}
    </div>
@endif


<script>
    $(function () {
        'use strict';
        $(".column-data").on('change', function () {
            var id = $(this).find('.ship_id').attr('id');
            var ship_id = $('.column-bank').find('.ship_'+id).find('.ship_id').val();
            var payment = $('#payment').val();
            $(this).find('.ship_cost').text(0);
            // console.log(ship_id);
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
                    var overAllTotal = parseInt(ship_cost) + parseInt(total);
                    console.log(overAllTotal);
                    $('.overAllTotal').text(overAllTotal);
                }
            })
        })
    })

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
</script>


