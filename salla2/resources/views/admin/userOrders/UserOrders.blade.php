@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Customer Details')}}
@endsection

@section('page_header_name')
    {{_i('Customer Details')}}
@endsection


@section('content')

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Customer Details')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Customer Details')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-name">
                    <h3>{{ _i('Customer') }}</h3>
                </div>

                <div class="card-options">
                    @include('admin.userOrders.includes.filter')
                </div>
            </div>
            <div class="card-block">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            @if($user->image != null)
                                <img class="media-object img-circle comment-img" style="width: 55px;height: 55px"
                                     src="{{ asset($user->image) }}" alt="{{ $user->name }}">
                            @else
                                <img class="media-object img-circle comment-img" style="width: 55px;height: 55px"
                                     src="{{ asset('images/articles/personal_NoImage.jpg') }}" alt="{{ $user->name }}">
                            @endif
                        </div>

                        @php

                            $number =  $user->phone;
                            $masked =  str_pad(substr($number, -4), strlen($number), '*', STR_PAD_LEFT);

                        @endphp
                        <div class="media-body">
                            <h6 class="media-heading" style="font-weight: bold">{{ $user->name }}</h6>
                            <a href="tel:+{{ $masked }}" class="m-b-0">
                                <span class="btn btn-primary">
                                    <i class="ti-mobile"></i>
                                    {{ _i('Call') }}
                                </span>
                                {{ $masked }}
                            </a>
                            <hr>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>{{ _i('Orders') }}</h5>
            </div>
            <div class="card-block">
                @if(count($orders) > 0)
                    <table class="table text-nowrap">
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="table-row">
                                <td class="customer-td">
                                    <div>
                                        <a href="{{ url('adminpanel/orders/' . $order->id .'/edit') }}">{{ _i('Order') }}
                                            #{{ $order->ordernumber }}</a></div>
                                    <div
                                        class="text-muted text-size-small">{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</div>
                                </td>
                                @php

                                    $total = $order->total + $order->shipping_cost;

                                @endphp
                                <td class="text-right" data-title="{{ _i('Total') }}">
                                    <h6 class="text-semibold">{{ $total }}</h6>
                                </td>
                                <td class="text-right" data-title="الحالة"><span class="label label-flat label-rounded "
                                                                                 style="background:#404146">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>{{ _i('No Orders') }}</p>
                @endif
            </div>
        </div>
    </div>


@endsection


@push('js')

    <script>
        $(function () {
            $('#add_form').submit(function (e) {
                e.preventDefault();
                var id = '{{ $user->id }}';
                var url = "{{ route('UserSentSMS', ":id") }}";
                url = url.replace(':id', id);
                var form = $("#add_form").serialize();
                var table = $('.dataTable').DataTable();
                $.ajax({
                    url: url,
                    type: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (res) {
                        $('.modal').modal('hide');
                        $("#add_form").parsley().reset();
                        $('#message').val("");

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Message on its Way')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                    }
                })
            });
        });
    </script>

@endpush
