<div class="tab-pane" id="tab-colors">
<div class="table-responsive" data-toggle="validator" >
    <table id="colors" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <td class="text-left">{{ _i('Name') }}</td>
                <td class="text-left">{{ _i('Image') }}</td>
                <td class="text-left">{{ _i('Color') }}<span style="color: #F00;">*</span></td>
                <td class="text-left">{{ _i('Sort Order') }}</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($productColors as $prColor)
            <tr id="color-row{{ $loop->index }}">
                <td class="text-left">
                    @foreach ($languages as $lang)
                        @if (in_array($lang->id, $languageIds))
                            @foreach ($prColor->colorTranslation as $trans)
                            @if ($lang->id == $trans->language_id)

                                {{-- Translation row Id --}}
                                <input type="hidden" name="product_color[{{ $loop->parent->parent->index }}][product_color_description_id][{{ $lang->id }}]" value="{{ $trans->id }}">

                                <div class="input-group"><span class="input-group-addon"><img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}" /></span>
                                        <input data-minlength="2" type="text" name="product_color[{{ $loop->parent->parent->index }}][name][{{ $lang->id }}]" placeholder="{{ _i('Name') }}" class="form-control" value="{{ old('product_color['. $loop->parent->parent->index .'][name]['. $lang->id .']', $trans->name) }}" required="" />
                                        {!! $errors->first('name','<p class="text-danger"><strong>:message</strong></p>') !!}
                                </div>
                            @endif
                            @endforeach
                        @else
                            {{-- Translation row Id --}}
                            <input type="hidden" name="product_color[{{ $loop->parent->index }}][product_color_description_id][{{ $lang->id }}]" >

                            <div class="input-group"><span class="input-group-addon"><img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}" /></span>
                                <input type="text" name="product_color[{{ $loop->parent->index }}][name][{{ $lang->id }}]" placeholder="{{ _i('Name') }}" class="form-control" data-validate="true" required="">
                                {!! $errors->first('name','<p class="text-danger"><strong>:message</strong></p>') !!}
                            </div>
                        @endif
                    @endforeach
                </td>
                <td class="text-left">
                    <input type="file" name="product_color[{{ $loop->index }}][image]" id="product_color[{{ $loop->index }}][image]" accept="image/gif, image/jpeg, image/png">

                    @if(is_file(public_path('images\\products\\'.$prColor->image)))
                    <div class="bs-example bs-example-images">
                        <img src="{{ asset('images/products/'.$prColor->image) }}" width="100px" class="img-thumbnail">
                    </div>
                    @endif


                    <input required="" type="hidden" name="product_color[{{ $loop->index }}][product_color_id]" id="product_color[{{ $loop->index }}][product_color_id]" value="{{ $prColor->id }}">
                </td>
                <td class="text-right"><input autocomplete="off" type="text" name="product_color[{{ $loop->index }}][color]" placeholder="{{ _i('Color') }}" id="input_color{{ $loop->index }}" value="{{ $prColor->color }}" class="form-control oldColorInput">
                    {!! $errors->first('color','<p class="text-danger"><strong>:message</strong></p>') !!}</td>
                <td class="text-right">
                    <input required="" type="text" name="product_color[{{ $loop->index }}][sort_order]" value="{{ $prColor->sort_order }}" placeholder="{{ _i('Sort Order') }}" class="form-control"></td>
                <td class="text-left"><button type="button" onclick="deleteProductColor({{ $loop->index }}, {{ $prColor->id }})" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="{{ _i('Remove') }}"><i class="ti-minus"></i></button></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td class="text-left"><button type="button" onclick="addColor();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ _i('Add Color') }}"><i class="ti-plus"></i></button></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>


@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>

//Color
var color_row = {{count($productColors)}};

var ids = $('.oldColorInput').map(function() {
  var id = $(this).attr('id');

    $('#'+id).colorpicker();
});

function addColor() {
    var sort_order = color_row + 2;
    html  = '<tr id="color-row' + color_row + '">';

    html += '  <td class="text-left">';

    @foreach($languages as $lang)
    html += '<input type="hidden" name="product_color[' + color_row + '][product_color_description_id][{{ $lang->id }}]" >';
    html += '<div class="input-group"><span class="input-group-addon"><img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ _i($lang->name) }}" /></span><input type="text" name="product_color[' + color_row + '][name][{{ $lang->id }}]" placeholder="{{ _i('Name') }}" class="form-control"></div>';
    @endforeach

    html += '  </td>';
    html += '  <td class="text-left"><input type="file" name="product_color[' + color_row + '][image]" value="" id="product_color[' + color_row + '][image]" accept="image/gif, image/jpeg, image/png"></td>';
    html += '<input type="hidden" name="product_color[' + color_row + '][product_color_id]" id="product_color[' + color_row + '][product_color_id]" value=""></td>';
    html += '<td class="text-right"><input required="" type="text" autocomplete="off" name="product_color[' + color_row + '][color]" placeholder="{{ _i('Color') }} * " id="input_color'+color_row+'" class="form-control required="" data-validate="true"">' +
        '{!! $errors->first('color','<p class="text-danger"><strong>:message</strong></p>') !!}</td>';
    html += '  <td class="text-right"><input type="text" name="product_color[' + color_row + '][sort_order]" value="' + sort_order + '" placeholder="{{ _i('Sort Order') }}" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#color-row' + color_row  + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button></td>';
    html += '</tr>';

    $('#colors tbody').append(html);

    $('#input_color'+color_row).colorpicker();

    color_row++;
}

function deleteProductColor(rowNum, product_color_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductColor') !!}',
        data: { product_color_id: product_color_id }
    })
    .done(function(msg) {
        // alert("Data Saved: " + msg);
    });
    $('#color-row' + rowNum).remove();
}
</script>
@endpush
