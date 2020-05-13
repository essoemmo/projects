@extends('master.layout.index',[
'title' => _i('Edit Sample'),
'subtitle' => _i('Edit Sample'),
'activePageName' => _i('Edit Sample'),
'additionalPageUrl' => url('/master/samples/all') ,
'additionalPageName' => _i('All'),
])

@section('content')

<!-- Page-body start -->
<div class="page-body">
    <!-- Blog-card start -->
    <div class="card blog-page" id="blog">
        <div class="card-block">
    <div class="box-body">
        <form  action="{{url('master/samples/'.$sample->id.'/update')}}" method="post" class="form-horizontal" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">

            @csrf

             <!-- ================================== lang =================================== -->

             <div class="form-group row">
                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" name="lang_id" id="language_addform" required="">
                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                        @foreach($languages as $lang)
                            <option value="{{$lang->id}}" {{$sample_data->lang_id ==$lang->id ?"selected":"" }}>{{_i($lang->title)}}</option>
                        @endforeach
                    </select>
                    <small  class="form-text text-muted">{{_i('Please select language to show article categories')}}</small>
                </div>
            </div>


            <!-- ================================== category_id =================================== -->

            <div class="form-group row" id="store_id">

                <label for="store_id" class=" col-sm-2 col-form-label"> {{_i('Store')}} <span style="color: #F00;">*</span> </label>

                <div class="col-sm-6">
                     <select id="category" class="form-control" name="store_id" >
                         @foreach($stores as$value)
                             <option {{ $sample->store_id == $value->id ? 'selected' : '' }} value="{{ $value->id }}"> {{ $value->title }}</option>
                         @endforeach
                     </select>
                </div>

            </div>


            <!-- ================================== image =================================== -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="image">{{_i('Image')}} <span style="color: #F00;">*</span> </label>

                @if(is_file(public_path('uploads/samples/'.$sample->id.'/'.$sample->img_url)))

                    <div class="col-sm-6">
                        <input type="file" name="img_url" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/*">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>
                    </div>

                    <div class="bs-example bs-example-images">
                        <img src="{{ asset('uploads/samples/'.$sample->id.'/'.$sample->img_url) }}" id="old_img"  style=" width: 300px; height: 150px;" class="img-thumbnail">
                    </div>
                @else
                    <div class="col-sm-6">
                        <input type="file" name="img_url" id="filex" onchange="apperImage(this)" class="btn btn-default" accept="image/*" required="">
                        <span class="text-danger invalid-feedback">
                            <strong>{{$errors->first('image')}}</strong>
                        </span>
                    </div>

                    <img class="img-responsive pad" id="slider_img" hidden style="margin-top: -200px; width: 300px; height: 250px;" >
                @endif

            </div>
                <!-- ================================== description =================================== -->
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="txtUser">
                         {{_i('Description')}} <span style="color: #F00;">*</span> </label>

                    <div class="col-sm-6">
                         <textarea id="editor1" id="description" class="form-control" name="description" placeholder="{{_i('Sample description')}}&hellip;"
                         >{{$sample_data->description}}</textarea>
                    </div>

                </div>





            <!-- /.box-body -->
            <div class="box-footer">

                <button type="submit" class="btn btn-info pull-left" >
                    {{_i('Save')}}
                </button>
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

        $(function () {
            CKEDITOR.replace('editor1', {
                filebrowserUploadUrl: "{{asset('AdminFlatAble/ckeditor/ck_upload.php')}}",
                filebrowserUploadMethod: 'form'
            });
        });

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(300).height(250);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }



        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#new_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

    </script>

@endpush
