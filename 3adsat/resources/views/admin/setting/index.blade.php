
@extends('admin.layout.index',[
'title' => _i('General Setting'),
'subtitle' => _i('General Setting'),
'activePageName' => _i('General Setting'),
'additionalPageUrl' => url('/admin/panel/settings') ,
'additionalPageName' => _i('Add'),
] )

{{--@section('page_header_name' , 'All Permissions')--}}

@section('content')

{{--    <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#Setting" role="tab" aria-controls="home"--}}
{{--               aria-selected="true">{{_i('General Setting')}}</a>--}}
{{--        </li>--}}

{{--    </ul>--}}

    <div class="tab-content card" id="myTabContent">
        <div class="card-header">
            <h5> {{ _i('General Setting') }} </h5>
   @include("admin.translate_buttons",["table" => "settings"])
        </div>
        <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="home-tab">

            <form  action="{{route('settings-update')}}" method="post" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate=""  >
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                    </div>
                    <input type="hidden" name="setting_id" value="{{settings()->id}}">

{{--                                <div class="form-group">--}}
{{--                                    <label>{{_i('language')}}</label>--}}
{{--                                    <select name="language" class="form-control">--}}

{{--                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)--}}
{{--                                            <option value="{{$key}}">{{$lang}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                    <!-- ================================== title =================================== -->
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label " for="title">
                            {{_i('Title')}} <span style="color: #F00;">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="title" value="{{ settings()->title}}" id="title" required="" class="form-control" placeholder="{{_i('Website Name')}}">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="title">
                            {{_i('email')}} <span style="color: #F00;">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="email" name="email" value="{{ settings()->email}}" id="title" required="" class="form-control" placeholder="{{_i('Website email')}}">
                            @if ($errors->has('email'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label " for="title">
                            {{_i('sales email')}} <span style="color: #F00;">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="email" name="sales_email" value="{{ settings()->sales_email}}" id="title" required="" class="form-control" placeholder="{{_i('Sales email')}}">
                            @if ($errors->has('sales_email'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('sales_email') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="title">
                            {{_i('contact email')}} <span style="color: #F00;">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="email" name="contact_email" value="{{ settings()->contact_email}}" id="title" required="" class="form-control" placeholder="{{_i('contact email')}}">
                            @if ($errors->has('contact_email'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('contact_email') }}</strong>
                             </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('logo')}} <span style="color: #F00;">*</span>
                            </label>
                        <div class="col-sm-4">
                            <input type="file" name="logo" class="form-control image">
                            @if ($errors->has('logo'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('logo') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                        <div class="col-md-4">
                            <a href="{{asset('uploads/setting/'.settings()->loge)}}" target="logo">
                            <img src="{{asset('uploads/setting/'.settings()->loge)}}" class="image-preview" style="width: 80px">
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('Control website')}} <span style="color: #F00;">*</span>
                            </label>
                        <div class="col-sm-4">
                            <select name="mantance" class="form-control">
                                <option value="">------</option>
                                <option value="1" {{settings()->mantance == 1 ? 'selected' : ''}}>{{_i('open')}}</option>
                                <option value="0" {{settings()->mantance == 0 ? 'selected' : ''}}>{{_i('close')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('facebook_url')}}
                            </label>
                        <div class="col-sm-4">
                            <input type="text" name="facebook_url" class="form-control" value="{{settings()->facebook_url}}">
                            @if ($errors->has('facebook_url'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('facebook_url') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="title">
                            {{_i('instagram_url')}}
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="instagram_url" class="form-control" value="{{settings()->instagram_url}}">
                            @if ($errors->has('instagram_url'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('instagram_url') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>
                    <div class="form-group row">

                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('twitter_url')}}
                            </label>
                        <div class="col-sm-4">
                            <input type="text" name="twitter_url" class="form-control" value="{{settings()->twitter_url}}">
                            @if ($errors->has('twitter_url'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('twitter_url') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>
                    <div class="form-group row">

                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('youtube_url')}}
                            </label>
                        <div class="col-sm-4">
                            <input type="text" name="youtube_url" class="form-control" value="{{settings()->youtube_url}}">
                            @if ($errors->has('youtube_url'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('youtube_url') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>

                    <div class="form-group row">
                        @foreach ($countries as $country)
                                <label class="col-sm-2 col-form-label " for="phone">
                                    {{ $country->name }} {{_i('phone')}} <span style="color: #F00;">*</span>
                                </label>
                            <div class="col-sm-4">
                                <?php $phone = \App\Models\SettingCountryPhone::where('setting_id', settings()->id)->where('country_id', $country->country_id)->first(); ?>
                                @if($phone != null)
                                <input type="text" id="phone" name="phone_{{ $country->iso_code }}" class="form-control" value="{{ $phone->phone }}">
                                @else
                                    <input type="text" id="phone" name="phone_{{ $country->iso_code }}" class="form-control" value="">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label " for="title">
                            {{_i('address')}}
                        </label>
                        <div class="col-sm-4">
                            <input type="text" name="address" class="form-control" value="{{settings()->address}}">
                            @if ($errors->has('address'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('address') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label " for="title">
                                {{_i('description')}}
                            </label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control ckeditor">
                                {{settings()->description}}
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                             </span>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" value="{{_i('save')}}" class="btn btn-primary">
                </div>
                <!-- /.box-footer -->
            </form>


        </div>
        {{--        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Food truck fixie--}}
        {{--            locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,--}}
        {{--            blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.--}}
        {{--            Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum--}}
        {{--            PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS--}}
        {{--            salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit,--}}
        {{--            sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester--}}
        {{--            stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</div>--}}
        {{--        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Etsy mixtape--}}
        {{--            wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack--}}
        {{--            lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard--}}
        {{--            locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify--}}
        {{--            squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie--}}
        {{--            etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog--}}
        {{--            stumptown. Pitchfork sustainable tofu synth chambray yr.</div>--}}
    </div>


@endsection
























