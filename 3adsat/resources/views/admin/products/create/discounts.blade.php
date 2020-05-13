<div class="tab-pane" style="display: none" id="discounts">
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
