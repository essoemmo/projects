@extends('admin.layout.index',[
'title' => _i('All User Setting'),
'activePageName' => _i('All User Setting'),
] )


@section('content')

    @include('admin.layout.session')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('User Setting') }}</h5>
        </div>
        <div class="card-block">
            @if($userSetting == null)
                <div class="wrapper">
                    {!! Form::open(['route' => 'userSetting.store', 'method' => 'post','class'=>'j-forms','id'=>'j-forms','files'=>true,'data-parsley-validate']) !!}
                    @honeypot {{--prevent form spam--}}
                    <div class="content">

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Side Menu Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="myAccounts_menu" name="myAccounts_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Accounts In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="myAds_menu" name="myAds_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Ads In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="featuredAd_menu" name="featuredAd_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Featured Ads In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="AdInOurAccounts_menu" name="AdInOurAccounts_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Ad In Our Accounts In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="myPoints_menu" name="myPoints_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Points In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="ticketOpen_menu" name="ticketOpen_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Open Ticket In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="famous_ads_menu" name="famous_ads_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Ads In User Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Famous Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="famous_ads_front" name="famous_ads_front"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Ads in Front') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="famous_section" name="famous_section" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Section') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Famous Identification Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="identification_number"
                                                   name="identification_number" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Identification Number') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="identification_image" name="identification_image"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Identification Image') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Register Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="normal_user_register" name="normal_user_register"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Normal User Register Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="famous_user_register" name="famous_user_register"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous User Register Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="register_section" name="register_section"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Register Section') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Send Email & SMS Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="send_email" name="send_email" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send Email Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="send_sms" name="send_sms" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send SMS Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" id="send_section" name="send_section" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send Section') }}</span>
                                        </label>
                                    </div>
                                </div>
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
                    {!! Form::close() !!}
                </div>
            @else
            <!-------------------------------------- if setting foun => update  ----------------------------------------------------------------------->
                <div class="wrapper">
                    {!! Form::open(['route' => 'userSetting.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true]) !!}
                    @honeypot {{--prevent form spam--}}
                    <div class="content">

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Side Menu Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->myAccounts_menu == 1) checked
                                                   @endif id="myAccounts_menu" name="myAccounts_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Accounts In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->myAds_menu == 1) checked
                                                   @endif id="myAds_menu" name="myAds_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Ads In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->featuredAd_menu == 1) checked
                                                   @endif id="featuredAd_menu" name="featuredAd_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Featured Ads In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->AdInOurAccounts_menu == 1) checked
                                                   @endif id="AdInOurAccounts_menu" name="AdInOurAccounts_menu"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Ad In Our Accounts In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->myPoints_menu == 1) checked
                                                   @endif id="myPoints_menu" name="myPoints_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate My Points In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->ticketOpen_menu == 1) checked
                                                   @endif id="ticketOpen_menu" name="ticketOpen_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Open Ticket In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->famous_ads_menu == 1) checked
                                                   @endif id="famous_ads_menu" name="famous_ads_menu" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Ads In Side Menu') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Famous Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->famous_ads_front == 1) checked
                                                   @endif id="famous_ads_front" name="famous_ads_front" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Ads in Front') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->famous_section == 1) checked
                                                   @endif id="famous_section" name="famous_section" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous Section') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Famous Identification Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->identification_number == 1) checked
                                                   @endif id="identification_number" name="identification_number"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Identification Number') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->identification_image == 1) checked
                                                   @endif id="identification_image" name="identification_image"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Identification Image') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Register Section') }}</span>
                        </div>

                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->normal_user_register == 1) checked
                                                   @endif id="normal_user_register" name="normal_user_register"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Normal User Register Option') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->famous_user_register == 1) checked
                                                   @endif id="famous_user_register" name="famous_user_register"
                                                   value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Famous User Register Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->register_section == 1) checked
                                                   @endif id="register_section" name="register_section" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Register Section') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Send Email & SMS Section') }}</span>
                        </div>
                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->send_email == 1) checked
                                                   @endif id="send_email" name="send_email" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send Email Option') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->send_sms == 1) checked
                                                   @endif id="send_sms" name="send_sms" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send SMS Option') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->send_section == 1) checked
                                                   @endif id="send_section" name="send_section" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Send Section') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Contact Us Section') }}</span>
                        </div>
                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->contact_us == 1) checked
                                                   @endif id="contact_us" name="contact_us" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Contact Us & Show to Users') }}</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br>
                        <div class="divider-text gap-top-20 gap-bottom-45">
                            <span>{{ _i('Points') }}</span>
                        </div>
                        <div class="col-sm-12 col-xl-12 m-b-30">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" @if($userSetting->points == 1) checked
                                                   @endif id="points" name="points" value="1">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{ _i('Activate Users Points') }}</span>
                                        </label>
                                    </div>
                                </div>

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

                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('js')

    <script type="text/javascript">
        $('#send_email').on('click', function () {
            $('#send_section').prop('checked', true);
        });
        $('#send_sms').on('click', function () {
            $('#send_section').prop('checked', true);
        });
        $('#send_section').click(function () {
            if ($(this).prop("checked") == true) {
                $('#send_sms').prop('checked', true);
                $('#send_email').prop('checked', true);
            } else if ($(this).prop("checked") == false) {
                $('#send_sms').prop('checked', false);
                $('#send_email').prop('checked', false);
            }
        });
        $('#normal_user_register').on('click', function () {
            $('#register_section').prop('checked', true);
        });
        $('#famous_user_register').on('click', function () {
            $('#register_section').prop('checked', true);
        });
        $('#register_section').click(function () {
            if ($(this).prop("checked") == true) {
                $('#normal_user_register').prop('checked', true);
                $('#famous_user_register').prop('checked', true);
            } else if ($(this).prop("checked") == false) {
                $('#normal_user_register').prop('checked', false);
                $('#famous_user_register').prop('checked', false);
            }
        });
        $('#famous_ads_front').on('click', function () {
            $('#famous_section').prop('checked', true);
        });
        $('#famous_ads_menu').on('click', function () {
            $('#famous_section').prop('checked', true);
        });
        $('#famous_section').click(function () {
            if ($(this).prop("checked") == true) {
                $('#famous_ads_front').prop('checked', true);
                $('#famous_ads_menu').prop('checked', true);
            } else if ($(this).prop("checked") == false) {
                $('#famous_ads_front').prop('checked', false);
                $('#famous_ads_menu').prop('checked', false);
            }
        });
    </script>

@endpush
