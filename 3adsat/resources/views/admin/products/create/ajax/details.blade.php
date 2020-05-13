<div class="table-responsive">
        <table id="attribute" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td class="text-left">{{ _i('Attribute') }}</td>
                <td class="text-left">{{ _i('Text') }}</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($attributes as $item)
                <tr id="attribute-row-{{ $count }}">
                    <td class="text-left" style="width: 40%;">

                        <h5>{{ $item->name }}</h5>
                        <input type="hidden" name="attribute[{{ $count }}]" class="form-control" value="{{ $item->id }}" />
                    </td>
                    <td class="text-left">

                        @foreach($languages as $lang)
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ _i($lang->name) }}" />
                                </span>
                                <textarea name="product_attribute[{{ $count }}][{{ $lang->id }}]" rows="2" placeholder="{{ _i('Text') }}" class="form-control"></textarea>
                            </div>

                        @endforeach
                    </td>
                    <td class="text-right">
                        <button type="button" data-toggle="tooltip" onclick="$('#attribute-row-{{ $count }}').remove();" title="{{ _i('Remove ') }}" class="btn btn-danger">
                            <i class="ti-minus"></i>
                        </button>
                    </td>
                </tr>
                <div class="hidden">{{ $count++ }}</div>
            @endforeach
            </tbody>
{{--            <tfoot>--}}
{{--                <tr>--}}
{{--                    <td colspan="2"></td>--}}
{{--                    <td class="text-right"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Attribute"><i class="fa fa-plus-circle"></i></button></td>--}}
{{--                </tr>--}}
{{--            </tfoot>--}}
        </table>
    </div>
