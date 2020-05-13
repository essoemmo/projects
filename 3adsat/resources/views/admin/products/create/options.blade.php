<div class="form-group">
    <label class="col-sm-2 control-label" for="option_id">{{ _i('Option') }}</label>
    <div class="col-sm-8">
        <select class="form-control select2" style="width: 100%;" id="option_id" name="option_id">
            <option value="0" {{ ( old("option_id") == 0 ? "selected":"") }}>{{ _i('None') }}</option>
            @foreach ($options as $item)
            <option value="{{ $item->id }}" {{ ( old("option_id") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-2">
        <button type="button" onclick="addOption();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Option"><i class="ti-plus"></i></button>
    </div>
</div>
<br />
<div id="optionsChoosen">
</div>
@push('js')
<script type="text/javascript">
    

var option_row = 0;

function addOption() {

        //get option data by AJAX
        var option_id = $('#option_id').val();
        if(option_id != 0){

            $.ajax({        
                method: "POST",
                url: '{!! route('boilerplate.products.getOption') !!}',
                data: { option_id: option_id }
            })
            .done(function(response) {
                var html =' <div id="div-option' + option_row + '">';

                 html  += '<hr><div class="row">';
                html +='<div class="col-sm-10"><h3>'+ response.name +'</h3> </div>';
                html += '<div class="col-sm-2"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#div-option' + option_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger">  <i class="ti-minus"></i></button></div></div>';
                html += '   <input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
                html += '   <input type="hidden" name="product_option[' + option_row + '][name]" value="' + response.name + '" />';
                html += '   <input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + response.option_id + '" />';
                html += '   <input type="hidden" name="product_option[' + option_row + '][type]" value="' + response.type + '" />';

                html += '   <div class="form-group">';
                html += '     <label class="col-sm-2 control-label" for="input-required' + option_row + '">{{ _i('Required') }}</label>';
                html += '     <div class="col-sm-10"><select name="product_option[' + option_row + '][required]" id="input-required' + option_row + '" class="form-control">';
                html += '         <option value="1">{{ _i('Yes') }}</option>';
                html += '         <option value="0">{{ _i('No') }}</option>';
                html += '     </select></div>';
                html += '   </div>';             
              
                // html += '<div class="form-group"> <label class = "col-sm-2 control-label" for = "input-parent' + option_row + '" > {{ _i('Parent Option') }} </label> <div class = "col-sm-10" ><select name="product_option[' + option_row + '][parent_option_id]" id="input-parent' + option_row + '" class="form-control tmdparent" rel="0"><option value="">  {{ _i('None') }}  </option>';

                //     @foreach ($options as $item)
                //     html += '<option value="{{ $item->id }}" {{ ( old("option_id") == $item->id ? "selected":"") }}>{{ $item->name }}</option>';
                //     @endforeach
                // html += '</select> </div> </div>';

                if (response.type == 'select' || response.type == 'radio' || response.type == 'checkbox' || response.type == 'image') {
                    html += '<div class="table-responsive">';
                    html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
                    html += '    <thead>';
                    html += '      <tr>';
                    html += '        <td class="text-left">{{ _i('Option Value') }}</td>';
                    html += '        <td class="text-right">{{ _i('Quantity') }}</td>';
                    html += '        <td class="text-left">{{ _i('Subtract Stock') }}</td>';
                    html += '        <td class="text-right">{{ _i('Price') }}</td>';
                    html += '        <td class="text-right">{{ _i('Weight') }}</td>';
                    html += '        <td class="text-right">{{ _i('Parent Option Value') }}</td>';
                    html += '        <td></td>';
                    html += '      </tr>';
                    html += '    </thead>';
                    html += '    <tbody>';
                    html += '    </tbody>';
                    html += '    <tfoot>';
                    html += '      <tr>';
                    html += '        <td colspan="6"></td>';
                    html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="{{ _i('Add Option Value') }}" class="btn btn-primary"><i class="ti-plus"></i></button></td>';
                    html += '      </tr>';
                    html += '    </tfoot>';
                    html += '  </table>';
                    html += '</div>';

                    html += '  <select id="option-values' + option_row + '" style="display: none;">';

                    for (i = 0; i < response.option_values.length; i++) {
                        html += '  <option value="' + response.option_values[i]['id'] + '">' + response.option_values[i]['name'] + '</option>';
                    }

                    html += '  </select>';
                    html += '</div>';
                }
                $('#optionsChoosen').append(html);

                option_row++;
            });  
        }
}

var option_value_row = 0;

function addOptionValue(option_row) {
    html  = '<tr id="option-value-row' + option_value_row + '">';
    html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
    html += $('#option-values' + option_row).html();
    html += '  </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
    html += '  <td class="text-right"><input type="number" min="1" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" placeholder="{{ _i('Quantity') }}" class="form-control" /></td>';
    html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]" class="form-control">';
    html += '    <option value="1">{{ _i('Yes') }}</option>';
    html += '    <option value="0">{{ _i('No') }}</option>';
    html += '  </select></td>';
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="number" step="0.1" min="0" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" placeholder="{{ _i('Price') }}" class="form-control" /></td>';
    
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="number" step="0.1" min="0" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" placeholder="{{ _i('Weight') }}" class="form-control" /></td>';
    
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][parent_option_value_id]" class="form-control">';
    {{-- html += '    <option value="0">{{ _i('Select') }}</option>'; --}}
    html += '  </select>';

    html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button></td>';
    html += '</tr>';

    $('#option-value' + option_row + ' tbody').append(html);
    $('[rel=tooltip]').tooltip();

    option_value_row++;
}
</script>
@endpush