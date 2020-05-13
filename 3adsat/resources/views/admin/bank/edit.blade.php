@extends('admin.layout.index',[
'title' => _i('Edit Bank'),
'subtitle' => _i('Edit Bank'),
'activePageName' => _i('Edit Bank'),
'additionalPageUrl' => url('/admin/panel/transferBank') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Bank') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('transferBank.update',$bank->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="txtUser">
                                {{_i('name of Bank')}} </label>
                            <input type="text" name="title" value="{{ $bank->title }}" id="title" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="holder_name">
                                {{_i('holder name')}} </label>
                            <input type="text" name="holder_name" value="{{ $bank->holder_name }}" id="holder_name" required="" class="form-control">
                            @if ($errors->has('holder_name'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('holder_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="iban">
                                {{_i('iban')}} </label>
                            <input type="text" name="iban" value="{{ $bank->iban }}" id="iban" required="" class="form-control">
                            @if ($errors->has('iban'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('iban') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="holder_number">
                                {{_i('holder number')}} </label>
                            <input type="number" name="holder_number" value="{{ $bank->holder_number }}" id="holder_number" required="" class="form-control">
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
                        </div>

                        <!-- Photo -->
                        <div>
                            <img class="img-responsive pad" width="150px" height="150px" src="{{ asset($bank->logo) }}" id="image">
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
