<div class="card card-body">
    <form accept-charset="UTF-8" class="row" data-parsley-validate="" id="payOnline_visa" action="https://api.moyasar.com/v1/payments.html" method="POST">
        @csrf

        <input type="hidden" name="callback_url" value="{{ route('postPay') }}" />

        <input type="hidden" name="source[type]" value="creditcard">

        <input type="hidden" name="amount" value="{{ (round(\Cart::getTotal() * getRate(country_code())->rate) * 100) }}">

        <input type="hidden" name="currency" value="{{ enCurrency()->translate('en')->code }}">

        @if($online != null)
            <input type="hidden" name="publishable_api_key" value="{{ $online->key }}">
        @endif


        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[name]" id="name"
                       value="{{old('source[name]')}}" placeholder="{{ _i('Cardholder\'s Name') }}" required="">
                <span class="text-danger">
                    <strong>{{$errors->first('name')}}</strong>
                </span>
            </div>
        </div>

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[number]" id="number"
                       value="{{old('source[number]')}}" placeholder="{{ _i('Card Number') }}" required="" 	data-parsley-type="integer">
                <span class="text-danger">
                    <strong>{{$errors->first('number')}}</strong>
                </span>
            </div>
        </div>

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[month]" id="month"
                       value="{{old('source[month]')}}" placeholder="{{ _i('Month') }}" required="">
                <span class="text-danger">
                    <strong>{{$errors->first('month')}}</strong>
                </span>
            </div>
        </div>

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[year]" id="year"
                       value="{{old('source[year]')}}" placeholder="{{ _i('Year') }}" required="">
                <span class="text-danger">
                    <strong>{{$errors->first('year')}}</strong>
                </span>
            </div>
        </div>

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[cvc]" id="cvc"
                       value="{{old('source[cvc]')}}" placeholder="{{ _i('CVC / CVV') }}" required="">
                <span class="text-danger">
                    <strong>{{$errors->first('cvc')}}</strong>
                </span>
            </div>
        </div>

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <select name="source[company]" class="form-control" id="company">
                    <option selected value="null">{{ _i('Select') }}</option>
                    <option value="visa">Visa</option>
                    <option value="master">Master Card</option>
                </select>
                <span class="text-danger">
                    <strong>{{$errors->first('company')}}</strong>
                </span>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-yellow py-2">{{ _i('Pay') }}</button>
        </div>

    </form>

</div>
