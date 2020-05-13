@extends('admin.layout.index',[
'title' => _i('Edit Region'),
'activePageName' => _i('Edit Region'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit Region') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::model($region,['route' => ['regions.update',$region->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms', 'data-parsley-validate']) !!}
                @csrf

            <div class="content">
                <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>{{ _i('edit region') }}</span>
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
                                            <input type="text" name="{{ $lang->locale }}_title" value="{{ $region->translate($lang->locale)->title }}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}" >
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
                    <label class="col-sm-2 col-form-label">{{ _i('Code') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="code" value="{{ $region->code }}" class="form-control" placeholder="{{ _i('Code') }}" required>
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
