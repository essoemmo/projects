<div class="tab-pane active" id="tab-general">

    <div class="form-group">
        <label for="model" class="col-sm-2 control-label">{{ _i('Model') }}<span style="color: #F00;">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="model" name="model" placeholder="{{ _i('Model') }}" value="{{ old('model', $rowData->model) }}" data-minlength="2" required="">
            {!! $errors->first('model','<p class="text-danger"><strong>:message</strong></p>') !!}
        </div>
    </div>
    {{--category--}}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="categoryIds[]">{{ _i('Category') }}  <span style="color: #F00;"> *</span></label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" multiple="multiple" style="width: 100%;" id="categoryIds[]" name="categoryIds[]">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}"  @if($currentProductCatgeories->containsStrict('category_id', $item->id)) selected="selected" @endif>{{ $item->getParentsNames($language_id) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--product_type--}}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="product_type">{{ _i('Product Type') }} <span style="color: #F00;">*</span></label>
        <div class="col-sm-10">
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="product_type_1" value="glasses" @if ($rowData->product_type == "glasses") checked @endif>
                <label class="control-label" for="product_type_1">{{ _i('Glasses') }}</label>
            </div>
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="product_type_2" value="sunglass" @if ($rowData->product_type == "sunglass") checked @endif>
                <label class="control-label"  for="product_type_2">{{ _i('Sun Glass') }}</label>
            </div>
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="product_type_3" value="lenses" @if ($rowData->product_type == "lenses") checked @endif>
                <label class="control-label" for="product_type_3">{{ _i('Lenses') }}</label>
            </div>
        </div>
        <div class="col-sm-7"></div>
{{--        @dd($showOptions)--}}
        <div class="col-sm-3">
            <div id="show_options"  style="display: none">
                <select class="form-control selectpicker show_options" name="type" title='Choose one of the following...'>
                    <option @if($product_sphere->containsStrict('type', 1) || $product_cylinder->containsStrict('type', 1) || $product_axis->containsStrict('type', 1)) selected @endif value="1">{{ _i('Colored') }}</option>
                    <option @if($product_sphere->containsStrict('type', 2) || $product_cylinder->containsStrict('type', 2) || $product_axis->containsStrict('type', 2)) selected @endif value="2">{{ _i('Transparent') }}</option>
                </select>
            </div>
            <div id="show_lenses"  style="display: none">
                @if($product_sphere->containsStrict('type', 1))
                    <div class="colored">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" @if(in_array("s", $code)) checked @endif onchange="$('#sphere').toggle();"  name="lenses_options[]" value="s">
                                {{_i("Show SPHERE")}}
                            </label>
                            <select style="display: none" class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="sphere[]" id="sphere">
                                @foreach($spheres_colored as $key => $value)
                                    <option @if($product_sphere->containsStrict('sphere_id', $key)) selected="selected" @endif value="{{ $key }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @elseif($product_sphere->containsStrict('type', 2) || $product_cylinder->containsStrict('type', 2) || $product_axis->containsStrict('type', 2))
                    <div class="trans">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" @if(in_array("s", $code)) checked @endif onchange="$('#sphere').toggle();"  name="lenses_options[]" value="s">
                                {{_i("Show SPHERE")}}
                            </label>
                            <select style="display: none" class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="sphere[]" id="sphere">
                                @foreach($spheres_trans as $key => $value)
                                    <option @if($product_sphere->containsStrict('sphere_id', $key)) selected="selected" @endif value="{{ $key }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" @if(in_array("cyl", $code)) checked @endif onchange="$('#cylinder').toggle();"  name="lenses_options[]" value="cyl">
                                {{_i("Show CYLINDER")}}
                            </label>
                            <select style="display: none" class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="cylinder[]" id="cylinder">
                                @foreach($cylinders_trans as $key => $value)
                                    <option @if($product_cylinder->containsStrict('cylinder_id', $key)) selected="selected" @endif value="{{ $key }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" @if(in_array("a", $code)) checked @endif onchange="$('#axis').toggle();"  name="lenses_options[]" value="a">
                                {{_i("Show AXIS")}}
                            </label>
                            <select style="display: none" class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="axis[]" id="axis">
                                @foreach($axis_trans as $key => $value)
                                    <option @if($product_axis->containsStrict('axis_id', $key)) selected="selected" @endif value="{{ $key }}">{{ $value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"  @if(in_array("auto_reorder", $code)) checked @endif name="lenses_options[]" value="auto_reorder" onchange="$('#auto_reorder').toggle();">
                                {{_i("Show auto reorder")}}
                            </label>
                            <input type="text" @if(in_array("auto_reorder", $code)) value="{{ $showOptions->value }}" style="display: block" @endif placeholder="15,30" name="auto_reorder" class="" id="auto_reorder" style="display: none"/>
                        </div>
                    </div>
                @endif
            </div>
            <div id="lenses_selection" class="col-md-12">
                    <label class="control-label">{{ _i('Glasses Lenses') }}</label>
                    <select multiple name="lenses[]" class="selectpicker form-control">
                        @foreach($lenses as $lens)
                            <option {{in_array($lens->id,$product_lenses->toArray())?'selected':''}} value="{{$lens->id}}">{{$lens->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
    </div>
    {{--image--}}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="categoryIds[]">{{ _i('Main Image') }} <span style="color: #F00;">*</span></label>
        <div class="col-sm-10">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">

                    <tbody>
                    <tr>
                        <td class="text-left">
                            <input type="file" name="main_image" value="" id="main_image" accept="image/gif, image/jpeg, image/png"  >

                            @if(is_file(public_path('images\\products\\'.$rowData->main_image)))
                                <div class="bs-example bs-example-images">
                                    <img src="{{ asset('images/products/'.$rowData->main_image) }}" width="100px" class="img-thumbnail">
                                </div>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
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
                                <li class="nav-item"><a  class="nav-link @if ($loop->first) active @endif" href="#language{{ $lang->id }}" data-toggle="tab"><img src="{{ asset('languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ _i($lang->name) }} <i class="fa"></i></a></li>
                            @endforeach
{{--                                @foreach ($languages as $lang)--}}
{{--                                    <li class=" @if ($loop->first) active @endif"><a href="#language{{ $lang->id }}" data-toggle="tab">--}}
{{--                                            <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }} <i class="fa"></i></a></li>--}}
{{--                                @endforeach--}}
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach ($languages as $lang)
                                @if (in_array($lang->id, $languageIds))
                                    @foreach ($productTranslation as $trans)
                                        @if ($lang->id == $trans->language_id)
                                            <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">
                                                <span></span>
                                                {{-- Translation row Id --}}
                                                <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">

                                                <div class="form-group">
                                                    <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Product Name') }} <span style="color: #F00;"> *</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Product Name') }}" value="{{ old('name['.$lang->id.']', $trans->name) }}" required="" data-minlength="2">
                                                        {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="meta_title[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Title') }} <span style="color: #F00;"> *</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="meta_title[{{ $lang->id }}]" name="meta_title[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Title') }}" required="" value="{{ old('meta_title['.$lang->id.']', $trans->meta_title) }}" data-minlength="2">
                                                        <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>
                                                        @if ($errors->has('meta_title['.$lang->id.']'))
                                                            <span class="text-danger invalid-feedback">
                                                            <strong>{{ $errors->first('meta_title['.$lang->id.']') }}</strong>
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

{{--    <div class="form-group">--}}
{{--        <div class="col-md-10 col-md-offset-2">--}}
{{--            <ul class="nav nav-tabs" id="language">--}}
{{--                @foreach ($languages as $lang)--}}
{{--                    <li class=" @if ($loop->first) active @endif"><a href="#language{{ $lang->id }}" data-toggle="tab">--}}
{{--                            <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }} <i class="fa"></i></a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--            <div class="tab-content">--}}
{{--                @foreach ($languages as $lang)--}}
{{--                    @if (in_array($lang->id, $languageIds))--}}
{{--                        @foreach ($productTranslation as $trans)--}}
{{--                            @if ($lang->id == $trans->language_id)--}}
{{--                                <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">--}}
{{--                                    <span></span>--}}
{{--                                    --}}{{-- Translation row Id --}}
{{--                                    <input type="hidden" name="id[{{ $lang->id }}]" id="id[{{ $lang->id }}]" value="{{ $trans->id }}">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Product Name') }} <span style="color: #F00;"> *</span></label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Product Name') }}" value="{{ old('name['.$lang->id.']', $trans->name) }}" required data-minlength="2">--}}
{{--                                            {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="meta_title[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Title') }} <span style="color: #F00;"> *</span></label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input type="text" class="form-control" id="meta_title[{{ $lang->id }}]" name="meta_title[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Title') }}" required value="{{ old('meta_title['.$lang->id.']', $trans->meta_title) }}" data-minlength="2">--}}
{{--                                            <div class="help-block">{{ _i('Minimum of 2 characters') }}</div>--}}
{{--                                            @if ($errors->has('meta_title['.$lang->id.']'))--}}
{{--                                                <span class="text-danger invalid-feedback">--}}
{{--                                                            <strong>{{ $errors->first('meta_title['.$lang->id.']') }}</strong>--}}
{{--                                                        </span>--}}
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
