
@extends('admin.layout.index',[
'title' => _i('Add Cylinder '),
'subtitle' => _i('Add Cylinder '),
'activePageName' => _i('Add Cylinder'),
'additionalPageUrl' => url('/admin/panel/cylinder') ,
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
<form class="form-horizontal" action="{{ route('cylinder.store') }}" method="post" enctype="multipart/form-data" id="addForm" role="form" data-toggle="validator">
    @csrf

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("cylinder.index") }}" class="btn btn-default"><i class="ti-list"></i>{{ _i('cylinder List') }}</a></li>
                        <li class="breadcrumb-item active"><button type="submit" class="btn btn-primary">
                              <i class="ti-save"></i>  {{ _i('save') }}
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
                            <h5 class="card-title">{{ _i('Add cylinder') }}</h5>
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
                                                <div class="tab-pane active" id="tab-general">
                                                    <select class="form-control show_options" name="type" title='Choose one of the following...'>
                                                        <option value="">{{ _i('select') }}</option>
                                                        <option value="1">{{ _i('Colored') }}</option>
                                                        <option value="2">{{ _i('Transparent') }}</option>
                                                    </select>
                                                    <div id="show_cylinder" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="title" class="col-sm-2 control-label">{{ _i('Title') }}<span style="color: #F00;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="title" name="title_colored" placeholder="{{ _i('title') }}" value="{{ old('title') }}" required data-minlength="2">
                                                                {!! $errors->first('title','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price" class="col-sm-2 control-label">{{ _i('Price') }}<span style="color: #F00;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="price" name="price_colored" placeholder="{{ _i('price') }}" value="{{ old('price') }}" required data-minlength="2">
                                                                {!! $errors->first('price','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="show_cylinder_no_price" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="title" class="col-sm-2 control-label">{{ _i('Title') }}<span style="color: #F00;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="title" name="title_trans" placeholder="{{ _i('title') }}" value="{{ old('title') }}" required data-minlength="2">
                                                                {!! $errors->first('title','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price" class="col-sm-2 control-label">{{ _i('Price') }}<span style="color: #F00;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="price" name="price_trans" placeholder="{{ _i('price') }}" value="0" readonly data-minlength="2">
                                                                {!! $errors->first('price','<p class="text-danger"><strong>:message</strong></p>') !!}
                                                            </div>
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
</form>
@endsection
@push('js')

    <script>

        $(".show_options").on("change",function(){
            var show_options = $('.show_options option:selected').val();
            console.log(show_options);
            if(show_options == 1) {
                $("#show_cylinder").show();
                $('#show_cylinder_no_price').find('#title').removeAttr('required');
                $('#show_cylinder_no_price').find('#price').removeAttr('required');
            } else {
                $("#show_cylinder").hide();
                $('#show_cylinder_no_price').find('#title').prop('required',true);
                $('#show_cylinder_no_price').find('#price').prop('required',true);
            }
            if(show_options == 2) {
                $("#show_cylinder_no_price").show();
                $('#show_cylinder').find('#title').removeAttr('required');
                $('#show_cylinder').find('#price').removeAttr('required');
            } else {
                $("#show_cylinder_no_price").hide();
                $('#show_cylinder').find('#title').prop('required',true);
                $('#show_cylinder').find('#price').prop('required',true);
            }
        });
    </script>

@endpush
