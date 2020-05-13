@extends('admin.AdminLayout.index')

@section('title')
{{_i('index')}}
@endsection

@section('content')
<style>
    .table-card .row-table span,
    .table-card .row-table h5 {
        white-space: nowrap;
    }

</style>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card client-blocks dark-primary-border">
                <div class="card-block">
                                       <h5>{{_i('Article')}}</h5>
                    <ul>
                        <li style="float: left">
                            <i class="icofont icofont-document-folder"></i>
                        </li>
                        <li class="text-right">
                            <?php $article = \App\Models\Article\Article::where('store_id',\App\Bll\Utility::getStoreId())->count(); ?>
                            {{$article}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">


            <div class="card client-blocks warning-border">
                <div class="card-block">
                    <h5>{{_i('Clients')}}</h5>
                    <ul>
                        <li style="float: left">
                            <i class="icofont icofont-ui-user-group text-warning"></i>
                        </li>
                        <li class="text-right text-warning">
                            <?php $users = \App\User::where('store_id',\App\Bll\Utility::getStoreId())->count(); ?>
                            {{$users}}
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card client-blocks success-border">
                <div class="card-block">
                    <h5>{{_i('shipping companies')}}</h5>
                    <ul>
                        <li style="float: left">
                            <i class="icofont icofont-files text-success"></i>
                        </li>
                        <li class="text-right text-success">
                            <?php $companies = \App\Models\Shipping\shippingCompanies::where('store_id',session('StoreId'))->count(); ?>
                            {{$companies}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card client-blocks">
                <div class="card-block">
                    <h5>{{_i('products')}}</h5>
                    <ul>
                        <li style="float: left">
                            <i class="icofont icofont-ui-folder text-primary"></i>
                        </li>
                        <li class="text-right text-primary">
                            <?php $products = \App\Models\product\products::where('store_id',session('StoreId'))->count(); ?>
                            {{$products}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{_i('Month summary')}} {{_i(\App\Bll\Utility::setDate())}} </h5>
                </div>
                <div class="row-table">
                    <div class="col-sm-6 card-block-big br">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icofont icofont-eye-alt text-success"></i>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{ $visitors->count() }}</h5>
                                <span>{{_i('Visits')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 card-block-big">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icofont icofont-fire-alt text-danger"></i>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5> --- </h5>
                                <span>{{_i('Sales')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-table">
                    <div class="col-sm-6 card-block-big br">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icofont icofont-files text-info"></i>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{ $orders->count() }}</h5>
                                <span>{{_i('Order')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 card-block-big">
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icofont icofont icofont-dart text-warning"></i>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5> ---- </h5>
                                <span>{{_i('Goal of the month')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12 col-xl-6">
            <!-- List view card start -->
            <div class="card">
                <div class="card-header">
                    <h5> Notifications </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                    </div>
                </div>
                <div class="row card-block">
                    <div class="col-md-12">
                        <ul class="list-view">
                        @if (!empty($notifications))
                             @foreach ($notifications as $notification)
                                 @php  $data = json_decode($notification->data) @endphp

                            <li>
                                <div class="card user-card">
                                    <div class="card-block">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="col-xs-12">
                                                    <h6 class="d-inline-block">
                                                        {{ $data->username->name ?? 'visitor' }}
                                                    </h6>
                                                    <label class="label label-info">Agent</label>
                                                </div>
                                                @if (!empty($data->comment))
                                                <p>{{ $data->comment }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                             @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- List view card end -->
        </div>



        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{_i('Orders')}} {{_i(\App\Bll\Utility::setDate())}} </h5>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <div class="dt-responsive table-responsive">
                            <div id="e-product-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <table id="e-product-list"
                                            class="table table-bordered w-100 dataTable no-footer" cellspacing="0"
                                            role="grid">
                                            <thead>
                                                <tr role="row">

                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 56px;">{{_i('User Name')}}</th>

                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 43px;">{{_i('Order Number')}}</th>

                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 46px;">{{_i('Order Status')}}</th>

                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 46px;">{{_i('Shipping Cost')}}</th>

                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 85px;">{{_i('Total')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $product)
                                                <tr role="row" class="odd">
                                                    <td class="pro-name">
                                                        <span>{{$product->name}}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="label label-danger">{{$product->ordernumber}}</span>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="label label-danger">{{$product->status}}</span>
                                                    </td>

                                                    <td class="pro-list-img">
                                                        <span
                                                        class="label label-danger">{{$product->shipping_cost}}</span>
                                                    </td>
                                                    <td class="pro-name">
                                                        <span>{{$product->total}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-5"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="e-product-list_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="e-product-list_previous"><a href="#"
                                                        aria-controls="e-product-list" data-dt-idx="0" tabindex="0"
                                                        class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="e-product-list" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item next disabled"
                                                    id="e-product-list_next"><a href="#" aria-controls="e-product-list"
                                                        data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->

</section>




@endsection
