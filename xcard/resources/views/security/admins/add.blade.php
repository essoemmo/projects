@extends('admin.layout.index',[
'title' => _i('Add Admin'),
'subtitle' => _i('Add Admin'),
'activePageName' => _i('Add Admin'),
'additionalPageUrl' => url('/admin/admin/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Add Admin') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ url('/admin/admin/add') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                        @csrf

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label" >{{ _i('First Name :') }}</label>

                                <div class="col-sm-6">
                                    <input id="name" type="text"  class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}"  placeholder=" {{_i('First Name')}}" required="">

                                    @if ($errors->has('first_name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label" >{{ _i('Last Name :') }}</label>

                                <div class="col-sm-6">
                                    <input  type="text"  class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}"  placeholder=" {{_i('Last Name')}}" data-parsley-maxlength="191">

                                    @if ($errors->has('last_name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 control-label">{{ _i('E-Mail Address :') }}</label>

                                <div class="col-sm-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder=" Email" required="" data-parsley-maxlength="191">

                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('email') }}</strong>
                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 control-label">{{ _i('Password :') }}</label>

                                <div class="col-sm-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{_i('Password')}}" required="" data-parsley-maxlength="191">

                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-2 control-label">{{ _i('Confirm Password :') }}</label>

                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{_i('Confirm Password')}}" min="6" data-parsley-min="6" data-parsley-equalto="#password" required="" >
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
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 control-label">{{ _i('Mobile') }}</label>

                                <div class="col-sm-6">
                                    <input  type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{old('mobile')}}" data-parsley-maxlength="15">

                                    @if ($errors->has('mobile'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 control-label">{{ _i('Rolles') }}</label>

                                <div class="col-sm-6">

                                    <select class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required="">

                                        @foreach($roles as  $role)
                                            <option   value="{{$role->id}}" > {{$role->name}} </option>
                                        @endforeach

                                        @if ($errors->has('role'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role')}}</strong>
                                </span>
                                        @endif

                                    </select>

                                </div>
                            </div>
                            {{--<div class="form-group row ">--}}
                            {{--<label class="col-sm-4 control-label">--}}
                            {{--{{ _i('Roles :')}}  </label>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row row">--}}

                            {{--@foreach($roles as  $role)--}}
                            {{--<div class="col-sm-3">--}}

                            {{--<div class="checkbox checkbox-custom">--}}

                            {{--<label for="chk-91"> <input class="control-label" id="chk-91" type="checkbox" name="roles[]" value="{{$role->id}}" data-parsley-multiple="groups">--}}
                            {{--{{$role->name}}--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@endforeach--}}

                            {{--</div>--}}




                        </div>


                        <!-- /.box-body -->
                        <div class="box-footer">
                            {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                            <button type="submit" class="btn btn-primary "> {{ _i('Add') }}</button>
                        </div>
                        <!-- /.box-footer -->

                    </form>

                </div>


            </div>
        </div>

    </div>

@endsection






@section('footer')





@endsection
