@extends('front.layout.index')

@section('title')

    {{ _i('My Profile') }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="{{ _i('Home') }}"
                                               href="{{ route('home') }}">  {{ _i('Home') }} </a></li>
                <li class="breadcrumb-item active" title="{{ _i('My Profile') }}"
                    aria-current="page">{{ _i('My Profile') }}</li>
            </ol>
        </div>
    </nav>


    <!-- =============================== Model Body password div ============================================== -->
    <div class="modal fade " id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="pull-right">
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> &times;</span></button>
                    </div>
                    <h4 class="modal-title">{{_i('Change Password')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form action="{{ route('updatePassword') }}" class="form-horizontal" method="POST"
                          data-parsley-validate>

                        @csrf

                        @honeypot {{--prevent form spam--}}

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">{{ _i('old Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                       name="old_password" placeholder="{{_i('Old Password')}}"
                                       value="{{old('old_password')}}">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">{{ _i('Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" id="Password" placeholder="{{_i('Password')}}"
                                       value="{{old('password')}}"
                                       data-parsley-minlength="8"
                                       data-parsley-errors-container=".errorpassmessage"
                                       data-parsley-required-message="Please enter your new password."
                                       data-parsley-uppercase="1"
                                       data-parsley-lowercase="1"
                                       data-parsley-number="1"
                                       data-parsley-special="1">
                                <span class="errorpassmessage"></span>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">{{ _i('Confirm Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       name="password_confirmation" id="password_confirmation"
                                       placeholder="{{_i('Password Confirmation')}}"
                                       value="{{old('password_confirmation')}}"
                                       data-parsley-minlength="8"
                                       data-parsley-errors-container=".errorpassmessage"
                                       data-parsley-required-message="Please re-enter your new password."
                                       data-parsley-equalto="#Password"/>
                                <span class="errorpassmessage"></span>
                            </div>
                        </div>

                        <div class="text-left">
                            <input type="submit" class="btn grade m-2" value="{{ _i('Save') }}">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!------================ end passwor div =================--->

    <div class="user-page py-3">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    @include('front.user.includes.sideMenu')
                </div>
                <div class="col-md-9">

                    <div class="card  border-0">
                        <div class="card-header shadow-sm">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}
                                : {{ membership_number($user->membership_number) }}</div>
                        </div>

                        <div class="card-body">
                            @if($user->country_id == null && $user->mobile == null)
                                <p class="text-center text-danger">{{ _i('Please Complete Your Profile To Add Your Accounts') }}</p>
                            @endif

                            <form data-parsley-validate action="{{ route('userProfile.store') }}" method="POST"
                                  enctype="multipart/form-data">

                                @csrf

                                @honeypot {{--prevent form spam--}}

                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">{{ _i('First Name') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="first_name" name="first_name"
                                               value="{{ $user->first_name }}" class="form-control" required
                                               maxlength="191" minlength="3"
                                               data-parsley-errors-container=".errorMessageFirst">
                                        <span class="errorMessageFirst"></span>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Last Name') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" value="{{ $user->last_name }}"
                                               class="form-control" required maxlength="191" minlength="3"
                                               data-parsley-errors-container=".errorMessageLast">
                                        <span class="errorMessageLast"></span>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label">{{ _i('Gender') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="gender" id="gender" class="form-control">
                                            <option disabled selected>{{ _i('Select') }}</option>
                                            <option @if($user->gender == 'male') selected
                                                    @endif value="male">{{ _i('Male') }}</option>
                                            <option @if($user->gender == 'female') selected
                                                    @endif value="female">{{ _i('Female') }}</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="country" class="col-sm-3 col-form-label">{{ _i('Country') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="country_id" id="country" class="form-control" required>
                                            <option disabled selected>{{ _i('Select') }}</option>
                                            @foreach($countries as $country)
                                                <option @if($user->country_id == $country->id) selected
                                                        @endif value="{{ $country->id }}">{{ $country->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('country_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row" @if($user->city_id == null) style="display: none"
                                     @endif id="city">
                                    <label for="city_id" class="col-sm-3 col-form-label">{{ _i('City') }}</label>
                                    <div class="col-sm-9">
                                        <select name="city_id" id="city_id" class="form-control">
                                            <option disabled selected>{{ _i('Select') }}</option>
                                            @foreach($cities as $city)
                                                <option @if($user->city_id == $city->id) selected
                                                        @endif value="{{ $city->id }}">{{ $city->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('city_id'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('city_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Phone') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <input type="text" class="call_code col-sm-2 form-control mr-3"
                                                   @if($user->country) value="{{ $user->country->call_code }}" @endif>
                                            <input type="text" name="mobile" data-parsley-type="number" minlength="9"
                                                   value="{{ $user->mobile }}" class="mr-2 form-control col-sm-9"
                                                   required>
                                        </div>
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Email') }} <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                               required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert" style="display: block">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Image') }}</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input" name="user_image"
                                                   aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label">{{ _i('Upload Image') }}</label>
                                        </div>
                                        @if ($errors->has('user_image'))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                               <strong>{{ $errors->first('user_image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                @if(auth()->user()->user_type == "famous")
                                    @if(userSetting()->identification_number == 1 && userSetting()->identification_number != 0)
                                        <div class="form-group row">
                                            <label for=""
                                                   class="col-sm-3 col-form-label">{{_i('Identification Number')}}</label>
                                            <div class="col-sm-9">
                                                <input type="number" min="1" class="form-control" name="identify_number"
                                                       @if($user->identify_number) value="{{ $user->identify_number}}"
                                                       @endif required="" data-parsley-maxlength="20">
                                            </div>
                                            @if ($errors->has('identify_number'))
                                                <span class="text-danger invalid-feedback" role="alert"
                                                      style="display: block">
                                                   <strong>{{ $errors->first('identify_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    @if(userSetting()->identification_image == 1 && userSetting()->identification_image != 0)
                                        <div class="form-group row">
                                            <label for=""
                                                   class="col-sm-3 col-form-label">{{_i('Identification Image')}}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control custom-file-input  "
                                                           id="inputGroupFile01"
                                                           aria-describedby="inputGroupFileAddon01"
                                                           name="identify_image"
                                                           @if($user->identify_image) value="{{ $user->identify_image}}"
                                                           @else  required="" @endif>
                                                    <label class="custom-file-label id-photo"
                                                           for="inputGroupFile01"></label>
                                                </div>
                                                @if ($errors->has('identify_image'))
                                                    <span class="text-danger invalid-feedback" role="alert"
                                                          style="display: block">
                                                       <strong>{{ $errors->first('identify_image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if(userSetting()->send_section == 1 && userSetting()->send_section != 0)
                                    <strong class="form-text my-3" style="color: red">
                                        {{_i('Our team sends service and advertising messages on the phone and e-mail, do you want to receive these messages from the site ?')}}
                                    </strong>

                                    @if(userSetting()->send_email != 0 && userSetting()->send_email == 1)
                                        <div class="row form-group">
                                            <label for="send_email"
                                                   class="col-sm-9 col-form-label">{{_i('Yes, I would like to receive messages on my email')}}</label>
                                            <div class="col-sm-3">
                                                <input type="checkbox" class="btn btn-outline-dark" name="send_email"
                                                       id="send_email" value="1"
                                                       @if($user->send_email == 1) checked @endif>
                                            </div>
                                        </div>
                                    @endif

                                    @if(userSetting()->send_sms != 0 && userSetting()->send_sms == 1)
                                        <div class="row form-group">
                                            <label for="send_sms"
                                                   class="col-sm-9 col-form-label">{{_i('Yes, I would like to receive messages on my phone')}}</label>
                                            <div class="col-sm-3">
                                                <input type="checkbox" class="btn btn-outline-dark" name="send_sms"
                                                       id="send_sms" value="1" @if($user->send_sms == 1) checked @endif>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row form-group">
                                        <label for="none"
                                               class="col-sm-9 col-form-label">{{_i('I don\'t want to')}}</label>
                                        <div class="col-sm-3">
                                            <input type="checkbox" class="btn btn-outline-dark" name="none" id="none"
                                                   value="none"
                                                   @if($user->send_sms == 0 && $user->send_email == 0) checked @endif>
                                        </div>
                                    </div>
                                @endif

                                <div class="text-left">
                                    <input type="button" class="btn grade m-2" data-toggle="modal"
                                           data-target="#modal-default" value="{{ _i('Update Password') }}">
                                    <input type="submit" class="btn grade m-2" value="{{ _i('Save') }}">
                                </div>

                                <br>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('css')
    <style>
        .custom-file-label.id-photo::after {
        . grade;
            content: {{_i('Insert Identity Image')}};
        }
    </style>
@endpush

@push('js')

    <script>
        $('#none').on('click', function () {
            $('#send_email').prop('checked', false);
            $('#send_sms').prop('checked', false);
        });
        $('#send_email').on('click', function () {
            $('#none').prop('checked', false);
        });
        $('#send_sms').on('click', function () {
            $('#none').prop('checked', false);
        });
        $(function () {
            'use strict';
            $('#country').on('change', function (e) {
                var country_id = $(this).val();
                $.ajax({
                    url: '{{ route('getCallCode') }}',
                    DataType: 'json',
                    type: 'get',
                    data: {country_id: country_id},
                    success: function (res) {
                        if (res[0] == true) {
                            $('.call_code').val(res[1]);
                        } else {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Error Happened Please Try Again') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                    }
                })
            });
        });

        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getCityList')}}",
                    DataType: 'json',
                    data: {countryID: countryID},
                    success: function (res) {
                        if (res[0] == true) {
                            console.log(res[1]);
                            $("#city").css('display', 'flex');
                            $("#city_id").empty();
                            $("#city_id").append('<option>{{ _i('select') }}</option>');
                            $.each(res[1], function (key, value) {
                                $("#city_id").append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        } else {
                            $("#city").css('display', 'none');
                        }
                    }
                });
            } else {
                $("#city").css('display', 'none');
            }
        });
    </script>


@endpush
