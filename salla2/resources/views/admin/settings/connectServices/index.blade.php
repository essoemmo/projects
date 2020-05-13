@extends('admin.AdminLayout.index')

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

<style>


</style>


@section('content')
    <!-- START CUSTOM TABS -->
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Connect services')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Connect services')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card group-widget start -->
        <div class="row">

            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3>
                                <a href="{{ url('adminpanel/chat/get') }}"
                                   class="text-primary">{{ _i('Chat Settings') }}</a>
                            </h3>
                            <p>{{ _i('Chat services') }}</p>
                            <div class="progress ">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <i class="icofont icofont-ui-chat"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

