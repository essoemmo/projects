@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Campaign List')}}
@endsection

@section('content')

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Campaign List')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{url('adminpanel')}}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Campaign List')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ _i('Campaign List') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>

                    <div class="card-block">


                        <div class="dt-responsive table-responsive text-center">
                            @include('admin.AdminLayout.message')
                            {!! $dataTable->table([
                                'class'=> 'table table-bordered table-striped  text-center'
                            ],true) !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush


@endsection


