@extends('web.layout.master')
@push('css')
    <style>
        .custom-control{
            position: fixed !important;
        }
    </style>

    @endpush
@section('content')

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="{{_i(route('getweblogin'))}}" class="btn btn-green ">{{_i('Already have an account? Click here to enter')}}</a>
                    </div>
                    @if ($errors->all())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <hr>
                     @include("auth.social")
                    <form action="{{route('postregister')}}" method="post" data-parsley-validate="" enctype="multipart/form-data">
                       {{csrf_field()}}
                        {{method_field('post')}}
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="firstname" id="firstName" placeholder="{{_i('First Name')}}" data-parsley-required="true">
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lastname" placeholder="{{_i('Last Name')}}" data-parsley-required="true">
                            </div>

                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       placeholder="{{_i('Email')}}" data-parsley-required="true"
                                       data-parsley-type="email">

                                <input type="password" class="form-control" id="Password" name="password" placeholder="{{_i('Password')}}"
                                       data-parsley-required="true"
                                       data-parsley-minlength="6">

                                <input id="password-confirm" type="password" class="form-control" placeholder="{{ _i('Confirm Password') }}" name="password_confirmation" required>

                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{_i('Mobile')}}"
                                       data-parsley-required="true"
                                       data-parsley-minlength="6">

                                <input type="file" class="form-control" id="image" name="image">

                                @php
                                $country = \App\Models\Country::with('hasDescription')->get();
                                @endphp
                                <select class="form-control" name="country">
                                    <option>{{_i('Choose Country....')}}</option>
                                    @foreach ($country as $coun)
                                        @foreach($coun->hasDescription->where('language_id',getLang(lang())) as $co )
                                            <option value="{{$co->country_id}}">{{$co->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>

                                <input type="text" hidden class="form-control" id="Country" placeholder="{{_i('country')}}">

                                <div class="custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" data-parsley-required="true">
                                    <label class="custom-control-label" for="customCheck1">{{_i('I acknowledge and agree to the Privacy Policy and the Terms of Use Agreement')}}.</label>
                                </div>

                                <div class="text-center my-4">
                                    <button type="submit" class="btn btn-blue">{{_i('join now')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
