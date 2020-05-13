@extends('admin.layout.index',[
'title' => _i('All NewsLetter'),
'activePageName' => _i('All NewsLetter'),
] )
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="index.html">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{_i('Pages')}}</a>
    </li>
    <li class="breadcrumb-item"><a href="#!">{{_i('NewsLetter')}}</a>
    </li>
@endsection
@section('content')
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
