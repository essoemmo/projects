@extends('front.layout.inner')
@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url(LaravelGettext::getLocale(),'/')}}">{{_i('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{_i('register')}}</li>
        </ol>
    </div>
</nav>


<section class="register-form custom-reg-form  ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow mb-4">
                <div class="head-title text-center pt-3">
                    {{_i("Welcome to online trade")}}

                </div>
                <div class="text-center text-danger">
                    <?php
                  
                    $membership_data = $membership->getData(\App\Bll\Utility::language()->id)
                    ?>
                    {{$membership_data->title}}
                    {{$membership->price}}  {{$membership->currency_code}}

                </div>
                <form method="POST" action="" data-parsley-validate="">
                    @csrf
                    <div class="row">

                        <div class="col-sm-12">
                            <p> {{_i('Store Name')}}</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-shopping-basket"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       name="title" id="title" placeholder="{{_i('Store Name')}}" maxlength="191"
                                       data-parsley-maxlength="191" required="" value="{{old('title')}}">
                                @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>{{_i('domain Name')}} </p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-link"></i></label>
                                </div>

                                <div class="input-group-append">

                                    <label class="input-group-text">sallatk.com.</label>
                                </div>

                                <input type="text" class="form-control{{ $errors->has('domain') ? ' is-invalid' : '' }}"
                                       name="domain" id="domain" placeholder="{{_i('domain Name')}}" maxlength="191"
                                       data-parsley-maxlength="191" required="" value="{{old('domain')}}">
                                @if ($errors->has('domain'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('domain') }}</strong>
                                </span>
                                @endif

                            </div>
                            <small class="form-text text-muted mb-3">{{_i('It will be the link of the store that customers can access to order. English letters and numbers must be used')}}</small>

                        </div>
                        <div class="col-sm-6">

                            <label> {{_i("Store Manager")}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-user"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" id="firstName" placeholder="{{_i('First Name')}}" maxlength="191"
                                       data-parsley-maxlength="191" required="" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <label> &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-user"></i></label>
                                </div>
                                <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                       name="lastname" id="lastname" placeholder="{{_i('Last Name')}}" maxlength="191"
                                       data-parsley-maxlength="191" required="" value="{{old('lastname')}}">
                                @if ($errors->has('lastname'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <label>{{_i('Phone')}}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-mobile"></i></label>
                                </div>
                                <input type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       name="phone" placeholder="{{_i('Phone')}}" value="{{old('phone')}}"
                                       data-parsley-maxlength="15" required="">
                                @if ($errors->has('phone'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!--                        <div class="col-sm-6">
                                                    <label>{{_i('Country')}}</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text"><i class="fa fa-globe"></i></label>
                                                        </div>
                                                        <select class="nice-select" name="country_id" aria-hidden="true" id="Country">
                                                        <option value selected disabled>{{_i('Choose Country')}}</option>
                                                        @foreach(\App\CountriesData::where('lang_id', getLang(session('lang')))->get() as $country)
                                                        <option value="{{$country->id}}"
                                                            {{old('country_id') == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>-->

                        <div class="col-sm-6">
                            <label> {{_i('E-mail')}} </label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <label class="input-group-text"><i class="fa fa-envelope-o"></i></label>
                                </div>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
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

                        <div class="col-sm-6">
                            <label>{{_i('Password')}} </label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <label class="input-group-text"><i class="fa fa-key"></i></label>
                                </div>
                                <input type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                       id="Password" placeholder="{{_i('Password')}}" value="{{old('password')}}" min="6"
                                       data-parsley-min="6" required="">
                                @if ($errors->has('password'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>{{_i('Confirm Password')}} </label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <label class="input-group-text"><i class="fa fa-key"></i></label>
                                </div>
                                <input type="password"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       name="password_confirmation" id="password_confirmation"
                                       placeholder="{{_i('Password Confirmation')}}" value="{{old('password_confirmation')}}"
                                       min="6" data-parsley-min="6" data-parsley-equalto="#Password" required="">
                                @if ($errors->has('password_confirmation'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" required="">
                                <label class="custom-control-label" for="customCheck1">
                                    {{_i('I agree to privacy policy and terms of use agreement.')}}
                                </label>
                            </div>

                            <div class="text-center my-4 mr-1">
                                <button type="submit" class="btn btn-pink btn-block rounded-0">{{_i('Create store')}}</button>
                            </div>

                            <div class="center3">

                                <a href="{{route('webLogin',LaravelGettext::getLocale())}}" class="btn btn-blue rounded-0 ">{{ _i('Already have an account? Click here to enter') }}</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>





@endsection
