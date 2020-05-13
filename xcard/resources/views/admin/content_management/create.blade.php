@extends('admin.layout.index',[
'title' => _i('Add Content '),
'subtitle' => _i('Add Content '),
'activePageName' => _i('Add Content'),
'additionalPageUrl' => route('content_management.index') ,
'additionalPageName' => _i('All'),
] )


@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('create new content') }}</h5>
        </div>

        <div class=" card-block">
            <form action="{{route('content_management.store')}}"  method="post"  class="j-forms" id="j-forms" enctype="multipart/form-data" data-parsley-validate="" >
                <?= csrf_field() ?>
                <div class="content">
                    <div class="row">
                        <!-- First Row -->
                        <div class="col-md-4">
                            <label><?=_i('Language')?> </label>
                            <select  class="form-control" name="lang_id">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                @foreach($langs as $lang)
                                    <option value="<?=$lang['id']?>" <?=old('lang_id') == $lang['id'] ? 'selected' : ''?> ><?=_i($lang['title'])?></option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label><?=_i('Type')?> </label>
                            <select  class="form-control" name="type">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                <option value="home" <?=old('type') == 'home' ? 'selected' : ''?> ><?=_i('Home')?></option>
                                <option value="footer" <?=old('type') == 'footer' ? 'selected' : ''?> ><?=_i('Footer')?></option>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4  {{ $errors->has('order') ? ' has-error' : '' }}">
                            <label><?=_i(' Order ')?> <span style="color: #F00;">*</span></label>
                            <select  class="form-control" name="order" required="">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                @for($i = 1 ; $i <= 10 ; $i++)
                                    <option value="<?=$i?>" <?=old('order') == $i ? 'selected' : ''?> ><?=$i?></option>
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
                    <!---
                        <div class="col-md-7 {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label><?=_i('Title')?> <span style="color: #F00;">*</span></label>
                            <input id="title"  class="form-control " name="title" required="" data-parsley-maxlength="191" value="<?=old('title')?>">
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback">
                                    <strong><?= $errors->first('title') ?></strong>
                                </span>
                            @endif
                        </div>
                       <div class="col-md-1"></div>
                        -->

                        <div class="col-md-7">
                            <label><?=_i('Columns Number')?> <span style="color: #F00;">*</span></label>
                            <select  class="form-control" name="columns" required=""  id="column_select" >
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                @for($i = 1 ; $i <= 4 ; $i++)
                                    <option value="<?=$i?>" <?=old('columns') == $i ? 'selected' : ''?> ><?=$i?></option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    <div class="form-group row"></div>
                    <!--========================================= Content =======================================-->

                    <div class="row form-group">
                        <div class="col-lg-12">

                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#{{ $lang->locale }}" role="tab" aria-expanded="false">{{ $lang->title }}</a>
                                        <div class="slide"></div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content card-block">
                                @foreach($langs as $key => $lang)
                                    <div class="tab-pane @if ($loop->first) active @endif" id="{{ $lang->locale }}" role="tabpanel" aria-expanded="false">

                                        <div class="form-group row" >
                                            <label class="col-md-2 control-label ">{{ $lang->title }} <?=_i('Title')?> <span style="color: #F00;">*</span></label>
                                            <div class="col-md-7">
                                                <input id="title"  class="form-control " name="{{ $lang->locale }}_title" data-parsley-maxlength="191" value="<?=old('title')?>" required="">
                                            </div>
                                        </div>


                                            <div class="row">
                                            <div class="col-md-6" >
                                                <label  >{{ $lang->title }} {{_i('Column1')}} <span style="color: #F00;">*</span></label>
                                                <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="{{ $lang->title }} {{ _i('content column1 here...') }} ">{{old('content[0]')}}</textarea>
                                            </div>

                                            <div class="col-md-6 column2" style="display:none" >
                                                <label >{{ $lang->title }} {{_i('Column2')}} <span style="color: #F00;">*</span></label>
                                                <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="{{ $lang->title }} {{ _i('content column2 here...') }}">{{old('content[1]')}}</textarea>
                                            </div>

                                            <div class="col-md-6 column3" style="display:none" >
                                                <label  >{{ $lang->title }} {{_i('Column3')}} <span style="color: #F00;">*</span></label>
                                                <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="{{ $lang->title }} {{ _i('content column3 here...') }}">{{old('content[2]')}}</textarea>
                                            </div>

                                            <div class="col-md-6 column4" style="display:none" >
                                                <label >{{ $lang->title }} {{_i('Column4')}} <span style="color: #F00;">*</span></label>
                                                <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="{{ $lang->title }} {{ _i('content column4 here...') }}">{{old('content[3]')}}</textarea>
                                            </div>
                                        </div>




                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>


    </div>

@endsection

@push('js')


    <script> //columnNumber
        $('#column_select').click(function(){
            var selected_no = $(this).val();
            //console.log(selected_no);
            if(selected_no == 1){
                $('.column2').hide();
                $('.column3').hide();
                $('.column4').hide();
            }else if(selected_no == 2){
                $('.column2').show();
                $('.column3').hide();
                $('.column4').hide();
            }else if(selected_no == 3){
                $('.column2').show();
                $('.column3').show();
                $('.column4').hide();
            }
            else if(selected_no == 4){
                $('.column2').show();
                $('.column3').show();
                $('.column4').show();
            }
        });
    </script>
@endpush