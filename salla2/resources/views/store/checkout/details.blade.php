@if(count($shippingOption) > 0)

<div class="card shadow-sm">
    <div class="card-body">
        <div class="card-header pt-0 pr-0 mb-2">{{ _i('Shipping Companies') }}
            <strong class="error-shipping" style="color: red; display: none">{{ _i('Choose One Please') }}</strong>
        </div>

        @php
        $currency = \App\Bll\Constants::defaultCurrency;
        @endphp


        <div class="addresses-wrapper">
            <div class="single-address">
                <div class="row">
                    <div class="col-md-3">

                        <h6>{{ _i('Name') }}</h6>

                    </div>
                    <div class="col-md-3">
                        <h6>{{ _i('Cost') }}</h6>

                    </div>
                    <div class="col-md-3">
                        <h6>{{ _i('Delivery time') }}</h6>

                    </div>
                </div>
            </div>
                @foreach($shippingOption as $option)
 <div class="single-address">
                <div class="row">

                    <div class="col-md-3">
                        <input form="saveOrder" type="radio" required
                               id="{{ $option->id }}"
                               class="ship_id"
                               value="{{ $option->shipping_option_id }}" name="shippingOption">
                        <input type="hidden" value="{{ $option->cash_delivery_commission }}"
                               class="cash_delivery_commission" name="cash_delivery_commission">
                        <input type="hidden" value="{{ $option->cost }}" class="cost" name="cost">
                        <input type="hidden" value="{{ $option->id }}" class="id">
                      
                        <label for="{{ $option->id }}">{{ $option->title }}</label>
                    </div>
                    <div class="col-md-3">
                      
                        <label for="{{ $option->id }}">{{ $option->cost }}</label>
                    </div>
                    <div class="col-md-3">
                      
                        <label for="{{ $option->id }}">{{ $option->delay }}</label>
                    </div>

                </div>
 </div>
                @endforeach
            </div>
        </div>
        <script>
            $('.ship_id').on('click', function () {
                var id = $(this).attr('id');
                var cash_delivery_commission = $(this).next('.cash_delivery_commission').val();
                var cost = $(this).next().next('.cost').val();
                var currency = '{{ $currency }}';
                var total = '{{ Cart::total() }}';
                $('.delivery_commission').text(cash_delivery_commission + ' ' + currency);
                $('.shipping-cost').text(cost + ' ' + currency);
                $('.all_total').text(parseInt(total) + parseInt(cost) + ' ' + currency);
            });
        </script>
        @else
        <div class="col-sm-12">
            <div class="alert alert-danger text-center">
                {{ _i('There is no shipping to this city or country') }}
            </div>
        </div>
        @endif

    </div>

</div>





