<div class="tab-pane" id="tab_links">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="manufacturer_id">{{ _i('Manufacturers') }}</label>
        <div class="col-sm-10">
            <select class="form-control" style="width: 100%;" id="manufacturer_id" name="manufacturer_id">
                <option value="0" {{ ( old("manufacturer_id", $rowData->manufacturer_id) == 0 ? "selected":"") }}>{{ _i('None') }}</option>
                @foreach ($manufacturers as $item)
                    <option value="{{ $item->id }}" {{ ( old("manufacturer_id", $rowData->manufacturer_id) == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="relatedProductIds[]">{{ _i('Related Products') }}</label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" multiple="multiple" style="width: 100%;" id="relatedProductIds[]" name="relatedProductIds[]">
                @foreach ($relatedProducts as $item)
                    <option value="{{ $item->id }}"  @if($currentProductRelated->containsStrict('related_id', $item->id)) selected="selected" @endif >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="" id="tab-data">
        <div class="col-sm-1"></div>
        <div class="row">
            <div class="col-12">
                <!-- Custom Tabs -->
                <div class="card">
                    <div class="d-flex p-0">
                        <ul class="nav nav-tabs" id="language">
                                @foreach ($languages as $lang)
                                    <li class="nav-item" ><a class="nav-link @if ($loop->first) active @endif" href="#desclanguage{{ $lang->id }}" data-toggle="tab">
                                            <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ _i($lang->name) }} <i class="fa"></i></a></li>
                                @endforeach

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach ($languages as $lang)
                                @if (in_array($lang->id, $languageIds))
                                    @foreach ($productTranslation as $trans)
                                        @if ($lang->id == $trans->language_id)

                                            <div class="tab-pane @if ($loop->first) active @endif " id="desclanguage{{ $lang->id }}">
                                                <span></span>
                                                {{-- Translation row Id --}}
                                                <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">


                                                <div class="form-group">
                                                    <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>
                                                    <div class="col-sm-10">
                                            <textarea class="form-control ckeditor" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">
{{ old('description['.$lang->id.']', $trans->description) }}</textarea>
                                                        {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Description') }}</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="meta_description[{{ $lang->id }}]" name="meta_description[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Description') }}" rows="5">{{ old('meta_description['.$lang->id.']', $trans->meta_description) }}</textarea>
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
                                                        <textarea class="form-control" id="meta_keyword[{{ $lang->id }}]" name="meta_keyword[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Keywords') }}" rows="5">{{ old('meta_keyword['.$lang->id.']', $trans->meta_keyword) }}</textarea>
                                                        @if ($errors->has('meta_keyword['.$lang->id.']'))
                                                            <span class="text-danger invalid-feedback">
                                                                                <strong>{{ $errors->first('meta_keyword['.$lang->id.']') }}</strong>
                                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">
                                        <span></span>
                                        @include('admin.products.general');
                                    </div>
                                @endif
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

{{--    --}}
{{--    <div class="form-group">--}}
{{--        <div class="col-md-10 col-md-offset-2">--}}
{{--            <ul class="nav nav-tabs" id="language">--}}
{{--                @foreach ($languages as $lang)--}}
{{--                    <li class=" @if ($loop->first) active @endif"><a href="#desclanguage{{ $lang->id }}" data-toggle="tab">--}}
{{--                            <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }} <i class="fa"></i></a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--            <div class="tab-content">--}}
{{--                @foreach ($languages as $lang)--}}
{{--                    @if (in_array($lang->id, $languageIds))--}}
{{--                        @foreach ($productTranslation as $trans)--}}
{{--                            @if ($lang->id == $trans->language_id)--}}

{{--                                <div class="tab-pane @if ($loop->first) active @endif " id="desclanguage{{ $lang->id }}">--}}
{{--                                    <span></span>--}}
{{--                                    --}}{{-- Translation row Id --}}
{{--                                    <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">--}}


{{--                                    <div class="form-group">--}}
{{--                                        <label for="description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Description') }}</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <textarea class="form-control ckeditor" id="description[{{ $lang->id }}]" name="description[{{ $lang->id }}]" placeholder="{{ _i('Description') }}">--}}
{{--{{ old('description['.$lang->id.']', $trans->description) }}</textarea>--}}
{{--                                            {!! $errors->first('description['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="meta_description[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Description') }}</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <textarea class="form-control" id="meta_description[{{ $lang->id }}]" name="meta_description[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Description') }}" rows="5">{{ old('meta_description['.$lang->id.']', $trans->meta_description) }}</textarea>--}}
{{--                                            @if ($errors->has('meta_description['.$lang->id.']'))--}}
{{--                                                <span class="text-danger invalid-feedback">--}}
{{--                                                                                <strong>{{ $errors->first('meta_description['.$lang->id.']') }}</strong>--}}
{{--                                                                            </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="meta_keyword[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Keywords') }}</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <textarea class="form-control" id="meta_keyword[{{ $lang->id }}]" name="meta_keyword[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Keywords') }}" rows="5">{{ old('meta_keyword['.$lang->id.']', $trans->meta_keyword) }}</textarea>--}}
{{--                                            @if ($errors->has('meta_keyword['.$lang->id.']'))--}}
{{--                                                <span class="text-danger invalid-feedback">--}}
{{--                                                                                <strong>{{ $errors->first('meta_keyword['.$lang->id.']') }}</strong>--}}
{{--                                                                            </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                        <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">--}}
{{--                            <span></span>--}}
{{--                            @include('admin.products.general');--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
