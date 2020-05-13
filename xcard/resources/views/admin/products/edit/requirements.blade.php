<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit System Requirements') }}</h5>
        <button id="edit-requirements-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        @if($product->translate(app()->getLocale())->System_requirements != null)
        <div class="view-requirements">
            <div class="card-block">
                <div class="row">
                    <div id="system_requirements">
                        {!! $product->translate(app()->getLocale())->System_requirements !!}
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="view-requirements">
                <div class="alert alert-danger">
                    {{ _i('No System Requirements') }}
                </div>
            </div>
        @endif
        <div class="edit-requirements j-forms" style="display: none;" id="j-forms">

            <div class="content">
                <form id="form-requirements" data-parsley-validate>

                @csrf

                <div class="row form-group">
                    <div class="col-lg-12">

                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            @foreach($langs as $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $lang->locale }}_req" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                    <div class="slide"></div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content card-block">
                            @foreach($langs as $lang)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}_req" role="tabpanel" aria-expanded="false">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Requirements') }}</label>
                                        <div class="col-sm-10">
                                            <textarea name="{{ $lang->locale }}_requirements" class="editor form-control" placeholder="{{ $lang->title }} {{ _i('Requirements') }}">
                                                {{ $product->translate($lang->locale)->System_requirements }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">{{ _i('Save') }}</button>
                    <a href="javascript:void(0)" id="edit-cancel-btn-requirements" class="btn btn-default waves-effect">{{ _i('Cancel') }}</a>
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



