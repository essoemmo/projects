<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Images') }}</h5>
        <button id="edit-image-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if(count($product_files) > 0)
        <div class="view-image">
            <div class="card-block">
                <div class="row">
                    @foreach($product_files as $file)
                        <div class="col-sm-3">
                            <a href="{{ asset($file->image) }}" data-toggle="lightbox" data-gallery="example-gallery">
                                <img src="{{ asset($file->image) }}" class="img-fluid" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
            <div class="view-image">
                <div class="alert alert-danger">
                    {{ _i('No Images') }}
                </div>
            </div>
        @endif
        <div class="edit-image j-forms" style="display: none;" id="j-forms">
            <div class="content">
                <div class="dropzone options" id="dropzonefield" style="border: 1px solid #452A6F;margin: 10px"></div>
                <button class="btn btn-tiffany mt-4 ml-4 mb-4" onclick="uploadFiles()" style="cursor: pointer" type="button"> {{_i('Save Images')}} </button>
                <div class="text-center">
    {{--                <button type="submit" name="submitButton" value="tests" class="btn btn-primary waves-effect waves-light m-r-20 m-t-20">{{ _i('Save') }}</button>--}}
                    <a href="javascript:void(0)" id="edit-cancel-btn-image" class="btn btn-default waves-effect mb-4">{{ _i('Cancel') }}</a>
                    <div class="loader-block" style="display: none">
                        <svg id="loader2" viewBox="0 0 100 100">
                            <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        <h5 class="card-header-text">{{ _i('Edit Videos') }}</h5>--}}
{{--        <button id="edit-video-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">--}}
{{--            <i class="icofont icofont-edit"></i>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <div class="card-block">--}}
{{--        @if(count($product_videos) > 0)--}}
{{--            <div class="view-video">--}}
{{--                <div class="card-block">--}}
{{--                    <div class="row">--}}
{{--                        @foreach($product_videos as $file)--}}
{{--                            <div class="col-sm-3">--}}
{{--                                <video width="500px" height="auto" src="{{ $file->image }}" controls></video>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="view-video">--}}
{{--                <div class="alert alert-danger">--}}
{{--                    {{ _i('No Images') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div class="edit-video j-forms" style="display: none;" id="j-forms">--}}
{{--            <div class="content">--}}
{{--                <div class="dropzone options" id="dropzonefield2" style="border: 1px solid #452A6F;margin: 10px"></div>--}}
{{--                <button class="btn btn-tiffany mt-4 ml-4 mb-4" onclick="uploadFiles2()" style="cursor: pointer" type="button"> {{_i('Save Images')}} </button>--}}
{{--                <div class="text-center">--}}
{{--                    --}}{{--                <button type="submit" name="submitButton" value="tests" class="btn btn-primary waves-effect waves-light m-r-20 m-t-20">{{ _i('Save') }}</button>--}}
{{--                    <a href="javascript:void(0)" id="edit-cancel-btn-video" class="btn btn-default waves-effect mb-4">{{ _i('Cancel') }}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--</div>--}}



