@extends('front.layout.index')

@section('title')

    {{ _i('My Profile') }}

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

                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            @if(!empty($notification->data['subject']))
                                                <h5 class="card-title">{{ $notification->data['subject'] }}</h5>
                                            @endif
                                            @if(!empty($notification->data['order']))
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $notification->data['order'] }}</h6>
                                            @endif
                                            <p class="card-text">
                                                @php

                                                    if(!empty($notification->data['subject']) && !empty($notification->data['order'])) {
                                                        $search  = array("{userFirstName}","{userLastName}" ,"{userEmail}","{siteName}","{order}");
                                                        $replace = array(auth()->user()->first_name, auth()->user()->last_name, auth()->user()->email,setting()->title, $notification->data['order']);

                                                        $output = str_replace($search, $replace, $notification->data['body']);
                                                    }
                                                    $output = $notification->data['body'];

                                                @endphp

                                                {!!  $output !!}
                                            </p>
                                            @if($notification->read_at == null)
                                                <a href="{{ route('userReadNotify', $notification->id) }}"
                                                   class="card-link">{{ _i('Mark As Read') }}</a>
                                            @endif

                                            <a href="{{ route('userDeleteNotify', $notification->id) }}"
                                               class="card-link">{{ _i('Delete') }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-danger">
                                    <p class="lead">{{ _i('No Notifications') }}</p>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('css')
    <style>
        .custom-file-label.id-photo::after {
        . grade;
            content: {{_i('Insert Identity Image')}};
        }
    </style>
@endpush

@push('js')

    <script>
        $('#none').on('click', function () {
            $('#send_email').prop('checked', false);
            $('#send_sms').prop('checked', false);
        });
        $('#send_email').on('click', function () {
            $('#none').prop('checked', false);
        });
        $('#send_sms').on('click', function () {
            $('#none').prop('checked', false);
        });
        $(function () {
            'use strict';
            $('#country').on('change', function (e) {
                var country_id = $(this).val();
                $.ajax({
                    url: '{{ route('getCallCode') }}',
                    DataType: 'json',
                    type: 'get',
                    data: {country_id: country_id},
                    success: function (res) {
                        if (res[0] == true) {
                            $('.call_code').val(res[1]);
                        } else {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Error Happened Please Try Again') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                    }
                })
            });
        });

        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('getCityList')}}",
                    DataType: 'json',
                    data: {countryID: countryID},
                    success: function (res) {
                        if (res[0] == true) {
                            console.log(res[1]);
                            $("#city").css('display', 'flex');
                            $("#city_id").empty();
                            $("#city_id").append('<option>{{ _i('select') }}</option>');
                            $.each(res[1], function (key, value) {
                                $("#city_id").append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        } else {
                            $("#city").css('display', 'none');
                        }
                    }
                });
            } else {
                $("#city").css('display', 'none');
            }
        });
    </script>


@endpush
