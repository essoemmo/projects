<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Languages') }}</h5>
        <button id="edit-languages-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if(count($product->languages) > 0)
            <div class="view-languages">
                @foreach($product->languages as $item)
                    <button class="btn btn-primary btn-outline-primary">
                        {{ $item->translate(app()->getLocale())->title }}
                    </button>
                @endforeach
            </div>
        @else
            <div class="view-languages">
                <div class="alert alert-danger">
                    {{ _i('No Languages') }}
                </div>
            </div>
        @endif
        <div class="edit-languages j-forms" style="display: none;" id="j-forms">
            <div class="content">

                <form id="form-languages" data-parsley-validate>

                    @csrf

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Select Language') }}</span>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Languages') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select') }}" name="langs[]" multiple="multiple">
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang->id }}" @foreach($product->languages as $item) @if($item->id == $lang->id) selected @endif @endforeach> {{ $lang->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">{{ _i('Save') }}</button>
                        <a href="javascript:void(0)" id="edit-cancel-btn-languages" class="btn btn-default waves-effect">{{ _i('Cancel') }}</a>
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

<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Game Details') }}</h5>
        <button id="edit-details-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if(count($product->details) > 0)
            <div class="view-details">
                @foreach($product->details as $item)
                    <button class="btn btn-primary btn-outline-primary">
                        {{ $item->title }}
                    </button>
                @endforeach
            </div>
        @else
            <div class="view-details">
                <div class="alert alert-danger">
                    {{ _i('No Game Details') }}
                </div>
            </div>
        @endif
        <div class="edit-details j-forms" style="display: none;" id="j-forms">
            <div class="content">

                <form id="form-details" data-parsley-validate>

                    @csrf

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Select Game Details') }}</span>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Game Details') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select') }}" name="details[]" multiple="multiple">
                                        @foreach($game_details as $detail)
                                            <option value="{{ $detail->id }}" @foreach($product->details as $item) @if($item->id == $detail->id) selected @endif @endforeach> {{ $detail->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">{{ _i('Save') }}</button>
                        <a href="javascript:void(0)" id="edit-cancel-btn-details" class="btn btn-default waves-effect">{{ _i('Cancel') }}</a>
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


<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Genre') }}</h5>
        <button id="edit-genre-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if(count($product->genres) > 0)
            <div class="view-genre">
                @foreach($product->genres as $item)
                    <button class="btn btn-primary btn-outline-primary">
                        {{ $item->translate(app()->getLocale())->title }}
                    </button>
                @endforeach
            </div>
        @else
            <div class="view-genre">
                <div class="alert alert-danger">
                    {{ _i('No Genres') }}
                </div>
            </div>
        @endif
        <div class="edit-genre j-forms" style="display: none;" id="j-forms">
            <div class="content">

                <form id="form-genre" data-parsley-validate>

                    @csrf

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Select Genre') }}</span>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Genres') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select') }}" name="genres[]" multiple="multiple">
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" @foreach($product->genres as $item) @if($item->id == $genre->id) selected @endif @endforeach> {{ $genre->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">{{ _i('Save') }}</button>
                        <a href="javascript:void(0)" id="edit-cancel-btn-genre" class="btn btn-default waves-effect">{{ _i('Cancel') }}</a>
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



