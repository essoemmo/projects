@php
    $currency = \App\Bll\Constants::defaultCurrency;
@endphp

<div class="col-md-4">
    <div>
        <div class="card pay">
            <div class="card-header">
                <h5>{{_i("payment")}}</h5>
                <button class="btn btn-tiffany f-right" data-toggle="modal" data-target="#payment"
                        type="button"><i
                        class="fa fa-edit"></i>{{_i("Add")}}</button>
            </div>
            <div class="card-body position-relative">
                <span class="paymentIcon">
                    <i class="ti-money"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="modal fade" ref="payment" id="payment" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i("payment")}}</h4>
                </div>
                <div class="modal-body">
                    <div class="payment_details">
                        <div class="section-title">
                            {{_i("payment_options")}}
                        </div>
                        <div class="transaction_types">
                            <ul class="list-unstyled">
                                <li>
                                    <div>
                                        <label>
                                            <input type="radio"
                                                   value="bank"
                                                   data-title="{{ _i('Bank') }}"
                                                   class="paymentMethod choose_bank" name="payment">
                                            {{ _i('Pay With Bank') }}
                                            <br/>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="radio"
                                                   value="delivery"
                                                   data-title="{{ _i('Delivery') }}"
                                                   class="paymentMethod delivery" name="payment">
                                            {{ _i('Payment on receipt from the shipping company') }}
                                            (<span class="delivery_commission_payment"></span>)
                                            <br/>

                                        </label>
                                    </div>
                                    @foreach ($transtransaction_types as $transtransaction_type)
                                        <div>
                                            <label>
                                                <input type="radio"
                                                       onclick="getpaymentid({{ $transtransaction_type->id }})"
                                                       value="online"
                                                       data-title="{{ $transtransaction_type->title }}"
                                                       class="paymentMethod myfatoorah_show" name="payment">
                                                {{ $transtransaction_type->title }}
                                                <br/>
                                            </label>
                                            <input type="hidden" name="payment_id"
                                                   class="payment_id"
                                                   value="{{ $transtransaction_type->id }}">
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                            @if(count($banks) > 0)
                                <div class="choose_bank_show mb-4" style="display: none">
                                    <select class="form-control bank" id="bank"
                                            name="bank"
                                            style="height: auto">
                                        <option selected
                                                disabled>{{ _i('select') }}</option>
                                        @foreach($banks as $key => $bank)
                                            <option value="{{ $key }}">{{ $bank }}</option>
                                        @endforeach
                                    </select>
                                    <div class="bank-details">

                                    </div>
                                </div>
                            @else
                                <div class="text-danger">
                                    {{_i("No Banks Available")}}
                                </div>
                            @endif

                            <div class="choose_myfatoorah_show mt-2 mb-4" style="display: none">
                                <div class="online-details">
                                    <input type="hidden" name="price_myfatoorah"
                                           class="price_myfatoorah" form="myfatoorah_form"
                                           value="">
                                    <input type="hidden" name="currency_myfatoorah"
                                           class="currency_myfatoorah" form="myfatoorah_form"
                                           value="{{ $currency }}">
                                    <input type="hidden" name="user_myfatoorah"
                                           class="user_myfatoorah" form="myfatoorah_form">
                                    <button type="submit" form="myfatoorah_form"
                                            class="btn btn-outline-primary btn-block myfatoorah">
                                        {{ _i('Pay') }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="shipping_cost" class="shipping_cost_input">
                    <button class="btn btn-tiffany" type="button" onclick="savepayment()">{{_i("save")}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


@push('js')
    <script language="javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getpaymentid(id) {
            window.paymentId = id;
        }

        $('.bank').on('change', function () {
            var bank_id = $(this).children("option:selected").val();
            $('.bank-details').css('display', 'none');
            if (bank_id != null) {
                $.ajax({
                    type: "GET",
                    url: "{{route('get-pay-banks')}}",
                    dataType: 'html',
                    data: {bank_id: bank_id},
                    success: function (data) {
                        $('.bank-details').css('display', 'block').html(data);
                    }
                });
            }
        });

        $('body').on('click', '.paymentMethod', function () {
            var id = $(this).val();
            if (id == 'delivery') {
                $('.choose_bank_show').css('display', 'none');
                var Shipping__cost = $('.Shipping__cost_original').val();
                var delivery_commission_payment = $('.delivery_commission_payment').text();
                var total = parseInt(Shipping__cost) + parseInt(delivery_commission_payment);
                $('.Shipping__cost').text(total);
                $('.shipping_cost_input').val(total);
            } else if (id == 'bank') {
                $('.choose_bank_show').css('display', 'block');
                var Shipping__cost = parseInt($('.Shipping__cost_original').val());
                $('.Shipping__cost').text(Shipping__cost);
                $('.shipping_cost_input').val(Shipping__cost);
            } else {
                $('.choose_bank_show').css('display', 'none');
                var Shipping__cost = parseInt($('.Shipping__cost_original').val());
                $('.Shipping__cost').text(Shipping__cost);
                $('.shipping_cost_input').val(Shipping__cost);
            }
        });

        function savepayment() {

            var title = $("input[name='payment']:checked").data('title');
            $('.paymentIcon').empty();
            $('.paymentIcon').append(`
                <div>
                ${title}
                    </div>
            `);
            $('#payment').modal('toggle');
        }

        $('.myfatoorah_show').on('click', function () {
            var total = parseInt($('.total').text());
            $('.price_myfatoorah').val(total);
            $('.choose_myfatoorah_show').css('display', 'block');
            $('.choose_bank_show').css('display', 'none');
        });
    </script>
@endpush
