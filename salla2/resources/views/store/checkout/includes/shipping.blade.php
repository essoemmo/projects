<fieldset class="shipping">
    <div class="order-status">
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="fa fa-square"></i>{{ _i('Shipping Address') }}</li>
                <li class="list-inline-item"><i class="fa fa-square-o"></i> {{ _i('Payment') }}</li>
                <li class="list-inline-item"><i class="fa fa-square-o "></i>{{ _i('order placed') }}</li>
            </ul>
        </div>
    </div>

    <div class="common-wrapper user-page">
        <div class="container">
            <div class="card shadow-sm">
                <div id="form_one" data-parsley-validate>
                    <div class="card-body">

                        <div
                            class="card-header pt-0 pr-0 mb-2">{{ _i('Shipping and delivery address') }}</div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="country" class=" col-form-label">{{ _i('Country') }}</label>
                                    <select class="form-control" form="form_one" id="country"
                                            name="country_id">
                                        <option value="" selected disabled>{{ _i('select') }}</option>
                                        @foreach($countries as $key => $country)
                                            <option value="{{$key}}"
                                                    @if(auth()->user()->country_id == $key) selected @endif>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="neighborhood"
                                           class=" col-form-label">{{ _i('neighborhood') }}</label>
                                    <input type="text" form="form_one" class="form-control"
                                           id="neighborhood"
                                           placeholder="{{_i('neighborhood')}}"
                                           name="neighborhood" value="{{old('neighborhood')}}" required="">
                                    @if ($errors->has('neighborhood'))
                                        <strong
                                            style="color: red;">{{ $errors->first('neighborhood') }}</strong>
                                    @endif

                                </div>
                                <div class="form-group ">
                                    <label for="street" class=" col-form-label">{{ _i('Street') }}</label>
                                    <input type="text" form="form_one" class="form-control" id="street"
                                           placeholder="{{_i('street')}}" name="street"
                                           value="{{old('street')}}" required="">
                                    @if ($errors->has('street'))
                                        <strong style="color: red;">{{ $errors->first('street') }}</strong>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="city" class=" col-form-label">{{ _i('City') }}</label>
                                    <select class="form-control" form="form_one" name="city_id" id="city"
                                            required="">
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="address" class=" col-form-label">{{ _i('address') }}</label>
                                    <input type="text" form="form_one" class="form-control" id="address"
                                           placeholder="{{_i('address')}}" name="address"
                                           required="" value="{{auth()->user()->address}}">
                                    @if ($errors->has('address'))
                                        <strong style="color: red;">{{ $errors->first('address') }}</strong>
                                    @endif

                                </div>
                                <div class="form-group ">
                                    <label for="code"
                                           class=" col-form-label">{{ _i('Postal Code') }}</label>
                                    <input type="text" form="form_one" class="form-control" id="code"
                                           placeholder="{{_i('postal code')}}" name="code"
                                           value="{{old('code')}}" required="">
                                    @if ($errors->has('code'))
                                        <strong style="color: red;">{{ $errors->first('code') }}</strong>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>


            <div class="column-bank">

            </div>

            @if ($errors->has('shippingOption'))
                <strong style="color: red;">{{ _i('Shipping details are required') }}</strong>
            @endif

            <div class="text-left mt-3">
                <button type="button"
                        class="btn btn-mainColor rounded next">{{ _i('Next') }}
                </button>
            </div>
        </div>
    </div>
</fieldset>
