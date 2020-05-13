@extends('admin.layout.index',[
'title' => _i('Edit Member'),
'subtitle' => _i('Edit Member'),
'activePageName' => _i('Edit Member'),
] )




@section('content')
    <!-- Page-body start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Member') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">


                    <form method="post"
                          action="{{ \LaravelLocalization::localizeURL('/admin/user/'.$user->id.'/edit') }}"
                          class="form-horizontal" data-parsley-validate="">
                        @csrf

                        @honeypot {{--prevent form spam--}}


                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">{{ _i('First Name') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $user['first_name'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 control-label">{{ _i('Last Name') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $user['last_name'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('E-Mail Address') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $user->email }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('Mobile') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $user['mobile'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('Job') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $user['job_type'] }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">{{ _i('Country') }} :</label>
                            <label for="name" class="col-sm-4 control-label">{{ $country['title'] }}</label>
                        </div>

                        <div class="row form-group">
                            <label class="col-sm-2 control-label">{{ _i('Status') }} :</label>
                            <div class="col-sm-10">
                                <div class="form-radio">

                                    <div class="radio radiofill radio-primary radio-inline">
                                        <label>
                                            <input type="radio" name="status"
                                                   value="1" {{$user['status'] == 1 ? "checked" : ""}} >
                                            <i class="helper"></i>{{ _i('Active') }}
                                        </label>
                                    </div>
                                    <div class="radio radiofill radio-primary radio-inline">
                                        <label>
                                            <input type="radio" name="status"
                                                   value="0" {{$user['status'] == 0 ? "checked" : ""}}>
                                            <i class="helper"></i>{{ _i('Not Active') }}
                                        </label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"> {{ _i('Save')}}</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>

                </div>

            </div>
        </div>

    </div>


@endsection


