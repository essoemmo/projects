@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Offers')}}
@endsection

@section('content')

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Offers')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{url('adminpanel')}}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Offers')}}</a>
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
                        <h5> {{ _i('Offers List') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>
                    </div>

                    <div class="card-block">


                        <div class="dt-responsive table-responsive text-center">
{{--                            <table id="content_data"  class="table table-striped table-bordered nowrap text-center">--}}
{{--                                <thead>--}}
{{--                                <tr role="row">--}}
{{--                                    <th>{{_i('ID')}}</th>--}}
{{--                                    <th>{{_i('Section')}}</th>--}}
{{--                                    <th>{{_i('Columns')}}</th>--}}
{{--                                    <th>{{_i('Type')}}</th>--}}
{{--                                    <th>{{_i(' Order ')}}</th>--}}
{{--                                    <th>{{_i('Edit')}}</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}

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


