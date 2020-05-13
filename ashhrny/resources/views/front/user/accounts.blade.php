@extends('front.layout.index')

@section('title')

    {{ _i('My Accounts') }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="{{ _i('Home') }}"
                                               href="{{ route('home') }}">  {{ _i('Home') }} </a></li>
                <li class="breadcrumb-item active" title="{{ _i('My Profile') }}"
                    aria-current="page">{{ _i('My Profile') }}</li>
            </ol>
        </div>
    </nav>

    <div class="user-page py-3">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    @include('front.user.includes.sideMenu')
                </div>
                <div class="col-md-9">

                    <div class="card  border-0">
                        <div class="card-header shadow-sm">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}
                                : {{ membership_number($user->membership_number) }}</div>
                        </div>

                        <div class="card-body">
                            @if(count($user->userSocial) == 0)
                                <p class="text-center text-danger">{{ _i('Enter your accounts and achieve followers and high views') }}</p>
                            @endif
                            @if($user_default == null)
                                <p class="text-center text-danger">{{ _i('Please choose an account to advertise') }}</p>
                            @endif
                            @if(count($user_social) == 0)
                                <form data-parsley-validate action="{{ route('accounts.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @if(count($socialLinks) > 0)

                                        @csrf

                                        @honeypot {{--prevent form spam--}}

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

                                        <div class="text-left">
                                            <input type="submit" class="btn grade m-2" value="{{_i('Save')}}">
                                        </div>

                                    @else
                                        <div class="alert alert-danger">
                                            {{ _i('No Social Accounts') }}
                                        </div>
                                    @endif

                                </form>

                            @else

                                <form data-parsley-validate action="{{ route('accounts.update') }}" method="POST"
                                      enctype="multipart/form-data">

                                    @csrf

                                    @foreach($socialLinks as $social)
                                        @if(in_array($social->id,$user_social_array))

                                            @foreach($user_social as $link)
                                                @if($link->social_id == $social->id)

                                                    <div class="form-group row">
                                                        <label for=""
                                                               class="col-sm-3 col-form-label">{{ $social->title }}</label>
                                                        <div class="col-sm-9">
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
                                                                    <button class="btn btn-outline-dark default_url"
                                                                            type="button"
                                                                            title="{{_i('Advertise now')}}">
                                                                        <input type="hidden" name="default_url"
                                                                               class="url" value="{{ $link->id }}">
                                                                        {{--                                                                            <i class="fas fa-user" aria-hidden="true"></i>--}}
                                                                        {{ _i('Advertise Now') }}
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
                                                       class="col-sm-3 col-form-label">{{ $social->title }}</label>
                                                <div class="col-sm-9">
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

                                    <div class="text-left">
                                        <input type="submit" class="btn grade m-2" value="{{_i('Save')}}">
                                    </div>

                                </form>

                            @endif
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $('.default_url').on('click', function () {
            var id = $(this).children('.url').val();
            $.ajax({
                url: '{{ route('changeUrl') }}',
                method: 'GET',
                DataType: 'json',
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
