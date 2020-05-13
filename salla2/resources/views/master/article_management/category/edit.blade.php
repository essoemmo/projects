@extends('master.layout.index',[
'title' => _i('Edit Article Category'),
'subtitle' => _i('Edit Article Category'),
'activePageName' => _i('Edit Article Category'),
'additionalPageUrl' => url('/master/article_cat') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Article Category') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ url('/master/article_cat/'.$article_cat->id.'/update') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="lang_id" id="language_addform" required="">
                                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                                        @foreach($langs as $lang)
                                            <option value="{{$lang->id}}" {{$article_cat_data['lang_id'] == $lang->id ? "selected":"" }}>{{_i($lang->title)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Title') }} <span style="color: #F00;">*</span></label>

                                <div class="col-sm-6">
                                    <input  type="text"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $article_cat_data['title'] }}"  placeholder=" {{_i('Article Category Title')}}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_active" class="col-sm-2 control-label">{{ _i('Publish') }}</label>

                                <div class="col-sm-3">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input id="is_active" type="checkbox" name="published" value="1" {{$article_cat['published']==1 ? "checked":""}}>
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- ================================== Attachments =================================== -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{_i('Image')}}</label>
                                @if(is_file(public_path($article_cat->img_url)))

                                    <div class="col-sm-4">
                                        <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*">
                                        <span class="text-danger invalid-feedback">
                                        <strong>{{$errors->first('img_url')}}</strong>
                                    </span>
                                    </div>

                                    <div class="col-sm-6">
                                        <img src="{{ asset($article_cat->img_url) }}" id="old_img"  style="margin: 0 auto; width: 300px; height: 250px;display: block" class="img-thumbnail">
                                    </div>
                                @else
                                    <div class="col-sm-4">
                                        <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/*">
                                        <span class="text-danger invalid-feedback">
                                    <strong>{{$errors->first('img_url')}}</strong>
                                </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <img class="img-responsive pad" id="article_img" style="margin: 0 auto;display: block;">
                                    </div>
                                @endif
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button class="btn btn-primary col-sm-6">{{_i('Save')}}</button>

                        </div>
                        <!-- /.box-footer -->


                    </form>

                </div>


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







