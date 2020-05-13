
@extends('admin.layout.index',[
'title' => _i('Add Shipping Company'),
'subtitle' => _i('Add Shipping Company'),
'activePageName' => _i('Add Shipping Company'),
'additionalPageUrl' => url('/admin/panel/transactionType') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
{{--                        <li class="breadcrumb-item"><a href="{{url('/admin/panel/transferBank')}}" class="btn btn-default"><i class="ti-list"></i>{{ _i('All Banks') }}</a></li>--}}

                    </ol>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">

            <div class="card-header">
                <h5 >{{ _i('add new Shipping Company') }}</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('shipping_company.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="txtUser">
                            {{_i('Title')}} </label>
                        <input type="text" name="title" value="{{old('title')}}" id="title" required="" class="form-control">
                        @if ($errors->has('title'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="description">
                            {{_i('description')}} </label>
                        <textarea name="description" id="" class="form-control"></textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="logo">{{_i('Logo')}}</label>
                        <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                               value="{{old('logo')}}">
                        <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                        <!-- Photo -->
                        <img class="img-responsive pad" id="image">
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i> {{_i('Save')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
@endsection
