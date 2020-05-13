@extends('admin.layout.index',[
'title' => _i('Create Tag'),
'activePageName' => _i('Create Tag'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create new tags') }}</h5>
        </div>
        <div class="card-block">
            {!! Form::open(['route' => 'tags.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}
                @csrf
                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('create tags') }}</span>
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
                                        <div class="clone-leftside-btn-2 cloneya-wrap">
                                            <div class="unit toclone-widget-left toclone cloneya">
                                                <div class="input">
                                                    <input type="text" placeholder="{{ $lang->title }} {{ _i('Title') }}" name="{{ $lang->locale }}_title" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
