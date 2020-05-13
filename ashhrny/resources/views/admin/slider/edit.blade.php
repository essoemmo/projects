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
            @honeypot {{--prevent form spam--}}

            <div class="content">
                <div class="divider-text gap-top-20 gap-bottom-45">
                    <span>{{ _i('edit slider') }}</span>
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
                                            @if($slider->translate($lang->locale))
                                                <input type="text" name="{{ $lang->locale }}_title"
                                                       value="{{ $slider->translate($lang->locale)->title }}"
                                                       class="form-control"
                                                       placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                            @else
                                                <input type="text" name="{{ $lang->locale }}_title" class="form-control"
                                                       placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('User') }}</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">{{ _i('User') }}</label>

                    <div class="col-sm-10 ">
                        <select class="js-example-disabled-results col-sm-12" name="user_id" required="">
                            <option value="two" disabled="disabled">{{_i('Select User')}}</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" {{$slider->user_id == $user->id ? "selected" : ""}}>
                                    {{$user['first_name'] ." ".$user['last_name']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('Sort') }}</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">{{ _i('Sort') }}</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" max="125" name="sort" value="{{$slider['sort']}}"
                               class="form-control form-control-round" placeholder="{{_i('Enter Slider Sort')}}">
                    </div>
                </div>

                <div class="divider-text gap-top-45 gap-bottom-45">
                    <span>{{ _i('Alt Image') }}</span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label">{{  _i('Alt Image') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="alt_image" value="{{$slider->alt_image}}"
                               class="form-control form-control-round" placeholder="{{_i('Enter Slider Alt Image')}}">
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
