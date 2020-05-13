@extends('admin.layout.index',[
'title' => _i('Send Users Notifications Or Email'),
'activePageName' => _i('Send Users Notifications Or Email'),
] )


@section('content')

    @include('admin.layout.session')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Send Users Notifications Or Email') }}</h5>
        </div>
        <div class="card-block">
            <form action="{{ route('sendUsersNotiStore') }}" method="post" data-parsley-validate>
                @csrf
                @honeypot {{--prevent form spam--}}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ _i('Message') }}</label>
                    <div class="col-sm-10">
                    <textarea name="message" required class="form-control ckeditor"
                              placeholder="{{ _i('Type Your Message') }}"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ _i('Send Method') }}</label>
                    <div class="col-sm-10">
                        <select name="type[]" required multiple data-actions-box="true"
                                title="{{ _i('Choose one of the following...') }}" id="send_method"
                                class="selectpicker form-control">
                            <option value="notify">{{ _i('Notification') }}</option>
                            <option value="email">{{ _i('Email') }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">{{ _i('Select Users') }}</label>
                    <div class="col-sm-10">
                        <select name="users[]" multiple required id="users" data-live-search="true"
                                title="{{ _i('Choose one of the following...') }}"
                                class="selectpicker form-control" data-actions-box="true">
                            @foreach($users as $user)
                                <option
                                    value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit"
                                class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

