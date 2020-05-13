@extends('admin.layout.master', [
'title' => _i('Countries'),
'subtitle' => _i('Add Country'),
'breadcrumb' => [ _i('Countries') => _i('countries.index'), _i('Add Country')]])
@push('css')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css"></style>
<style type="text/css">
.form-group {
    margin-top: 15px;
}
</style>
@endpush
@section('content')
<form class="form-horizontal" action="{{ route('countries.store') }}" data-parsley-validate="" method="post" enctype="multipart/form-data" id="addForm" role="form" data-toggle="validator">
    @csrf
    <div class="row">
        <div class="col-sm-12 mbl">
            <a href="{{ route("countries.index") }}" class="btn btn-default">
                {{ _i('Countries List') }}
            </a>
            <span class="btn-group pull-right">
                <button type="submit" class="btn btn-primary">
                    {{ __('save') }}
                </button>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ _i('Add Country') }}</h3>
                </div>
                <div class="box-body">
                    @foreach ($languages as $lang)
                    <div class="form-group">
                        <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Country Name') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}">
                                </span>
                                <input type="text" class="form-control" data-parsley-required="true" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Country Name') }}" value="{{ old('name['.$lang->id.']') }}" required data-minlength="2">
                                {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                            </div>
                                <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                        </div>
                    </div>
                    @endforeach            

                    <div class="form-group">
                        <label for="iso_code" class="col-sm-2 control-label">{{ _i('ISO Code') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="iso_code" name="iso_code" placeholder="{{ _i('Country Name') }}" value="{{ old('iso_code') }}" data-minlength="2" data-parsley-required="true">
                            {!! $errors->first('iso_code','<p class="text-danger"><strong>:message</strong></p>') !!}
                            <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">{{ _i('Image') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png" required>
                            {!! $errors->first('image','<p class="text-danger"><strong>:message</strong></p>') !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="currency_id">{{ _i('Currency') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">                                     
                            <select class="form-control selectpicker" style="width: 100%;" id="currency_id" name="currency_id" required data-validate="true">
                                <option value="" {{ ( old("currency_id") == "" ? "selected":"") }} >  </option>
                                @foreach ($currencies as $item)
                                <option value="{{ $item->id }}"  {{ ( old("currency_id") == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="language_ids[]">{{ _i('Languages') }}<span style="color: #F00;">*</span></label>
                        <div class="col-sm-10">                                     
                            <select class="form-control select2 selectpicker" multiple="multiple" style="width: 100%;" id="language_ids[]" name="language_ids[]" required data-validate="true">
                                @foreach ($languages as $item)
                                <option value="{{ $item->id }}"  {{ ( old("language_ids[]") == $item->id ? "selected":"") }} >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="postcode_required">{{ _i('Postcode Required') }}</label>
                        <div class="col-sm-10">
                            <select name="postcode_required" id="postcode_required" class="form-control">
                                <option value="0" {{ ( old("postcode_required") == 0 ? "selected":"") }}>{{ _i('No') }}</option>
                                <option value="1" {{ ( old("postcode_required") == 1 ? "selected":"") }}>{{ _i('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="default_country">{{ _i('Default') }}</label>
                        <div class="col-sm-10">
                            <select name="default_country" id="default_country" class="form-control">
                                <option value="0" {{ ( old("default_country") == 0 ? "selected":"") }}>{{ _i('No') }}</option>
                                <option value="1" {{ ( old("default_country") == 1 ? "selected":"") }}>{{ _i('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status">{{ _i('Status') }}</label>
                        <div class="col-sm-10">
                            <select name="status" id="input-status" class="form-control">
                                <option value="0" {{ ( old("status") == 0 ? "selected":"") }}>{{ _i('Enabled') }}</option>
                                <option value="1" {{ ( old("status") == 1 ? "selected":"") }}>{{ _i('Disabled') }}</option>
                            </select>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label class="col-sm-2 control-label" for="payment_methods[]">{{ _i('Payment Methods') }}<span style="color: #F00;">*</span></label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <select class="form-control select2" multiple="multiple" style="width: 100%;" id="payment_methods[]" name="payment_methods[]">--}}
{{--                                @foreach ($paymentMethods as $item)--}}
{{--                                <option value="{{ $item->id }}" {{ ( old("payment_methods[]") == $item->id ? "selected":"") }}>{{ $item->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('js')
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
{{--<script>--}}
{{--    $('.select2').select2();--}}
{{--</script>--}}
@endpush
