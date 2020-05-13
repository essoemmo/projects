@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Add Home Page Section')}}
@endsection

@section('page_header_name')
    {{ _i('Add Home Page Section') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Home Page Section') }}</h5>
        </div>

    <!-- /.box-header -->
        <div class="card-body table-responsive text-center">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped text-center'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection


@push('js')


<style>

.dt-buttons{
        float: right !important;
        margin-top: -60px;
    }
    .dataTables_length{
        float: right;
        margin-top: -64px;
        margin-right: -33px;
    }
    .dataTables_filter{
        margin-top: -61px;
        margin-right: 219px;
    }

</style>

@endpush
