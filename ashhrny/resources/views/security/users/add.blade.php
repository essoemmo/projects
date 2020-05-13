@extends('admin.layout.index',[
'title' => _i('Add User'),
'subtitle' => _i('Add User'),
'activePageName' => _i('Add User'),
'additionalPageUrl' => url('/admin/user/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Add User') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ \LaravelLocalization::localizeURL('/admin/user/add') }}"
                          class="form-horizontal" id="demo-form" data-parsley-validate="">
                        @csrf
                        @honeypot {{--prevent form spam--}}


                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ _i('First Name :') }}</label>

                                <div class="col-sm-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           name="first_name" value="{{ old('first_name') }}"
                                           placeholder=" {{_i('First Name')}}" required="">

                                    @if ($errors->has('first_name'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ _i('Last Name :') }}</label>

                                <div class="col-sm-6">
                                    <input type="text"
                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           name="last_name" value="{{ old('last_name') }}"
                                           placeholder=" {{_i('Last Name')}}" data-parsley-maxlength="191">

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
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" placeholder=" Email" required=""
                                           data-parsley-maxlength="191">

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
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" placeholder="{{_i('Password')}}" required=""
                                           data-parsley-maxlength="191">

                                    @if ($errors->has('password'))
                                        <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-sm-2 control-label">{{ _i('Confirm Password :') }}</label>

                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="{{_i('Confirm Password')}}" min="6"
                                           data-parsley-min="6" data-parsley-equalto="#password" required="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-sm-2 control-label">{{ _i('Mobile') }}</label>

                                <div class="col-sm-6">
                                    <input type="number"
                                           class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                           name="mobile" value="{{old('mobile')}}" data-parsley-maxlength="15">

                                    @if ($errors->has('mobile'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>


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
