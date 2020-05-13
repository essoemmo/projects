
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
                        @foreach($langs as $key => $lang)
                            <option value="<?=$lang['id']?>" @if(!empty($content_data[0])) {{$content_data[0]['lang_id'] == $lang['id'] ? 'selected' : ''}} @endif ><?=_i($lang['title'])?></option>
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
                <!--- -
                <div class="col-md-7 {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label><?=_i('Title')?> <span style="color: #F00;">*</span></label>
                    <input id="title"  class="form-control " name="title" required="" data-parsley-maxlength="191" value="<?=$content_section['title']?>">
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
                            <option value="<?=$i?>" <?=$content_section['columns'] == $i ? 'selected' : ''?> ><?=$i?></option>
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
                                                        <input id="title"  class="form-control " name="{{ $lang->locale }}_title" data-parsley-maxlength="191" value="<?=$content_data_title->where('locale' ,$lang->locale )->first()->title?>" required="">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div style="display: none;!important;"> <?= $contents = \App\Models\ContentSectionTranslation::where('content_section_id' ,$content_section['id'])->where('locale' , $lang->locale )->get(); ?></div>

                                                @foreach($contents  as $k => $single)

                                        <div class="col-md-6 column{{$k+1}}" >
                                            <label >{{_i('Column')}}{{$k+1}} <span style="color: #F00;">*</span></label>
                                            <textarea  class="textarea form-control editor" name="{{$lang->locale}}_content[]"  data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?=$single['content']?></textarea>
                                        </div>
                                    @endforeach

                                    @if(empty($content_data[0]))

                                        <div class="col-md-6 column1" >
                                             <label >{{_i('Column1')}} <span style="color: #F00;">*</span></label>
                                             <textarea  class="textarea form-control editor" name="{{$lang->locale}}_content[]"  data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                                        </div>

                                    @endif


                                    <div class="col-md-6 column_additional2"   style="display:none">
                                        <label >{{_i('Column2')}} <span style="color: #F00;">*</span></label>
                                        <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                                    </div>
                                    <div class="col-md-6 column_additional3"   style="display:none">
                                        <label >{{_i('Column3')}} <span style="color: #F00;">*</span></label>
                                        <textarea class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                                    </div>
                                    <div class="col-md-6 column_additional4"   style="display:none">
                                        <label >{{_i('Column4')}} <span style="color: #F00;">*</span></label>
                                        <textarea  class="textarea form-control editor" name="{{ $lang->locale }}_content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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


    <script> //columnNumber
        var count_content = $('#count_content_data').val();
        console.log(count_content);

        $('#column_select').click(function(){
            var selected_no = $(this).val();
            //console.log(selected_no);
            console.log(count_content);
            if(selected_no == 1){
                $('.column2').hide();
                $('.column3').hide();
                $('.column4').hide();
                $('.column_additional2').hide();
                $('.column_additional3').hide();
                $('.column_additional4').hide();
            }else if(selected_no == 2 ){
                $('.column2').show();
                $('.column3').hide();
                $('.column4').hide();
                $('.column_additional3').hide();
                $('.column_additional4').hide();
                if(count_content < 2){
                    $('.column_additional2').show();
                }
            }else if(selected_no == 3){
                $('.column2').show();
                $('.column3').show();
                $('.column4').hide();
                $('.column_additional4').hide();
                if(count_content < 2){
                    $('.column_additional2').show();
                    $('.column_additional3').show();
                }else if(count_content <3){
                    $('.column_additional3').show();
                }
            }
            else if(selected_no == 4){
                $('.column2').show();
                $('.column3').show();
                $('.column4').show();
                if(count_content < 2){
                    $('.column_additional2').show();
                    $('.column_additional3').show();
                    $('.column_additional4').show();
                }else if(count_content < 3){
                    $('.column_additional3').show();
                    $('.column_additional4').show();
                }else if(count_content < 4){
                    $('.column_additional4').show();
                }
            }
        });
    </script>
@endpush