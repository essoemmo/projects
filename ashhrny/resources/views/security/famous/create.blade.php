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
                    <form method="POST" action="{{ route('famousStore') }}" class="form-horizontal" id="demo-form"
                          data-parsley-validate="">
                        @csrf
                        @honeypot {{--prevent form spam--}}

                        <input type="hidden" name="user_type" value="famous">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ _i('First Name :') }}</label>
                                <div class="col-sm-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           name="first_name" required value="{{ old('first_name') }}"
                                           placeholder=" {{_i('First Name')}}">
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
                                           name="last_name" required value="{{ old('last_name') }}"
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
                                    <input id="email" type="email" required
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" placeholder="{{ _i('Email') }}"
                                           data-parsley-maxlength="191">
                                    @if ($errors->has('email'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cost"
                                       class="col-sm-2 control-label">{{ _i('The cost of advertising :') }}</label>
                                <div class="col-sm-6">
                                    <input id="cost" type="text" required
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="cost" value="{{ old('cost') }}"
                                           placeholder="{{ _i('The cost of advertising') }}"
                                           data-parsley-type="number">
                                    @if ($errors->has('cost'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(count($socialLinks) > 0)
                                @foreach($socialLinks as $social)

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">{{ $social->title }}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group custom-group row">
                                                <input type="url" data-parsley-type="url"
                                                       data-parsley-errors-container=".errorMessageFirst"
                                                       class="ml-3 form-control"
                                                       @if ($errors->has('social.' . $social->id)) style="border-color: #dc3545"
                                                       @endif placeholder="https://www.{{ $social->translate('en')->title }}.com"
                                                       name="social[{{ $social->id }}]">
                                                <input type="text" class="form-control"
                                                       placeholder="{{ _i('Content Type') }} {{ $social->title }}"
                                                       name="contentType[{{ $social->id }}]">
                                            </div>
                                        </div>
                                    </div>

                                    @if ($errors->has('social.' . $social->id))
                                        <div>
                                                    <span class="text-danger text-center invalid-feedback mb-3"
                                                          role="alert" style="display: block">
                                                       <strong>{{ _i('This URL Is Used Before') }}</strong>
                                                    </span>
                                        </div>
                                    @endif

                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    {{ _i('No Social Accounts') }}
                                </div>
                            @endif

                        </div>

                    {{--                        <div class="alert alert-danger text-center">--}}
                    {{--                            <p class="lead">{{ _i('User Will Receive Email With Generated Password') }}</p>--}}
                    {{--                        </div>--}}


                    <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary "> {{ _i('Create') }}</button>
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
