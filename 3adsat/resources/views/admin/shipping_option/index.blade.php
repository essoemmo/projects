
@extends('admin.layout.index',[
'title' => _i('All Shipping Option'),
'subtitle' => _i('All Shipping Option'),
'activePageName' => _i('Add Shipping Option'),
'additionalPageUrl' => url('/admin/panel/shipping_company') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Shipping Option') }}</h5>
        </div>



    @include('admin.layout.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection
