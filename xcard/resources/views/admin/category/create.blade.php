@extends('admin.layout.index',[
'title' => _i('Create Category'),
'activePageName' => _i('Create Category'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create category') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::open(['route' => 'categories.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('create category') }}</span>
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
                            <span>{{ _i('Parent & Main Menu') }}</span>
                        </div>

                        <div class="form-group row">
                            @if(count($categories) > 0)
                                <div class="col-sm-6">
                                    <select class="form-control" name="parent_id">
                                        <option value="">{{_i('select ...')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-sm-6">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" name="main_menu" value="1">
                                        <span class="cr float-right">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span class="mr-4">{{ _i('Main Menu') }}</span>
                                    </label>
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

            {!! Form::close() !!}
        </div>
    </div>

@endsection
