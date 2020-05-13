
@extends('admin.layout.index',[
'title' => _i('Add Transaction Type'),
'subtitle' => _i('Add Transaction Type'),
'activePageName' => _i('Add Transaction Type'),
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
                <h5 >{{ _i('add new Transaction Type') }}</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('transactionType.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
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
                        <label class="col-xs-2 exampleInputEmail1" for="code">
                            {{_i('Code')}} </label>
                        <input type="text" name="code" value="{{old('code')}}" id="code" required="" class="form-control">
                        @if ($errors->has('code'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="main">
                            {{_i('main')}} </label>
                        {{Form::select('main',[0=>_i('backend'),1=>_i('frontend')],null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                        @if ($errors->has('main'))
                            <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('main') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="transaction_status">
                            {{_i('transaction status')}} </label>
                        {{Form::select('status',['bank'=>_i('bank'),'without'=>_i('without')],null,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                        @if ($errors->has('status'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
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
