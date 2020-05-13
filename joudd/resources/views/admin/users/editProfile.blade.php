


@extends('admin.layout.layout')

@section('title')

    {{_i('Edit User')}}
    {{$user->first_name}} {{ $user->last_name }}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Profile')}}
            {{--<small>{{_i('Control panel')}}</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li class="active"><a href="{{url('/admin/user/profile/'.$user->id.'/edit')}}">{{_i('Edit User')}} {{$user->first_name}} {{ $user->last_name }}</a></li>
        </ol>
    </section>


@endsection




@section('content')


    <div class="box box-info">
        <div class="box-header">
            {{--<h3 class="box-title">Edit User {{$user->name}}</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <form method="post" action="{{url('/admin/user/'.$user->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-xs-4 control-label">{{ _i('First Name') }}</label>

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
                    <label for="name" class="col-xs-4 control-label">{{ _i('Last Name') }}</label>

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
                    <label for="password" class="col-xs-4 control-label">{{ _i('Password :') }}</label>

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
                    <label for="password" class="col-xs-4 control-label">{{ _i('Confirm Password :') }}</label>

                    <div class="col-xs-6">
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" >

                        @if ($errors->has('password'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>





                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> {{ _i('Save')}}</button>
                </div>
                <!-- /.box-footer -->

            </form>



        </div>

    </div>



@endsection






@section('footer')





@endsection
