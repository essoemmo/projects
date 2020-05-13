
@extends('admin.layout.index',[
'title' => _i('Edit Manufacturer '),
'subtitle' => _i('Edit Manufacturer'),
'activePageName' => _i('Edit Manufacturer'),
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
<form class="form-horizontal" action="{{ route('manufacturers.update', ['id' => $editData->id]) }}" method="POST" enctype="multipart/form-data" id="editForm" role="form" data-toggle="validator" data-parsley-validate="" >
    @csrf
    {{ method_field('PUT') }}


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("manufacturers.index") }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('Manufacturers List') }}</a></li>
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
                            <h5 class="card-title">{{ _i('Edit manufacturers') }}</h5>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                      <div class="card-body">
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="name" class="col-sm-2 control-label">{{ _i(' Name') }}<span style="color: #F00;">*</span></label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name" name="name" placeholder="{{ _i('Manufacturer Name') }}" value="{{ old('name', $editData->name) }}" required data-minlength="2">
                                      {!! $errors->first('name','<p class="text-danger"><strong>:message</strong></p>') !!}
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="image" class="col-sm-2 control-label">{{ _i('Image') }}<span style="color: #F00;">*</span></label>
                                  <div class="col-sm-10">
                                      <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                          <input type="file" name="image" id="image" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                          {!! $errors->first('image','<p class="text-danger"><strong>:message</strong></p>') !!}
                                      </div>
                                          <div class="bs-example bs-example-images">
                                              <img src="{{ asset('/images/manufacturers/'.$editData->image) }}" width="300px" class="img-thumbnail">
                                          </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="sort_order" class="col-sm-2 control-label">{{ _i('Sort Order') }}</label>
                                  <div class="col-sm-10">
                                      <input type="number" class="form-control" min="1" id="sort_order" name="sort_order" placeholder="{{ _i('Sort Order') }}" data-parsley-type="number" value="{{ old('sort_order', $editData->sort_order) }}">
                                  </div>
                              </div>
                          </div>

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
