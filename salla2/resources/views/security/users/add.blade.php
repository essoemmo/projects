@extends('admin.AdminLayout.index')

@section('title')

    {{_i('Add ').$type}}

@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Add ').$type}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/'.$redirect_url.'/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/'.$redirect_url.'/create')}}">{{_i('Add')}}</a></li>
@endsection



@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Add ').$type}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{url('/adminpanel')}}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Add User')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
        <form method="POST" action="{{ url('/adminpanel/'.$redirect_url.'/add') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">
                <div class="form-group row">
                <label for="name" class="col-sm-4 control-label" >{{ _i('Name :') }}</label>

                <div class="col-sm-6">
                    <input id="name" type="text"  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder=" {{_i(' First Name')}}" required="">

                    @if ($errors->has('name'))
                        <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 control-label" >{{ _i('Last Name') }}</label>

                    <div class="col-sm-6">
                        <input  type="text"  class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}"  placeholder=" {{_i('Last Name')}}" data-parsley-maxlength="191">

                        @if ($errors->has('lastname'))
                            <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>

            <div class="form-group row">
                <label for="email" class="col-sm-4 control-label">{{ _i('E-Mail Address :') }}</label>

                <div class="col-sm-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder=" {{_i('Email')}}" required="">

                    @if ($errors->has('email'))
                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('email') }}</strong>
                         </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 control-label">{{ _i('Password :') }}</label>

                <div class="col-sm-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{_i('Password')}}" required="">

                    @if ($errors->has('password'))
                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-sm-4 control-label">{{ _i('Confirm Password :') }}</label>

                <div class="col-sm-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{_i('Confirm Password')}}" required="">
                </div>
            </div>

            {{--<div class="form-group row" >--}}

                 {{--<label class="col-sm-4 control-label"> Roles </label>--}}
                    {{--<div class="checkbox" style="margin-right: 3%;">--}}
                        {{--@foreach(\Spatie\Permission\Models\Role::all() as  $role)--}}
                            {{--<label>--}}
                                {{--<input type="checkbox" name="roles[]">--}}
                                {{--{{$role->name}}--}}
                            {{--</label>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}

            {{--</div>--}}


                @if($type == "Admin"  )
                <div class="form-group row">
                    <label for="password" class="col-sm-4 control-label">{{ _i('Rolles') }}</label>

                    <div class="col-sm-6">

                        <select class="form-control{{ $errors->has('roles[]') ? ' is-invalid' : '' }}" name="roles[]" required="">

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
                @endif





          </div>


            <!-- /.box-body -->
            <div class="box-footer">
                {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                <button type="submit" class="btn btn-info "> {{ _i('Add') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>
    </div>






@endsection






@section('footer')





@endsection
