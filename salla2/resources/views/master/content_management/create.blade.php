@extends('master.layout.index',[
'title' => _i('Add content'),
'subtitle' => _i('Add content'),
'activePageName' => _i('Add content'),
'additionalPageUrl' => url('/master/content_management') ,
'additionalPageName' => _i('All'),
] )
@section('page_header_name')
{{ _i('Add Content') }}
@endsection


@section('content')
<!-- /.box-header -->
<!-- =====Filter Section===== -->
<div class="box-body">
    <form action="{{url('master/content_management')}}" method="post" enctype="multipart/form-data"
        data-parsley-validate="">
        <?= csrf_field() ?>

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/master/content_management')}}"
                                    class="btn btn-default"> <i class="ti-list"></i> {{ _i('All Contents') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{url('master/content_management')}}">
                                    <button type="submit" class="btn btn-primary"> <i class="ti-save"></i>
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
                        <h5>{{ _i('Add Content') }}</h5>
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
                                <select class="form-control" name="lang_id">
                                    <option selected disabled><?=_i('CHOOSE')?></option>
                                    @foreach($languages as $lang)
                                    <option value="<?=$lang['id']?>"
                                        <?=old('lang_id') == $lang['id'] ? 'selected' : ''?>><?=_i($lang['title'])?>
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label><?=_i('Type')?> </label>
                                <select class="form-control" name="type">
                                    <option selected disabled><?=_i('CHOOSE')?></option>
                                    <option value="home" <?=old('type') == 'home' ? 'selected' : ''?>><?=_i('Home')?>
                                    </option>
                                    <option value="footer" <?=old('type') == 'footer' ? 'selected' : ''?>>
                                        <?=_i('Footer')?></option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4  {{ $errors->has('order') ? ' has-error' : '' }}">
                                <label><?=_i(' Order ')?> <span style="color: #F00;">*</span></label>
                                <select class="form-control" name="order" required="">
                                    <option selected disabled><?=_i('CHOOSE')?></option>
                                    @for($i = 1 ; $i <= 10 ; $i++) <option value="<?=$i?>"
                                        <?=old('order') == $i ? 'selected' : ''?>><?=$i?></option>
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
                                <input id="title" class="form-control " data-parsley-maxlength="191"
                                    value="<?=old('title')?>" name="title" required="">
                                @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong><?= $errors->first('title') ?></strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <label><?=_i('Columns Number')?> <span style="color: #F00;">*</span></label>
                                <select class="form-control" name="columns" required="" id="column_select">
                                    <option selected disabled><?=_i('CHOOSE')?></option>
                                    @for($i = 1 ; $i <= 4 ; $i++) <option value="<?=$i?>"
                                        <?=old('columns') == $i ? 'selected' : ''?>><?=$i?></option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row"></div>
                        <!--========================================= Content =======================================-->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="editor1">{{_i('Column1')}} <span style="color: #F00;">*</span></label>
                                <textarea id="editor1" class="form-control" name="content[]" data-parsley-minlength="10"
                                    placeholder="Place write content here...">{{old('content')}}</textarea>
                            </div>

                            <div class="col-md-6" style="display:none" id="column2">
                                <label for="editor2">{{_i('Column2')}} <span style="color: #F00;">*</span></label>
                                <textarea id="editor2" class="form-control" name="content[]" data-parsley-minlength="10"
                                    placeholder="Place write content here...">{{old('content[1]')}}</textarea>
                            </div>

                            <div class="col-md-6" style="display:none" id="column3">
                                <label for="editor3">{{_i('Column3')}} <span style="color: #F00;">*</span></label>
                                <textarea id="editor3" class="form-control" name="content[]" data-parsley-minlength="10"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                    placeholder="Place write content here...">{{old('content[2]')}}</textarea>
                            </div>

                            <div class="col-md-6" style="display:none" id="column4">
                                <label for="editor4">{{_i('Column4')}} <span style="color: #F00;">*</span></label>
                                <textarea id="editor4" class="form-control" name="content[]" data-parsley-minlength="10"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                    placeholder="Place write content here...">{{old('content[3]')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>
</div>

@endsection

@push('js')
<script>
    $(function () {
        CKEDITOR.replace('editor1', {
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master.php')}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('editor2', {
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master.php')}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('editor3', {
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master.php')}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('editor4', {
            extraPlugins: 'colorbutton,colordialog',
            filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master.php')}}",
            filebrowserUploadMethod: 'form'
        });
    });

</script>
<script>
    //columnNumber
    $('#column_select').change(function () {

        var selected_no = $(this).val();
        console.log(selected_no);
        if (selected_no == 1) {
            $('#column2').hide();
            $('#column3').hide();
            $('#column4').hide();
        } else if (selected_no == 2) {
            $('#column2').show();
            $('#column3').hide();
            $('#column4').hide();
        } else if (selected_no == 3) {
            $('#column2').show();
            $('#column3').show();
            $('#column4').hide();
        } else if (selected_no == 4) {
            $('#column2').show();
            $('#column3').show();
            $('#column4').show();
        }
    });

</script>
@endpush
