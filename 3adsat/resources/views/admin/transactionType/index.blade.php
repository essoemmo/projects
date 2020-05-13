
@extends('admin.layout.index',[
'title' => _i('All Transaction Type'),
'subtitle' => _i('All Transaction Type'),
'activePageName' => _i('Add Transaction Type'),
'additionalPageUrl' => url('/admin/panel/transactionType') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Transaction Type') }}</h5>
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
