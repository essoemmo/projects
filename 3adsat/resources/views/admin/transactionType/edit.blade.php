@extends('admin.layout.index',[
'title' => _i('Edit Transaction Type'),
'subtitle' => _i('Edit Transaction Type'),
'activePageName' => _i('Edit Transaction Type'),
'additionalPageUrl' => url('/admin/panel/transactionType') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Transaction Type') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('transactionType.update',$type->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="txtUser">
                                {{_i('Title')}} </label>
                            <input type="text" name="title" value="{{ $type->title }}" id="title" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="code">
                                {{_i('Code')}} </label>
                            <input type="text" name="code" value="{{ $type->code }}" id="code" required="" class="form-control">
                            @if ($errors->has('code'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="main">
                                {{_i('main')}} </label>
                            {{Form::select('main',[0=>_i('backend'),1=>_i('frontend')],$type->main,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                            @if ($errors->has('main'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('main') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="transaction_status">
                                {{_i('transaction status')}} </label>
                            {{Form::select('status',['bank'=>_i('bank'),'without'=>_i('without')],$type->status,['class'=>'form-control','placeholder'=>_i('select ...')])}}
                            @if ($errors->has('status'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ _i('save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection
