@extends('master.layout.index',[
'title' => _i('Country'),
'subtitle' => _i('Country'),
'activePageName' => _i('Country'),
'additionalPageUrl' => url('/master/country/all') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Add Country')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Add Country')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->

        <div class="card">

            <div class="card-title">
                <h5>{{_i('Add Country')}}</h5>
            </div>

            <div class="card-block">
                <form  action="{{url('/master/country/store')}}" method="post" class="form-horizontal"id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

                    @csrf
                    <div class="box-body">
                        <div class="form-group row">
                        </div>

                        <div class="form-group row" >

                            <label class="col-sm-2 col-form-label " for="txtUser">
                                {{_i('Title')}} </label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{old('title')}}" id="txtUser" required="" class="form-control">
                                @if ($errors->has('title'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- ================================== code =================================== -->
                        <div class="form-group row" >

                            <label class="col-sm-2 col-form-label " for="code">
                                {{_i('County Code')}} </label>
                            <div class="col-sm-10">
                                <input type="text" name="code" value="{{old('code')}}" id="code" required="" class="form-control">
                                @if ($errors->has('code'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- ================================== Attachments =================================== -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="logo">{{_i('Logo')}}</label>
                            <div class="col-sm-4">
                                <input type="file" name="logo" id="logo" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                       value="{{old('logo')}}">
                                <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('logo')}}</strong>
                            </span>
                            </div>
                            <!-- Photo -->
                            <div class="col-sm-12">
                                <img class="img-responsive pad" id="article_img" style="margin: 0 auto;display: block;">
                            </div>
                        </div>



                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                        <button type="submit" class="btn btn-info pull-left col-md-12" >
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
