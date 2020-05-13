
@extends('admin.layout.index',[
'title' => _i('Add Manufacturer '),
'subtitle' => _i('Add Manufacturer'),
'activePageName' => _i('Add Manufacturer'),
'additionalPageUrl' => url('/admin/panel/manufacturers') ,
'additionalPageName' => _i('All'),
] )


@push('css')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css"></style>
<style type="text/css">
.form-group {
    margin-top: 15px;
}

</style>
@endpush
@section('content')
<form class="form-horizontal" action="{{ route('manufacturers.store') }}" method="post" enctype="multipart/form-data" id="addForm" role="form" data-toggle="validator" data-parsley-validate="" >
    @csrf


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("manufacturers.index") }}" class="btn btn-default"> <i class="ti-list"></i>{{ _i('Manufacturers List') }}</a></li>
                        <li class="breadcrumb-item active"><button type="submit" class="btn btn-primary">
                               <i class="ti-save"></i> {{ _i('save') }}
                            </button></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">
                            <h5 class="card-title">{{ _i('Add manufacturers') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->

                                        <div class="card-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">{{ _i('Name') }}<span style="color: #F00;">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ _i('Manufacturer Name') }}" value="{{ old('name') }}" required>
                                                        {!! $errors->first('name','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image" class="col-sm-2 control-label">{{ _i('Image') }}<span style="color: #F00;">*</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png" required>
                                                        {!! $errors->first('image','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Sort Order') }}</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" min="1" id="sort_order" name="sort_order" placeholder="{{ _i('Sort Order') }}" data-parsley-type="number" value="{{ old('sort_order', 1) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-content -->
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</form>
@endsection
{{--@push('js')--}}
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
{{--@endpush--}}
