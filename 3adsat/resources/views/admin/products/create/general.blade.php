<div class="tab-pane active" id="general">

    {{--model--}}
    <div class="form-group row">
        <label for="model" class="col-sm-2 control-label">{{ _i('Model') }} <span style="color: #F00;">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="model" name="model" placeholder="{{ _i('Model') }}" value="{{ old('model') }}" data-minlength="2" required="">
            {!! $errors->first('model','<p class="text-danger"><strong>:message</strong></p>') !!}
        </div>
    </div>
    {{--category--}}
    <div class="form-group row">
        <label class="col-sm-2 control-label" for="categoryIds[]">{{ _i('Category') }} <span style="color: #F00;">*</span></label>
        <div class="col-sm-10">
            <select class="form-control selectpicker" required="" multiple="multiple" title='Choose one of the following...' style="width: 100%;" id="categoryIds[]" name="categoryIds[]" data-live-search="true">
                @foreach ($categories as $item)
                <option value="{{ $item->id }}" {{ ( old("categoryIds[]") == $item->id ? "selected":"") }}>{{ $item->getParentsNames($language_id) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--product_type--}}
    <div class="form-group row">
        <label class="col-sm-2 control-label" for="product_type">{{ _i('Product Type') }} <span style="color: #F00;">*
            </span></label>
        <div class="col-sm-10">
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="glasses" value="glasses" checked="" >
                <label class="control-label" for="glasses">{{ _i('Glasses') }}</label>
            </div>
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="sun" value="sunglass">
                <label class="control-label" for="sun">{{ _i('Sun Glass') }}</label>
            </div>
            <div class="col-sm-3" style="display: inline-block">
                <input type="radio" name="product_type" id="lenses" value="lenses">
                <label class="control-label" for="lenses">{{ _i('Lenses') }}</label>
            </div>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <div class="col-sm-4">
                <div id="lenses_selection" class="col-md-12">
                    <label class="control-label">{{ _i('Lenses') }}</label>
                    <select multiple name="lenses[]" class="form-control selectpicker">
                        @foreach($lenses as $lens)
                            <option value="{{$lens->id}}">{{$lens->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div id="show_options" style="display: none">
                    <select class="form-control selectpicker show_options" name="type" title='Choose one of the following...'>
                        <option value="1">{{ _i('Colored') }}</option>
                        <option value="2">{{ _i('Transparent') }}</option>
                    </select>
                </div>
                <div class="column-option">

                </div>
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
                                <input type="file" name="main_image" value="" id="main_image" accept="image/gif, image/jpeg, image/png" required="">
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
                            <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#language{{ $lang->id }}" data-toggle="tab"><img src="{{ asset('languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ _i($lang->name )}} <i class="ti"></i></a></li>
                            @endforeach
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
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
    {{-- <div class="form-group">--}}
    {{-- <div class="col-md-10 col-md-offset-2">--}}
    {{-- <ul class="nav nav-tabs" id="language">--}}
    {{-- @foreach ($languages as $lang)--}}
    {{-- <li class="@if ($loop->first) active @endif"><a href="#language{{ $lang->id }}" data-toggle="tab">--}}
    {{-- <img src="{{ asset('languages/'.$lang->image) }}" title="{{ $lang->name }}"> {{ $lang->name }} <i class="fa"></i></a></li>--}}
    {{-- @endforeach--}}
    {{-- </ul>--}}
    {{-- <div class="tab-content">--}}
    {{-- @foreach ($languages as $lang)--}}
    {{-- <div class="tab-pane @if ($loop->first) active @endif " id="language{{ $lang->id }}">--}}
    {{-- <span></span>--}}
    {{-- <div class="form-group">--}}
    {{-- <label for="name[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Product Name') }}<span style="color: #F00;">*</span></label>--}}
    {{-- <div class="col-sm-10">--}}
    {{-- <input type="text" class="form-control" id="name[{{ $lang->id }}]" name="name[{{ $lang->id }}]" placeholder="{{ _i('Product Name') }}" value="{{ old('name['.$lang->id.']') }}" required data-minlength="2">--}}
    {{-- {!! $errors->first('name['.$lang->id.']','<p class="text-danger"><strong>:message</strong></p>') !!}--}}
    {{-- </div>--}}
    {{-- </div>  <div class="form-group">--}}
    {{-- <label for="meta_title[{{ $lang->id }}]" class="col-sm-2 control-label">{{ _i('Meta Tag Title') }}<span style="color: #F00;">*</span></label>--}}
    {{-- <div class="col-sm-10">--}}
    {{-- <input type="text" class="form-control" id="meta_title[{{ $lang->id }}]" name="meta_title[{{ $lang->id }}]" placeholder="{{ _i('Meta Tag Title') }}" required value="{{ old('meta_title['.$lang->id.']') }}" data-minlength="2">--}}
    {{-- <div class="help-block">{{ _i('Minimum of 2 characters') }}
</div>--}}
{{-- @if ($errors->has('meta_title['.$lang->id.']'))--}}
{{-- <span class="text-danger invalid-feedback">--}}
{{-- <strong>{{ $errors->first('meta_title['.$lang->id.']') }}</strong>--}}
{{-- </span>--}}
{{-- @endif--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- @endforeach--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
</div>


@push('js')

<script>
    $(".show_options").on("change", function() {
        var type = $('.show_options option:selected').val();
        console.log(type);
        $(".column-option").css("display", "none");
        if (this) {
            $.ajax({
                url: '{{url('admin/panel/getOptions') }}',
                type: 'get',
                dataType: 'html',
                data: {
                    type: type
                },
                success: function(data) {
                    $('.column-option').css("display", "block").html(data);
                }
            });
        } else {
            $('.column-option').html('');
        }
    });
</script>
<script>

    function initView() {
        // Set Events
        $('input[name="product_type"]').on('click', function(e) {
            if (e.target.id === "glasses") {
                $('#lenses_selection').show();
            } else {
                $('#lenses_selection').hide();
            }
        });
    }
    initView();
</script>
@endpush
