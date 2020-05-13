<ul class="nav nav-tabs" id="language">
    @foreach ($languages as $lang)
    <li class=" @if ($loop->first) active @endif"><a href="#language{{ $lang->id }}" data-toggle="tab">
            <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }} <i class="fa"></i></a></li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach ($languages as $lang)
    <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">
        <span></span>
        <div class="form-group">
            <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Product Name') }}<span style="color: #F00;">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Product Name') }}" value="{{ old('name['.$lang->id.']') }}" required="" data-minlength="2">
                {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
            </div>
        </div>
        <div class="form-group">
            <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>
            <div class="col-sm-10">
                <textarea class="form-control ckeditor" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">{{ old('description['.$lang->id.']') }}</textarea>
                {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="country_id">{{ _i('Country') }}</label>
            <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" id="country_id" name="country_id">
                    @foreach ($countries as $item)
                    <option value="{{ $item->id }}" {{ ( old("countries") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="meta_title[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Title') }}<span style="color: #F00;">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="meta_title[{{ $lang->id }}]" name="meta_title[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Title') }}" required="" value="{{ old('meta_title['.$lang->id.']') }}" data-minlength="2">
                <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                @if ($errors->has('meta_title['.$lang->id.']'))
                <span class="text-danger invalid-feedback">
                    <strong>{{ $errors->first('meta_title['.$lang->id.']') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="meta_description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Description') }}</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="meta_description[{{ $lang->id }}]" name="meta_description[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Description') }}" rows="5">{{ old('meta_description['.$lang->id.']') }}</textarea>
                @if ($errors->has('meta_description['.$lang->id.']'))
                <span class="text-danger invalid-feedback">
                    <strong>{{ $errors->first('meta_description['.$lang->id.']') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="meta_keyword[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Keywords') }}</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="meta_keyword[{{ $lang->id }}]" name="meta_keyword[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Keywords') }}" rows="5">{{ old('meta_keyword['.$lang->id.']') }}</textarea>
                @if ($errors->has('meta_keyword['.$lang->id.']'))
                <span class="text-danger invalid-feedback">
                    <strong>{{ $errors->first('meta_keyword['.$lang->id.']') }}</strong>
                </span>
                @endif
            </div>
        </div>
        {{-- <div class="form-group">
            <label for="tag[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Product Tag') }}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tag[{{ $lang->id }}]" name="tag[{{ $lang->id }}]" placeholder="{{ _i('Product Tag') }}" value="{{ old('tag['.$lang->id.']') }}">
                <div class="help-block">{{ _i('Comma seperated') }}</div>
            </div>
        </div> --}}
    </div>
    @endforeach
</div>
