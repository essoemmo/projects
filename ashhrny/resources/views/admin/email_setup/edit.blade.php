@extends('admin.layout.index',[
'title' => $emailTemplate->translate(app()->getLocale())->title,
'activePageName' => $emailTemplate->translate(app()->getLocale())->title,
] )

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $emailTemplate->translate(app()->getLocale())->title }}</h5>
                </div>
                <div class="card-block">
                    {!! Form::model($emailTemplate,['route' => ['email_setup.update',$emailTemplate->id], 'method' => 'PUT','class'=>'j-forms','id'=>'j-forms', 'data-parsley-validate']) !!}
                    @csrf
                    @honeypot {{--prevent form spam--}}

                    <div class="content">
                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ $emailTemplate->translate(app()->getLocale())->title }}</span>
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
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Subject') }}</label>
                                                <div class="col-sm-10">
                                                    @if($emailTemplateData->translate($lang->locale))
                                                        <input type="text" name="{{ $lang->locale }}_subject"
                                                               value="{{ $emailTemplateData->translate($lang->locale)->subject }}"
                                                               class="form-control"
                                                               placeholder="{{ $lang->title }} {{ _i('Subject') }}"
                                                               required>
                                                    @else
                                                        <input type="text" name="{{ $lang->locale }}_subject"
                                                               class="form-control"
                                                               placeholder="{{ $lang->title }} {{ _i('Subject') }}"
                                                               required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Body') }}</label>
                                                <br>
                                                <div class="col-sm-12">
                                                    @if($emailTemplateData->translate($lang->locale))
                                                        <textarea name="{{ $lang->locale }}_body"
                                                                  class="form-control ckeditor"
                                                                  placeholder="{{ $lang->title }} {{ _i('Body') }}"
                                                                  required>
                                                                {{ $emailTemplateData->translate($lang->locale)->body }}
                                                            </textarea>
                                                    @else
                                                        <textarea name="{{ $lang->locale }}_body"
                                                                  class="form-control ckeditor"
                                                                  placeholder="{{ $lang->title }} {{ _i('Body') }}"
                                                                  required></textarea>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('From Email') }}</span>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12">

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ _i('From Email') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="from_email"
                                               value="{{ $emailTemplateData->from_email }}" class="form-control"
                                               placeholder="{{ _i('From Email') }}" required>
                                    </div>
                                </div>

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

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-border-danger">
                <div class="card-header">
                    <h5>{{ $emailTemplate->translate(app()->getLocale())->title }}</h5>
                    <hr>
                    <p class="lead">{{ $emailTemplate->translate(app()->getLocale())->description }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
