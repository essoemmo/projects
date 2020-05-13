<div class="tab-pane" id="tab-images">
    {{--                                <div class="table-responsive">--}}
    {{--                                    <table class="table table-striped table-bordered table-hover">--}}
    {{--                                        <thead>--}}
    {{--                                            <tr>--}}
    {{--                                                <td class="text-left">{{ _i('Main Image') }}<span style="color: #F00;">*</span></td>--}}
    {{--                                            </tr>--}}
    {{--                                        </thead>--}}
    {{--                                        <tbody>--}}
    {{--                                            <tr>--}}
    {{--                                                <td class="text-left">--}}
    {{--                                                    <input type="file" name="main_image" value="" id="main_image" accept="image/gif, image/jpeg, image/png" >--}}

    {{--                                                    @if(is_file(public_path('images\\products\\'.$rowData->main_image)))--}}
    {{--                                                    <div class="bs-example bs-example-images">--}}
    {{--                                                        <img src="{{ asset('images/products/'.$rowData->main_image) }}" width="100px" class="img-thumbnail">--}}
    {{--                                                    </div>--}}
    {{--                                                    @endif--}}
    {{--                                                </td>--}}
    {{--                                            </tr>--}}
    {{--                                        </tbody>--}}
    {{--                                    </table>--}}
    {{--                                </div>--}}
    <div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td class="text-left">{{ _i('Additional Images') }}</td>
<!--                <td class="text-right">{{ _i('Color') }}</td>-->
                <td class="text-right">{{ _i('Sort Order') }}</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($productImages as $prImage)
                <tr id="image-row{{ $loop->index }}">
                    <td class="text-left">
                        
                        
                      
                            <div class="bs-example bs-example-images">ff
                                <img src="{{ asset('images/products/'.$prImage->image) }}" width="100px" class="img-thumbnail">
                            </div>
                        
                    </td>
                    <td class="text-right"><input type="text" name="product_image[{{ $loop->index }}][sort_order]" value="{{ $prImage->sort_order }}" placeholder="{{ _i('Sort Order') }}" class="form-control"></td>
                    <td class="text-left"><button type="button" onclick="deleteProductImage({{ $loop->index }}, {{ $prImage->id }})" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="{{ _i('Remove') }}"><i class=" ti-minus"></i></button></td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{{ _i('Add Image') }}"><i class=" ti-plus"></i></button></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
