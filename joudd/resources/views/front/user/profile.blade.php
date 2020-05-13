@extends('front.layout.app')

@section('content')


    <nav aria-label="breadcrumb" class="welcome">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Profile')}}</li>
            </ol>
        </div>
    </nav>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info' ] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }} text-center" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-info text-center" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @endif

         @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger text-center"> {{$error}}</div>
     @endforeach
 @endif
            @if(Session::has('login_message'))
                <br />
                <h6 class="alert alert-info text-center login_message" > <b>   {{ Session::get('login_message') }} </b></h6>
            @endif
    </div>

    <!-- =============================== Model Body password div ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header " >
                    <h4 class="modal-title">{{_i('Change Password')}}</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/update_password')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="box-body">
                            <!-- ================================== password =================================== -->
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <input id="inputPassword3" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password"
                                           placeholder="{{_i('Old Password')}}"  required="" min="6" data-parsley-min="6" >

                                    @if ($errors->has('old_password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <br/>
                                <div class="col-xs-6">
                                    <input id="inputPassword3" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                           placeholder="{{_i('New Password')}}"  required="" min="6" data-parsley-min="6" >

                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <br />
                                <div class="col-xs-6">
                                    <input type="password" name="password_confirmation"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                           placeholder="{{_i('Confirm Password')}}"  required=""  min="6" data-parsley-min="6">

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
                            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>

                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!------================ end passwor div =================--->



    <div class="user-page common-wrapper" >
        <div class="container">
            <div class="row profile ">

                @include('front.user.profile_nav' , $user)


                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <h5 class="card-header">{{_i('Welcome')}} , {{$user->first_name .' '. $user->last_name}}</h5>
                        <div class="card-body">

                            <div class="card-body">
                                <form class=""  action="{{url('/profile')}}" method="post" data-parsley-validate="" id="fileupload"  enctype="multipart/form-data">
                                    @csrf

                                    <label class=" control-label">{{_i('Personal Image')}}</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                                            <label class="custom-file-label" for="inputGroupFile01">{{_i('Choose file')}}</label>
                                        </div>
                                    </div>

                                    <label for="inputname3" class=" control-label" >{{_i('First Name')}}</label>
                                    <input type="text" id="inputname3" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{_i('First Name')}}"
                                           name="first_name" maxlength="191"	data-parsley-maxlength="191" required="" value="{{$user->first_name}}">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif

                                    <label for="inputname2" class=" control-label" >{{_i('Last Name')}}</label>
                                    <input type="text" id="inputname2" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{_i('Last Name')}}"
                                           name="last_name"  maxlength="100"	data-parsley-maxlength="100" value="{{$user->last_name}}">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif


                                    <label for="inputEmail3" class=" control-label"> {{_i('E-mail')}}</label>
                                    <input type="email" readonly="" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="inputEmail3" placeholder="{{_i('E-mail')}}"
                                           name="email" data-parsley-type="email" data-parsley-maxlength="191" required="" value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                    <label for="inptPhone" class=" control-label"> {{_i('Mobile')}}</label>
                                    <input id="inptPhone" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"  placeholder="{{_i('Mobile')}}"
                                           value="{{$user->mobile}}" data-parsley-maxlength="15" required="">
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif

                                    <div class="form-group">
                                    <label for="inputCountry" class=" control-label"> {{_i('Country')}}</label>
                                    <select  class="form-control select2 " name="country_id"  tabindex="-1" style="width:100%" aria-hidden="true" id="inputCountry" required="" >
                                        <option value selected disabled>{{_i('Choose Country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : ''}}> {{ $country->title }}</option>
                                        @endforeach

                                    </select>
                                    </div>


                                    <button type="submit" class="btn btn-info">{{_i('Update')}}</button>
                                    <a>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
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
    </div>


@endsection


