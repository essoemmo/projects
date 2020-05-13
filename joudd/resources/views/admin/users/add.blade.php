
@extends('admin.layout.layout')

@section('title')

    {{_i('Add User')}}

    @endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Users')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/user/all')}}">{{_i('All Users')}}</a></li>
            <li class="active"><a href="{{url('/admin/user/create')}}">{{_i('Add User')}}</a></li>
        </ol>
    </section>


@endsection

@section('content')


    <div class="box box-info">
        <div class="box-header with-border" {{-- style="margin-bottom: 2%;"--}}>
            {{--<h3 class="box-title"> {{_i('User Form')}}</h3>--}}
        </div>
        <!-- /.box-header -->


        <form method="POST" action="{{ url('/admin/user/create') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">
                <div class="form-group">
                <label for="name" class="col-xs-4 control-label" >{{ _i('Name :') }}</label>

                <div class="col-xs-6">
                    <input id="name" type="text"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder=" Name" required="">

                    @if ($errors->has('name'))
                        <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-xs-4 control-label">{{ _i('E-Mail Address :') }}</label>

                <div class="col-xs-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder=" Email" required="">

                    @if ($errors->has('email'))
                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('email') }}</strong>
                         </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-xs-4 control-label">{{ _i('Password :') }}</label>

                <div class="col-xs-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder=" Password" required="">

                    @if ($errors->has('password'))
                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-xs-4 control-label">{{ _i('Confirm Password :') }}</label>

                <div class="col-xs-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder=" Confirm Password" required="">
                </div>
            </div>

                <div class="form-group row">
                    <label for="password" class="col-xs-4 control-label">{{ _i('Rolle :') }}</label>

                    <div class="col-xs-6">

                        <select class="form-control{{ $errors->has('roles[]') ? ' is-invalid' : '' }}" name="roles[]" required="">

                            <option value="" disabled selected> {{_i('Choose')}}</option>
                            @foreach($roles as  $role)
                                <option   value="{{$role->id}}" > {{$role->name}} </option>
                            @endforeach

                            @if ($errors->has('roles[]'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roles[]')}}</strong>
                                </span>
                            @endif

                        </select>

                    </div>
                </div>

          </div>

            <!-- /.box-body -->
            <div class="box-footer">
                {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                <button type="submit" class="btn btn-info "> {{ _i(' Add User') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>
@endsection
@section('footer')

@endsection
