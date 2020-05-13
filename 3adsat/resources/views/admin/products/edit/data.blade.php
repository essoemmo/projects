<div class="tab-pane" id="tab_data">

    <div class="form-group">
        <label for="sku" class="col-sm-2 control-label">{{ _i('SKU') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="sku" name="sku" placeholder="{{ _i('SKU') }}" value="{{ old('sku', $rowData->sku) }}">
            <div class="help-block">Stock Keeping Unit</div>
        </div>
    </div>
    <div class="form-group">
        <label for="upc" class="col-sm-2 control-label">{{ _i('UPC') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="upc" name="upc" placeholder="{{ _i('UPC') }}" value="{{ old('upc', $rowData->upc) }}">
            <div class="help-block">Universal Product Code</div>
        </div>
    </div>
    <div class="form-group">
        <label for="ean" class="col-sm-2 control-label">{{ _i('EAN') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ean" name="ean" placeholder="{{ _i('EAN') }}" value="{{ old('ean', $rowData->ean) }}">
            <div class="help-block">European Article Number</div>
        </div>
    </div>
    <div class="form-group">
        <label for="jan" class="col-sm-2 control-label">{{ _i('JAN') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jan" name="jan" placeholder="{{ _i('JAN') }}" value="{{ old('jan', $rowData->jan) }}">
            <div class="help-block">Japanese Article Number</div>
        </div>
    </div>
    <div class="form-group">
        <label for="isbn" class="col-sm-2 control-label">{{ _i('ISBN') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="{{ _i('ISBN') }}" value="{{ old('isbn', $rowData->isbn) }}">
            <div class="help-block">International Standard Book Number</div>
        </div>
    </div>
    <div class="form-group">
        <label for="mpn" class="col-sm-2 control-label">{{ _i('MPN') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mpn" name="mpn" placeholder="{{ _i('MPN') }}" value="{{ old('mpn', $rowData->mpn) }}">
            <div class="help-block">Manufacturer Part Number</div>
        </div>
    </div>
    <div class="form-group">
        <label for="location" class="col-sm-2 control-label">{{ _i('Location') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="location" name="location" placeholder="{{ _i('Location') }}" value="{{ old('location', $rowData->location) }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-date-available">{{ _i('Date Available') }}</label>
        <div class="col-sm-3">
            <div class="input-group date">
                <input type="text" name="date_available" id="date_available" value="{{ old('date_available', $rowData->date_available) }}" placeholder="{{ _i('Date Available') }}" data-date-format="YYYY-MM-DD" class="form-control datepicker">
                <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class=" ti-calendar"></i></button>
                                            </span></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-length">{{ _i('Dimensions (L x W x H)') }}</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-4">
                    <input type="number" name="length" value="{{ old('length', $rowData->length) }}" placeholder="{{ _i('Length') }}" id="length" class="form-control" step="0.1" min="0">
                </div>
                <div class="col-sm-4">
                    <input type="number" name="width" value="{{ old('width', $rowData->width) }}" placeholder="{{ _i('Width') }}" id="width" class="form-control" step="0.1" min="0">
                </div>
                <div class="col-sm-4">
                    <input type="number" name="height" value="{{ old('height', $rowData->height) }}" placeholder="{{ _i('Height') }}" id="height" class="form-control" step="0.1" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="length_type">{{ _i('Length Type') }}</label>
        <div class="col-sm-10">
            <select name="length_type" id="length_type" class="form-control">
                <option value="cm" selected="selected">{{ _i('Centimeter') }}</option>
                <option value="mm" {{ ( old("length_type", $rowData->length_type) == "mm" ? "selected":"") }}>{{ _i('Millimeter') }}</option>
                <option value="in" {{ ( old("length_type", $rowData->length_type) == "in" ? "selected":"") }}>{{ _i('Inch') }}</option>
                <option value="ft" {{ ( old("length_type", $rowData->length_type) == "ft" ? "selected":"") }}>{{ _i('Foot') }}</option>
                <option value="m" {{ ( old("length_type", $rowData->length_type) == "m" ? "selected":"") }}>{{ _i('Meter') }}</option>
                <option value="yd" {{ ( old("length_type", $rowData->length_type) == "yd" ? "selected":"") }}>{{ _i('Yard') }}</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-weight">{{ _i('Weight') }}</label>
        <div class="col-sm-10">
            <input type="text" name="weight" value="{{ old("weight", $rowData->weight) }}" placeholder="{{ _i('Weight') }}" id="weight" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="weight_type">{{ _i('Weight Type') }}</label>
        <div class="col-sm-10">
            <select name="weight_type" id="weight_type" class="form-control">
                <option value="kg" {{ ( old("weight_type", $rowData->weight_type) == "kg" ? "selected":"") }}>{{ _i('Kilogram') }}</option>
                <option value="g" {{ ( old("weight_type", $rowData->weight_type) == "g" ? "selected":"") }}>{{ _i('Gram') }}</option>
                <option value="lb" {{ ( old("weight_type", $rowData->weight_type) == "lb" ? "selected":"") }}>{{ _i('Pound') }} </option>
                <option value="oz" {{ ( old("weight_type", $rowData->weight_type) == "oz" ? "selected":"") }}>{{ _i('Ounce') }}</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="sort_order" class="col-sm-2 control-label">{{ _i('Sort Order') }}</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" min="1" id="sort_order" name="sort_order" placeholder="{{ _i('Sort Order') }}" data-parsley-type="number" value="{{ old('sort_order', $rowData->sort_order) }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-status">{{ _i('Status') }}</label>
        <div class="col-sm-10">
            <select name="status" id="status" class="form-control">
                <option value="0" {{ ( old("status", $rowData->status) == 0 ? "selected":"") }}>{{ _i('Enabled') }}</option>
                <option value="1" {{ ( old("status", $rowData->status) == 1 ? "selected":"") }}>{{ _i('Disabled') }}</option>
                <option value="2" {{ ( old("status", $rowData->status) == 2 ? "selected":"") }}>{{ _i('Not Available') }}</option>
            </select>
        </div>
    </div>
</div>
