<div id="bank_details" style="display: block;" class="bank_details">
    <div class="d-flex justify-content-between my-3">
        <div class="bank_right">{{ _i(';
Account owner') }}</div>
        <div class="bank_left">{{ $bank->holder_name }}</div>
    </div>
    <div class="d-flex justify-content-between my-3">
        <div class="bank_right">{{ _i('account number
') }}</div>
        <div class="bank_left">{{ $bank->holder_number }}</div>
    </div>
    <div class="d-flex justify-content-between my-3">
        <div class="bank_right">{{ _i('
IBAN') }}</div>
        <div class="bank_left">{{ $bank->iban }}</div>
    </div>
    <div class="clear"></div>
</div>

<input type="text" form="saveOrder" class="form-control" name="holder_name"
       id="holder_name"
       value="{{old('holder_name')}}"
       placeholder="{{ _i('Holder name') }}" required="">
<input type="text" form="saveOrder" class="form-control"
       name="bank_transactions_num" id="bank_transactions_num"
       value="{{old('bank_transactions_num')}}"
       placeholder="{{ _i('Bank Transactions number') }}"
       required="">
<input type="file" form="saveOrder" name="image" id="logo"
       onchange="showImg(this)" class="btn btn-default"
       accept="image/gif, image/jpeg, image/png"
       value="{{old('image')}}" required="">
<img class="img-responsive pad" id="article_img">
