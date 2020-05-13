@extends('admin.AdminLayout.index',[
'title' => _i('Edit Profile'),
'subtitle' => _i('Edit Profile'),
'activePageName' => _i('Edit Profile'),
] )


@push('css')
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('master/assets/icon/icofont/css/icofont.css')}}">
@endpush

@section('content')

    <!-- =============================== Model Body password div ============================================== -->
    <!-- Sign in modal start -->
    <div class="modal fade" id="update_password" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{_i('Change Password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{url('/adminpanel/profile/update_password')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                    @csrf
                <div class="modal-body p-b-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                       value="{{old('password')}}" required="" min="6" data-parsley-min="6" placeholder="{{_i('Password')}}">
                                @if ($errors->has('password'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <input type="password" name="password_confirmation"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       value="{{old('password_confirmation')}}" required=""  min="6" data-parsley-min="6" data-parsley-equalto="#password" placeholder="{{_i('Confirm Password')}}">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">{{_i('Save')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{_i('Close')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sign in modal end -->
    <!------================ end passwor div =================--->

    <!-- Page-body start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Profile') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">


                    <div class="col-lg-12 col-xl-12">
                        <div class="card user-card" style="padding:50px;" >
                            <div class="card-header-img">
                                @if (!empty(\App\Bll\Utility::getStoreprofile()->image))
                                    <img class="img-fluid img-circle" style="width: 174px;" src="{{asset('/uploads/users/'.\App\Bll\Utility::getStoreprofile()->id.'/'.\App\Bll\Utility::getStoreprofile()->image)}}" alt="card-img">
                                @else
                                <img src="{{asset('masterAdmin/assets/images/user.png')}}" alt="User-Profile-Image">
                                @endif
                                <h4>{{$user['name'] ." ". $user['lastname']}}</h4>
                            </div>

                            <form id="profile_from" action="{{url('adminpanel/profile/update')}}" method="post" data-parsley-validate="" enctype="multipart/form-data">
                            @csrf

                            <!-- Basic group add-ons start -->
                                <div class="m-b-20 ">
                                    <div class="row ">
                                        <div class="col-sm-8 col-lg-10" style="margin-left:7em; margin-right:20px;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-user m-r-5"></i></span>
                                                <input type="text" name="name" class="form-control" placeholder="{{_i('First Name')}}" aria-required="true" value="{{$user->name}}" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-sm-8 col-lg-10" style="margin-left:7em; margin-right:20px;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-plus m-r-5"></i></span>
                                                <input type="text" name="lastname" class="form-control" placeholder="{{_i('Last Name')}}" aria-required="true" value="{{$user['lastname']}}" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 col-lg-10"  style="margin-left:7em; margin-right:20px;" >
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-ipod-touch"></i></span>
                                                <input type="text" class="form-control" name="phone"  value="{{$user->phone}}"  placeholder="{{_i('Phone Number')}}" required="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 col-lg-10"  style="margin-left:7em; margin-right:20px;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-file-image card-icon"></i></span>
                                                <input type="file" name="image" id="image" onchange="showBannerImage(this)"
                                    class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                    value="{{old('image')}}" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 col-lg-10"  style="margin-left:7em; margin-right:20px;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-ui-message card-icon"></i></span>
                                                <input type="email" name="email" class="form-control" placeholder="{{_i('Email')}}" value="{{$user->email}}" required="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Basic group add-ons end -->

                                <div class="box-footer">

                                    <div class="align-content-center " style="text-align: center;">
                                        <button type="submit" class="btn btn-info pull-leftt "> {{ _i('Save')}}</button>

{{--                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">--}}
{{--                                            {{_i('Change Password')}}--}}
{{--                                        </button> --}}
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_password">
                                            {{_i('Change Password')}}
                                        </button>
                                    </div>

                                </div>


                            </form>


                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>


@endsection
