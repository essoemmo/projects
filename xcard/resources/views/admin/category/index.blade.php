@extends('admin.layout.index',[
'title' => _i('All Categories'),
'activePageName' => _i('All Categories'),
] )
@section('content')
@include('admin.layout.session')
    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {!! $dataTable->table([
                     'class' => "table table-striped table-bordered nowrap dataTable"
                     ],true) !!}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
