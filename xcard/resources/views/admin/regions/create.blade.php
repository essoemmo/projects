@extends('admin.layout.index',[
'title' => _i('Create Region'),
'activePageName' => _i('Create Region'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create new region') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::open(['route' => 'regions.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms', 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('create region') }}</span>
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
                                            <label class="col-sm-2 control-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="{{ $lang->locale }}_title" value="{{old($lang->locale."_title")}}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}" >
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('code') }}</span>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Code') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" value="{{old('code')}}" class="form-control" placeholder="{{ _i('Code') }}" required="">
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


