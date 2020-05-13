@extends('store.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home' ,app()->getLocale())}}">{{_i('Home')}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Account settings')}}</li>
            </ol>
        </div>
    </nav>


    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info' ] as $msg)
            @if(Session::has($msg))
                <br/>
                <h6 class="alert alert-{{ $msg }} text-center"><b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
        @if(Session::has('flash_message'))
            <br/>
            <h6 class="alert alert-success text-center"><b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>


    <!-- =============================== Model Body password div ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">{{_i('Change Password')}}</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form class="form-horizontal" action="{{route('update-new' ,app()->getLocale())}}" method="POST"
                          class="form-horizontal" id="form_1" data-parsley-validate="">
                        @csrf
                        {{method_field('put')}}
                        <div class="box-body">
                            <!-- ================================== password =================================== -->
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password"
                                           placeholder="{{_i('New Password')}}" required="" min="6"
                                           data-parsley-min="6">

                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <br/>
                                <div class="col-xs-6">
                                    <input type="password" name="password_confirmation"
                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           placeholder="{{_i('Confirm Password')}}" required="" min="6"
                                           data-parsley-min="6"
                                           data-parsley-equalto="#password">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button class="btn btn-red  btn-mainColor" form="form_1" type="submit"
                                    id="s_form_1">{{ _i('Save')}}</button>

                            <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">{{ _i('Close')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!------================ end passwor div =================--->

    <div class="user-page common-wrapper">
        <div class="container">
            <div class="row profile">
                @include('store.user.showprofile',$user)
                <div class="col-md-9">

                    <div class="card shadow-sm">
                        <div class="card-header">{{_i('My Account Settings')}}</div>
                        <div class="card-body">
                            <form class="" action="{{route('myprofile' ,app()->getLocale())}}" method="post"
                                  data-parsley-validate="" id="fileupload" enctype="multipart/form-data">
                                @csrf

                                <label class=" control-label">{{_i('Personal Image')}}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="icofont icofont-file-image card-icon"></i></span>
                                        <input type="file" name="image" id="image" onchange="showBannerImage(this)"
                                               class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                               value="{{old('image')}}">
                                    </div>

                                </div>

                                <label for="inputname3" class=" control-label">{{_i('First Name')}}</label>
                                <input type="text" id="inputname3"
                                       class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="{{_i('First Name')}}"
                                       name="name" maxlength="191" data-parsley-maxlength="191" required=""
                                       value="{{$user->name}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                <label for="inputname2" class=" control-label">{{_i('Last Name')}}</label>
                                <input type="text" id="inputname2"
                                       class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                       placeholder="{{_i('Last Name')}}"
                                       name="lastname" maxlength="100" data-parsley-maxlength="100"
                                       value="{{$user->lastname}}">
                                @if ($errors->has('lastname'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif


                                <label for="inputEmail3" class=" control-label"> {{_i('E-mail')}}</label>
                                <input type="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       id="inputEmail3" placeholder="{{_i('E-mail')}}"
                                       name="email" data-parsley-type="email" data-parsley-maxlength="191" required=""
                                       value="{{$user->email}}">
                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <label for="inptPhone" class=" control-label"> {{_i('Phone')}}</label>
                                <input id="inptPhone" type="number"
                                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                       placeholder="{{_i('Phone')}}"
                                       value="{{$user->phone}}" data-parsley-maxlength="15" required="">
                                @if ($errors->has('phone'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif

                                <label for="gender" class=" control-label"> {{_i('Gender')}}</label>
                                <select name="gender" id="gender"
                                        class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                    <option
                                        value="0" {{ $user->gender == 0 ? 'selected' : '' }}>{{ _i('Male') }}</option>
                                    <option
                                        value="1" {{ $user->gender == 1 ? 'selected' : '' }}>{{ _i('Female') }}</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                                <label for="inputCountry" class=" control-label"> {{_i('Country')}}</label>
                                <select class="form-control " name="country_id" aria-hidden="true"
                                        id="Country">
                                    <option value selected disabled>{{_i('Choose Country')}}</option>
                                    @foreach(\App\CountriesData::where('lang_id', getLang(session('lang')))->get() as $country)
                                        <option value="{{$country->id}}"
                                            {{$user['country_id'] == $country->id ? 'selected' : ''}}> {{ _i($country->title)}}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="address" class=" control-label"> {{_i('Address')}}</label>
                                <textarea type="text" class="form-control" id="address" name="address"
                                          placeholder="{{_i('Enter Your Address here...')}}">{{$user->address}}</textarea>
                                <br>

                                <button type="submit" class="btn btn-red btn-mainColor">{{_i('Update')}}</button>
                                <a>
                                    <button type="button" class="btn btn-red  btn-mainColor" data-toggle="modal"
                                            data-target="#modal-default">
                                        {{_i('Change Password')}}
                                    </button>
                                </a>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
