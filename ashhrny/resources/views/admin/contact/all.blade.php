
@extends('admin.layout.index',[
'title' => _i('Contacts'),
'activePageName' => _i('Contacts'),
] )

@section('content')

    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {!! $dataTable->table([
                'class'=> 'table table-bordered table-striped  text-center col-sm-12'
            ],true) !!}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

@endsection