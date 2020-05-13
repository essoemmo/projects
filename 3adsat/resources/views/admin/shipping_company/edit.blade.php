@extends('admin.layout.index',[
'title' => _i('Edit Shipping Company'),
'subtitle' => _i('Edit Shipping Company'),
'activePageName' => _i('Edit Shipping Company'),
'additionalPageUrl' => url('/admin/panel/shipping_company') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Shipping Company') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('shipping_company.update',$company->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="txtUser">
                                {{_i('Title')}} </label>
                            <input type="text" name="title" value="{{ $company->title }}" id="title" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="description">
                                {{_i('description')}} </label>
                            <textarea name="description" id="" class="form-control">
                                {{ $company->description }}
                            </textarea>
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
                            <img class="img-responsive pad" src="{{ asset($company->logo) }}" id="image">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> {{ _i('save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection
