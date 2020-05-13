@extends('admin.layout.layout')

@section('title')

{{_i('Add Course')}}

@endsection



@section('page_header')

<section class="content-header">
    <h1>
        {{_i('Course')}}
        {{--<small>Control panel</small>--}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
        <li><a href="{{url('/admin/course/all')}}"> {{_i('All Courses')}}</a></li>
        <li class="active"><a href="{{url('/admin/course/create')}}"> {{_i('Add Course')}}</a></li>
    </ol>
</section>


@endsection

@section('content')


<div class="box box-info">
    <div class="box-header with-border">
        {{--<h3 class="box-title"> Course Form</h3>--}}
    </div>
    <!-- /.box-header -->


    <form method="POST" action="{{ url('/admin/course/create') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ============================================= Title ============================= -->

            <div class="form-group">
                <label for="name" class="col-xs-4 control-label">{{ _i('Course Name') }}</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{old('title')}}" placeholder=" Title" required="">
                    @if ($errors->has('title'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= sart date ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-4 control-label"> {{_i(' Start Date :')}} </label>

                <div class="col-xs-5">
                    <input type="date" name="start_date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('start_date'))
                    <strong>{{$errors->first('start_date')}}</strong>
                    @endif
                </div>
            </div>

            <!--========================================== end Date =======================================-->
            <div class="form-group">

                <label for="name" class="col-xs-4 control-label"> {{_i(' End Date :')}} </label>

                <div class="col-xs-5">
                    <input type="date" name="end_date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="">
                    @if($errors->has('end_date'))
                    <strong>{{$errors->first('end_date')}}</strong>
                    @endif
                </div>
            </div>

            <!-- ============================================= duration ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-4 control-label">{{ _i(' Duration :') }}</label>

                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{old('duration')}}" placeholder=" Duration" required="">

                    @if ($errors->has('duration'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duration') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= cost ============================= -->
            <div class="form-group">
                <label for="name" class="col-xs-4 control-label">{{ _i(' Cost :') }}</label>
                <div class="col-xs-5">
                    <input type="text" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" name="cost" value="{{old('cost')}}" placeholder=" Cost" required="">

                    @if ($errors->has('cost'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cost') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <!-- ================================== language =================================== -->
            <div class="form-group " >
                <label class="col-xs-4 control-label" for="language_addform">
                    {{_i('Language')}} </label>
                <div class="col-xs-5">
                    <select id="language_addform" class="form-control{{ $errors->has('lang_id') ? ' is-invalid' : '' }}" name="lang_id" required="">

                        <option disabled selected> {{_i('Choose')}}</option>
                        @foreach($langs as $language)
                            <option value="{{$language->id}}" {{old('lang_id') == $language->id ? 'selected' : '' }}> {{_i($language->title)}} </option>
                        @endforeach

                        @if ($errors->has('lang_id'))
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lang_id') }}</strong>
                            </span>
                        @endif
                    </select>
                </div>
            </div>

            <!-- ================================== country =================================== -->
            <div class="form-group " >
                <label class="col-xs-4 control-label " for="get_country">
                    {{_i('Country')}} </label>
                <div class="col-xs-5">
                    <select multiple required="" id="get_country" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="country_id[]" >

                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= currency ============================= -->

            <div class="form-group row">

                <label for="name" class="col-xs-4 control-label">{{ _i(' Currency') }}</label>

                <div class="col-xs-5">
                    <?php

                    ?>
                    {{$currencies->title}}
                    <input type="hidden" name="currency_id" readonly="" value="{{$currencies->id}}" />

                </div>
            </div>

            <!-- ============================================= Course Category ============================= -->

            <div class="form-group " >
                <label class="col-xs-4 control-label " for="get_category">
                    {{_i('Category')}} </label>
                <div class="col-xs-5">
                    <select required="" id="get_category" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="category_id" >

                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ============================================= Is Active ============================= -->
            @if(auth()->user()->hasRole('super-admin'))
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Status')}}</label>

                    <div class="col-xs-5">
                        <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="1">
                        <label class="form-check-label" for="type"> {{_i('Active')}} </label>

                        <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="0">
                        <label class="form-check-label" for="ype"> {{_i('Not Active')}} </label>

                        @if ($errors->has('is_active'))
                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('is_active') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            @endif
            <!-- ================================== Attachments =================================== -->
            <div class="form-group">
                <label class="col-xs-4 control-label">{{_i('Upload photo')}}</label>
                <div class="col-xs-5">
                    <input  type="file" name="file" id="filex" onchange="showImg(this)" class="btn btn-default" accept="image/gif, image/jpeg, image/png">
                    <strong>{{$errors->first('file')}}</strong>
                </div>
                <!-- Photo -->
                <img class="img-responsive pad" id="course_img" hidden style="margin-top: -250px">
            </div>

            <!----
            <div class="form-group">
                <label class="col-xs-4 control-label">{{_i('Upload Video')}}</label>
                <div class="col-xs-5 text-danger">
                    <input type="file" name="video" id="filev" class="btn btn-default" required="">
                    <strong>{{$errors->first('video')}}</strong>
                </div>
            </div>
            -->
            <!--========================================== Description =======================================-->
            <div class="form-group">

                <label for="name" class="col-xs-4 control-label">{{_i('Description')}}</label>
                <div class="col-xs-10">
                    <textarea id="editor1" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required="" value="{{old('description')}}" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place some text here"></textarea>
                    @if($errors->has('description'))
                    <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description')}}</strong>
                    </span>
                    @endif

                </div>
            </div>



            <!--========================================== upload files =======================================-->
               <div class="form-group row">

                   <label for="name" class="col-xs-2 control-label">{{_i('Media files')}}</label>
                   {{--<div class="col-xs-5">--}}
                       {{--<input type="file" name="files[]" id=""  class="btn btn-default" multiple>--}}
                       {{--@if($errors->has('files'))--}}
                           {{--<span class="text-danger invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('files')}}</strong>--}}
                    {{--</span>--}}
                       {{--@endif--}}
                       {{----}}
                   {{--</div>--}}

                   <div class="col-xs-5">
                       <input type="file" name="files[]" id="fileUploader" style="display: inline" class=" btn btn-default" >
                   </div>
                   <div class="col-xs-5">
                       <button class="btn btn-success btn-sm" type="button" id="add" title='{{_i("Add Media files")}}' onclick="Add()"><i class="glyphicon glyphicon-plus"></i> {{_i("Add new file")}}</button>
                   </div>

                   <div class="col-xs-4">

                   </div>
                   <div class="col-xs-8">
                       <div id="files" class="files"></div>
                   </div>

               </div>





        </div>

        <!-- /.box-body -->
        <div class="box-footer">
            {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
            <button type="submit" class="btn btn-info "> {{ _i('Save') }}</button>
        </div>
        <!-- /.box-footer -->

    </form>

</div>






@endsection






@section('footer')


<script>
    $(function() {
        CKEDITOR.replace('editor1',{
            height: 250,
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('admin/bower_components/ckeditor/ck_upload.php')}}",
        });

    });

    function showImg(input) {

        var filereader = new FileReader();
        filereader.onload = (e) => {
            console.log(e);
            $('#course_img').attr('src', e.target.result).width(250).height(250);
        };
        console.log(input.files);
        filereader.readAsDataURL(input.files[0]);

    }
</script>

<script type="text/javascript">
    function Add()
    {
        $("#files").append('<div ><input name="files[]" type="file" style="display: inline" class="btn btn-default" /><button type="button" class="btn btn-danger btn-sm" name="delete" onclick="Delete(this)" title="Delete file"><?=_i("delete file")?></button></div>');
    }
    function Delete(obj)
    {

        $(obj).closest('div').remove();
    }

</script>

@endsection

@push('js')

    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/country/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_country").empty();
                            $("#get_country").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_country").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_country").empty();
                        }
                    }
                });
            }else{
                $("#get_country").empty();
            }
        });

    </script>
    <script>
        $('#language_addform').change(function(){
            var languageID = $(this).val();
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/course/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            $("#get_category").empty();
                            $("#get_category").append('<option disabled>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_category").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_category").empty();
                        }
                    }
                });
            }else{
                $("#get_category").empty();
            }
        });

    </script>

@endpush
