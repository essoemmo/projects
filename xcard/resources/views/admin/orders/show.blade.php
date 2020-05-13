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
                    <div class="col-sm-6">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item">
                                <a href="{{aUrl('orders/'.$order->id.'/delete') }}">
                                    <button type="button" class="btn btn-danger">
                                        {{ _i(__('Delete')) }}
                                    </button>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
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
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>{{_i('Order Details')}}</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><button data-toggle="tooltip" title="Date Added" class="btn btn-primary"><i class="ti-calendar"></i></button></td>
                                                                    <td>{{date("Y M d ", strtotime($order->created_at))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><button data-toggle="tooltip" title="Payment Method" class="btn btn-primary"><i class="ti-credit-card"></i></button></td>
                                                                    <td>{{ $transaction->payment_type }}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>{{_i('Customer Details')}}</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 1%;"><button data-toggle="tooltip" title="Customer" class="btn btn-primary btn-xs"><i class="ti-user"></i></button></td>
                                                                        <td>
                                                                            @if($user->first_name != null && $user->last_name != null)
                                                                                {{$user->first_name}} {{$user->last_name}}
                                                                            @else
                                                                                {{ $user->email }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                    <tr>
                                                                        <td><button data-toggle="tooltip" title="Mobile" class="btn btn-primary btn-xs"><i class="ti-mobile"></i></button></td>
                                                                        <td>
                                                                            @if($user->mobile != null)
                                                                                {{ $user->mobile }}</td>
                                                                            @else
                                                                                {{ _i('No Mobile') }}
                                                                            @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <input type="hidden" name="order_id" class="order_id" value="{{ $order->id }}">
                                                        <label for="status">{{ _i('Order Status') }}</label>
                                                        <select name="status" id="status" class="form-control pull-right mb-3">
                                                            <option @if($order->status == 'wait') selected @endif value="wait">{{ _i('wait') }}</option>
                                                            <option @if($order->status == 'refused') selected @endif value="refused">{{ _i('refused') }}</option>
                                                            <option @if($order->status == 'accepted') selected @endif value="accepted">{{ _i('accepted') }}</option>
                                                            <option @if($order->status == 'delivered') selected @endif value="delivered">{{ _i('delivered') }}</option>
                                                        </select>
                                                    </div>

                                                    <div id="send_code" @if($order->status == 'accepted' && $order->code_status == 0) style="display: block" @else style="display: none" @endif>
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-outline-primary" id="send">{{ _i('Send Codes') }}</a>
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

                            @if($transaction->payment_type == 'bank')
                                <div class="" id="tab-data">
                                    <div class="col-sm-1"></div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{_i('Bank Details')}}</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Bank" class="btn btn-primary">
                                                                        <i class="fa fa-bank"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->bank->translate(app()->getLocale())->title }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Bank Transaction Number" class="btn btn-primary">
                                                                        <i class="fa fa-sort-numeric-asc"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->bank_transactions_num }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Image" class="btn btn-primary">
                                                                        <i class="fa fa-file-image-o"></i>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <img class="img-responsive pad" width="150px" height="150px" src="{{ asset($transaction->image) }}" id="image">
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
        </div>
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- ./card -->
                                    </div>
                                    <!-- /.col -->
                                </div>

                                @elseif($transaction->payment_type == 'online')
                                <div class="" id="tab-data">
                                    <div class="col-sm-1"></div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{_i('Payment Details')}}</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Bank" class="btn btn-primary">
                                                                        <i class="fa fa-bank"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ _i('Online Payment') }}</td>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Transaction Number" class="btn btn-primary">
                                                                        <i class="fa fa-sort-numeric-asc"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->bank_transactions_num }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Holder Name" class="btn btn-primary">
                                                                        <i class="fa fa-user"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->holder_name }}</td>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Holder Card Number" class="btn btn-primary">
                                                                        <i class="fa fa-credit-card-alt"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->holder_card_number }}</td>
                                                                <td>
                                                                    <button data-toggle="tooltip" title="Holder Expire" class="btn btn-primary">
                                                                        <i class="fa fa-credit-card-alt"></i>
                                                                    </button>
                                                                </td>
                                                                <td>{{ $transaction->holder_expire }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- ./card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            @endif

                            <div class="" id="tab-data">
                                <div class="col-sm-1"></div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>{{_i('Products Details')}}</h5>
                                                </div>
                                                <div class="card-block">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <td class="text-left">{{_i('Product')}}</td>
                                                            <td class="text-right">{{_i('Quantity')}}</td>
                                                            <td class="text-right">{{_i('Unit Price')}}</td>
                                                            <td class="text-right">{{_i('Total')}}</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order_items as $item)
                                                                <tr>
                                                                    <td class="text-left">
                                                                        <a href="{{ aUrl('products/' . $item->type_id . '/edit') }}">
                                                                            {{ $item->product->translate(app()->getLocale())->title }}
                                                                        </a>
                                                                        <br />
                                                                    </td>
                                                                    <td class="text-right">{{ $item->count }}</td>
                                                                    <td class="text-right">{{ $item->price }}</td>
                                                                    <td class="text-right">{{ $item->count * $item->price }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr></tr>
                                                            <tr>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="thick-line text-right totalBefore">{{ $order->total }} </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
                $.ajax({
                    url:"{{ aUrl('orders/') }}/" + id + "/change",
                    DataType:'json',
                    type:'get',
                    data: {status: status, id: id},
                    success:function (res) {
                        if(res === true) {
                            new Noty ({
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
                if(status == 'accepted') {
                    $("#send_code").css("display","block");
                } else {
                    $("#send_code").css("display","none");
                }
            });


            $('#send').on('click', function (e) {
                var id = $('.order_id').val();
                $('.loader-block').css("display","block");
                $.ajax({
                    url:"{{ aUrl('orders/') }}/" + id + "/sendCodes",
                    DataType:'json',
                    type:'get',
                    data: {id: id},
                    success:function (res) {
                        $('.loader-block').css("display","none");
                        if(res === true) {
                            new Noty ({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Code Sent Successfully') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        } else {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Error Sending Code') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                    }
                });
            });
        });



    </script>

@endpush
