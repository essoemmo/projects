@extends('admin.layout.index',[
'title' => _i('Create Points'),
'activePageName' => _i('Create Points'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create new Points') }}</h5>
        </div>
        <div class="card-block">
            <form method="POST" action="{{route('points.store')}}" class="j-forms" data-parsley-validate>
                @csrf
                @honeypot {{--prevent form spam--}}

                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('create points') }}</span>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-12">

                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab"
                                           href="#{{ $lang->locale }}" role="tab"
                                           aria-expanded="false">{{ $lang->title }}</a>
                                        <div class="slide"></div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content card-block">
                                @foreach($langs as $lang)
                                    <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}"
                                         role="tabpanel" aria-expanded="false">
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-2 control-label"> {{ _i('Title') }} {{ _i($lang->title) }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="{{ $lang->locale }}_title" class="form-control"
                                                       placeholder=" {{ _i('Title') }} {{ _i($lang->title) }}"
                                                       required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-2 control-label"> {{ _i('Description') }} {{ _i($lang->title) }}</label>
                                            <div class="col-sm-10">
                                                <textarea name="{{ $lang->locale }}_description" class="form-control"
                                                          placeholder=" {{ _i('Description') }} {{ _i($lang->title) }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="divider-text gap-top-45 gap-bottom-45">
                        <span>{{ _i('Number of points') }}</span>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">{{ _i('Points Number') }}</label>
                        <div class="col-sm-10">
                            <input type="number" min="1" name="points_number" class="form-control"
                                   placeholder="{{ _i('Number of points') }}" required="">
                        </div>
                    </div>


                </div>

                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit"
                                    class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
