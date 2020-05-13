<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">{{ _i('Edit Info') }}</h5>
        <button id="edit-info-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
            <i class="icofont icofont-edit"></i>
        </button>
    </div>
    <div class="card-block">
        <div class="view-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="general-info">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <table class="table m-0 text-center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ _i('Name') }} : </th>
                                            <td>{{ $product->translate(app()->getLocale())->title }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ _i('Quantity') }} : </th>
                                            <td>{{ $product->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ _i('Price') }} : </th>
                                            <td>{{ $product->price }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ _i('Developer') }} : </th>
                                            <td>{{ $product->developers }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <table class="table text-center">
                                    <tbody>
                                    @if($product->region)
                                        <tr>
                                            <th scope="row">{{ _i('Region') }} : </th>
                                            <td>{{ $product->region->translate(app()->getLocale())->title }}</td>
                                        </tr>
                                    @endif
                                    @if($product->platform)
                                        <tr>
                                            <th scope="row">{{ _i('Platform') }} : </th>
                                            <td>{{ $product->platform->translate(app()->getLocale())->title }}</td>
                                        </tr>
                                    @endif
                                    @if($product->workOn)
                                        <tr>
                                            <th scope="row">{{ _i('Works On') }} : </th>
                                            <td>{{ $product->workOn->title }}</td>
                                        </tr>
                                    @endif
                                    @if($product->release_date)
                                        <tr>
                                            <th scope="row">{{ _i('Release Date') }} : </th>
                                            <td>{{ $product->release_date }}</td>
                                        </tr>
                                    @endif
                                    @if($product->publishers)
                                        <tr>
                                            <th scope="row">{{ _i('Publisher') }} : </th>
                                            <td>{{ $product->publishers }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <table class="table text-center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ _i('Description') }} : </th>
                                            <td style="word-wrap: break-word">{{ $product->translate(app()->getLocale())->description }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ _i('Categories') }} : </th>
                                            <td>
                                            @foreach($product->categories as $item)
                                                <button type="button" class="btn btn-primary waves-effect waves-light">
                                                    {{ $item->translate(app()->getLocale())->title }}
                                                </button>
                                            @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="edit-info j-forms" style="display: block;" id="j-forms">
            <div class="content">
                <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>{{ _i('Main Information') }}</span>
                </div>
                <form id="form-info" data-parsley-validate="" enctype="multipart/form-data">

                    @csrf

                    {{ method_field('put') }}

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
                                                <input type="text" name="{{ $lang->locale }}_title" value="{{ $product->translate($lang->locale)->title }}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                            <div class="col-sm-10">
                                            <textarea name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}">
                                                {{ $product->translate($lang->locale)->description }}
                                            </textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Media') }}</span>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ _i('Main Image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" onchange="showImg(this)" name="main_image"
                                   data-parsley-trigger="change" data-parsley-filemimetypes="image/*"
                                   data-parsley-validate
                                   data-parsley-imagemindimensions="250x325">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">{{ _i('video') }}</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="video" value="{{ $product->video }}" placeholder="{{ _i('Youtube Link') }}" required="" data-parsley-type="url">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <img class="img-fluid pad" src="{{ asset($product->main_image) }}" style="width: 150px"  id="image">
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Select Category') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Categories') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select') }}" name="categories[]" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @foreach($products_categories as $item) @if($item->category_id == $category->id) selected @endif @endforeach> {{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Related Products') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select') }}" name="products[]" multiple="multiple">
                                        @foreach($related_products as $item)
                                            <option value="{{$item->id}}" @foreach($related as $item) @if($item->product_id == $item->id) selected @endif @endforeach> {{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Quantity & Price') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Quantity') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="{{ $product->quantity }}" name="quantity" required data-parsley-min="1" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Price') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $product->price }}" name="price" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Developers & Publishers') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ $product->developers }}" name="developers"  placeholder="{{ _i('Developers') }}">
                            </div>
                        </div>
                        <!-- publishers -->
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ $product->publishers }}" name="publishers"  placeholder="{{ _i('Publishers') }}">
                            </div>
                        </div>
                        <!-- release date -->
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <input type="date" id="dropper-default" value="{{ $product->release_date }}" class="form-control" name="release_date"  placeholder="{{ _i('Release Date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Available On') }}</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <label class="col-form-label">{{ _i('Work On') }}</label>
                                <select name="works_on_id" class="selectpicker form-control show-menu-arrow" >
                                    <option value="" disabled selected>{{ _i('Select') }}</option>
                                    @foreach($works_on as $item)
                                        <option value="{{ $item->id }}" @if($product->works_on_id == $item->id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Regions -->
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <label class="col-form-label">{{ _i('Regions') }}</label>
                                <select name="region_id" class="selectpicker form-control show-menu-arrow" >
                                    <option value="" disabled selected>{{ _i('Select') }}</option>
                                    @foreach($regions as $item)
                                        <option value="{{ $item->id }}" @if($product->region_id == $item->id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Platforms -->
                        {{--                        @dd($platforms)--}}
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <label class="col-form-label">{{ _i('Platforms') }}</label>
                                <select name="platform_id" class="selectpicker form-control show-menu-arrow" id="platform" >
                                    <option value="" disabled selected>{{ _i('Select') }}</option>
                                    @foreach($platforms as $item)
                                        <option value="{{ $item->id }}" @if($product->platform_id == $item->id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger" style='display:none' id="errors">
                        <span class="text-danger" >{!! $errors->first('mandapName', ':message') !!} </span>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20 m-t-20">{{ _i('Save') }}</button>
                        <a href="javascript:void(0)" id="edit-cancel-btn" class="btn btn-default waves-effect m-t-20">{{ _i('Cancel') }}</a>
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



