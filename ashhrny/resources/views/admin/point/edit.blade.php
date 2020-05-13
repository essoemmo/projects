@extends('admin.layout.index',[
'title' => _i('Edit Points'),
'activePageName' => _i('Edit Points'),
] )

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('edit Points') }}</h5>
        </div>
        <div class="card-block">
            {{--            {!! Form::model($slider,['route' => ['sliders.update',$slider->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms','files'=>true, 'data-parsley-validate']) !!}--}}
            <form method="Post" action="{{route('points.update', $point->id)}}" class="j-forms" data-parsley-validate>
                @method('PUT')
                @csrf
                @honeypot {{--prevent form spam--}}


                <div class="content">
                    <div class="divider-text gap-top-20 gap-bottom-45">
                        <span>{{ _i('edit Points') }}</span>
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
                                                class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Title') }}</label>
                                            <div class="col-sm-10">
                                                @if($point->translate($lang->locale))
                                                    <input type="text" name="{{ $lang->locale }}_title"
                                                           value="{{ $point->translate($lang->locale)->title }}"
                                                           class="form-control"
                                                           placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                                @else
                                                    <input type="text" name="{{ $lang->locale }}_title"
                                                           class="form-control"
                                                           placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                            <div class="col-sm-10">
                                                @if($point->translate($lang->locale))
                                                    <textarea name="{{ $lang->locale }}_description"
                                                              class="form-control"
                                                              placeholder="{{ $lang->title }} {{ _i('Description') }}">{{ $point->translate($lang->locale)->description }}</textarea>
                                                @else
                                                    <textarea name="{{ $lang->locale }}_description"
                                                              class="form-control"
                                                              placeholder="{{ $lang->title }} {{ _i('Description') }}"></textarea>
                                                @endif
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
                        <label class="col-sm-2 col-form-label">{{ _i('Points Number') }}</label>
                        <div class="col-sm-10">
                            <input type="number" min="1" name="points_number" value="{{$point->points_number}}"
                                   class="form-control" placeholder="{{ _i('Number of points') }}" required>
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
