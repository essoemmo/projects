
@extends('admin.layout.index',[
'title' => _i('Content Edit ') . ' | ' .$content_section['title'],
'subtitle' => _i('Content Edit ') . ' | ' .$content_section['title'],
'activePageName' => _i('Content Edit ') ,
'additionalPageUrl' => route('content_management.index') ,
'additionalPageName' => _i('All'),
] )

@section('content')
    <!-- /.box-header -->
    <!-- =====Filter Section===== -->
    <div class="box-body" >
        <form action="{{route('content_management.update',$content_section->id)}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" >
            @method('PUT')
            <?= csrf_field() ?>
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('content_management.index')}}" class="btn btn-default"><i class="ti-list"></i> {{ _i('All Contents') }}</a></li>
                                <li class="breadcrumb-item active">
                                    <a href="{{route('content_management.update',$content_section->id)}}" >
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h5 >{{ _i('Add Content') }}</h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                                <i class="icofont icofont-refresh"></i>
                                <i class="icofont icofont-close-circled"></i>
                            </div>

                        </div>
                        <div class="card-body card-block">

            <div class="row">
                <!-- First Row -->
                <div class="col-md-4">
                    <label><?=_i('Language')?> </label>
                    <select  class="form-control" name="lang_id">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        @foreach($languages as $lang)
                            @if(count($content_data) > 0)
                                <option value="<?=$lang['id']?>" <?=$content_data[0]['lang_id'] == $lang['id'] ? 'selected' : ''?> ><?=_i($lang['name'])?></option>
                            @else
                                <option value="<?=$lang['id']?>"  ><?=_i($lang['name'])?></option>
                            @endif
                        @endforeach

                    </select>
                </div>

                <div class="col-md-3">
                    <label><?=_i('Type')?> </label>
                    <select  class="form-control" name="type">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        <option value="home" <?=$content_section['type'] == 'home' ? 'selected' : ''?> ><?=_i('Home')?></option>
                        <option value="footer" <?=$content_section['type'] == 'footer' ? 'selected' : ''?> ><?=_i('Footer')?></option>
                    </select>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4  {{ $errors->has('order') ? ' has-error' : '' }}">
                    <label><?=_i(' Order ')?> <span style="color: #F00;">*</span></label>
                    <select  class="form-control" name="order" required="">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        @for($i = 1 ; $i <= 10 ; $i++)
                            <option value="<?=$i?>" <?=$content_section['order'] == $i ? 'selected' : ''?> ><?=$i?></option>
                        @endfor
                    </select>
                    @if ($errors->has('order'))
                        <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('order') ?></strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row"></div>
            <div class="row">
                <!-- Second Row -->
                <div class="col-md-7 {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label><?=_i('Title')?> <span style="color: #F00;">*</span></label>
                    <input id="title"  class="form-control " name="title" data-parsley-maxlength="191" value="<?=$content_section['title']?>">
                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('title') ?></strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <label><?=_i('Columns Number')?> <span style="color: #F00;">*</span></label>
                    <select  class="form-control" name="columns" required=""  id="column_select" >
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        @for($i = 1 ; $i <= 4 ; $i++)
                            <option value="<?=$i?>" <?=$content_section['columns'] == $i ? 'selected' : ''?> ><?=$i?></option>
                        @endfor
                    </select>
                </div>
            </div>
                            <!-------------------   choose country ------>
            <div class="form-group">
                <label class="col-xs-2 " for="country_id"> <?=_i('Countries')?> <span style="color: #F00;">*</span> </label>

                <select class="form-control selectpicker" multiple style="width: 100%;" id="country_id" name="country_id[]" required="" data-validate="true">
                    @foreach ($country as $coun)
                        @foreach ($coun->hasDescription->where('language_id',checknotsessionlang()) as $co)
                            <option value="{{$co->country_id}}"
                                    @foreach($section_country as $item)
                                    @if($item['country_id'] == $co->country_id) selected @endif
                                    @endforeach >
                                {{ $co->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="form-group row"></div>
            <!--========================================= Content =======================================-->
            <div class="row">

                @foreach($content_data as $key => $single)
                    <div class="col-md-6" id="column{{$key+1}}">
                        <label for="editor{{$key+1}}" >{{_i('Column')}}{{$key+1}} <span style="color: #F00;">*</span></label>
                        <textarea id="editor{{$key+1}}" class="textarea form-control" name="content[]" required="" data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?=$single['content']?></textarea>
                    </div>
                @endforeach
                    <div class="col-md-6"  id="column_additional2" style="display:none">
                        <label for="editor2">{{_i('Column2')}} <span style="color: #F00;">*</span></label>
                        <textarea id="editor2" class="textarea form-control" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                    </div>
                    <div class="col-md-6"  id="column_additional3" style="display:none">
                        <label for="editor3">{{_i('Column3')}} <span style="color: #F00;">*</span></label>
                        <textarea id="editor3" class="textarea form-control" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                    </div>
                    <div class="col-md-6"  id="column_additional4" style="display:none">
                        <label for="editor4">{{_i('Column4')}} <span style="color: #F00;">*</span></label>
                        <textarea id="editor4" class="textarea form-control" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                    </div>
            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="count_content_data" value="<?=count($content_data)?>" >
@endsection

@push('js')


    <script>
        $(function() {
            CKEDITOR.replace('editor1',{
                filebrowserUploadUrl: "{{asset('admin2/assets/pages/ckeditor/ck_upload.php')}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('editor2',{
                filebrowserUploadUrl: "{{asset('admin2/assets/pages/ckeditor/ck_upload.php')}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('editor3',{
                filebrowserUploadUrl: "{{asset('admin2/assets/pages/ckeditor/ck_upload.php')}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('editor4',{
                filebrowserUploadUrl: "{{asset('admin2/assets/pages/ckeditor/ck_upload.php')}}",
                filebrowserUploadMethod: 'form'
            });
            //CKEDITOR.replace('editor4');
        });
    </script>

    <script> //columnNumber
        var count_content = $('#count_content_data').val();
        console.log(count_content);

        $('#column_select').change(function(){
            var selected_no = $(this).val();
            //console.log(selected_no);
            if(selected_no == 1){
                $('#column2').hide();
                $('#column3').hide();
                $('#column4').hide();
                $('#column_additional2').hide();
                $('#column_additional3').hide();
                $('#column_additional4').hide();
            }else if(selected_no == 2 ){
                $('#column2').show();
                $('#column3').hide();
                $('#column4').hide();
                $('#column_additional3').hide();
                $('#column_additional4').hide();
                if(count_content < 2){
                    $('#column_additional2').show();
                }
            }else if(selected_no == 3){
                $('#column2').show();
                $('#column3').show();
                $('#column4').hide();
                $('#column_additional4').hide();
                if(count_content < 2){
                    $('#column_additional2').show();
                    $('#column_additional3').show();
                }else if(count_content <3){
                    $('#column_additional3').show();
                }
            }
            else if(selected_no == 4){
                $('#column2').show();
                $('#column3').show();
                $('#column4').show();
                if(count_content < 2){
                    $('#column_additional2').show();
                    $('#column_additional3').show();
                    $('#column_additional4').show();
                }else if(count_content < 3){
                    $('#column_additional3').show();
                    $('#column_additional4').show();
                }else if(count_content < 4){
                    $('#column_additional4').show();
                }
            }
        });
    </script>
@endpush
