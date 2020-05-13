
@extends('admin.layout.index',[
'title' => _i('All Home Page Section'),
'subtitle' => _i('All Home Page Section'),
'activePageName' => _i('Add Home Page Section'),
'additionalPageUrl' => url('/admin/panel/section_products') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ _i('Home Page Section') }}</h5>
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
