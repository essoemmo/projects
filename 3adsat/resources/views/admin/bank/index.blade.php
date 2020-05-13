
@extends('admin.layout.index',[
'title' => _i('All bank transfer'),
'subtitle' => _i('All bank transfer'),
'activePageName' => _i('Add bank transfer'),
'additionalPageUrl' => url('/admin/panel/transferBank') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('bank transfer') }}</h5>
                              @include("admin.translate_buttons",["table" => "bank_transfers"])

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
