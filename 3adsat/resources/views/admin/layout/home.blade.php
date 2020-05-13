
@extends('admin.layout.index')

@section('content')

<div class="row">

    <div class="col-md-12 col-xl-4">
        <!-- table card start -->
        <div class="card table-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-6 card-block-big br">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{url('admin/panel/article/all')}}"><i class="icofont icofont-edit text-success"></i> </a>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{$articles}}</h5>
                                <a href="{{url('admin/panel/article/all')}}" style="color: black;"><span>{{_i('Article')}}</span> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 card-block-big">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{url('admin/panel/content_management')}}"><i class="icofont icofont-file-text text-danger"></i></a>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{$content_sections}}</h5>
                               <a href="{{url('admin/panel/content_management')}}"  style="color: black;"> <span>{{_i('Content')}}</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row-table">
                    <div class="col-sm-6 card-block-big br">
                        <div class="row">
                            <div class="col-sm-4">
                               <a href="{{url('admin/panel/newsletters/all')}}"> <i class="icofont icofont-email text-info"></i> </a>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{$newsletter}}</h5>
                                <a href="{{url('admin/panel/newsletters/all')}}" style="color: black;"> <span>{{_i('NewsLetters')}}</span> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 card-block-big">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{url('admin/panel/contact/all')}}"> <i class="icofont icofont-envelope-open text-warning"></i> </a>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5>{{$contacts}}</h5>
                                <a href="{{url('admin/panel/contact/all')}}"  style="color: black;"><span>{{_i('Contacts')}}</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table card end -->
    </div>

    <div class="col-md-12 col-xl-4">
        <!-- widget primary card start -->
        <div class="card table-card widget-primary-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/categories')}}" style="color: white;"> <i class="icofont icofont-justify-all"></i> </a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$product_cat}}</h4>
                        <a href="{{url('admin/panel/categories')}}" style="color: white;"> <h6>{{_i('Product Category')}}</h6></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget primary card end -->
        <!-- widget-success-card start -->
        <div class="card table-card widget-success-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/products')}}"  style="color: white;"> <i class="icofont icofont-trophy-alt"></i></a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$products}}</h4>
                        <a href="{{url('admin/panel/products')}}"  style="color: white;"> <h6>{{_i('Products')}}</h6> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget-success-card end -->
    </div>


    <div class="col-md-12 col-xl-4">
        <!-- widget primary card start -->
        <div class="card table-card widget-primary-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/rating/all')}}" style="color: white;"> <i class="icofont icofont-star"></i> </a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$rates}}</h4>
                        <a href="{{url('admin/panel/rating/all')}}" style="color: white;"> <h6>{{_i('Product Ratings')}}</h6> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget primary card end -->
        <!-- widget-success-card start -->
        <div class="card table-card widget-success-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/orders')}}"  style="color: white;"> <i class="icofont icofont-cart"></i></a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$products}}</h4>
                        <a href="{{url('admin/panel/orders')}}"  style="color: white;"> <h6>{{_i('Orders')}}</h6> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget-success-card end -->
    </div>

    <div class="col-md-12 col-xl-4">
        <!-- widget primary card start -->
        <div class="card table-card widget-primary-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/shipping_company')}}" style="color: white;"> <i class="icofont icofont-free-delivery"></i> </a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$shipping_company}}</h4>
                        <a href="{{url('admin/panel/shipping_company')}}" style="color: white;"> <h6>{{_i('Shipping Company')}}</h6> </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-xl-4">
        <!-- widget primary card start -->
        <div class="card table-card widget-primary-card">
            <div class="">
                <div class="row-table">
                    <div class="col-sm-3 card-block-big">
                        <a href="{{url('admin/panel/transferBank')}}" style="color: white;"> <i class="icofont icofont-money"></i> </a>
                    </div>
                    <div class="col-sm-9">
                        <h4>{{$rates}}</h4>
                        <a href="{{url('admin/panel/transferBank')}}" style="color: white;"> <h6>{{_i('Bank Transfer')}}</h6> </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
