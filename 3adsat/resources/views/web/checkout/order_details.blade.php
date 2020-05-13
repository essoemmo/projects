<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>{{ _i('Order Details') }}</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-active">
                                <thead>
                                    <tr>
                                        <td><strong>{{ _i('Product') }}</strong></td>
                                        <td class="text-center"><strong>{{ _i('Price') }}</strong></td>
                                        <td class="text-center"><strong>{{ _i('Quantity')}}</strong></td>
                                        <td class="text-right"><strong>{{ _i('Total') }}</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach($order->order_items as $item)
                                    <?php $data = json_decode($item->description) ?>

                                    <tr>
                                        <td>
                                            {{ $item->product->productDescriptions[0]->name }}
                                            {{--                                            @dd($data->right_size)--}}
                                            @if($item->type == 'glasses')
                                            <div class="row form-group">
                                                @if($data->left_size != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    <p>{{ _i('size') }}  : {{ $data->right_size }} </p>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                @if($data->left_cylinder != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    <p>{{ _i('cylinder') }} : {{ $data->right_cylinder }} </p>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                @if($data->left_axis != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    <p>{{ _i('axis') }} : {{ $data->right_axis }} </p>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                @if($data->lense_type != null)
                                                <div class="col-md-4">
                                                    <p>{{ _i('Lense Type') }} : {{ $data->lense_type }} </p>
                                                </div>
                                                @endif
                                                @if($data->pd)
                                                    <div class="col-md-4">
                                                        <p>{{ _i('PD Value') }} : {{ $data->pd }} </p>
                                                    </div>
                                                @endif
                                            </div>
                                            @endif
                                            @if($item->type == 'lenses')
                                            <div class="row form-group">
                                                @if($data->left_size != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    @if($data->right_size != null)
                                                    <p>{{ _i('size') }}  : {{ $data->right_size }} </p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                @if($data->left_size != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    @if($data->right_cylinder != null)
                                                    <p>{{ _i('cylinder') }} : {{ $data->right_cylinder }} </p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                @if($data->left_size != null)
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
                                                @else
                                                <div class="col-md-4">
                                                    @if($data->right_axis != null)
                                                    <p>{{ _i('axis') }} : {{ $data->right_axis }} </p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">

                                                    @if(isset($data->color->color))
                                                    <p style="display: inline-block">{{ _i('color') }} : {{ $data->color_name }}</p>
                                                    <i class="fa fa-1x fa-circle" style="color: {{ $data->color->color }}; display: inline-block"></i>
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
                                        <td class="text-center">{{ $item->price }} {{ $convert->code }} </td>
                                        <td class="text-center">{{ $item->count }}</td>
                                        <?php $total += $item->price * $item->count ?>
                                        <td class="text-right">{{ $total }} {{ $convert->code }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>{{ _i('Total') }}</strong></td>
                                        <td class="thick-line text-right">{{ $order->total }} {{ $convert->code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>{{ _i('Shipping Cost') }}</strong></td>
                                        <td class="no-line text-right">{{ $order->shipping_cost }} {{ $convert->code }}</td>
                                    </tr>
                                    <?php
                                    $overAllTotal = $order->shipping_cost + $order->total;
                                    ?>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>{{ _i('Total') }}</strong></td>
                                        <td class="no-line text-right">{{ $overAllTotal }} {{ $convert->code }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
