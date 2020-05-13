@extends('admin.layout.index',[
'title' => _i(' Customer Orders Details'),
'subtitle' => _i('Customer Orders Details'),
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
                                    @if($user->first_name != null && $user->last_name != null)
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    @else
                                        {{ $user->email }}
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
                                                            <td class="text-right">{{_i('Quantity')}}</td>
                                                            <td class="text-right">{{_i('Unit Price')}}</td>
                                                            <td class="text-right">{{_i('Total')}}</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($orders as $item)
{{--                                                                                                                            @dd($orders)--}}
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <a href="{{ aUrl('orders/'. $item->order_id ) }}">
                                                                            {{ $item->orderNumber }}
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="{{ aUrl('products/' . $item->type_id . '/edit') }}">
                                                                            {{ $item->product->translate(app()->getLocale())->title }}
                                                                        </a>
                                                                        <br />
                                                                    </td>
                                                                    <td class="text-center">{{ $item->count }}</td>
                                                                    <td class="text-center">{{ $item->price }}</td>
                                                                    <td class="text-center">{{ $item->count * $item->price }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr></tr>
                                                            <tr>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                                                                <td class="thick-line text-right totalBefore">{{ $orderTotal }} </td>
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

