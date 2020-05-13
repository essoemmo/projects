@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Data Recovery')}}
@endsection

@push('css')
    <style>

        .blog-page {
            margin: 43px;
            height: 200px;
        }

        h3 i {
            font-size: 45px !important;
        }

        .counter-card-1 [class*="card-"] div > i,
        .counter-card-2 [class*="card-"] div > i,
        .counter-card-3 [class*="card-"] div > i {
            font-size: 30px;
            color: #1abc9c !important;
        }
    </style>

@endpush

@section('content')

    {{--    Store settings--}}
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Data Recovery')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Data Recovery')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <!-- Blog-card group-widget start -->
        <div class="row">

            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3><a href="{{ route('dataRecovery.products') }}"
                                   class="text-primary">{{_i('Products') }}</a></h3>
                            <p>{{ _i('Products deleted during the past 30 days') }}</p>
                            <div class="progress ">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <i class="ti-view-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3><a href="{{ route('dataRecovery.orders') }}"
                                   class="text-primary">{{_i('Orders') }}</a></h3>
                            <p>{{ _i('Orders deleted during the past 30 days') }}</p>
                            <div class="progress ">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <i class="ti-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    {{--Store settings--}}

@endsection

