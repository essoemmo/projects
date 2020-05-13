@extends('admin.layout.index',[
'title' => _i('Create product'),
'activePageName' => _i('Create product'),
] )

@section('content')
    @include('admin.layout.message')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Create Product') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::open(['route' => 'products.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('Main Information') }}</span>
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
                                                <input type="text" name="{{ $lang->locale }}_title" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                            <div class="col-sm-10">
                                                <textarea name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
                                    <select class="js-example-basic-multiple form-control" data-tags="true" data-placeholder="{{ _i('Select a Category') }}" name="categories[]" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->title}}</option>
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
                                    <input type="number" class="form-control" name="quantity" required data-parsley-min="1" min="1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Price') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="price" required>
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
                                <input type="text" class="form-control" name="developers"  placeholder="{{ _i('Developers') }}">
                            </div>
                        </div>
                        <!-- publishers -->
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="publishers"  placeholder="{{ _i('Publishers') }}">
                            </div>
                        </div>
                        <!-- release date -->
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <input type="date" id="dropper-default" class="form-control" name="release_date"  placeholder="{{ _i('Release Date') }}">
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
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
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
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Platforms -->
{{--                        @dd($platforms)--}}
                        <div class="col-md-4">
                            <div class="col-sm-12">
                                <label class="col-form-label">{{ _i('Platforms') }}</label>
                                <select name="platform_id" class="selectpicker form-control show-menu-arrow" >
                                    <option value="" disabled selected>{{ _i('Select') }}</option>
                                    @foreach($platforms as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

        </div>

         {!! Form::close() !!}
    </div>

@endsection
