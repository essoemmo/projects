<div class="tab-pane" id="images" role="tabpanel">

    <div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td class="text-left">{{ _i('Additional Images') }}</td>
                <td class="text-right">{{ _i('Sort Order') }}</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr id="image-row0">
                <td class="text-left">
                    <input type="file" name="product_image[0][image]" value="" id="product_image[0][image]" accept="image/gif, image/jpeg, image/png">
                </td>
                <td class="text-right"><input type="text" name="product_image[0][sort_order]" value="1" placeholder="{{ _i('Sort Order') }}" class="form-control"></td>
                <td class="text-left"><button type="button" onclick="$('#image-row0').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="{{ _i('Remove') }}"><i class="ti-minus"></i></button></td>
            </tr>
            <tr id="image-row1">
                <td class="text-left">
                    <input type="file" name="product_image[1][image]" value="" id="product_image[1][image]" accept="image/gif, image/jpeg, image/png">
                </td>
                <td class="text-right"><input type="text" name="product_image[1][sort_order]" value="2" placeholder="{{ _i('Sort Order') }}" class="form-control"></td>
                <td class="text-left"><button type="button" onclick="$('#image-row1').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="{{ _i('Remove') }}"><i class="ti-minus"></i></button></td>
            </tr>
            <tr id="image-row2">
                <td class="text-left">
                    <input type="file" name="product_image[2][image]" value="" id="product_image[2][image]" accept="image/gif, image/jpeg, image/png">
                </td>
                <td class="text-right"><input type="text" name="product_image[2][sort_order]" value="3" placeholder="{{ _i('Sort Order') }}" class="form-control"></td>
                <td class="text-left"><button type="button" onclick="$('#image-row2').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="{{ _i('Remove') }}"><i class="ti-minus"></i></button></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ _i('Add Image') }}"><i class="ti-plus"></i></button></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
