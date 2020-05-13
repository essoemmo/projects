@extends('admin.layout.index',[
'title' => _i(' Customer Orders Details'),
'subtitle' => _i('Customer Orders Details'),
'activePageName' => _i('Add Customer Orders Details'),
'additionalPageUrl' => url('/admin/panel/customerOrderReport') ,
'additionalPageName' => _i('All'),
] )
@section('content')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

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
                                <h5 class="card-title">{{ _i('Customer Name') }} :
                                    @if($user->name == '')
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    @else
                                        {{ $user->name }}
                                    @endif
                                </h5>
                            </div>

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
                                                            <td class="text-left">{{_i('Order Number')}}</td>
                                                            <td class="text-left">{{_i('Product')}}</td>
                                                            <td class="text-left">{{_i('Product Type')}}</td>
                                                            <td class="text-right">{{_i('Quantity')}}</td>
                                                            <td class="text-right">{{_i('Unit Price')}}</td>
                                                            <td class="text-right">{{_i('Total')}}</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($orders as $item)
{{--                                                                                                                            @dd($orders)--}}
                                                                <tr>
                                                                    <td class="text-right">
                                                                        <a href="{{ url('/admin/panel/orders', $item->order_id ) }}">
                                                                            {{ $item->ordernumber }}
                                                                        </a>
                                                                    </td>
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
                                                                        @endif
                                                                        @if($item->type == 'lenses')
                                                                            <div class="row form-group">
                                                                                <div class="col-md-4">
                                                                                    @if($data->right_size != null)
                                                                                        <p>{{ _i('right size') }}  : {{ $data->right_size }} </p>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    @if($data->left_size != null)
                                                                                        <p>{{ _i('left size') }} : {{ $data->left_size }} </p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-md-4">
                                                                                    @if($data->right_cylinder != null)
                                                                                        <p>{{ _i('right cylinder') }} : {{ $data->right_cylinder }} </p>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    @if($data->left_cylinder != null)
                                                                                        <p>{{ _i('left cylinder') }} : {{ $data->left_cylinder }} </p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-md-4">
                                                                                    @if($data->right_axis != null)
                                                                                        <p>{{ _i('right axis') }} : {{ $data->right_axis }} </p>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    @if($data->left_axis != null)
                                                                                        <p>{{ _i('left axis') }} : {{ $data->left_axis }} </p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-md-4">
                                                                                    @if($data->color != null)
                                                                                        <p style="display: inline-block">{{ _i('color') }} : {{ $data->color_name }}</p>
                                                                                        <i class="fa fa-circle" style="color: {{ $data->color->color }}; display: inline-block"></i>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    @if($data->auto_reorder)
                                                                                        <p>{{ _i('auto reorder') }} : {{ $data->auto_reorder }} </p>
                                                                                    @endif
                                                                                </div>
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
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="thick-line text-right totalBefore">{{ $orderTotal }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line text-center"><strong>{{_i('Shipping charges')}}</strong></td>
                                                                <td class="no-line text-right ship_cost">{{ $orderShipCost }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line"></td>
                                                                <td class="no-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="no-line text-right overAllTotal">{{ $orderShipCost + $orderTotal }} </td>
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

