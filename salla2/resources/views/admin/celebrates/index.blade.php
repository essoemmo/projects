
@extends('admin.AdminLayout.index')

@section('title')
    Celebrate
@endsection

@section('page_header_name')
    Celebrate
@endsection


@section('content')

    {{--    "yajra/laravel-datatables-buttons": "^4.6",--}}
    {{--    "yajra/laravel-datatables-oracle": "~8.0",--}}

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Celebrate')}}</a>
                </li>
            </ul>
        </div>
    </div>

    <div style="clear:both;"></div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    {{-- <div class="page-body">

        <div class="card">
            <div class="card-block">
                <div class="card-title">
                    <h5>{{_i('Brands')}}</h5>
                </div>
            @include('admin.AdminLayout.message')
            {!! $dataTable->table([
                'class'=> 'table table-bordered table-striped table-responsive text-center'
            ],true) !!}
        </div>
    </div>
    </div> --}}

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <span class="pull-left">
                </span>
            </div>

            <div class="col-sm-12">
                <!-- Zero config.table start -->
                <div class="card">
                    <div class="card-header">
                        <h5>{{_i('All Celebrate')}}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                        </div>
                    </div>
                    <div class="card-block">

                        <div class="celebrate_detailes">
                            <p><i class="ti-check"></i>{{_i('The age of the company or store is less than a year')}}</p>
                            <p><i class="ti-check"></i>{{_i('The monthly income should be less than 50,000 SAR')}}</p>
                            <p><i class="ti-check"></i>{{_i('The store has been registered in a well-known platform')}}</p>
                            <p><i class="ti-check"></i>{{_i('The products or services are original and of excellent quality')}}</p>
                            <p><i class="ti-check"></i>{{_i('To have a distinguished customer evaluation of no less than four stars')}}</p>
                        </div>

{{--                            @dd($conditions)--}}
                                @if($conditions == 'true')
                                    <form method="post" action="{{route('celebrates.store')}}">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="store_id" class="form-control" value="{{$store_id}}">
                                        <button type="submit" class="btn btn-success btn-sm">{{_i('getServices')}}</button>
                                    </form>
                                    @else

                            <button class="btn btn-success btn-sm disabled">{{_i('getServices')}}</button><br>
                                    <span style="color: red">{{_i('this condition not true')}}</span>

                        @endif


                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('js')
        <script>
            $(function () {
                $('#brand_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('adminpanel/brands')}}',
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'image', name: 'image'},
                        {data: 'link', name: 'link'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: true, searchable: true}
                    ]
                });

            });
        </script>
    @endpush

@endsection
