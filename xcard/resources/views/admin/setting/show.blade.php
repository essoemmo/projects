@extends('admin.layout.index',[
'title' => _i('All Setting'),
'activePageName' => _i('All Setting'),
] )


@section('content')

    @include('admin.layout.session')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Setting') }}</h5>
        </div>
        <div class="card-block">
            @if($setting == null)
                <div class="wrapper">
                {!! Form::open(['route' => 'setting.store', 'method' => 'post','class'=>'j-forms','id'=>'j-forms','files'=>true,'data-parsley-validate']) !!}
{{--                    {{method_field('post')}}--}}

                    <div class="content">
                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Main Settings') }}</span>
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
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Address') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="{{ $lang->locale }}_address" class="form-control" placeholder="{{ $lang->title }} {{ _i('Address') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <br>

                        <div class="clone-widget cloneya-wrap">
                            <div class="unit widget left-50 right-50 toclone cloneya">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ _i('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" placeholder="{{ _i('Email') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clone-widget cloneya-wrap">
                            <div class="unit widget left-50 right-50 toclone cloneya">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label col-form-legend">{{ _i('Work Time') }}</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="work_time" class="form-control" placeholder="{{ _i('Work Time') }}" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Add Multiple Phone Numbers') }}</span>
                        </div>

                        <div class="clone-leftside-btn-2 cloneya-wrap">
                            <div class="unit toclone-widget-right toclone cloneya">
                                <div class="input">
                                    <input type="text" placeholder="{{ _i('Phone') }}" name="phone[]" required>
                                </div>
                                <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                    <i class="icofont icofont-minus"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                    <i class="icofont icofont-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Social Links') }}</span>
                        </div>

                        <div class="clone-leftside-btn-1 cloneya-wrap">
                            <div class="j-row toclone-widget-right toclone cloneya">
                                <div class="span6 unit">
                                    <div class="input">
{{--                                        <input type="text" placeholder="{{ _i('Social Title') }}" name="s_title[]" required>--}}
                                        <select class="col-sm-12" name="s_title[]" >
                                            <option value="fa-facebook" data-icon="fa-facebook">{{_i('Facebook')}}</option>
                                            <option value="fa-whatsapp" data-icon="fa-whatsapp">{{_i('Whatsapp')}}</option>
                                            <option value="fa-twitter" data-icon="fa-twitter">{{_i('Twitter')}}</option>
                                            <option value="fa-instagram" data-icon="fa-instagram">{{_i('Instagram')}}</option>
                                            <option value="fa-youtube" data-icon="fa-youtube">{{_i('Youtube')}}</option>
                                            <option value="fa-skype" data-icon="fa-skype">{{_i('Skype')}}</option>
                                            <option value="fa-snapchat" data-icon="fa-snapchat-ghost">{{_i('Snapchat')}}</option>
                                            <option value="fa-vimeo" data-icon="fa-vimeo">{{_i('Vimeo')}}</option>
                                            <option value="fa-soundcloud" data-icon="fa-soundcloud">{{_i('Soundcloud')}}</option>
                                            <option value="fa-wechat" data-icon="fa-wechat">{{_i('Wechat')}}</option>
                                            <option value="fa-flickr" data-icon="fa-flickr">{{_i('Flickr')}}</option>
                                            <option value="fa-pinterest" data-icon="fa-pinterest">{{_i('Pinterest')}}</option>
                                            <option value="fa-yahoo" data-icon="fa-yahoo">{{_i('Yahoo')}}</option>
                                            <option value="fa-spotify" data-icon="fa-spotify">{{_i('Spotify')}}</option>
                                            <option value="fa-linkedin" data-icon="fa-linkedin">{{_i('Linkedin')}}</option>
                                            <option value="fa-dropbox" data-icon="fa-dropbox">{{_i('Dropbox')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="span6 unit">
                                    <div class="input">
                                        <input type="text" placeholder="{{ _i('Social Link') }}" name="s_link[]" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                    <i class="icofont icofont-plus"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                    <i class="icofont icofont-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Upload Site Logo') }}</span>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-sm-2 col-form-label">{{ _i('Main Logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" onchange="showLogo(this)" class="form-control" name="logo" required>
                                </div>
                            </div>
                            <!-- Photo -->
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">{{ _i('Footer Logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" onchange="showFooterLogo(this)" class="form-control" name="footer_logo" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <img class="img-fluid pad" style="width: 150px" id="logo" >
                            </div>
                            <!-- Photo -->
                            <div class="col-md-6">
                                <img class="img-fluid pad" style="width: 150px" id="footerLogo" >
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Description') }}</span>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12">

                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    @foreach($langs as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#desc{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                            <div class="slide"></div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content card-block">
                                    @foreach($langs as $lang)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="desc{{ $lang->locale }}" role="tabpanel" aria-expanded="false">

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="5" cols="5" name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}"></textarea>
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
            @else
                <div class="wrapper">
                {!! Form::open(['route' => 'setting.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true]) !!}

                    <div class="content">
                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Main Settings') }}</span>
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
                                                    <input type="text" name="{{ $lang->locale }}_title" value="{{ $setting->translate($lang->locale)->title }}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Title') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Address') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="{{ $lang->locale }}_address" value="{{ $setting->translate($lang->locale)->address }}" class="form-control" placeholder="{{ $lang->title }} {{ _i('Address') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <br>

                        <div class="clone-widget cloneya-wrap">
                            <div class="unit widget left-50 right-50 toclone cloneya">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ _i('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{ $setting->email }}" class="form-control" placeholder="{{ _i('Email') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clone-widget cloneya-wrap">
                            <div class="unit widget left-50 right-50 toclone cloneya">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label col-form-legend">{{ _i('Work Time') }}</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="work_time" value="{{ $setting->work_time }}" class="form-control" placeholder="{{ _i('Work Time') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Add Multiple Phone Numbers') }}</span>
                        </div>
                        <div class="clone-leftside-btn-2 cloneya-wrap">
                            @foreach($setting->phones as $phone)
                                <div class="unit toclone-widget-right toclone cloneya">
                                    <div class="input">
                                        <input type="text" value="{{ $phone->phone }}" placeholder="{{ _i('Phone') }}" name="phone[]" required>
                                    </div>
                                    <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                        <i class="icofont icofont-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                        <i class="icofont icofont-plus"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Social Links') }}</span>
                        </div>


                        <div class="clone-leftside-btn-1 cloneya-wrap">
                            @if(count($slinks) > 0)
                                @foreach($slinks as $link)
                                    <div class="j-row toclone-widget-right toclone cloneya">
                                        <div class="span6 unit">
                                            <div class="input">
{{--                                                <input type="text" value="{{ $link->title }}" placeholder="{{ _i('Social Title') }}" name="s_title[]" required>--}}
                                                <select class="col-sm-12" name="s_title[]" >
                                                    <option value="fa-facebook" data-icon="fa-facebook" {{$link->title=="fa-facebook"?"selected":""}}>{{_i('Facebook')}}</option>
                                                    <option value="fa-whatsapp" data-icon="fa-whatsapp" {{$link->title=="fa-whatsapp"?"selected":""}}>{{_i('Whatsapp')}}</option>
                                                    <option value="fa-twitter" data-icon="fa-twitter" {{$link->title=="fa-twitter"?"selected":""}}>{{_i('Twitter')}}</option>
                                                    <option value="fa-instagram" data-icon="fa-instagram" {{$link->title=="fa-instagram"?"selected":""}}>{{_i('Instagram')}}</option>
                                                    <option value="fa-youtube" data-icon="fa-youtube" {{$link->title=="fa-youtube"?"selected":""}}>{{_i('Youtube')}}</option>
                                                    <option value="fa-skype" data-icon="fa-skype" {{$link->title=="fa-skype"?"selected":""}}>{{_i('Skype')}}</option>
                                                    <option value="fa-snapchat" data-icon="fa-snapchat-ghost" {{$link->title=="fa-snapchat-ghost"?"selected":""}}>{{_i('Snapchat')}}</option>
                                                    <option value="fa-vimeo" data-icon="fa-vimeo" {{$link->title=="fa-vimeo"?"selected":""}}>{{_i('Vimeo')}}</option>
                                                    <option value="fa-soundcloud" data-icon="fa-soundcloud" {{$link->title=="fa-soundcloud"?"selected":""}}>{{_i('Soundcloud')}}</option>
                                                    <option value="fa-wechat" data-icon="fa-wechat" {{$link->title=="fa-wechat"?"selected":""}}>{{_i('Wechat')}}</option>
                                                    <option value="fa-flickr" data-icon="fa-flickr" {{$link->title=="fa-flickr"?"selected":""}}>{{_i('Flickr')}}</option>
                                                    <option value="fa-pinterest" data-icon="fa-pinterest" {{$link->title=="fa-pinterest"?"selected":""}}>{{_i('Pinterest')}}</option>
                                                    <option value="fa-yahoo" data-icon="fa-yahoo" {{$link->title=="fa-yahoo"?"selected":""}}>{{_i('Yahoo')}}</option>
                                                    <option value="fa-spotify" data-icon="fa-spotify" {{$link->title=="fa-spotify"?"selected":""}}>{{_i('Spotify')}}</option>
                                                    <option value="fa-linkedin" data-icon="fa-linkedin" {{$link->title=="fa-linkedin"?"selected":""}}>{{_i('Linkedin')}}</option>
                                                    <option value="fa-dropbox" data-icon="fa-dropbox" {{$link->title=="fa-dropbox"?"selected":""}}>{{_i('Dropbox')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span6 unit">
                                            <div class="input">
                                                <input type="text" value="{{ $link->url }}" placeholder="{{ _i('Social Link') }}" name="s_link[]" required>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                            <i class="icofont icofont-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                            <i class="icofont icofont-plus"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="j-row toclone-widget-right toclone cloneya">
                                    <div class="span6 unit">
                                        <div class="input">
                                            <input type="text" placeholder="{{ _i('Social Title') }}" name="s_title[]" required>
                                        </div>
                                    </div>
                                    <div class="span6 unit">
                                        <div class="input">
                                            <input type="text" placeholder="{{ _i('Social Link') }}" name="s_link[]" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone">
                                        <i class="icofont icofont-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">
                                        <i class="icofont icofont-minus"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Upload Site Logo') }}</span>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-sm-2 col-form-label">{{ _i('Main Logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" onchange="showLogo(this)" class="form-control" name="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">{{ _i('Footer Logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" onchange="showFooterLogo(this)" class="form-control" name="footer_logo">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <img class="img-fluid pad" style="width: 150px" src="{{ $setting->logo }}" id="logo" >
                            </div>
                            <div class="col-md-6">
                                <img class="img-fluid pad" style="width: 150px" src="{{ $setting->footer_logo }}" id="footerLogo" >
                            </div>
                        </div>

                        <div class="divider-text gap-top-45 gap-bottom-45">
                            <span>{{ _i('Description') }}</span>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12">

                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    @foreach($langs as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#desc{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                            <div class="slide"></div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content card-block">
                                    @foreach($langs as $lang)
                                        <div class="tab-pane @if ($loop->first) active @endif" id="desc{{ $lang->locale }}" role="tabpanel" aria-expanded="false">

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $lang->title }} {{ _i('Description') }}</label>
                                                <div class="col-sm-10">
                                                    <textarea rows="5" cols="5" name="{{ $lang->locale }}_description" class="form-control" placeholder="{{ $lang->title }} {{ _i('Description') }}">
                                                        {{ $setting->translate($lang->locale)->description }}
                                                    </textarea>
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
            @endif
        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        function showLogo(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#logo').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function showFooterLogo(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#footerLogo').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

@endpush
