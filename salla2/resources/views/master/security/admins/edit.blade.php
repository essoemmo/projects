@extends('master.layout.index',[
'title' => _i('Edit Admin'),
'subtitle' => _i('Edit Admin'),
'activePageName' => _i('Edit Admin'),
'additionalPageUrl' => url('/master/admin/all') ,
'additionalPageName' => _i('All'),
] )


{{--<!-- =============================== Model Body password div ============================================== -->--}}


<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{_i('Change Password')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('/admin/changepassword/'.$user->id)}}" class="form-horizontal"  data-parsley-validate="">
                @csrf

                <div class="modal-body">

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 control-label">{{ _i('Change Password') }}</label>

                        <div class="col-sm-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                   value="{{old('password')}}" required="" min="6" data-parsley-min="6" placeholder="{{_i('Change Password')}}">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 control-label">{{ _i('Confirm Password') }}</label>

                        <div class="col-sm-8">
                            <input type="password" name="password_confirmation"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   value="{{old('password_confirmation')}}" required=""  min="6" data-parsley-min="6" data-parsley-equalto="#password" placeholder="{{_i('Confirm Password')}}">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">{{_i('Close')}}</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light "> {{_i('Save')}} </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--<!------================ end passwor div =================--->--}}

@section('content')
    <!-- Page-body start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Admin') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">


                    <form method="post" action="{{url('/master/admin/'.$user->id.'/edit')}}" class="form-horizontal"   data-parsley-validate="">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">{{ _i('First Name') }}</label>

                            <div class="col-sm-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required="" data-parsley-maxlength="191">

                                @if ($errors->has('name'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 control-label">{{ _i('Last Name') }}</label>

                            <div class="col-sm-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" data-parsley-maxlength="191">

                                @if ($errors->has('lastname'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('E-Mail Address') }}</label>

                            <div class="col-sm-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required="" data-parsley-maxlength="191">

                                @if ($errors->has('email'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('Mobile') }}</label>

                            <div class="col-sm-6">
                                <input  type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$user->phone}}" data-parsley-maxlength="15">

                                @if ($errors->has('phone'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        {{--                <div class="form-group row">--}}
                        {{--                    <label for="password" class="col-sm-2 control-label">{{ _i('Password') }}</label>--}}

                        {{--                    <div class="col-sm-6">--}}
                        {{--                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >--}}

                        {{--                        @if ($errors->has('password'))--}}
                        {{--                            <span class="text-danger invalid-feedback" role="alert">--}}
                        {{--                                  <strong>{{ $errors->first('password') }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                        @endif--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}


                        {{--                <div class="form-group row">--}}
                        {{--                    <label for="password" class="col-sm-2 control-label">{{ _i('Confirm Password') }}</label>--}}

                        {{--                    <div class="col-sm-6">--}}
                        {{--                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" >--}}

                        {{--                        @if ($errors->has('password'))--}}
                        {{--                            <span class="text-danger invalid-feedback" role="alert">--}}
                        {{--                                 <strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                        {{--                            </span>--}}
                        {{--                        @endif--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 control-label">{{ _i('Rolles') }}</label>

                            <div class="col-sm-6">

                                <select class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles" required="">

                                    @foreach($roles as $role)
                                        <option   value="{{$role->id}}"{{($user->hasRole($role->name)) ? 'selected':''}} > {{$role->name}} </option>
                                    @endforeach

                                    @if ($errors->has('roles'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roles')}}</strong>
                                </span>
                                    @endif

                                </select>

                            </div>
                        </div>


                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary"> {{ _i('Save')}}</button>

                            <!-- Modal static-->
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#default-Modal">{{_i('Change Password')}}</button>

                        </div>
                        <!-- /.box-footer -->

                    </form>



                </div>

            </div>
        </div>

    </div>


@endsection


