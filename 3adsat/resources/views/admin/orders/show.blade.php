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
                                <a href="{{url('/admin/panel/orders/'.$order->id.'/delete') }}">
                                    <button type="button" class="btn btn-danger">
                                        {{ _i(__('Delete')) }}
                                    </button>
                                </a>
                                <a href="{{url('/admin/panel/orders/'.$order->id.'/print') }}">
                                    <button type="button" class="btn btn-success">
                                        {{ _i(__('Print')) }}
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
                                <h5 class="card-title">{{ _i('Order No') }} : #{{ $order->ordernumber }}</h5>
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
                                                                    <td>{{ $paymentMethod->title }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-primary"><i class="ti-truck"></i></button></td>
                                                                    <td>
                                                                        @if($order->shipping_option!==null )
                                                                        {{ $order->shipping_option->company->title }}
                                                                        @endif
                                                                    </td>
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
                                                                            @if($user->name == '')
                                                                                {{$user->first_name}} {{$user->last_name}}
                                                                            @else
                                                                                {{ $user->name }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                    <tr>
                                                                        <td><button data-toggle="tooltip" title="E-Mail" class="btn btn-primary btn-xs"><i class="ti-email"></i></button></td>
                                                                        <td><a href="#">{{ $user->email }}</a></td>
                                                                    </tr>
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
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>{{_i('Shipping Address')}}</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            {{ _i('Mobile') }} : {{ $shipping_address->code }} <br>
                                                            {{ _i('Address') }} : {{ $shipping_address->Neighborhood }}, {{ $shipping_address->street }}, {{ $shipping_address->address }} <br>
                                                            {{ _i('City') }} : @if($shipping_address->city!=null) {{ $shipping_address->city->title }} <br> @endif
                                                            {{ _i('Country') }} : {{ $shipping_address->country->hasDescription[0]->name }} <br>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" name="order_id" class="order_id" value="{{ $order->id }}">
                                                        <label for="status">{{ _i('Order Status') }}</label>
                                                        <select name="status" id="status" class="form-control pull-right">
                                                            <option @if($order->status == 'wait') selected @endif value="wait">{{ _i('wait') }}</option>
                                                            <option @if($order->status == 'refused') selected @endif value="refused">{{ _i('refused') }}</option>
                                                            <option @if($order->status == 'accepted') selected @endif value="accepted">{{ _i('accepted') }}</option>
                                                            <option @if($order->status == 'shipped') selected @endif value="shipped">{{ _i('shipped') }}</option>
                                                            <option @if($order->status == 'delivered') selected @endif value="delivered">{{ _i('delivered') }}</option>
                                                        </select>
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

                            @if($transaction->type_id == 2)
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
                                                                <td><button data-toggle="tooltip" title="Bank" class="btn btn-primary"><i class="fa fa-bank"></i></button></td>
                                                                <td>{{ $transaction->bank->title }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><button data-toggle="tooltip" title="Bank Transaction Number" class="btn btn-primary"><i class="fa fa-sort-numeric-asc"></i></button></td>
                                                                <td>{{ $transaction->bank_transactions_num }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><button data-toggle="tooltip" title="Image" class="btn btn-primary"><i class="fa fa-file-image-o"></i></button></td>
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
                                                            <td class="text-left">{{_i('Product Type')}}</td>
                                                            <td class="text-right">{{_i('Quantity')}}</td>
                                                            <td class="text-right">{{_i('Unit Price')}}</td>
                                                            <td class="text-right">{{_i('Total')}}</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order_items as $item)
                                                                <tr>
                                                                    <td class="text-left">
                                                                        <a href="{{ url('/admin/panel/products/' . $item->type_id . '/edit') }}">{{ $item->product->productDescriptions[0]->name }}</a> <br />
                                                                        <?php $data = json_decode($item->description) ?>
                                                                        @if($item->type == 'glasses')
                                                                            @if($data->right_size || $data->left_size != null)
                                                                                <div class="row form-group">
                                                                                    @if($data->right_size != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('right size') }}  : {{ $data->right_size }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                    @if($data->left_size != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('left size') }} : {{ $data->left_size }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                            @if($data->right_cylinder || $data->left_cylinder != null)
                                                                                <div class="row form-group">
                                                                                    @if($data->right_cylinder != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('right cylinder') }} : {{ $data->right_cylinder }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                    @if($data->left_cylinder != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('left cylinder') }} : {{ $data->left_cylinder }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                            @if($data->right_axis || $data->left_axis != null)
                                                                                <div class="row form-group">
                                                                                    @if($data->right_axis != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('right axis') }} : {{ $data->right_axis }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                    @if($data->left_axis != null)
                                                                                        <div class="col-md-4">
                                                                                            <p>{{ _i('left axis') }} : {{ $data->left_axis }} </p>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                            @if($data->lense_type != null)
                                                                                <div class="row form-group">
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('Lense Type') }} : {{ $data->lense_type }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                                @if($data->pd != null)
                                                                                <div class="row form-group">
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('PD Value') }} : {{ $data->pd }} </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                        @if($item->type == 'lenses')
                                                                            <div class="row form-group">
                                                                                @if($data->right_size != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('right size') }}  : {{ $data->right_size }} </p>
                                                                                    </div>
                                                                                @endif
                                                                                @if($data->left_size != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('left size') }} : {{ $data->left_size }} </p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                @if($data->right_cylinder != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('right cylinder') }} : {{ $data->right_cylinder }} </p>
                                                                                    </div>
                                                                                @endif
                                                                                @if($data->left_cylinder != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('left cylinder') }} : {{ $data->left_cylinder }} </p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                @if($data->right_axis != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('right axis') }} : {{ $data->right_axis }} </p>
                                                                                    </div>
                                                                                @endif
                                                                                @if($data->left_axis != null)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('left axis') }} : {{ $data->left_axis }} </p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                @if($data->color != null)
                                                                                <div class="col-md-4">
                                                                                    <p style="display: inline-block">{{ _i('color') }} : {{ $data->color_name }}</p>
                                                                                    <i class="fa fa-circle" style="color: {{ $data->color->color }}; display: inline-block"></i>
                                                                                </div>
                                                                                @endif
                                                                                @if($data->auto_reorder)
                                                                                    <div class="col-md-4">
                                                                                        <p>{{ _i('auto reorder') }} : {{ $data->auto_reorder }} </p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-md-4">
                                                                                    @if($data->package)
                                                                                        <p style="display: inline-block">{{ _i('Pack of') }} : {{ $data->package }}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">{{ $item->type }}</td>
                                                                    <td class="text-right">{{ $item->count }}</td>
                                                                    <td class="text-right">{{ $item->price }}</td>
                                                                    <td class="text-right">{{ $item->count * $item->price }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr></tr>
                                                            <tr>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="thick-line text-right totalBefore">{{ $order->total }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line text-center"><strong>{{_i('Shipping charges')}}</strong></td>
                                                                <td class="no-line text-right ship_cost">{{ $order->shipping_cost }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="no-line text-right overAllTotal">{{ $order->shipping_cost + $order->total }} </td>
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
                console.log(status,id);
                $.ajax({
                    url:"{{ url('/admin/panel/orders/') }}/" + id + "/change",
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
                })
            });
        })
    </script>

@endpush
