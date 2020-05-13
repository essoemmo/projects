@extends('admin.index')

{{--@section('page_header_name' , 'All Permissions')--}}

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#Setting" role="tab" aria-controls="home"
               aria-selected="true">{{_i('General Setting')}}</a>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"--}}
        {{--               aria-selected="false">Profile</a>--}}
        {{--        </li>--}}
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"--}}
        {{--               aria-selected="false">Contact</a>--}}
        {{--        </li>--}}
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="home-tab">

            <form  action="{{route('settings-update')}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>
                    <input type="hidden" name="setting_id" value="{{settings()->id}}">

                                <div class="form-group">
                                    <label>{{_i('language')}}</label>
                                    <select name="language" class="form-control">

                                        @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                            <option value="{{$key}}">{{$lang}}</option>
                                        @endforeach
                                    </select>
                                </div>

                    <!-- ================================== title =================================== -->
                    <div class="form-group row" >
                        <div class="col-md-8">
                            <label class="col-md-8 col-form-label " for="title">
                                {{_i('Title')}} <span style="color: #F00;">*</span>
                            </label>
                            <div class="body">
                                <input type="text" name="title" value="{{ settings()->title}}" id="title" required="" class="form-control" placeholder="{{_i('Website Name')}}">
                                @if ($errors->has('title'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                 </span>
                                @endif
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('email')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="email" name="email" value="{{ settings()->email}}" id="title" required="" class="form-control" placeholder="{{_i('Website email')}}">
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                                @endif
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('logo')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="file" name="logo" class="form-control image">
                                @if ($errors->has('logo'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('Control website')}} <span style="color: #F00;">*</span>
                                </label>
                                <select name="mantance" class="form-control">
                                    <option value="">------</option>
                                    <option value="1" {{settings()->mantance == 1 ? 'selected' : ''}}>{{_i('open')}}</option>
                                    <option value="0" {{settings()->mantance == 0 ? 'selected' : ''}}>{{_i('close')}}</option>
                                </select>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('facebook_url')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="facebook_url" class="form-control" value="{{settings()->facebook_url}}">
                                @if ($errors->has('facebook_url'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('facebook_url') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('instagram_url')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="instagram_url" class="form-control" value="{{settings()->instagram_url}}">
                                @if ($errors->has('instagram_url'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('instagram_url') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('twitter_url')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="twitter_url" class="form-control" value="{{settings()->twitter_url}}">
                                @if ($errors->has('twitter_url'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('twitter_url') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('phone')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="phone1" class="form-control" value="{{settings()->phone1}}">
                                @if ($errors->has('phone1'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('phone1') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('address')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="address" class="form-control" value="{{settings()->address}}">
                                @if ($errors->has('address'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>


                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('description')}} <span style="color: #F00;">*</span>
                                </label>
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


                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('TitleTopSearch')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="TitleTopSearch" class="form-control" value="{{settings()->TitleTopSearch}}">
                                @if ($errors->has('TitleTopSearch'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('TitleTopSearch') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('descrption top the search')}} <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descriptionOnSearch" class="form-control ckeditor">
                                    {{settings()->descriptionOnSearch}}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('descriptionOnSearch') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>



                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('Titleactivemember')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="Titleactivemember" class="form-control" value="{{settings()->Titleactivemember}}">
                                @if ($errors->has('Titleactivemember'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('Titleactivemember') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('descrption activemember')}} <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descrptionactivemember" class="form-control ckeditor">
                                    {{settings()->descrptionactivemember}}
                                </textarea>
                                @if ($errors->has('descrptionactivemember'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('descrptionactivemember') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>



                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('Titleactivemember2')}} <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="Titleactivemember2" class="form-control" value="{{settings()->Titleactivemember2}}">
                                @if ($errors->has('Titleactivemember2'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('Titleactivemember2') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    {{_i('descrption descrptionactivemember2')}} <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descrptionactivemember2" class="form-control ckeditor">
                                    {{settings()->descrptionactivemember2}}
                                </textarea>
                                @if ($errors->has('descrptionactivemember2'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('descrptionactivemember2') }}</strong>
                                 </span>
                                @endif
                                <br>
                            </div>

                            <div class="body">
                                                            <label class="col-md-8 col-form-label " for="title">
                                                                {{_i('descrption descrptionactivemember2')}} <span style="color: #F00;">*</span>
                                                            </label>
                                                            <textarea name="descrptionactivemember2" class="form-control ckeditor">
                                                                {{settings()->descrptionactivemember2}}
                                                            </textarea>
                                                            @if ($errors->has('descrptionactivemember2'))
                                                                <span class="text-danger invalid-feedback">
                                                                <strong>{{ $errors->first('descrptionactivemember2') }}</strong>
                                                             </span>
                                                            @endif
                                                            <br>
                                                        </div>
                                                        <div class="body">
                                                                                        <label class="col-md-8 col-form-label " for="title">
                                                                                            {{_i('register_msg')}} <span style="color: #F00;">*</span>
                                                                                        </label>
                                                                                        <textarea name="register_msg" class="form-control ckeditor">
                                                                                            {{settings()->register_msg}}
                                                                                        </textarea>
                                                                                        @if ($errors->has('register_msg	'))
                                                                                            <span class="text-danger invalid-feedback">
                                                                                            <strong>{{ $errors->first('register_msg') }}</strong>
                                                             </span>
                                                       @endif
                                                 <br>
                                              </div>


                        </div>

                        <div class="col-md-4">
                            <img src="{{asset('uploads/setting/'.settings()->loge)}}" class="image-preview" style="width: 300px">
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <input type="submit" value="{{_i('save')}}" class="btn btn-info btn-sm">
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
























