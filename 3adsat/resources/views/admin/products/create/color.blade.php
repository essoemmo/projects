<div class="tab-pane" id="colors" role="tabpanel">
    <div class="table-responsive">
        <table id="colors" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td class="text-left">{{ _i('Name') }}</td>
                    <td class="text-left">{{ _i('Image') }}</td>
                    <td class="text-left">{{ _i('Color') }} <span style="color: #f00;"></span></td>
                    <td class="text-left">{{ _i('Sort Order') }}</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="text-left"><button type="button" onclick="addColor()" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ _i('Add Color') }}"><i class="ti-plus"></i></button></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>

//Color
var color_row = 0;

function addColor() {
    var sort_order = color_row + 1;
    html  = '<tr id="color-row' + color_row + '">';

    html += '  <td class="text-left">';

    @foreach($languages as $lang)
    html += '<div class="input-group"><span class="input-group-addon"><img src="{{ asset('languages/'.$lang->image) }}" title="{{ _i($lang->name )}}" /></span><input type="text" name="product_color[' + color_row + '][name][{{ $lang->id }}]" placeholder="{{ _i('Name') }}" class="form-control"></div>';
    @endforeach

    html += '  </td>';
    html += '  <td class="text-left"><input required="" type="file" name="product_color[' + color_row + '][image]" value="" id="product_color[' + color_row + '][image]" accept="image/gif, image/jpeg, image/png"></td>';
    html += '<td class="text-right"><input required="" type="text" name="product_color[' + color_row + '][color]" placeholder="{{ _i('Color') }}" id="input_color'+color_row+'" class="form-control" />' +
        '{!! $errors->first('color','<p class="text-danger"><strong>:message</strong></p>') !!}</td>';
    html += '  <td class="text-right"><input required="" type="text" name="product_color[' + color_row + '][sort_order]" value="' + sort_order + '" placeholder="{{ _i('Sort Order') }}" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#color-row' + color_row  + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button></td>';
    html += '</tr>';

    $('#colors tbody').append(html);

    $('#input_color'+color_row).colorpicker();

    color_row++;
}
</script>
@endpush
