
@extends('admin.layout.index',[
'title' => _i('Show Contact'),
'subtitle' => _i('Show Contact'),
'activePageName' => _i('Show Contact'),
'additionalPageUrl' => url('/admin/panel/contact/all') ,
'additionalPageName' => _i('All Contacts'),
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
    <form class="form-horizontal"  enctype="multipart/form-data" id="editForm" role="form" data-toggle="validator">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/panel/contact/all')}}" class="btn btn-default"> <i class="ti-arrow-left"></i>{{ _i('Back') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{url('/admin/panel/contact/'.$contact->id.'/delete')}}" >
                                <button type="button" class="btn btn-danger">  <i class="ti-trash"></i>
                                    {{ _i('Delete') }}
                                </button>
                                </a>
                            </li>
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
                                <h5 class="card-title">{{ _i('Show Contact') }}</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body card-block">

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  value="{{$contact->name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  value="{{$contact->email}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Phone') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  value="{{$contact->phone}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Country') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  value="{{$country_description}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sort_order" class="col-sm-2 control-label">{{ _i('Message') }}</label>
                                    <div class="col-sm-10">
                                        <textarea id="message"  class="form-control" name="message" required="" >{{$contact->message}}</textarea>
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


