
@extends('admin.layout.index',[
'title' => _i('Edit axis '),
'subtitle' => _i('Edit axis '),
'activePageName' => _i('Edit axis'),
'additionalPageUrl' => url('/admin/panel/axis') ,
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
{{-- {{ Form::open(['route' => 'boilerplate.pages.store', 'autocomplete' => 'off', 'class' =>
'form-horizontal']) }} --}}
<form class="form-horizontal" action="{{ route('axis.update', ['id' => $axis->id]) }}" method="POST" enctype="multipart/form-data" id="editForm" role="form" data-toggle="validator">
    @csrf
    {{ method_field('PUT') }}



    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("axis.index") }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('axis List') }}</a></li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">{{ _i('Edit axis') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="" id="tab-data">
                            <div class="col-sm-1"></div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->
                                        <div class="d-flex p-0">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a class="nav-link active" href="#tab-general" data-toggle="tab">{{ _i('General') }}<i class="fa"></i></a></li>
                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <h4>
                                                    @if($axis->type == 1)
                                                        {{ _i('Colored') }}
                                                    @elseif($axis->type == 2)
                                                        {{ _i('Transparent') }}
                                                    @endif
                                                </h4>
                                                <div class="tab-pane active" id="tab-general">
                                                    <div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">{{ _i('Title') }}<span style="color: #F00;">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ _i('title') }}" value="{{ old('model', $axis->title) }}" required data-minlength="2">
                                                            {!! $errors->first('title','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="price" class="col-sm-2 control-label">{{ _i('Price') }}<span style="color: #F00;">*</span></label>
                                                        <div class="col-sm-10">
                                                            @if($axis->type == 1)
                                                                <input type="text" class="form-control" id="price" name="price" placeholder="{{ _i('price') }}" value="{{ old('model', $axis->price) }}" >
                                                                {!! $errors->first('price','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            @elseif($axis->type == 2)
                                                                <input type="text" class="form-control" readonly id="price" name="price" placeholder="{{ _i('price') }}" value="{{ old('model', $axis->price) }}" >
                                                                {!! $errors->first('price','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            @endif
                                                        </div>
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


    {{-- {{ Form::close() }} --}}
</form>
@endsection

@push('js')
{{--<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>--}}
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
{{--<script>--}}
{{--$('#page_category_id').select2();--}}
{{--</script>--}}
@endpush
