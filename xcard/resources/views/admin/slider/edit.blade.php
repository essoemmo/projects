@extends('admin.layout.index',[
'title' => _i('Edit Slider'),
'activePageName' => _i('Edit Slider'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit slider') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::model($slider,['route' => ['sliders.update',$slider->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf

            <div class="content">
                <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>{{ _i('edit slider') }}</span>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12">

                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            @foreach($langs as $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                    <div class="slide"></div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content card-block">
                            @foreach($langs as $lang)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}" role="tabpanel" aria-expanded="false">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                        <div class="col-sm-10">
                                            @if($slider->translate($lang->locale))
                                                <input type="text" name="{{ $lang->locale }}_title" value="{{ $slider->translate($lang->locale)->title }}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}" >
                                            @else
                                                <input type="text" name="{{ $lang->locale }}_title"  class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}" >
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                        <div class="col-sm-10">
                                            @if($slider->translate($lang->locale))
                                                <textarea name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}" >{{ $slider->translate($lang->locale)->description }}</textarea>
                                            @else
                                                <textarea name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}" ></textarea>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('media') }}</span>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ _i('image') }}</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control form-control-round imagemindimensions" onchange="showImg(this)" name="image"
                               data-parsley-trigger="change" data-parsley-filemimetypes="image/*"
                               data-parsley-validate
                               data-parsley-imagemindimensions="1300x500">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <img class="img-fluid pad" style="width: 150px" src="{{ $slider->image }}" id="image" >
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('url') }}</span>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ _i('url') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control" placeholder="{{ _i('url') }}" required>
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('Publish') }}</span>
                </div>

                <div class="col-sm-12">
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" name="publish" @if($slider->publish == 1) checked @endif value="1">
                            <span class="cr float-right">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                            <span class="mr-4">{{ _i('Publish') }}</span>
                        </label>
                    </div>
                </div>
            </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('js')

    <script>

        window.Parsley.addValidator('imagemindimensions', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                let file = parsleyInstance.$element[0].files[0];
                let [width, height] = requirement.split('x');
                let image = new Image();
                let deferred = $.Deferred();

                image.src = window.URL.createObjectURL(file);
                image.onload = function() {
                    if (image.width >= width && image.height >= height) {
                        deferred.resolve();
                    }
                    else {
                        deferred.reject();
                    }
                };

                return deferred.promise();
            },
            messages: {
                en: 'Image dimensions have to be at least  %spx'
            }
        });

        $(document).on('change', '.js-photo-upload', function() {
            $(this).parsley().whenValid({}).done(function () {
                // process image
            });
        });
    </script>
@endpush
