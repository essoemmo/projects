<div class="tab-pane" id="tab-discounts">
    <div class="table-responsive">
        <table id="discount" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td class="text-right">{{ _i('Price') }}</td>
                <td class="text-right">{{ _i('Priority') }}</td>
                <td class="text-left">{{ _i('Date Start') }}</td>
                <td class="text-left">{{ _i('Date End') }}</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($productDiscounts as $prDiscount)
                <tr id="discount-row{{ $loop->index }}">
                    <td class="text-right">
                        <input type="number" min="1" step="0.1" name="product_discount[{{ $loop->index }}][price]" value="{{ $prDiscount->price }}" placeholder="{{ _i('Price') }}" class="form-control" />

                        <input type="hidden" name="product_discount[{{ $loop->index }}][product_discount_id]" id="product_discount[{{ $loop->index }}][product_discount_id]" value="{{ $prDiscount->id }}">
                    </td>
                    <td class="text-right">
                        <input type="number" min="1" step="1" name="product_discount[{{ $loop->index }}][priority]" value="{{ $prDiscount->priority }}" placeholder="{{ _i('Priority') }}" class="form-control" />
                    </td>
                    <td class="text-left" style="width: 20%;">
                        <div class="input-group date">
                            <input type="text" name="product_discount[{{ $loop->index }}][date_start]" value="{{ $prDiscount->date_start }}" placeholder="{{ _i('Date Start') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="ti-calendar"></i></button></span>
                        </div>
                    </td>
                    <td class="text-left" style="width: 20%;">
                        <div class="input-group date">
                            <input type="text" name="product_discount[{{ $loop->index }}][date_end]" value="{{ $prDiscount->date_end }}" placeholder="{{ _i('Date End') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="ti-calendar"></i></button></span>
                        </div>
                    </td>
                    <td class="text-left"><button type="button" onclick="deleteProductDiscount({{ $loop->index }}, {{ $prDiscount->id }})" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"></td>
                <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="Add Discount" class="btn btn-primary"><i class="ti-plus"></i></button></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
