    <div class="tab-pane" id="tab-price">
    <div id="new-row" class="hidden" name="created">
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="country_id">{{ _i('Country') }} <span style="color: #F00;">*</span></label>
            <div class="col-sm-3">
                <select class="form-control" disabled="disabled" required="" title='-{{_i("select")}}-' id="country_id" name="country_id[]" data-live-search="true">
                    @foreach ($countries as $item)
                    <option value="{{ $item->id }}" {{ ( old("countries") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="price" class="col-sm-3 control-label">{{ _i('Price') }}</label>
            <div class="col-sm-3">
                <input type="number" disabled="disabled" class="form-control" min="1" step="0.1" id="price" name="price[0][]" placeholder="{{ _i('Price') }}" data-parsley-type="number" value="{{ old('price', 1) }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="quantity" class="col-sm-3 control-label">{{ _i('Quantity') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" class="form-control" min="1" id="quantity" name="quantity[]" placeholder="{{ _i('Quantity') }}" data-parsley-type="number" value="{{ old('quantity', 1) }}">
            </div>
            <label for="minimum_order_amount" class="col-sm-3 control-label">{{ _i('Min Order Quantity') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" class="form-control" min="1" id="minimum_order_amount" name="minimum_order_amount[]" placeholder="{{ _i('Minimum Order Quantity') }}" data-parsley-type="number" value="{{ old('minimum_order_amount', 1) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="stock_status_id">{{ _i('Stock Status') }}</label>
            <div class="col-sm-3">
                <select disabled="disabled" class="form-control" style="width: 100%;" id="stock_status_id" name="stock_status_id[]">
                    <option value="0" {{ ( old("stock_status_id") == 0 ? "selected":"") }}>{{ _i('None') }}</option>
                    @foreach ($stockStatuses as $item)
                    <option value="{{ $item->id }}" {{ ( old("stock_status_id") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <label class="col-sm-3 control-label" for="subtract_stock">{{ _i('Subtract Stock') }}</label>
            <div class="col-sm-3">
                <select disabled="disabled" name="subtract_stock[]" id="subtract_stock" class="form-control">
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

        </div>
        <div class="form-group row">
            <label for="pkgSize" class="col-sm-3 control-label">{{ _i('Package Size 30') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" value="30" class="form-control" min="1" id="pkgSize" name="pkg[0][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
            <label for="pkgAmount" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" class="form-control" min="1" id="pkgAmount" name="pkg[0][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number" >
            </div>

        </div>
        <div class="form-group row">
            <label for="pkgSize1" class="col-sm-3 control-label">{{ _i('Package Size 90') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" value="90" class="form-control" min="1" id="pkgSize1" name="pkg[0][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
            <label for="pkgAmount1" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" class="form-control" min="1" id="pkgAmount1" name="pkg[0][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number" >
            </div>

        </div>

        <div class="form-group row">
            <label for="discount" class="col-sm-3 control-label">{{ _i('discount') }}</label>
            <div class="col-sm-3">
                <input disabled="disabled" type="number" class="form-control" min="1" id="discount" name="discount[]" placeholder="{{ _i('discount') }}" data-parsley-type="number" >
            </div>
        </div>

{{--        @include("admin.products.create.ship")--}}

        <div class="form-group row">
            <div class="col-md-12">
                <a    data-toggle="tooltip" onclick="remove(this)" title="{{ _i('Remove ') }}" class="col-sm-32 btn btn-danger delete_countryProduct">delete <i class=" ti-minus"></i> </a>
            </div>
        </div>
    </div>
    @foreach($countryProducts as $key => $product)
    {{--    @dd($countryProducts)--}}
    <div class="new-row{{$product[0]->id}}">
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="country_id">{{ _i('Country') }} <span style="color: #F00;">*</span></label>
            <div class="col-sm-3">
                <select class="form-control "  required="" id="country_id" name="country_id[]" data-live-search="true">
                    @foreach ($countries as $item)
                    <option value="{{ $item->id }}" @if($product[0]->country_id == $item->id) selected="selected" @endif >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="price{{$product[0]->id}}" class="col-sm-3 control-label">{{ _i('Price') }}</label>
            <div class="col-sm-3">
                <input type="number" @if($product[0]->size == 30 || $product[0]->size == 90)  value="" @endif value="{{ $product[0]->price }}" class="form-control" min="1" step="0.1" id="price{{$product[0]->id}}" name="price[{{ $count }}][]" placeholder="{{ _i('Price') }}" data-parsley-type="number">
            </div>
        </div>

        <div class="form-group row">
            <label for="quantity" class="col-sm-3 control-label">{{ _i('Quantity') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="quantity" name="quantity[]" placeholder="{{ _i('Quantity') }}" data-parsley-type="number" value="{{ $product[0]->quantity }}">
            </div>
            <label for="minimum_order_amount" class="col-sm-3 control-label">{{ _i('Min Order Quantity') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="minimum_order_amount" name="minimum_order_amount[]" placeholder="{{ _i('Minimum Order Quantity') }}" data-parsley-type="number" value="{{ $product[0]->minimum_order_amount }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="stock_status_id">{{ _i('Stock Status') }}</label>
            <div class="col-sm-3">
                <select class="form-control" style="width: 100%;" id="stock_status_id" name="stock_status_id[]">
                    <option value="0" {{ ( $product[0]->stock_status_id == 0 ? "selected":"") }}>{{ _i('None') }}</option>
                    @foreach ($stockStatuses as $item)
                    <option value="{{ $item->id }}" {{ ( $product[0]->stock_status_id == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <label class="col-sm-3 control-label" for="subtract_stock">{{ _i('Subtract Stock') }}</label>
            <div class="col-sm-3">
                <select name="subtract_stock[]" id="subtract_stock" class="form-control">
                    <option value="1" selected="selected">{{_i('Yes')}}</option>
                    <option value="0">{{_i('No')}}</option>
                </select>
            </div>
        </div>

        <div class="form-group row">

            <label for="pkgSize" class="col-sm-3 control-label">{{ _i('Package Size 30') }}</label>
            <div class="col-sm-3">
                <input type="number"  value="30" class="form-control" min="1" id="pkgSize" name="pkg[{{ $count }}][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
            <label for="minimum_order_amount" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">
                <input type="number" onfocus="hidePrice({{ $product[0]->id }})" class="form-control" min="1" id="pkgAmount" name="pkg[{{ $count }}][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number"  @if($product[0]->size == 30) value="{{ $product[0]->price }}" @else value="" @endif>
            </div>

        </div>
        <div class="form-group row">
            <label for="pkgSize1" class="col-sm-3 control-label">{{ _i('Package Size 90') }}</label>
            <div class="col-sm-3">
                <input type="number"  value="90" class="form-control" min="1" id="pkgSize1" name="pkg[{{ $count }}][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
            <label for="pkgAmount1" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">

                <input type="number" onfocus="hidePrice({{ $product[0]->id }})" class="form-control" min="1" id="pkgAmount1" name="pkg[{{ $count }}][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number" @if(isset($product[1]) && $product[1]->size == 90) value="{{ $product[1]->price }}" @else value="" @endif>

            </div>

        </div>

        <div class="form-group row">
            <label for="discount" class="col-sm-3 control-label">{{ _i('discount') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="discount" name="discount[]" placeholder="{{ _i('discount') }}" value="{{ $product[0]->discount }}" data-parsley-type="number" >
            </div>

        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <a  onclick="deleteCountryProduct({{ $product[0]->id }})" data-toggle="tooltip" title="{{ _i('Remove ') }}" class="col-sm-32 btn btn-danger delete_countryProduct">delete <i class=" ti-minus"></i> </a>
            </div>
        </div>
    </div>
    <div STYLE="display: none">{{$count++}}</div>

    <hr>
    @endforeach
    <div class="new-one">

    </div>
    <div class="form-group row">
        <div class="col-md-4 col-md-offset-8">
            <a href="javascript:void(0)" onclick="myJsFunc();"  class="btn btn-success btn-block data-click" >{{_i('Add New')}} <i class=" ti-plus"></i></a>
        </div>
    </div>
</div>

@push('js')
<script>
    function remove(obj)
    {
        console.log($(obj).closest('div[name="created"]')[0]);
        $(obj).closest('div[name="created"]')[0].remove();
        --count;
    }
    var count = {{ $count++ }};


    function myJsFunc() {
    var newInput = $('#new-row').clone(false).removeAttr('class').removeAttr('id');
    //console.log(newInput);
    //  $(newInput).attr("id", "row"+count);
    $(newInput).find('#price').attr('name', `price[${count}][]`);

    // $(newInput).find('input[name=requires_shipping]').attr('name', `requires_shipping[${count}]`);
    // $(newInput).find('.shippingDiv').attr('class', `shippingDiv${count}`);
    // $(newInput).find('input[name="shipping_courier_id[]"]').attr('name', `shipping_courier_id[${count}][]`);
    // $(newInput).find('input[name="shipping_cost[]"]').attr('name', `shipping_cost[${count}][]`);

    $(newInput).find('#pkgAmount').attr('name', `pkg[${count}][p][]`);
    $(newInput).find('#pkgAmount1').attr('name', `pkg[${count}][p][]`);
    $(newInput).find('#pkgSize').attr('name', `pkg[${count}][s][]`);
    $(newInput).find('#pkgSize1').attr('name', `pkg[${count}][s][]`);
    $(newInput).find('#tax_type').removeAttr('disabled');
    $(newInput).find('#tax_rate').removeAttr('disabled');
    $(newInput).find('#quantity').removeAttr('disabled');
    $(newInput).find('#country_id').removeAttr('disabled');
    $(newInput).find('#minimum_order_amount').removeAttr('disabled');
    $(newInput).find('#stock_status_id').removeAttr('disabled');
    $(newInput).find('#subtract_stock').removeAttr('disabled');
    $(newInput).find('#pkgAmount').removeAttr('disabled', '');
    $(newInput).find('#pkgAmount1').removeAttr('disabled', '');
    $(newInput).find('#pkgSize').removeAttr('disabled', '');
    $(newInput).find('#pkgSize1').removeAttr('disabled', '');
    $(newInput).find('#price').removeAttr('disabled', '');
    $(newInput).find('#discount').removeAttr('disabled', '');

    // $(newInput).find('#pkgAmount').removeAttr('onfocus').on('click', function () {

    // });
    // $(newInput).find('#pkgAmount1').removeAttr('onfocus').on('click', function () {
    //     $(newInput).find('#price').attr('disabled','');
    // });
    // $(newInput).find('#price').removeAttr('onfocus').on('click', function () {

    // });
    $('.new-one').append(newInput);
    ++count;
    }

</script>


@endpush
