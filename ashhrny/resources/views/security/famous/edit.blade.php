@extends('admin.layout.index',[
'title' => _i('Edit Famous'),
'subtitle' => _i('Edit Famous'),
'activePageName' => _i('Edit Famous'),
] )



@section('content')
    <!-- Page-body start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Famous') }} </h5>
                </div>
                <div class="card-block">

                    <form method="POST" action="{{ route('famousUpdate', $user->id) }}" class="form-horizontal"
                          id="demo-form"
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
                                           name="first_name" required value="{{ old('first_name', $user->first_name) }}"
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
                                           name="last_name" required value="{{ old('last_name', $user->last_name) }}"
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
                                           name="email" value="{{ old('email', $user->email) }}"
                                           placeholder="{{ _i('Email') }}"
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
                                           class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}"
                                           name="cost" value="{{ old('cost',$user->cost) }}"
                                           placeholder="{{ _i('The cost of advertising') }}"
                                           data-parsley-type="number">
                                    @if ($errors->has('cost'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
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

                            @if(count($user_social) == 0)
                                <form data-parsley-validate action="{{ route('accounts.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @if(count($socialLinks) > 0)

                                        @csrf

                                        @foreach($socialLinks as $social)

                                            <div class="form-group row">
                                                <label for=""
                                                       class="col-sm-2 col-form-label">{{ $social->title }}</label>
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

                                </form>

                            @else

                                @foreach($socialLinks as $social)
                                    @if(in_array($social->id,$user_social_array))
                                        @foreach($user_social as $link)
                                            @if($link->social_id == $social->id)

                                                <div class="form-group row">
                                                    <label for=""
                                                           class="col-sm-2 col-form-label">{{ $social->title }}</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group custom-group">
                                                            <input type="url" data-parsley-type="url"
                                                                   data-parsley-errors-container=".errorMessageFirst"
                                                                   class="ml-3 form-control"
                                                                   @if ($errors->has('social.' . $social->id)) style="border-color: #dc3545"
                                                                   @endif placeholder="https://www.{{ $social->translate('en')->title }}.com/profile_name"
                                                                   name="social[{{ $social->id }}]"
                                                                   value="{{ $link->url }}">
                                                            <input type="text" class="form-control"
                                                                   placeholder="{{ _i('Content Type') }} {{ $social->title }}"
                                                                   name="contentType[{{ $social->id }}]"
                                                                   value="{{ $link->content }}">
                                                            <div class="input-group-prepend"
                                                                 @if($link->default == 1) style="display: none" @endif>
                                                                <button class="btn btn-outline-dark famous-default_url"
                                                                        type="button"
                                                                        title="{{_i('Advertise now')}}">
                                                                    <input type="hidden" name="default_url"
                                                                           class="url" value="{{ $link->id }}">
                                                                    {{--<i class="fas fa-user" aria-hidden="true"></i>--}}
                                                                    {{ _i('Choose') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($errors->has('social.' . $social->id))
                                                    <span class="text-danger invalid-feedback" role="alert"
                                                          style="display: block">
                                                           <strong>{{ _i('This URL Is Used Before') }}</strong>
                                                        </span>
                                                @endif

                                            @endif

                                        @endforeach

                                    @else

                                        <div class="form-group row">
                                            <label for=""
                                                   class="col-sm-2 col-form-label">{{ $social->title }}</label>
                                            <div class="col-sm-10">
                                                <div class="input-group custom-group">
                                                    <input type="url" data-parsley-type="url"
                                                           data-parsley-errors-container=".errorMessageFirst"
                                                           class="ml-3 form-control"
                                                           @if ($errors->has('social.' . $social->id)) style="border-color: #dc3545"
                                                           @endif placeholder="https://www.{{ $social->translate('en')->title }}.com/profile_name"
                                                           name="social[{{ $social->id }}]">
                                                    <input type="text" class="form-control"
                                                           placeholder="{{ _i('Content Type') }} {{ $social->title }}"
                                                           name="contentType[{{ $social->id }}]">
                                                </div>

                                            </div>

                                        </div>
                                        @if ($errors->has('social.' . $social->id))
                                            <span class="text-danger invalid-feedback" role="alert"
                                                  style="display: block">
                                                       <strong>{{ _i('This URL Is Used Before') }}</strong>
                                                    </span>
                                        @endif

                                    @endif

                                @endforeach
                        </div>

                    @endif

                    {{--                        <div class="alert alert-danger text-center">--}}
                    {{--                            <p class="lead">{{ _i('User Will Receive Email With Generated Password') }}</p>--}}
                    {{--                        </div>--}}


                    <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary "> {{ _i('Update') }}</button>
                        </div>
                        <!-- /.box-footer -->

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection

@push('js')

    <script>
        $('.famous-default_url').on('click', function () {
            var id = '{{ $user['id'] }}';
            $.ajax({
                url: '{{ route('famousDefaultUrl') }}',
                DataType: 'json',
                method: 'GET',
                data: {_token: '{{ csrf_token() }}', id: id},
                success: function (res) {
                    if (res == true) {
                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Default Account Changed Successfully') }}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            })
        })
    </script>

@endpush


