<div class="tab-pane" id="links" role="tabpanel">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="manufacturer_id">{{ _i('Manufacturers') }}</label>
        <div class="col-sm-10">
            <select class="form-control" style="width: 100%;" id="manufacturer_id" name="manufacturer_id">
                <option value="0" {{ ( old("manufacturer_id") == 0 ? "selected":"") }}>{{ _i('None') }}</option>
                @foreach ($manufacturers as $item)
                    <option value="{{ $item->id }}" {{ ( old("manufacturer_id") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="relatedProductIds[]">{{ _i('Related Products') }}</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" multiple="multiple" style="width: 100%;" id="relatedProductIds[]" name="relatedProductIds[]">
                @foreach ($relatedProducts as $item)
                    <option value="{{ $item->id }}" {{ ( old("relatedProductIds[]") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="">
        <div class="col-sm-1"></div>
        <div class="row">
            <div class="col-12">
                <!-- Custom Tabs -->
                <div class="card">
                    <div class="d-flex p-0">
                        <ul class="nav nav-tabs" id="language">
                            @foreach ($languages as $lang)
                                <li class="nav-item" >
                                    <a class="nav-link @if ($loop->first) active @endif" href="#languageDesc{{ $lang->id }}" data-toggle="tab">
                                        <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ _i($lang->name) }}
                                        <i class="ti"></i>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach ($languages as $lang)
                                <div class="tab-pane @if($loop->first) active @endif" id="languageDesc{{ $lang->id }}">
                                    <span></span>
                                    <div class="form-group">
                                        <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">{{ old('description['.$lang->id.']') }}</textarea>
                                            {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>

{{--    <ul class="nav nav-tabs" id="language">--}}
{{--        @foreach ($languages as $lang)--}}
{{--            <li class="@if ($loop->first) active @endif">--}}
{{--                <a href="#languageDesc{{ $lang->id }}" data-toggle="tab">--}}
{{--                    <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }}--}}
{{--                    <i class="fa"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--    <div class="tab-content">--}}
{{--        @foreach ($languages as $lang)--}}
{{--            <div class="tab-pane @if($loop->first) active @endif" id="languageDesc{{ $lang->id }}">--}}
{{--                <span></span>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <textarea class="form-control" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">{{ old('description['.$lang->id.']') }}</textarea>--}}
{{--                        {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <div class="form-group">--}}
{{--                    <label for="meta_description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Description') }}</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <textarea class="form-control" id="meta_description[{{ $lang->id }}]" name="meta_description[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Description') }}" rows="5">{{ old('meta_description['.$lang->id.']') }}</textarea>--}}
{{--                        @if ($errors->has('meta_description['.$lang->id.']'))--}}
{{--                            <span class="text-danger invalid-feedback">--}}
{{--                                                    <strong>{{ $errors->first('meta_description['.$lang->id.']') }}</strong>--}}
{{--                                                </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="meta_keyword[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Keywords') }}</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <textarea class="form-control" id="meta_keyword[{{ $lang->id }}]" name="meta_keyword[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Keywords') }}" rows="5">{{ old('meta_keyword['.$lang->id.']') }}</textarea>--}}
{{--                        @if ($errors->has('meta_keyword['.$lang->id.']'))--}}
{{--                            <span class="text-danger invalid-feedback">--}}
{{--                                                    <strong>{{ $errors->first('meta_keyword['.$lang->id.']') }}</strong>--}}
{{--                                                </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
</div>
