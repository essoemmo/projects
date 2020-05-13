<fieldset class="payment">
    <div class="order-status">
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-square"></i>{{ _i('Shipping Address') }}</li>
                <li class="list-inline-item"><i class="fa fa-square"></i> {{ _i('Payment') }}</li>
                <li class="list-inline-item"><i class="fa fa-square-o "></i>{{ _i('order placed') }}</li>
            </ul>
        </div>
    </div>

    <div class="payment-methods">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="color-purple font-weight-bold mb-4">{{ _i('Choose your payment method') }}</h6>
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="bank-tab" data-toggle="tab" href="#bank"
                               role="tab"
                               aria-controls="bank" aria-selected="true">{{ _i('Pay By Bank') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="COD-tab" data-toggle="tab" href="#COD" role="tab"
                               aria-controls="COD" aria-selected="false">{{ _i('Pay On Delivery') }}</a>
                        </li>

                        @if(count($payments) > 0)
                            @foreach($payments as $payment)
                                <li class="nav-item">
                                    <a class="nav-link" id="{{ $payment->status }}-tab" data-toggle="tab"
                                       href="#{{ $payment->status }}"
                                       role="tab"
                                       aria-controls="{{ $payment->status }}"
                                       aria-selected="false">{{ _i('Pay With') }} {{ $payment->status }}</a>
                                </li>
                            @endforeach

                        @endif

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="bank" role="tabpanel"
                             aria-labelledby="bank-tab">
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" required id="customRadio2" name="payment"
                                       class="custom-control-input choose_bank" form="saveOrder"
                                       value="bank">
                                <label class="custom-control-label"
                                       for="customRadio2">{{ _i('Pay By Bank Transfer') }}</label>
                            </div>
                            @if(count($banks) > 0)
                                <div class="choose_bank_show mt-2" style="display: none">
                                    <select class="form-control bank" form="saveOrder" id="bank"
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

                        </div>
                        <div class="tab-pane fade" id="COD" role="tabpanel" aria-labelledby="COD-tab">

                            <div class="custom-control custom-radio">
                                <input type="radio" required id="customRadio1" name="payment"
                                       class="custom-control-input add_delivery_cost" form="saveOrder"
                                       value="delivery">
                                <label class="custom-control-label"
                                       for="customRadio1">{{ _i('Payment on receipt from the shipping company') }}
                                    (<span class="delivery_commission"></span>)
                                </label>
                            </div>

                        </div>

                        @if(count($payments) > 0)
                            @foreach($payments as $payment)
                                <div class="tab-pane fade" id="{{ $payment->status }}" role="tabpanel"
                                     aria-labelledby="{{ $payment->status }}-tab">

                                    <div class="custom-control custom-radio">
                                        <input type="radio" required id="customRadio{{ $payment->status }}"
                                               name="payment"
                                               class="custom-control-input myfatoorah_show" form="saveOrder"
                                               value="online">
                                        <label class="custom-control-label"
                                               for="customRadio{{ $payment->status }}">{{ _i('Payment With') }} {{ $payment->status }}
                                        </label>
                                    </div>
                                    @if($payment->status == 'myfatoorah')
                                        <input type="hidden" name="payment_id"
                                               class="payment_id" form="saveOrder"
                                               value="{{ $payment->id }}">
                                        <div class="choose_myfatoorah_show mt-2" style="display: none">
                                            <div class="online-details">
                                                <input type="hidden" name="price_myfatoorah"
                                                       class="price_myfatoorah" form="myfatoorah_form"
                                                       value="{{ Cart::total() }}">
                                                <input type="hidden" name="currency_myfatoorah"
                                                       class="currency_myfatoorah" form="myfatoorah_form"
                                                       value="{{ $currency }}">
                                                <input type="hidden" name="shipping_cost_myfatoorah"
                                                       class="shipping_cost" form="myfatoorah_form">
                                                <input type="hidden" name="discount_cost_myfatoorah"
                                                       class="discount_cost_myfatoorah" form="myfatoorah_form">
                                                <button type="submit" form="myfatoorah_form"
                                                        class="btn btn-outline-primary btn-block myfatoorah">
                                                    {{ _i('Pay') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            @endforeach
                        @endif

                    </div>

                    <button type="button"
                            class="btn btn-mainColor btn-block rounded py-2 order_save">{{ _i('Confirm Order') }}</button>
                    <button type="button"
                            class="btn btn-block rounded py-2 previous">{{ _i('Previous') }}</button>
                    <hr>
                    <div class="top-product-helper mb-3">
                        <div class="page-title"> {{ _i('Orders') }}
                            <span>( {{ count(\Gloudemans\Shoppingcart\Facades\Cart::content()) }} @if(count(Cart::content()) == 1)
                                    {{ _i('Product') }}
                                @else
                                    {{ _i('Products') }}
                                @endif
                                    )</span></div>
                    </div>

                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)

                        <div class="single-full-product wide-product mb-4 p-3">

                            <div class="media">
                                <div class="product-thumbnail">

                                    @if($item->options->image == null)
                                        <img src="http://placehold.it/100x100" alt="..."
                                             class="img-fluid"/>
                                    @else <img src="{{ asset($item->options->image) }}" alt="..."
                                               class="img-fluid"/> @endif
                                </div>

                                <div class="media-body">
                                    <div
                                        class="d-md-flex justify-content-between align-items-center mb-2">
                                        <h2 class="title"><a
                                                href="{{ route('product_url', [app()->getLocale(),$item->id] ) }}">{{ $item->name }}</a>
                                        </h2>
                                        <div class="price">{{ _i('Price') }}
                                            : {{ $item->price }} {{ $currency }}</div>
                                        <div class="quantity">
                                            <label>{{ _i('Quantity') }}</label> : {{ $item->qty }}
                                        </div>

                                    </div>
                                    <p>
                                        @if($item->description == null)
                                            {{ _i('No Description') }}
                                        @else
                                            {{ $item->description }}
                                        @endif
                                    </p>


                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="cost-box single-full-product p-3 ">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @php
                                $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
                            @endphp
                            @if ($storeOptions != null)
                                @if ($storeOptions->discount_codes == 1)
                                    <input type="text" name="discount_code" form="saveOrder" class="form-control"
                                           placeholder="{{ _i('Discount Code') }}" style="margin-bottom: 0">
                                    <button type="button"
                                            class="btn btn-mainColor rounded discount_code">{{ _i('Discount') }}</button>
                                @endif
                            @endif

                        </div>
                        <div class="text-center">
                            <div class="error" style="display: none">
                                <div class="alert alert-danger">
                                    {{ _i('Discount Code Used Before') }}
                                </div>
                            </div>
                            <div class="empty" style="display: none">
                                <div class="alert alert-danger empty_text">

                                </div>
                            </div>
                        </div>
                        <div class="text-center color-purple cost-box-title ">{{ _i('
Order summary') }}</div>
                        <div
                            class="single-cost-line d-flex justify-content-between align-items-center ">
                            <p>{{ _i('
Subtotal') }}</p>
                            <div
                                class="price subtotal">{{ \Gloudemans\Shoppingcart\Facades\Cart::total() }} {{ $currency }}</div>
                        </div>
                        <div
                            class="single-cost-line d-flex justify-content-between align-items-center ">
                            <p>{{ _i('Shipping') }}</p>
                            <div class="shipping-cost">{{ _i('Free') }}</div>
                        </div>

                        @if ($storeOptions != null)
                            @if ($storeOptions->discount_codes == 1)
                                <div
                                    class="single-cost-line d-flex justify-content-between align-items-center show_discount"
                                    style="display: none !important;">
                                    <p>{{ _i('Discount') }}</p>
                                    <div class="discount"></div>
                                </div>
                            @endif
                        @endif

                        <div
                            class="total single-cost-line d-flex justify-content-between align-items-center ">
                            <p>{{ _i('Overall Total') }}</p>
                            <div
                                class="price all_total"> {{ Gloudemans\Shoppingcart\Facades\Cart::total() }} {{ $currency }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</fieldset>
