@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Sms Setting')}}
@endsection


@section('content')

    {{--    Store settings--}}
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Sms Settings')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Settings')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h5>{{ _i('Sms Settings') }}</h5>
                    </div>
                    <div class="card-block">
                        <div class="">
                            <form action="{{ route('sms.store') }}" method="post" class="j-forms" id="sms_store"
                                  data-parsley-validate="" enctype="multipart/form-data">

                                @csrf

                                <div class="content">

                                    <div class="divider-text gap-top-20 gap-bottom-45">
                                        <span>{{ _i('SMS') }}</span>
                                    </div>

                                    <div class="form-group row">

                                        <label for="sender_name"
                                               class="col-sm-2 col-form-label"> {{_i('Name Of The Sender')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control" name="sender_name"
                                                   required
                                                   id="sender_name" placeholder="{{_i('Name Of The Sender')}}"
                                                   value="{{old('name', $smsReservation->sender_name ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('name')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label for="sender_ad_name"
                                               class="col-sm-2 col-form-label"> {{_i('Sender Ad Name')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control"
                                                   name="sender_ad_name" required
                                                   id="sender_ad_name" placeholder="{{_i('Sender Ad Name')}}"
                                                   value="{{old('sender_ad_name', $smsReservation->sender_ad_name ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('sender_ad_name')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label for="company_name"
                                               class="col-sm-2 col-form-label"> {{_i('Company Name')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control" name="company_name"
                                                   required
                                                   id="company_name" placeholder="{{_i('Company Name')}}"
                                                   value="{{old('company_name', $smsReservation->company_name ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('company_name')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label for="commercial_register"
                                               class="col-sm-2 col-form-label"> {{_i('Commercial Registration No')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control"
                                                   name="commercial_register" required
                                                   id="commercial_register"
                                                   placeholder="{{_i('Commercial Registration No')}}"
                                                   value="{{old('commercial_register', $smsReservation->commercial_register ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('commercial_register')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label for="store_owner_name"
                                               class="col-sm-2 col-form-label"> {{_i('Delegate Name')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control"
                                                   name="store_owner_name" required
                                                   id="store_owner_name" placeholder="{{_i('Delegate Name')}}"
                                                   value="{{old('store_owner_name', $smsReservation->store_owner_name ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('store_owner_name')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label for="store_title"
                                               class="col-sm-2 col-form-label"> {{_i('Delegate Title')}} </label>

                                        <div class="col-sm-10">
                                            <input type="text" form="sms_store" class="form-control" name="store_title"
                                                   required
                                                   id="store_title" placeholder="{{_i('Delegate Title')}}"
                                                   value="{{old('store_title', $smsReservation->store_title ?? '')}}"
                                                   data-parsley-length="[3, 191]">

                                            <span class="text-danger invalid-feedback">
                                                <strong>{{$errors->first('store_title')}}</strong>
                                            </span>

                                        </div>
                                    </div>

                                    @if($smsReservation == null)
                                        <button type="button"
                                                class="btn btn-primary generateDocs text-center mb-3">{{ _i('Save') }}</button>
                                    @elseif ($smsReservation->status == 0)

                                        <div class="alert alert-danger text-center">
                                            <p>{{ _i('Pending Approval, Once Approve Cannot Change Data') }}</p>
                                        </div>
                                    @else
                                        <div class="alert alert-primary text-center">
                                            <p>{{ _i('Approved, To Change data Contact with Administration') }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group row">

                                        <div class="col-sm-12">

                                            <div class="downloadLetters" style="display: none">
                                                <div class="divider-text gap-top-20 gap-bottom-45">
                                                    <span>{{ _i('Download letters') }}</span>
                                                </div>

                                                <p class="px-4 text-danger">
                                                    {{ _i('Please download the following letters, sign and stamp them with the official seal of the facility, in addition to signing for the next step') }}
                                                </p>
                                                <ul class="m-b-0 px-4 list-group">
                                                    <li class="p-t-0 mb-2">
                                                        <a href="{{ asset('uploads/sms/' . $store_id . '/smsGeneralName.docx') ?? '' }}"
                                                           download="">
                                                            {{ _i('General sender name registration letter') }}</a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a href="{{ asset('uploads/sms/' . $store_id . '/smsAdName.docx') ?? '' }}"
                                                           download="">{{ _i('Letter of registration letter of the advertiser') }}</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="col-sm-12">
                                            <div class="uploadLetters" style="display: none">
                                                <div class="divider-text gap-top-20 gap-bottom-45">
                                                    <span>{{ _i('Upload letters') }}</span>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-2 col-form-label">{{ _i('Letter of registration letter of the advertiser') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" required form="sms_store" name="adName"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-2 col-form-label">{{ _i('General sender name registration letter') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" required form="sms_store" name="generalName"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-2 col-form-label">{{ _i('Commercial Register') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" required form="sms_store"
                                                               name="commercialRegisterFile"
                                                               class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="footer" style="display: none">
                                    <button type="submit" form="sms_store"
                                            class="btn btn-primary text-center m-b-0">{{ _i('Save') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--Store settings--}}

@endsection


@push('js')

    <script !src="">
        $(function () {
            $('.generateDocs').on('click', function (e) {
                e.preventDefault();
                var sender_name = $('#sender_name').val();
                var sender_ad_name = $('#sender_ad_name').val();
                var company_name = $('#company_name').val();
                var commercial_register = $('#commercial_register').val();
                var store_owner_name = $('#store_owner_name').val();
                var store_title = $('#store_title').val();
                $.ajax({
                    url: "{{route('sms.generateDocs')}}",
                    type: "get",
                    data: {
                        sender_name: sender_name,
                        sender_ad_name: sender_ad_name,
                        company_name: company_name,
                        commercial_register: commercial_register,
                        store_owner_name: store_owner_name,
                        store_title: store_title,
                    },
                    dataType: 'json',

                    success: function (res) {
                        if (res.status == true) {
                            $('.downloadLetters').css('display', 'block');
                            $('.uploadLetters').css('display', 'block');
                            $('.generateDocs').css('display', 'none');
                            $('.footer').css('display', 'block');
                        }
                    }
                })
            });
        });
    </script>

@endpush

