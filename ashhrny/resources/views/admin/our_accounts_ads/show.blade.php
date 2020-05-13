@extends('admin.layout.index',[
'title' => _i('All Orders'),
'subtitle' => _i('All Orders'),
'activePageName' => _i('Add Orders'),
'additionalPageUrl' => url('/admin/panel/orders') ,
'additionalPageName' => _i('All'),
] )
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <a href="{{aUrl('orders/'.$order->id.'/delete') }}">
                        <button type="button" class="btn btn-block btn-danger">
                            <i class="fa fa-trash"></i> {{ _i(__('Delete')) }}
                        </button>
                    </a>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-primary print-btn">
                        <i class="fa fa-print"></i> {{ _i('Print') }}</button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-info" data-toggle="modal"
                            data-target="#notification">
                        <i class="fa fa-bell"></i> {{ _i('Send Notification') }}</button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#email">
                        <i class="fa fa-bell"></i> {{ _i('Send Email') }}</button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('admin.site_ads.includes.model')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card" id="print-area">
                        <div class="card-header">
                            <h5 class="card-title">{{ _i('Order No') }} : #{{ $order->orderNumber }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{_i('Customer Details')}}</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: 1%;">
                                                                    <button data-toggle="tooltip" title="Customer"
                                                                            class="btn btn-primary btn-xs"><i
                                                                            class="ti-user"></i></button>
                                                                </td>
                                                                <td>
                                                                    @if($user->first_name != null && $user->last_name != null)
                                                                        {{$user->first_name}} {{$user->last_name}}
                                                                    @else
                                                                        {{ $user->email }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 1%;">
                                                                    <button data-toggle="tooltip" title="Email"
                                                                            class="btn btn-primary btn-xs"><i
                                                                            class="ti-email"></i></button>
                                                                </td>
                                                                <td>
                                                                    {{ $user->email }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 1%;">
                                                                    <button data-toggle="tooltip" title="membership no"
                                                                            class="btn btn-primary btn-xs"><i
                                                                            class="fa fa-wpforms"></i></button>
                                                                </td>
                                                                <td>
                                                                    {{ membership_number($user->membership_number) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Mobile"
                                                                            class="btn btn-primary btn-xs"><i
                                                                            class="ti-mobile"></i></button>
                                                                </td>
                                                                <td>
                                                                    @if($user->mobile != null)
                                                                        {{ str_replace('+', '00', country_call_code()) . $user->mobile }}</td>
                                                                @else
                                                                    {{ _i('No Mobile') }}
                                                                @endif
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div>
                                                    <input type="hidden" name="order_id" class="order_id"
                                                           value="{{ $order->id }}">
                                                    <input type="hidden" name="famous_ad_id" class="famous_ad_id"
                                                           value="{{ $famous_ad->id }}">
                                                    <label for="status">{{ _i('Order Status') }}</label>
                                                    <select name="status" id="status"
                                                            class="form-control hide_print pull-right mb-3">
                                                        <option @if($order->status == 'wait') selected
                                                                @endif value="wait">{{ _i('wait') }}</option>
                                                        <option @if($order->status == 'refused') selected
                                                                @endif value="refused">{{ _i('refused') }}</option>
                                                        <option @if($order->status == 'accepted') selected
                                                                @endif value="accepted">{{ _i('accepted') }}</option>
                                                        {{--                                                            <option @if($order->status == 'delivered') selected @endif value="delivered">{{ _i('delivered') }}</option>--}}
                                                    </select>
                                                    <span class="show_print"
                                                          style="display: none;">{{ $order->status }}</span>
                                                </div>
                                                <div id="publish"
                                                     @if($order->status == 'accepted' && $famous_ad->publish == 0) style="display: block"
                                                     @else style="display: none" @endif>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-outline-primary"
                                                       id="accept">{{ _i('Accept Ad') }}</a>
                                                    <div class="loader-block" style="display: none">
                                                        <svg id="loader2" viewBox="0 0 100 100">
                                                            <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>

                        @if($transaction != null)
                            @include('admin.our_account_ads.old.payment')
                        @else
                            <div class="container">
                                <div class="alert alert-danger text-center">
                                    <p>{{ _i('Not paid') }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{_i('Ad Details')}}</h5>
                                            </div>
                                            <div class="card-block">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">{{_i('Ad Type')}}</td>
                                                        <td class="text-right">{{_i('Ad Cost')}}</td>
                                                        <td class="text-right">{{_i('Total')}}</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-left">
                                                            @if($famous_ad->advert_type == 'user')
                                                                {{ _i('Famous Ads') }}
                                                            @elseif($famous_ad->advert_type == 'website')
                                                                {{ _i('Our Accounts Ads') }}
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ $famous_ad->price }} {{ _i('SAR') }}</td>
                                                        <td class="text-right">{{ $famous_ad->price }} {{ _i('SAR') }}</td>
                                                    </tr>
                                                    <tr></tr>
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-center">
                                                            <strong>{{_i('Total')}}</strong></td>
                                                        <td class="thick-line text-right totalBefore">{{ $order->total }}  {{ _i('SAR') }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{_i('More Details')}}</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    {{ _i('Account Type') }}
                                                                </td>
                                                                <td>{{ $famous_ad->content_type->translate(app()->getLocale())->title }}</td>
                                                                <td>
                                                                    {{ _i('User Social Account') }}
                                                                </td>
                                                                <td>
                                                                    <i class="fa {{ $famous_ad->social_link->social->icon }}"></i>
                                                                    <a target="_blank"
                                                                       href="{{ $famous_ad->social_link->url }}">{{ $famous_ad->social_link->social->translate(app()->getLocale())->title }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    {{ _i('Image Or Video') }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ asset($famous_ad->file) }}"
                                                                       style="cursor: pointer">
                                                                        {{pathinfo(\Illuminate\Support\Str::limit($famous_ad->file),PATHINFO_FILENAME)}}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    {{ _i('Content') }}
                                                                </td>
                                                                <td>
                                                                    {{ $famous_ad->content }}
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{--                                                @if($userAdRate != null)--}}
                                                {{--                                                    <div class="card">--}}
                                                {{--                                                        <div class="card-header">--}}
                                                {{--                                                            <h5>{{_i('Adv Rate')}}</h5>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                        <div class="card-block">--}}
                                                {{--                                                            <table class="table">--}}
                                                {{--                                                                <tbody>--}}
                                                {{--                                                                <tr>--}}
                                                {{--                                                                    <td>--}}
                                                {{--                                                                        {{ _i('Rate') }}--}}
                                                {{--                                                                    </td>--}}
                                                {{--                                                                    <td>{{ $userAdRate->rate->translate(app()->getLocale())->title }}</td>--}}
                                                {{--                                                                    <td>--}}
                                                {{--                                                                        {{ _i('Comment') }}--}}
                                                {{--                                                                    </td>--}}
                                                {{--                                                                    <td>--}}
                                                {{--                                                                        {{ $userAdRate->comment }}--}}
                                                {{--                                                                    </td>--}}
                                                {{--                                                                </tr>--}}
                                                {{--                                                                </tbody>--}}
                                                {{--                                                            </table>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>

@endsection


@push('js')

    <script>
        $(function () {
            'use strict';
            $('#status').on('change', function (e) {
                var status = $(this).val();
                var id = $('.order_id').val();
                var famous_ad_id = $('.famous_ad_id').val();
                $('.loader-block').css("display", "block");
                $.ajax({
                    url: "{{ aUrl('orders/') }}/" + id + "/change",
                    DataType: 'json',
                    type: 'get',
                    data: {status: status, id: id, famous_ad_id: famous_ad_id},
                    success: function (res) {
                        if (res === true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Order status successfully modified') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        } else {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('The status of the request is not expedited') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                    }
                });
                if (status == 'accepted') {
                    $("#publish").css("display", "block");
                } else {
                    $("#publish").css("display", "none");
                }
            });

            $('#accept').on('click', function (e) {
                var id = $('.famous_ad_id').val();
                $('.loader-block').css("display", "block");
                $.ajax({
                    url: "{{ aUrl('famous_ads/') }}/" + id + "/change",
                    DataType: 'json',
                    type: 'get',
                    data: {id: id},
                    success: function (res) {
                        $('.loader-block').css("display", "none");
                        if (res === true) {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Ad Accepted Successfully') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        } else {
                            if (res[1] != null) {
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: res[1],
                                    timeout: 3000,
                                    killer: true
                                }).show();
                            } else {
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{ _i('Error Accepting Ad') }}",
                                    timeout: 3000,
                                    killer: true
                                }).show();
                            }
                        }
                    }
                });
            });
        });

        $(document).on('click', '.print-btn', function (e) {
            e.preventDefault();
            $('.show_print').css('display', 'block');
            $('.hide_print').css('display', 'none');
            $('#print-area').printThis({
                printDelay: 500,
            });
        });

        $('#send_noty').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('send_notification')}}",
                type: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.modal.modal-notification').modal('hide');
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('Message Sent Successfully')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }
            })
        });

        $('#send_email').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('send_notification')}}",
                type: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.modal.modal-notification').modal('hide');
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: "{{ _i('Message Sent Successfully')}}",
                        timeout: 2000,
                        killer: true
                    }).show();
                }
            })
        });


    </script>

@endpush
