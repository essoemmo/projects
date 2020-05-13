@extends('admin.AdminLayout.index')

@section('title')

    {{_i('Edit User')}}
    {{$user->name}}

@endsection



@section('header')


@endsection



@section('page_header_name')
    {{_i('Edit User')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/user/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/store/'.$user->id.'/edit')}}">{{_i('Edit')}}</a></li>
@endsection


{{--<!-- =============================== Model Body password div ============================================== -->--}}
{{----}}
{{--<div class="modal fade" id="modal-default">--}}
{{--<div class="modal-dialog">--}}
{{--<div class="modal-content">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--<span aria-hidden="true">&times;</span></button>--}}
{{--<h4 class="modal-title">Default Modal</h4>--}}
{{--</div>--}}
{{--<div class="modal-body">--}}

{{--<form method="post" action="{{url('/adminpanel/user/profile/password')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">--}}
{{--@csrf--}}


{{--<div class="form-group row">--}}
{{--<label for="name" class="col-xs-4 control-label">{{ _i('Change Password') }}</label>--}}

{{--<div class="col-xs-8">--}}
{{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"--}}
{{--value="{{old('password')}}" required="" min="6" data-parsley-min="6" placeholder="{{_i('Change Password')}}">--}}

{{--@if ($errors->has('name'))--}}
{{--<span class="text-danger invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('name') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="name" class="col-xs-4 control-label">{{ _i('Confirm Password') }}</label>--}}

{{--<div class="col-xs-8">--}}
{{--<input type="password" name="password_confirmation"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"--}}
{{--value="{{old('password_confirmation')}}" required=""  min="6" data-parsley-min="6" placeholder="{{_i('Confirm Password')}}">--}}

{{--@if ($errors->has('name'))--}}
{{--<span class="text-danger invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('name') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--</form>--}}
{{--</div>--}}

{{--<div class="modal-footer">--}}
{{--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{_i('Close')}}</button>--}}
{{--<button  class="btn btn-info" type="submit" id="s_form_1">{{_i('Save')}}</button>--}}
{{--</div>--}}

{{--</div>--}}
{{--<!-- /.modal-content -->--}}
{{--</div>--}}
{{--<!-- /.modal-dialog -->--}}
{{--</div>--}}
{{--<!-- /.modal -->--}}

{{--<!------================ end passwor div =================--->--}}



@section('content')


    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">{{_i('Edit store') }} {{ $user->name}}</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">





                {{Form::model($user->id,['method'=>'put','route'=>['store.update',$user->id],'class'=>'from-horizontal'])}}
            @csrf


                <div class="form-group row">
                    <label for="name" class="col-xs-4 control-label">{{ _i('Name') }}</label>

                    <div class="col-xs-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required="">

                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-xs-4 control-label">{{ _i('E-Mail Address') }}</label>

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
                    <label for="password" class="col-xs-4 control-label">{{ _i('Password') }}</label>

                    <div class="col-xs-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                        @if ($errors->has('password'))
                            <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="password" class="col-xs-4 control-label">{{ _i('Confirm Password') }}</label>

                    <div class="col-xs-6">
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" >

                        @if ($errors->has('password'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            <div class="form-group row">
                <label for="password" class="col-xs-4 control-label">{{ _i('Rolles') }}</label>

                <div class="col-xs-6">

                    <select class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles" required="">
                        <option value="">اختر ...</option>
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

                    <button type="submit" class="btn btn-info pull-leftt"> {{ _i('Save')}}</button>

                    {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">--}}
                    {{--{{_i('Change Password')}}--}}
                    {{--</button>--}}

                </div>
                <!-- /.box-footer -->

            {{Form::close()}}



        </div>

    </div>



@endsection






@section('footer')





@endsection
