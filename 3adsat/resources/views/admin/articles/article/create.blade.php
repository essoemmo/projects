
@extends('admin.layout.index',[
'title' => _i('Add Article '),
'subtitle' => _i('Add Article '),
'activePageName' => _i('Add Article'),
'additionalPageUrl' => url('/admin/panel/article/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <form  action="{{url('/admin/panel/article/store')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
        @csrf

        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/panel/article/all')}}" class="btn btn-default">{{ _i('All Articles') }}</a></li>
                        <li class="breadcrumb-item active">
                            <a href="{{url('/admin/panel/article/store')}}" >
                                <button type="submit" class="btn btn-primary">   <i class="ti-save"></i>
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
            <div class="row">
                <!-- left column -->
                <div class="col-sm-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 >{{ _i('Add Article') }}</h5>
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
                                <label for="sort_order" class="col-sm-2 control-label">{{ _i('Title') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" value="{{old('title')}}" id="txtUser" required="" class="form-control">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- ================================== language =================================== -->
                            <div class="form-group row" >
                                <label class="col-sm-2 control-label " for="lang_id">
                                    {{_i('Language')}} </label>
                                <div class="col-sm-10">
                                    <select id="language" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                                        <option disabled selected> {{_i('Choose')}}</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->name)}} </option>
                                        @endforeach

                                        @if ($errors->has('lang_id'))
                                            <span class="text-danger invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lang_id') }}</strong>
                                            </span>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!----==========================  category name==========================--->
                            <div class="form-group row" >
                                <label class="col-sm-2 control-label  " for="name">
                                    {{_i('Category')}}
                                </label>
                                <div class="col-sm-10">
                                    <select id="article_category" class="form-control{{ $errors->has('trainer_id') ? ' is-invalid' : '' }}" name="category_id" required="">

                                        <option disabled selected> {{_i('Choose')}}</option>

                                    </select>
                                </div>
                            </div>
                            <!----==========================  created ==========================--->
                            <div class="form-group row" >

                                <label class="col-sm-2 control-label " for="date">
                                    {{_i('Date ')}} </label>
                                <div class="col-sm-10">
                                    <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{old('created')}}">
                                </div>
                            </div>
                            <!----==========================  published ==========================--->
                            <!-- checkbox -->
                            <div class="form-group row" >

                                <label class="col-sm-2 control-label " for="published">
                                    {{_i('Publish')}}
                                </label>
                                <div class="col-sm-6">
{{--                                    <label>--}}
{{--                                        <input type="checkbox" class="minimal control-label" id="checkbox" name="published" value="1" {{old('published') == 1 ? 'checked' : ''}} >--}}
{{--                                    </label>--}}

                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" name="published" value="1"  {{old('published') == 1 ? 'checked' : ''}}  id="published">
                                            <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <!-- ================================== Attachments =================================== -->
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{_i('Image')}}</label>
                                <div class="col-sm-6">
                                    <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png"
                                           value="{{old('img_url')}}">
                                    <span class="text-danger invalid-feedback">
                                <strong>{{$errors->first('img_url')}}</strong>
                            </span>
                                </div>
                                <!-- Photo -->
                                <img class="img-responsive pad" id="article_img"  style="margin-top: -60px"  >
                            </div>
                            <!--========================================= Content =======================================-->
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{_i('Content')}}</label>
                                <div class="col-sm-12">
                                    <textarea id="editor2" class="textarea form-control editor {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required=""  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here...">{{old('content')}}</textarea>
                                    @if($errors->has('content'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content')}}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->


</form>


@endsection

@push('js')


    <script>
        $(function() {
            //Replace the <textarea id="editor1"> with a CKEditor
            CKEDITOR.replace('editor2');
        });
    </script>

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

    <script>

      //  $("#article_category").append('<option value>{{ _i('select') }}</option>');
        $('#language').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/panel/artcle_category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#article_category").empty();
                            $("#article_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#article_category").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#article_category").empty();
                        }
                    }
                });
            }else{
                $("#article_category").empty();
            }
        });

    </script>

@endpush
