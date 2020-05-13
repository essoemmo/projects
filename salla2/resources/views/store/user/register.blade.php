@extends('store.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home' ,app()->getLocale())}}">{{_i('Home')}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Register')}}</li>
            </ol>
        </div>
    </nav>

    @if(\App\Bll\Utility::getTemplateCode() == "purple")
        <section class="register-form common-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="center">
                            <a href=""><img src="{{asset('perpal/images/logo.png')}}" alt="" class="img-fluid logo"></a>
                            <div class="welcome-head-1">{{_i('Welcome to our website')}}</div>
                            <div class="welcome-head-2">{{_i('Register a new account')}}</div>
                            <a href="{{route('signin', app()->getLocale())}}">{{_i('Do you already have an account? sign in')}}</a>
                        </div>
                        <form action="{{route('store_register', app()->getLocale())}}" method="post"
                              data-parsley-validate="">

                            @csrf

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/contact.png')}}"
                                                                         alt=""></span>
                                    <input type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" id="firstName" placeholder="{{_i('First Name')}}" maxlength="191"
                                           data-parsley-maxlength="191" required="" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/contact.png')}}"
                                                                         alt=""></span>
                                    <input type="text"
                                           class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                           name="lastname" id="LastName" placeholder="{{_i('Last Name')}}"
                                           maxlength="100"
                                           data-parsley-maxlength="100" value="{{old('lastname')}}">
                                    @if ($errors->has('lastname'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/envelope.png')}}"
                                                                         alt=""></span>
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           id="exampleInputEmail1" placeholder="{{_i('E-mail')}}" name="email"
                                           data-parsley-type="email" data-parsley-maxlength="191" required=""
                                           value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{url('perpal/images/lock.png')}}" alt=""></span>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password"
                                           id="Password" placeholder="{{_i('Password')}}" value="{{old('password')}}"
                                           min="6"
                                           data-parsley-min="6" required="">
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/lock.png')}}"
                                                                         alt=""></span>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" id="password_confirmation"
                                           placeholder="{{_i('Password Confirmation')}}"
                                           value="{{old('Re-enter the password')}}"
                                           min="6" data-parsley-min="6" data-parsley-equalto="#Password" required="">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone" placeholder="{{_i('Phone')}}" value="{{old('phone')}}"
                                           data-parsley-maxlength="15" required="">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <select class="js-example-basic-single selct2 col-sm-12 " name="country_id"
                                            id="Country">
                                        <option value selected disabled>{{_i('Choose Country')}}</option>
                                        @foreach(\App\CountriesData::where('lang_id', getLang(session('lang')))->get() as $country)
                                            <option value="{{$country->id}}"
                                                {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                        <textarea class="form-control" name="address"
                                  placeholder="{{_i('Enter Your Address...')}}">{{old('address')}}</textarea>
                            </div>

                            <div class="center">
                                <button type="submit"
                                        class="btn btn-mainColor btn-block rounded my-4">{{_i('Subscribe')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
 @elseif(\App\Bll\Utility::getTemplateCode() == "shade")
  <div class="center">

                            <a href="{{route('signin' ,app()->getLocale())}}"                               class="btn btn-green ">{{_i('Already have an account? Click here to enter')}}</a>
                        </div>
  <form action="{{route('store_register', app()->getLocale())}}" method="post"       data-parsley-validate="">

                            @csrf

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/contact.png')}}"
                                                                         alt=""></span>
                                    <input type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" id="firstName" placeholder="{{_i('First Name')}}" maxlength="191"
                                           data-parsley-maxlength="191" required="" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/contact.png')}}"
                                                                         alt=""></span>
                                    <input type="text"
                                           class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                           name="lastname" id="LastName" placeholder="{{_i('Last Name')}}"
                                           maxlength="100"
                                           data-parsley-maxlength="100" value="{{old('lastname')}}">
                                    @if ($errors->has('lastname'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/envelope.png')}}"
                                                                         alt=""></span>
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           id="exampleInputEmail1" placeholder="{{_i('E-mail')}}" name="email"
                                           data-parsley-type="email" data-parsley-maxlength="191" required=""
                                           value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{url('perpal/images/lock.png')}}" alt=""></span>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password"
                                           id="Password" placeholder="{{_i('Password')}}" value="{{old('password')}}"
                                           min="6"
                                           data-parsley-min="6" required="">
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="{{asset('perpal/images/lock.png')}}"
                                                                         alt=""></span>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" id="password_confirmation"
                                           placeholder="{{_i('Password Confirmation')}}"
                                           value="{{old('Re-enter the password')}}"
                                           min="6" data-parsley-min="6" data-parsley-equalto="#Password" required="">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone" placeholder="{{_i('Phone')}}" value="{{old('phone')}}"
                                           data-parsley-maxlength="15" required="">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <select class="js-example-basic-single selct2 col-sm-12 " name="country_id"
                                            id="Country">
                                        <option value selected disabled>{{_i('Choose Country')}}</option>
                                        @foreach(\App\CountriesData::where('lang_id', getLang(session('lang')))->get() as $country)
                                            <option value="{{$country->id}}"
                                                {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                        <textarea class="form-control" name="address"
                                  placeholder="{{_i('Enter Your Address...')}}">{{old('address')}}</textarea>
                            </div>

                            <div class="center">
                                <button type="submit"
                                        class="btn btn-mainColor btn-block rounded my-4">{{_i('Subscribe')}}</button>
                            </div>

                        </form>
    @else
        <!-------------------------------- check for template ----------------------------------------------------------->
        <section class="register-form common-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="center">

                            <a href="{{route('signin' ,app()->getLocale())}}"
                               class="btn btn-green ">{{_i('Already have an account? Click here to enter')}}</a>
                        </div>
                        <form action="{{route('store_register' ,app()->getLocale())}}" method="post"
                              data-parsley-validate="">

                            @csrf

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" id="firstName" placeholder="{{_i('First Name')}}" maxlength="191"
                                           data-parsley-maxlength="191" required="" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                           name="lastname" id="LastName" placeholder="{{_i('Last Name')}}"
                                           maxlength="100"
                                           data-parsley-maxlength="100" value="{{old('lastname')}}">
                                    @if ($errors->has('lastname'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <input type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           id="exampleInputEmail1" placeholder="{{_i('E-mail')}}" name="email"
                                           data-parsley-type="email" data-parsley-maxlength="191" required=""
                                           value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif

                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password"
                                           id="Password" placeholder="{{_i('Password')}}" value="{{old('password')}}"
                                           min="6"
                                           data-parsley-min="6" required="">
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                    <input type="password"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           name="password_confirmation" id="password_confirmation"
                                           placeholder="{{_i('Password Confirmation')}}"
                                           value="{{old('password_confirmation')}}"
                                           min="6" data-parsley-min="6" data-parsley-equalto="#Password" required="">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                    @endif
                                    <input type="number"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone" placeholder="{{_i('Phone')}}" value="{{old('phone')}}"
                                           data-parsley-maxlength="15" required="">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                    @endif


                                    <select class="nice-select" name="country_id" aria-hidden="true" id="Country">
                                        <option value selected disabled>{{_i('Choose Country')}}</option>
                                        @foreach(\App\CountriesData::where('lang_id', getLang(session('lang')))->get() as $country)
                                            <option value="{{$country->id}}"
                                                {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                            </option>
                                        @endforeach
                                    </select>


                                    <textarea class="form-control" name="address"
                                              placeholder="{{_i('Enter Your Address...')}}">{{old('address')}}</textarea>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                               required="">
                                        <label class="custom-control-label" for="customCheck1">
                                            {{_i('I acknowledge and agree to the Privacy Policy and the Terms of Use Agreement.')}}
                                        </label>
                                    </div>

                                    <div class="text-center my-4">
                                        <button type="submit" class="btn btn-red">{{_i('Join Us')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    @endif

@endsection
