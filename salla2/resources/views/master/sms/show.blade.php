
@extends('master.layout.index',[
'title' => _i('Sms Reservation') . ' ' . ($sms->store->title),
'subtitle' => _i('Sms Reservation') . ' ' . ($sms->store->title),
'activePageName' => _i('Sms Reservation'),
'additionalPageUrl' => url('/master/sms_reservations') ,
'additionalPageName' => _i('All'),

] )

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 20px !important;">
                    <h5> {{ _i('Sms Reservation') . ' ' . ($sms->store->title) }} </h5>
                    @if($sms->status == 0)
                        <div class="card-header-right mr-4">
                            <a href="{{ route('SmsReservation.approve', $sms->id) }}"
                               class="btn btn-primary">{{ _i('Approve') }}</a>
                        </div>
                    @endif
                </div>
                <div class="card-block">
                    <div class="content">
                        @if($sms->status == 1)
                            <div class="alert alert-primary text-center">
                                <p>{{ _i('Approved') }}</p>
                            </div>
                        @endif

                        <div class="form-group row">

                            <label for="sender_name"
                                   class="col-sm-6"> {{_i('Name Of The Sender')}} </label>
                            <div class="col-sm-6">
                                {{ $sms->sender_name }}
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="sender_ad_name"
                                   class="col-sm-6 col-form-label"> {{_i('Sender Ad Name')}} </label>

                            <div class="col-sm-6">
                                {{ $sms->sender_ad_name }}
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="company_name"
                                   class="col-sm-6 col-form-label"> {{_i('Company Name')}} </label>

                            <div class="col-sm-6">
                                {{ $sms->company_name }}
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="commercial_register"
                                   class="col-sm-6 col-form-label"> {{_i('Commercial Registration No')}} </label>

                            <div class="col-sm-6">
                                {{ $sms->commercial_register }}
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="store_owner_name"
                                   class="col-sm-6 col-form-label"> {{_i('Delegate Name')}} </label>

                            <div class="col-sm-6">
                                {{ $sms->store_owner_name }}
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="store_title"
                                   class="col-sm-6 col-form-label"> {{_i('Delegate Title')}} </label>

                            <div class="col-sm-6">
                                {{ $sms->store_title }}
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <div class="col-md-4">
                                <a href="{{ asset($sms->ad_name) }}"
                                   class="btn btn-primary text-wrap">{{ _i('Letter of registration of the advertiser') }}</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ asset($sms->general_name) }}"
                                   class="btn btn-primary">{{ _i('General sender name registration letter') }}</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ asset($sms->commercial_register_file) }}"
                                   class="btn btn-primary">{{ _i('Commercial Register') }}</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

