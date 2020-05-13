@if(count($features) > 0)
    <div class="head-title">{{ _i('Product Features Options') }}</div>
    <div class="feature">
        @foreach($features as $feature)
            <div class="row form-group">
                <label class="col-sm-4"
                       for="feature_option">{{ $feature->data->title ?? _i('not found') }}</label>
                <div class="col-sm-8">
                    <select class="float-none feature_option form-control" name="feature_option[]">
                        <option selected value="0" data-price="0"> -- {{ _i('Choose') }}--
                        </option>
                        @foreach($feature->options as $option)
                            <option value="{{ $option->id }}" id="{{ $feature->id }}"
                                    data-price="{{ $option->price }}">{{ $option->data->title ?? _i('not found') }}
                                ({{ $option->price }} {{ $product->currency_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    </div>
@endif
