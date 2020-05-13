


@extends('admin.layout.layout')

@section('title')

    {{_i('Edit User')}}
    {{$user->name}}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Users')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/user/all')}}">{{_i('All Users')}}</a></li>
            <li class="active"><a href="{{url('/admin/users/'.$user->id.'/edit')}}">{{_i('Edit User')}}</a></li>
        </ol>
    </section>


@endsection


@section('content')

        <!-- =============================== Model Body password div ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times;</span></button>
                    <h4 class="modal-title">{{_i('Change Password')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/admin/user/'.$user->id.'/update_password')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="box-body">
                            <!-- ================================== password =================================== -->

                            <div class="form-group row">

                                <label for="name" class="col-xs-4 control-label" >{{_i('Password :')}}</label>
                                <div class="col-xs-7">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                           placeholder="" required="" min="6" data-parsley-min="6" >
                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="name" class="col-xs-4 control-label" >{{_i('Confirm Password :')}}</label>
                            <div class="col-xs-7">
                                <input type="password" name="password_confirmation"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       placeholder="" required=""  min="6" data-parsley-min="6" data-parsley-equalto="#password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- ================================Submit==================================== -->
                        <div class="modal-footer">
                            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('save')}}</button>

                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('close')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!------================ end passwor div =================--->

    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">{{_i('Edit User')}} {{$user->name}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="post" action="{{url('/admin/user/'.$user->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf

                <div class="form-group row">
                    <label for="first_name" class="col-xs-4 control-label">{{ _i('First Name') }}</label>

                    <div class="col-xs-6">
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->first_name }}" required="">

                        @if ($errors->has('first_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-xs-4 control-label">{{ _i('Last Name') }}</label>

                    <div class="col-xs-6">
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $user->last_name }}" required="">

                        @if ($errors->has('last_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div class="form-group row">
                    <label for="email" class="col-xs-4 control-label">{{ _i('Email Address :') }}</label>

                    <div class="col-xs-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required="">

                        @if ($errors->has('email'))
                            <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-xs-4 control-label">{{ _i('Rolle :') }}</label>

                    <div class="col-xs-6">

                        <select class="form-control{{ $errors->has('roles[]') ? ' is-invalid' : '' }}" name="roles[]" required="">

                            <option value="" disabled selected>{{_i('Choose')}}</option>
                            @foreach($roles as $role)
                                <option   value="{{$role->id}}"{{($user->hasRole($role->name)) ? 'selected':''}} > {{$role->name}} </option>
                            @endforeach

                            @if ($errors->has('roles[]'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roles[]')}}</strong>
                                </span>
                            @endif

                        </select>

                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> {{ _i('Save')}}</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                        {{_i('Change Password')}}
                    </button>
                </div>
                <!-- /.box-footer -->

            </form>



        </div>

    </div>

@endsection

@section('footer')

@endsection
