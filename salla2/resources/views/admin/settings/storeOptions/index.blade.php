@extends('admin.AdminLayout.index')

@section('title')
    {{ _i('Store Options') }}
@endsection

@section('content')


    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Maintenance Mode') }}</h5>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 col-xl-12 m-b-10">

                    <form action="{{ route('storeOptions.storeMaintenance', $setting->setting_id) }}" method="post"
                          id="form_store_maintenance">

                        @csrf
                        @method('POST')

                        <p>{{ _i('After activating the maintenance mode, you will be able to enter the store on its own and work on preparing it, while customers will see a maintenance page for them. To view it, log in to your store from another browser, or log out of the control panel') }}</p>

                        <hr>

                        <div class="row form-group">
                            <label class="col-md-4" for="maintenance"> {{ _i('Maintenance Mode') }}</label>
                            <div class="col-md-8">
                                <input type="checkbox" form="form_store_maintenance" class="js-single" id="maintenance"
                                       name="maintenance"
                                       @if($setting->maintenance == 1) checked=""
                                       @endif data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4" for="maintenance_title"> {{ _i('Maintenance Title') }}</label>
                            <div class="col-md-8">
                                <input type="text" form="form_store_maintenance" class="form-control"
                                       name="maintenance_title"
                                       id="maintenance_title"
                                       placeholder="{{ _i('Maintenance Title') }}" minlength="3" maxlength="50"
                                       value="{{ ($setting->maintenance_title != null) ? $setting->maintenance_title : '' }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4" for="maintenance_message"> {{ _i('Maintenance Message') }}</label>
                            <div class="col-md-8">
                            <textarea class="form-control" form="form_store_maintenance" name="maintenance_message"
                                      id="maintenance_message" minlength="3" maxlength="200"
                                      placeholder="{{ _i('Maintenance Message') }}">{{ ($setting->maintenance_message != null) ? $setting->maintenance_message : '' }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" form="form_store_maintenance"
                                        class="btn btn-primary m-b-0">{{ _i('Submit') }}</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Store Options') }}</h5>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 col-xl-12 m-b-10">

                    <form action="{{ route('storeOptions.storeOptions', $storeOptions->id) }}" method="post"
                          id="form_store">

                        @csrf
                        @method('POST')

                        <div class="row form-group">
                            <label class="col-md-4" for="order_accept"> {{ _i('Orders Requests') }}</label>
                            <div class="col-md-8 d-flex justify-content-end">
                                <input type="checkbox" form="form_store" class="js-switch" id="order_accept"
                                       name="order_accept"
                                       @if($storeOptions->order_accept == 1)
                                       checked=""
                                       @endif
                                       data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4"
                                   for="product_rating"> {{ _i('Show product rating') }}</label>
                            <div class="col-md-8 d-flex justify-content-end">
                                <input type="checkbox" form="form_store" class="js-switch" id="product_rating"
                                       name="product_rating"
                                       @if($storeOptions->product_rating == 1)
                                       checked=""
                                       @endif
                                       data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4"
                                   for="product_outStock"> {{ _i('Show Out Of Stock products') }}</label>
                            <div class="col-md-8 d-flex justify-content-end">
                                <input type="checkbox" form="form_store" class="js-switch" id="product_outStock"
                                       name="product_outStock"
                                       @if($storeOptions->product_outStock == 1)
                                       checked=""
                                       @endif
                                       data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4"
                                   for="discount_codes"> {{ _i('Activate discount coupons') }}</label>
                            <div class="col-md-8 d-flex justify-content-end">
                                <input type="checkbox" form="form_store" class="js-switch" id="discount_codes"
                                       name="discount_codes"
                                       @if($storeOptions->discount_codes == 1)
                                       checked=""
                                       @endif
                                       data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        {{--                        <div class="row form-group">--}}
                        {{--                            <label class="col-md-4"--}}
                        {{--                                   for="product_purchases_count"> {{ _i('Show product purchases times') }}</label>--}}
                        {{--                            <div class="col-md-8 d-flex justify-content-end">--}}
                        {{--                                <input type="checkbox" form="form_store" class="js-switch" id="product_purchases_count"--}}
                        {{--                                       name="product_purchases_count"--}}
                        {{--                                       @if($storeOptions->product_purchases_count == 1)--}}
                        {{--                                       checked=""--}}
                        {{--                                       @endif--}}
                        {{--                                       data-switchery="true"--}}
                        {{--                                       style="display: none;">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="row form-group">
                            <label class="col-md-4"
                                   for="similar_products"> {{ _i('Show products you might like on the product page') }}</label>
                            <div class="col-md-8 d-flex justify-content-end">
                                <input type="checkbox" form="form_store" class="js-switch" id="similar_products"
                                       name="similar_products"
                                       @if($storeOptions->similar_products == 1)
                                       checked=""
                                       @endif
                                       data-switchery="true"
                                       style="display: none;">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" form="form_store"
                                        class="btn btn-primary m-b-0">{{ _i('Submit') }}</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

