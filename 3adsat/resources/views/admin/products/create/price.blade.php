<div class="tab-pane" id="price" role="tabpanel">
    <div id="new-row">
        <div class="form-group row">
             <label class="col-sm-3 control-label" for="country_id">{{ _i('Country') }} <span style="color: #F00;">*</span></label>
            <div class="col-sm-3">
                <select class="form-control" required="" id="country_id" name="country_id[]" >
                    @foreach ($countries as $item)
                    <option value="{{ $item->id }}" {{ ( old("countries") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <label for="price" class="col-sm-3 control-label">{{ _i('Price') }}</label>
            <div class="col-sm-3">
                <input onfocus="" type="number" class="form-control" min="1" step="0.1" id="price" name="price[0][]" placeholder="{{ _i('Price') }}" data-parsley-type="number" value="{{ old('price', 1) }}">
            </div>
        </div>

        <div class="form-group row">
              <label for="quantity" class="col-sm-3 control-label">{{ _i('Quantity') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="quantity" name="quantity[]" placeholder="{{ _i('Quantity') }}" data-parsley-type="number" value="{{ old('quantity', 1) }}">
            </div>
          <label for="minimum_order_amount" class="col-sm-3 control-label">{{ _i('Min Order Quantity') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="minimum_order_amount" name="minimum_order_amount[]" placeholder="{{ _i('Minimum Order Quantity') }}" data-parsley-type="number" value="{{ old('minimum_order_amount', 1) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="stock_status_id">{{ _i('Stock Status') }}</label>
            <div class="col-sm-3">
                <select class="form-control" style="width: 100%;" id="stock_status_id" name="stock_status_id[]">
                    <option value="0" {{ ( old("stock_status_id") == 0 ? "selected":"") }}>{{ _i('None') }}</option>
                    @foreach ($stockStatuses as $item)
                    <option value="{{ $item->id }}" {{ ( old("stock_status_id") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

              <label class="col-sm-3 control-label" for="subtract_stock">{{ _i('Subtract Stock') }}</label>
            <div class="col-sm-3">
                <select name="subtract_stock[]" id="subtract_stock" class="form-control">
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
              <label for="pkgSize" class="col-sm-3 control-label">{{ _i('Package Size') }}</label>
            <div class="col-sm-3">
                <input type="number"  value="30" class="form-control" min="1" id="pkgSize" name="pkg[0][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
          <label for="pkgAmount" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">
                <input onfocus="" type="number" class="form-control" min="1" id="pkgAmount" name="pkg[0][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number" >
            </div>

        </div>
        <div class="form-group row">
              <label for="pkgSize1" class="col-sm-3 control-label">{{ _i('Package Size') }}</label>
            <div class="col-sm-3">
                <input type="number"  value="90" class="form-control" min="1" id="pkgSize1" name="pkg[0][s][]" placeholder="{{ _i('Size') }}" data-parsley-type="number" >
            </div>
            <label for="pkgAmount1" class="col-sm-3 control-label">{{ _i('Package Price') }}</label>
            <div class="col-sm-3">
                    <input onfocus="" type="number" class="form-control" min="1" id="pkgAmount1" name="pkg[0][p][]" placeholder="{{ _i('Package Price') }}" data-parsley-type="number" >
            </div>

        </div>

        <div class="form-group row">
            <label for="discount" class="col-sm-3 control-label">{{ _i('Discount') }}</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" min="1" id="discount" name="discount[]" placeholder="{{ _i('discount') }}" data-parsley-type="number" >
            </div>
        </div>

{{--                @include('admin.products.create.ship')--}}
{{--        <div>--}}
{{--            <label class="col-sm-3 control-label">{{ _i('Requires Shipping') }}</label>--}}
{{--            <div class="col-sm-10">--}}
{{--                <label class="radio-inline">--}}
{{--                    <input type="radio"  name="requires_shipping[0][]" value="1" {{ ( old("requires_shipping") == 1 ? 'checked="checked"':"") }} onchange="showShippingCouriers(1);">--}}
{{--                    {{ _i('Yes') }}--}}
{{--                </label>--}}
{{--                <label class="radio-inline">--}}
{{--                    <input type="radio" name="requires_shipping[0][]" value="0" {{ ( old("requires_shipping") == 0 ? 'checked="checked"':"") }} onchange="showShippingCouriers(0);">--}}
{{--                    {{ _i('No') }}--}}
{{--                </label>--}}

{{--                <div class="table-responsive shippingDiv[0]" >--}}
{{--                    <table id="attribute" class="table table-striped table-bordered table-hover">--}}
{{--                        <thead>--}}
{{--                        <th></th>--}}
{{--                        <th>{{ _i('Name') }}</th>--}}
{{--                        <th>{{ _i('Cost') }}</th>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($shippingCouriers as $item)--}}
{{--                            <tr>--}}
{{--                                <td><input type="checkbox" name="shipping_courier_id[0][]" value="{{ $item->id }}" ></td>--}}
{{--                                <td>{{ $item->name }}</td>--}}
{{--                                <td><input type="number" min="0" step="0.1" class="form-control" name="shipping_cost[0][]" id="shipping_cost[{{ $item->id }}]" value="0"></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <hr>

  </div>

    <div class="new-one">

{{--        <a href="javascript:void(0)" onclick="myJsFunc();" class="btn btn-success data-click">+</a>--}}
    </div>

    <div class="form-group row">
        <div class="col-md-4 col-md-offset-8" >
            <a href="javascript:void(0)" onclick="myJsFunc();" class="btn btn-success btn-block data-click">Add New <i class="ti-plus"></i></a>
        </div>
    </div>

</div>

@push('js')

    <script>
        var count = 1;
        function myJsFunc() {
         //   return;
            var newInput = $('#new-row').clone(false);
            $(newInput).find('#price').attr('name',`price[${count}][]`);
            $(newInput).find('#pkgAmount').attr('name',`pkg[${count}][p][]`);
            $(newInput).find('#pkgAmount1').attr('name',`pkg[${count}][p][]`);
            $(newInput).find('#pkgSize').attr('name',`pkg[${count}][s][]`);
            $(newInput).find('#pkgSize1').attr('name',`pkg[${count}][s][]`);
            // $(newInput).find('input[name=requires_shipping]').attr('name', `requires_shipping[${count}]`);
            // $(newInput).find('.shippingDiv').attr('class', `shippingDiv${count}`);
            // $(newInput).find('input[name="shipping_courier_id[0][]"]').attr('name', `shipping_courier_id[${count}][]`);
            // $(newInput).find('input[name="shipping_cost[0][]"]').attr('name', `shipping_cost[${count}][]`);

//            $(newInput).find('#pkgAmount').removeAttr('onfocus').on('click', function () {
//                $(newInput).find('#price').attr('disabled','');
//            });
//            $(newInput).find('#pkgAmount1').removeAttr('onfocus').on('click', function () {
//                $(newInput).find('#price').attr('disabled','');
//            });
//            $(newInput).find('#price').removeAttr('onfocus').on('click', function () {
//                $(newInput).find('#pkgAmount').attr('disabled','');
//                $(newInput).find('#pkgAmount1').attr('disabled','');
//                $(newInput).find('#pkgSize').attr('disabled','').removeAttr('readonly');
//                $(newInput).find('#pkgSize1').attr('disabled','').removeAttr('readonly');
//            });
            $('.new-one').append(newInput);
            ++count;
        }

    </script>

@endpush
