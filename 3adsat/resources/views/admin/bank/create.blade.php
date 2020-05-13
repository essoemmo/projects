
@extends('admin.layout.index',[
'title' => _i('Add Bank'),
'subtitle' => _i('Add Bank'),
'activePageName' => _i('Add Bank'),
'additionalPageUrl' => url('/admin/panel/transferBank') ,
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
                <h5 >{{ _i('add new Bank') }}</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('transferBank.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="txtUser">
                            {{_i('name of Bank')}} </label>
                        <input type="text" name="title" value="{{old('title')}}" id="title" required="" class="form-control">
                        @if ($errors->has('title'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="holder_name">
                            {{_i('holder name')}} </label>
                        <input type="text" name="holder_name" value="{{old('holder_name')}}" id="holder_name" required="" class="form-control">
                        @if ($errors->has('holder_name'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('holder_name') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="iban">
                            {{_i('iban')}} </label>
                        <input type="text" name="iban" value="{{old('iban')}}" id="iban" required="" class="form-control">
                        @if ($errors->has('iban'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('iban') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="holder_number">
                            {{_i('holder number')}} </label>
                        <input type="number" name="holder_number" value="{{old('holder_number')}}" id="holder_number" required="" class="form-control">
                        @if ($errors->has('holder_number'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('holder_number') }}</strong>
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
                        <img class="img-responsive pad" id="image" >
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i>{{_i('Save')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
@endsection
