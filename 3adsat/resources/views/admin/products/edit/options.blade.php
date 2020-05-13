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
        <button type="button" onclick="addOption();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Option"><i class=" ti-plus"></i></button>
    </div>
</div>
<br />
<div id="optionsChoosen">
    @foreach ($productOptions as $prOption)
    <div id="div-option{{ $loop->index }}">
        <hr>
        <div class="row">
            <div class="col-sm-10">
                <h3>{{ $prOption->name }}</h3>
            </div>
            <div class="col-sm-2">
                <button type="button" onclick="deleteProductOption({{ $loop->index }}, {{ $prOption->id }})" data-toggle="tooltip" id="delete-option{{ $loop->index }}" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger">
                    <i class="ti-minus"></i>
                </button>
            </div>
        </div>
        <input type="hidden" name="product_option[{{ $loop->index }}][product_option_id]" value="{{ $prOption->id }}" />
        <input type="hidden" name="product_option[{{ $loop->index }}][name]" value="{{ $prOption->name }}" />
        <input type="hidden" name="product_option[{{ $loop->index }}][option_id]" value="{{ $prOption->option_id }}" />
        <input type="hidden" name="product_option[{{ $loop->index }}][type]" value="{{ $prOption->type }}" />
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-required{{ $loop->index }}">{{ _i('Required') }}</label>
            <div class="col-sm-10"><select name="product_option[{{ $loop->index }}][required]" id="input-required{{ $loop->index }}" class="form-control">
                    <option value="1" {{ ( old("input-required".$loop->index."][required]", $prOption->required) == "1" ? "selected":"") }}>{{ _i('Yes') }}</option>
                    <option value="0" {{ ( old("input-required".$loop->index."][required]", $prOption->required) == "0" ? "selected":"") }}>{{ _i('No') }}</option>
                </select></div>
        </div>
        <div class="form-group"> <label class="col-sm-2 control-label" for="input-parent{{ $loop->index }}"> {{ _i('Parent Option') }} </label>
            <div class="col-sm-10">

                <input type="hidden" id="parent_options_count{{ $loop->index }}" value="{{count($prOption->productOptionParents)}}">

                <table id="parent_options_table_{{ $loop->index }}" class="table table-bordered table-hover">
                    <tbody>
                        @if(!empty($prOption->productOptionParents))
                            @foreach($prOption->productOptionParents as $parent)
                                <tr>
                                    <td>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="product_option[{{ $loop->parent->index }}][parent_option][{{ $loop->index }}][product_option_parent_id]" value="{{ $parent->id }}">

                                            <select name="product_option[{{ $loop->parent->index }}][parent_option][{{ $loop->index }}][parent_option_id]" id="input-parent{{ $loop->parent->index }}_{{ $loop->index }}" class="form-control tmdparent" rel="0" data-rownum="{{ $loop->parent->index }}" onchange="getParentValues({{ $loop->parent->index }}, {{ $loop->index }})">
                                                <option value=""> --- </option>
                                                @foreach ($productOptions as $item)
                                                <option value="{{ $item->id }}" @if($parent->parent_option_id == $item->id) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <div id="div_parent_option_values_{{ $loop->parent->index }}_{{ $loop->index }}">
                                                <select name="product_option[{{ $loop->parent->index }}][parent_option][{{ $loop->index }}][product_option_parent_value_ids][]" id="input-parent_values{{ $loop->parent->index }}_{{ $loop->index }}" class="form-control " rel="0" multiple="multiple">
                                                    @if(!empty($parent->productOptionValues))
                                                    @foreach($parent->productOptionValues as $item)
                                                    <option value="{{ $item->id }}"  @if($parent->productOptionParentValues->containsStrict('product_option_value_id', $item->id)) selected="selected" @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select> 
                                            </div>
                                        </div>
                                    </td>
                                    <td><button type="button" onclick="$(this).closest(\'tr\').remove();" data-toggle="tooltip" class="btn btn-danger" title="{{ _i('Remove parent option') }}"><i class=" ti-minus"></i></button></td>
                                </tr>
                           @endforeach
                       @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td width="100%">
                                <div id="text_no_parent_options_{{ $loop->index }}" style="display: none;">{{ _i('Currently, there\'s no parent options.') }}</div>
                            </td>
                            <td><button type="button" onclick="addParentOption({{ $loop->index }}, {{count($prOption->productOptionParents)}})" data-toggle="tooltip" class="btn btn-primary" title="" data-original-title="{{ _i('Add parent option') }}"><i class="ti-plus"></i></button></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
        @if($prOption->type == 'select' || $prOption->type == 'radio' || $prOption->type == 'checkbox' || $prOption->type == 'image')
        <div class="table-responsive">
            <table id="option-value{{ $loop->index }}" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">{{ _i('Option Value') }}</td>
                        <td class="text-right">{{ _i('Quantity') }}</td>
                        <td class="text-left">{{ _i('Subtract Stock') }}</td>
                        <td class="text-right">{{ _i('Price') }}</td>
                        <td class="text-right">{{ _i('Weight') }}</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prOption->productOptionValues as $prOptionValue)
                    <tr id="option-value-row{{ $loop->index }}">
                        <td class="text-left"><select name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][option_value_id]" class="form-control" value="{{ $prOptionValue->option_value_id }}">
                                @foreach($prOption->optionValues as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $prOptionValue->option_value_id)? "selected": "" }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][product_option_value_id]" value="{{ $prOptionValue->id }}" />
                        </td>
                        <td class="text-right"><input type="number" min="1" name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][quantity]" value="{{ $prOptionValue->quantity }}" placeholder="{{ _i('Quantity') }}" class="form-control" /></td>
                        <td class="text-left"><select name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][subtract]" class="form-control">
                                <option value="1" {{ ($prOptionValue->subtract_stock) == "1" ? "selected":"" }}>{{ _i('Yes') }}</option>
                                <option value="0" {{ ($prOptionValue->subtract_stock) == "0" ? "selected":"" }}>{{ _i('No') }}</option>
                            </select></td>
                        <td class="text-right"><select name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][price_prefix]" class="form-control">
                                <option value="+" {{ ($prOptionValue->price_prefix == "+") ? "selected":"" }}>+</option>
                                <option value="-" {{ ($prOptionValue->price_prefix) == "-" ? "selected":"" }}>-</option>
                            </select>
                            <input type="number" step="0.1" min="0" name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][price]" value="{{ $prOptionValue->price }}" placeholder="{{ _i('Price') }}" class="form-control" /></td>
                        <td class="text-right"><select name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][weight_prefix]" class="form-control">
                                <option value="+" {{ ($prOptionValue->weight_prefix) == "+" ? "selected":"" }}>+</option>
                                <option value="-" {{ ($prOptionValue->weight_prefix) == "-" ? "selected":"" }}>-</option>
                            </select>
                            <input type="number" step="0.1" min="0" name="product_option[{{ $loop->parent->index }}][product_option_value][{{ $loop->index }}][weight]" value="{{ $prOptionValue->weight }}" placeholder="{{ _i('Weight') }}" class="form-control" /></td>
                        <td class="text-left">
                            <button type="button" id="delete-option-value{{ $loop->index }}" onclick="deleteProductOptionValue({{ $loop->index }}, {{ $prOptionValue->id }})" data-toggle="tooltip" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger">
                                <i class=" ti-minus"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td class="text-left">
                            {{-- option value row count --}}
                            <input type="hidden" id="product_option_value_count{{ $loop->index }}" value="{{count($prOption->productOptionValues)}}">
                            <button type="button" onclick="addOptionValue({{ $loop->index }});" data-toggle="tooltip" title="{{ _i('Add Option Value') }}" class="btn btn-primary"><i class=" ti-plus"></i></button></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <select id="option-values{{ $loop->index }}" style="display: none;">
            @foreach($prOption->productOptionValues as $prOptionValue)
            <option value="{{ $prOptionValue->id }}">{{ $prOptionValue->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
    @endforeach
</div>
@push('js')
<script type="text/javascript">    
var option_row = {{count($productOptions)}};

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
          console.log(response);
                var html =' <div id="div-option' + option_row + '">';
                 html  += '<hr><div class="row">';
                html +='<div class="col-sm-10"><h3>'+ response.name +'</h3> </div>';
                html += '<div class="col-sm-2"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#div-option' + option_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger">  <i class=" ti-minus"></i></button></div></div>';
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
                html += '<div class="form-group"> <label class = "col-sm-2 control-label" for = "input-parent' + option_row + '" > {{ _i('Parent Option') }} </label> <div class = "col-sm-10" >';
                html += '<input type="hidden" id="parent_options_count' + option_row + '" value="0">';
                html += '<table id="parent_options_table_' + option_row + '" class="table table-bordered table-hover">';
                    html += '<tbody>';   
                    html += '</tbody>';
                    html += '<tfoot>';
                        html += '<tr>';
                            html += '<td width="100%">';
                                html += '<div id="text_no_parent_options_' + option_row + '" style="display: none;">{{ _i('Currently, there\'s no parent options.') }}</div>';
                            html += '</td>';
                            html += '<td><button type="button" onclick="addParentOption(' + option_row + ', 0)" data-toggle="tooltip" class="btn btn-primary" title="" data-original-title="{{ _i('Add parent option') }}"><i class=" ti-plus"></i></button></td>';
                        html += '</tr>';
                    html += '</tfoot>';
                html += '</table>';
                html += ' </div> </div>';

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
                    html += '        <td></td>';
                    html += '      </tr>';
                    html += '    </thead>';
                    html += '    <tbody>';
                    html += '    </tbody>';
                    html += '    <tfoot>';
                    html += '      <tr>';
                    html += '        <td colspan="5"></td>';
                    html += '        <td class="text-left"><input type="hidden" id="product_option_value_count' + option_row + '" value="0"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="{{ _i('Add Option Value') }}" class="btn btn-primary"><i class=" ti-plus"></i></button></td>';
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

    option_value_row = $('#product_option_value_count'+ option_row).val();

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
    html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class=" ti-minus"></i></button></td>';
    html += '</tr>';

    $('#option-value' + option_row + ' tbody').append(html);
    $('[rel=tooltip]').tooltip();

    option_value_row++;
    $('#product_option_value_count'+ option_row).val(option_value_row);
}

var parent_option_row = 0;

function addParentOption(option_row, parent_option_row){

    parent_option_row = $('#parent_options_count'+ option_row).val();

    var html = '<tr>';
    html += '<td>';
    html += '<div class="col-sm-4">';
    html += '<input type="hidden" name="product_option['+ option_row +'][parent_option]['+ parent_option_row +'][product_option_parent_id]" value=""> <select name="product_option['+ option_row +'][parent_option]['+ parent_option_row +'][parent_option_id]" id="input-parent'+ option_row +'_'+ parent_option_row +'" class="form-control tmdparent" rel="0" data-rownum="'+ option_row +'" onchange="getParentValues('+ option_row +', '+ parent_option_row +')">';
    html += '<option value=""> --- </option>';
    @foreach ($productOptions as $item)
    html += '<option value="{{ $item->id }}">{{ $item->name }}</option>';
    @endforeach
    html += '</select> ';
    html += '</div>';
    html += '<div class="col-sm-4">';
    html += '<div id="div_parent_option_values_'+ option_row + '_'+ parent_option_row +'">';
    html += '</div>';
    html += '</div>';
    html += '</td>';
    html += '<td><button type="button" onclick="$(this).closest(\'tr\').remove();" data-toggle="tooltip" class="btn btn-danger" title="{{ _i('Remove parent option') }}"><i class=" ti-minus-circle"></i></button></td>';
    html += '</tr>';

    parent_option_row++;

    var table = $('#parent_options_table_'+option_row);
    table.find('tbody').append(html);
    $('#parent_options_count'+ option_row).val(parent_option_row);
}

function getParentValues(option_row, parent_option_row) {
    var parent_option_id = $('#input-parent'+option_row+'_'+parent_option_row).val();
    if(parent_option_id !=""){
        $.ajax({        
            method: "POST",
            url: '{!! route('boilerplate.products.getParentValues') !!}',
            data: { parent_option_id: parent_option_id  }
        })
        .done(function(response) {
            console.log(response);
            var html = '<select name="product_option['+ option_row +'][parent_option]['+ parent_option_row +'][product_option_parent_value_ids][]" id="input-parent_values'+ option_row +'_'+ parent_option_row +'" class="form-control select2" rel="0" multiple="multiple">';
            for (i = 0; i < response.product_option_values.length; i++) { 
                html += '<option value="' + response.product_option_values[i]['id'] + '">' + response.product_option_values[i]['name'] + '</option>';
            }
            html += '</select> ';
            $('#div_parent_option_values_'+option_row+'_'+parent_option_row).html(html);
        });
    } else {
        $('#div_parent_option_values_'+option_row+'_'+parent_option_row).html('');
    }
}
</script>
@endpush