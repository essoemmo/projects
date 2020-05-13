@extends('admin.layout.master', [
'title' => _i('Edit Article Category'),
'subtitle' => _i('Edit Article Category'),
'breadcrumb' => [ _i('Edit Article Category') => _i('Edit Article Category'), _i('Edit Article Category')]])


@section('content')


    <form  action="{{url('/admin/panel/artcle_category/'.$artcl_category->id.'/update')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

        @csrf
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/panel/artcle_category/all')}}" class="btn btn-default">{{ _i('All Article Category') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a  >
                                    <button type="submit" class="btn btn-info">  <i class="fa fa-save "></i>
                                        {{ _i('Save') }}
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ _i('Edit Article Category') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group row" >
                                    <label class="col-sm-2 control-label " for="txtUser">
                                        {{_i('Title')}} </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" value="{{$artcl_category->title}}" id="txtUser" required="" class="form-control">
                                        @if ($errors->has('title'))
                                            <span class="text-danger invalid-feedback">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!----==========================  published ==========================--->
                                <!-- checkbox -->
                                <div class="form-group row" >
                                    <label class="col-sm-2 control-label" for="checkbox">
                                        {{_i('Publish')}}
                                    </label>
                                    <div class="col-sm-10">
                                        <label>
                                            <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{$artcl_category->published == 1 ? 'checked' : ''}} >
                                        </label>
                                    </div>

                                </div>
                                <!-- ================================== language =================================== -->
                                <div class="form-group row" >
                                    <label class="col-sm-2 ccontrol-label " for="lang_id">
                                        {{_i('Language')}} </label>

                                    <div class="col-sm-10">
                                        <select class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">
                                            <option disabled selected> {{_i('Choose')}}</option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}" {{$artcl_category->lang_id == $language->id ? 'selected' : '' }}> {{_i($language->name)}} </option>
                                            @endforeach

                                            @if ($errors->has('lang_id'))
                                                <span class="text-danger invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <!--- =============================== Attachments =================================== -->
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{_i('Image')}}</label>

                                    @if(is_file(public_path('uploads/artcl_category/'.$artcl_category->id.'/'.$artcl_category->img_url)))
                                        <div class="bs-example bs-example-images">
                                            <div class="col-sm-6">
                                                <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                                <span class="text-danger invalid-feedback">
                                                    <strong>{{$errors->first('img_url')}}</strong>
                                                </span>
                                            </div>
                                            <img src="{{ asset('uploads/artcl_category/'.$artcl_category->id.'/'.$artcl_category->img_url) }}" id="old_img"  style="margin-left:450px; width: 300px; height: 250px;" class="img-thumbnail">
                                        </div>

                                    @elseif(is_file(public_path('uploads/artcl_category/'.$artcl_category->source_id.'/'.$artcl_category->img_url)))
                                        <div class="bs-example bs-example-images">
                                            <div class="col-sm-6">
                                                <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                                <span class="text-danger invalid-feedback">
                                                    <strong>{{$errors->first('img_url')}}</strong>
                                                </span>
                                            </div>
                                            <img src="{{ asset('uploads/artcl_category/'.$artcl_category->source_id.'/'.$artcl_category->img_url) }}" id="old_img"  style="margin-left:450px; width: 300px; height: 250px;" class="img-thumbnail">
                                        </div>

                                    @else
                                        <div class="col-sm-6">
                                            <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                                            <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('img_url')}}</strong>
                                </span>
                                        </div>

                                        <img class="img-responsive pad" id="article_img"  style="margin-top: -5px">
                                    @endif
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

@push('js')
    <script>

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(270).height(220);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#article_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

    </script>
@endpush

