<div class="tab-pane" id="tab-attributes">
    @if($productAttributes->isNotEmpty())
{{--        @dd($productAttributes)--}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td class="text-left">{{ _i('Attribute') }}</td>
                <td class="text-left">{{ _i('Text') }}</td>
                <td></td>
            </tr>
            </thead>
            <tbody id="attribute" >
                @foreach ($productAttributes as $prAttribute)
                    <tr id="attribute-row{{ $loop->index }}">
                        <td class="text-left" style="width: 40%;">
                            <select class="form-control selectpicker" id="product_attribute[{{ $loop->index }}][attribute_id]" name="product_attribute[{{ $loop->index }}][attribute_id]">

                                @foreach($attributes as $item)
                                    <option value="{{ $item->id }}" {{ ( old("product_attribute[". $loop->index."][attribute_id]", $prAttribute->pr_attribute_id) == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <!--<input type="hidden" name="product_attribute[{{ $loop->index }}][product_attribute_id][]" value="{{ $prAttribute->id }}" />-->

                        </td>

                        <td class="text-left">
                            @foreach($languages as $lang)
                                @if (in_array($lang->id, $languageIds))
                                    @foreach ($prAttribute->productAttributeValues as $prAttributeValue)
                                        @if ($lang->id == $prAttributeValue->language_id)
                                            <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ _i($lang->name)}}" />
                                                                    </span>
                                                <textarea name="product_attribute[{{ $loop->parent->parent->index }}][text][{{ $lang->id }}][]" rows="5" placeholder="{{ _i('Text') }}" class="form-control">{{ $prAttributeValue->text }}</textarea>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}" />
                                                                    </span>
                                        <textarea name="product_attribute[{{ $loop->parent->parent->index }}][text][{{ $lang->id }}]" rows="5" placeholder="{{ _i('Text') }}" class="form-control">{{ old('product_attribute['. $loop->index.'][text]['.$lang->id.']') }}</textarea>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-right">
                            <button type="button" onclick="deleteProductAttribute({{ $loop->index }}, {{ $prAttribute->pr_attribute_id }}, {{ $prAttribute->product_id }})" data-toggle="tooltip" title="{{ _i('Remove ') }}" class="btn btn-danger"><i class="ti-minus"></i></button>
                        </td>
                    </tr>

                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-right"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Attribute"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
            </tfoot>
        </table>
    </div>
        @else
            <div class="form-group">
                <div class="col-md-12">
                    <select class="form-control select2 attributeGroup" id="attributeGroup" name="attributeGroup">
                        <option value="">---</option>
                        @foreach($attributeGroup as $item)
                            <option value="{{ $item->id }}" {{ ( old("attributeGroup") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            {{--loader spinner--}}
            <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
                <img src="{{ url('/') }}/images/ajax-loader.gif"/>
            </div>
            <div class="column-data">

            </div>
        @endif
</div>
