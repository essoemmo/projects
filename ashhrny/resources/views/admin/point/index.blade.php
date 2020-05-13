@extends('admin.layout.index',[
'title' => _i('All Points'),
'activePageName' => _i('All Points'),
] )

@section('content')

    <div class="row">

{{--        <div class="col-sm-12 mbl">--}}
{{--            <span class="pull-left">--}}
{{--                  <a href="{{url('admin/points/create')}}" target="_blank" class="btn btn-primary create add-permission">--}}
{{--                        <i class="ti-plus"></i>{{_i('create new Points')}}--}}
{{--                    </a>--}}

{{--            </span>--}}
{{--        </div>--}}

        <div class="col-sm-12">

            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Points List') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="dt-responsive table-responsive text-center">
                        {!! $dataTable->table([
                     'class' => "table table-striped table-bordered nowrap text-center"
                     ],true) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

@endsection



@push('js')
    {!! $dataTable->scripts() !!}
@endpush
