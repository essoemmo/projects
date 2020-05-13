<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Codes') }}</h5>
        <button id="edit-codes-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if(count($product->codes) > 0)
        <div class="view-codes">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table text-center">
                            <tbody>
                            @foreach($product->codes as $item)
                                <tr>
                                    <th scope="row">{{ _i('Code') }} : </th>
                                    <td>{{ $item->code }}</td>
                                    <th scope="row">{{ _i('status') }} : </th>
                                    <td>
                                        @if($item->status == 0)
                                            {{ _i('Available') }}
                                        @else
                                            {{ _i('Sold') }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="view-codes">
                <div class="alert alert-danger">
                    {{ _i('No codes') }}
                </div>
            </div>
        @endif
        <div class="edit-codes j-forms" style="display: none;" id="j-forms">

            <div class="content">
                <form id="form-codes" data-parsley-validate>

                @csrf

                <div class="row form-group">
                    <div class="col-lg-12">
                        @if(count($codes) > 0)
                            @foreach($codes as $code)
                                <div class="clone-leftside-btn-1 cloneya-wrap">
                                    <div class="j-row toclone-widget-right toclone cloneya">
                                        <div class="span6 unit">
                                            <div class="input">
                                                <input type="text" value="{{ $code->code }}" placeholder="{{ _i('Code') }}" name="codes[]" required>
                                            </div>
                                        </div>
                                        <div class="span6 unit">
                                            <div class="input">
                                                <select name="status[]" class="form-control clone-select">
                                                    <option disabled selected>{{ _i('Select') }}</option>
                                                    <option value="0" @if($code->status == 0) selected @endif>{{ _i('Available') }}</option>
                                                    <option value="1" @if($code->status == 1) selected @endif>{{ _i('Sold') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                            <i class="icofont icofont-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                            <i class="icofont icofont-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="clone-leftside-btn-1 cloneya-wrap">
                            <div class="j-row toclone-widget-right toclone cloneya">
                                <div class="span6 unit">
                                    <div class="input">
                                        <input type="text" placeholder="{{ _i('Code') }}" name="codes[]" required>
                                    </div>
                                </div>
                                <div class="span6 unit">
                                    <div class="input">
                                        <select name="status[]" class="form-control clone-select">
                                            <option disabled selected>{{ _i('Select') }}</option>
                                            <option value="0">{{ _i('Available') }}</option>
                                            <option value="1">{{ _i('Sold') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                    <i class="icofont icofont-plus"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                    <i class="icofont icofont-minus"></i>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">{{ _i('Save') }}</button>
                    <a href="javascript:void(0)" id="edit-cancel-btn-codes" class="btn btn-default waves-effect">{{ _i('Cancel') }}</a>
                    <div class="loader-block" style="display: none">
                        <svg id="loader2" viewBox="0 0 100 100">
                            <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                        </svg>
                    </div>
                </div>

            </form>

            </div>

        </div>

    </div>

</div>



