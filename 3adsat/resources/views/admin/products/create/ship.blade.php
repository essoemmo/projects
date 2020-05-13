 <label class="col-sm-2 control-label">{{ _i('Requires Shipping') }}</label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type="radio"  name="requires_shipping[0][]" value="1" {{ ( old("requires_shipping") == 1 ? 'checked="checked"':"") }} onchange="showShippingCouriers(1);">
                                                {{ _i('Yes') }}
            </label>
            <label class="radio-inline">
                <input type="radio" name="requires_shipping[0][]" value="0" {{ ( old("requires_shipping") == 0 ? 'checked="checked"':"") }} onchange="showShippingCouriers(0);">
                                                {{ _i('No') }}
            </label>

            <div class="table-responsive shippingDiv[0]" >
                <table id="attribute" class="table table-striped table-bordered table-hover">
                    <thead>
                    <th></th>
                    <th>{{ _i('Name') }}</th>
                    <th>{{ _i('Cost') }}</th>
                    </thead>
                    <tbody>
                        @foreach($shippingCouriers as $item)
                        <tr>
                            <td><input type="checkbox" name="shipping_courier_id[0][]" value="{{ $item->id }}" ></td>
                            <td>{{ $item->name }}</td>
                            <td><input type="number" min="0" step="0.1" class="form-control" name="shipping_cost[0][]" id="shipping_cost[{{ $item->id }}]" value="0"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
