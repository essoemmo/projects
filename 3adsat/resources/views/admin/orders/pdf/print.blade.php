<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: 'dejavu sans', sans-serif;
        direction:rtl;
        text-align:right;
        padding:0;
        margin: 0;
    }
    .el-account{
        float: right;
        width: 50%;
    }
    .el-date{
        float: left;
        width: 25%
    }
    .el-date p,.el-account p{
        font-size: 12px;
        margin: 0 20px -25px;
        padding: 15px 0;
    }
    .el-no3{
        width:100%;
        display:block;
        margin:0 auto;
        text-align:center;
    }
    .el-no3 span{
        padding: 5px 20px !important;
        font-weight: bold;
        font-size: 12px;
    }
    .clearfix{
        clear:both;
    }
    table{
        width: 100%;
        text-align: center;
        font-size: 10px;
        margin-top: 20px;
    }
    .table th{
        background-color: #f3f3f3;
        text-align: center;
        font-size: 11px;
    }
    .table td{
        text-align: right;
    }
    table td, table th {
        padding: .5rem;
        vertical-align: middle;
        border: 1px solid #000000 !important;
    }
    table .th-empty{
        border: none !important;
        background: none
    }
    .text-center{
        text-align: center;
    }
</style>
<body>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>{{_i('Order Details')}}</h5>
                                                </div>
                                                <div class="card-block">
                                                    {{ _i('Order Date') }} : {{date("Y M d ", strtotime($order->created_at))}}
                                                    <br>
                                                    {{ _i('Payment Method') }} : {{ $paymentMethod->title }} <br>
                                                    {{ _i('Shipping Company') }} : @if($order->shipping_option!==null ) {{ $order->shipping_option->company->title }} @endif
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>{{_i('Customer Details')}}</h5>
                                                </div>
                                                <div class="card-block">
                                                    {{ _i('Customer Name') }} :  @if($user->name == '') {{$user->first_name}} {{$user->last_name}} @else {{ $user->name }} @endif
                                                    <br>
                                                    {{ _i('Customer Email') }} : {{ $user->email }} <br>
                                                    {{ _i('Customer Mobile') }} : @if($user->mobile != null) {{ $user->mobile }} @else {{ _i('No Mobile') }} @endif
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
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
                                                {{ _i('Order Status') }} : {{ $order->status }} <br>
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
                    <hr>
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
                                                {{ _i('Bank Name') }} : {{ $transaction->bank->title }} <br>
                                                {{ _i('Transaction Number') }} : {{ $transaction->bank_transactions_num }}
                                                <br>
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
                    <hr>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
