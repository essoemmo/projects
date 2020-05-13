@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Add bank')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Add bank')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/country/all')}}">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/adminpanel/transferBank/create')}}">{{_i('Add')}}</a></li>
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Add bank')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Add bank')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
            <form  action="{{url('/adminpanel/transferBank')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                @csrf
                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="txtUser">
                            {{_i('name of bank')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="title" value="{{old('title')}}" id="title" required="" class="form-control">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== holder_name =================================== -->
                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="holder_name">
                            {{_i('holder name')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="holder_name" value="{{old('holder_name')}}" id="holder_name" required="" class="form-control">
                            @if ($errors->has('holder_name'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('holder_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== iban =================================== -->
                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="iban">
                            {{_i('iban')}} </label>
                        <div class="col-sm-6">
                            <input type="text" name="iban" value="{{old('iban')}}" id="iban" required="" class="form-control">
                            @if ($errors->has('iban'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('iban') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- ================================== holder_number =================================== -->
                    <div class="form-group row" >

                        <label class="col-sm-2 col-form-label " for="holder_number">
                            {{_i('holder number')}} </label>
                        <div class="col-sm-6">
                            <input type="number" min="1" max="999999999" name="holder_number" value="{{old('holder_number')}}" id="holder_number" required="" class="form-control">
                            @if ($errors->has('holder_number'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('holder_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                   <!-- ================================== Attachments =================================== -->
                    <div class="form-group">
                        <label class="col-sm-2 col-form-label" for="logo">{{_i('Logo')}}</label>
                        <div class="col-sm-4">
                            <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                   value="{{old('logo')}}">
                            <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                        </div>
                        <!-- Photo -->
                        <div class="col-sm-6">
                            <img class="img-responsive pad" id="article_img" style="margin: 0 auto;display: block;">
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-left" >
                        {{_i('Add')}}
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>
    </div>


@endsection

@push('js')
    <script>


        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#article_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>

@endpush
