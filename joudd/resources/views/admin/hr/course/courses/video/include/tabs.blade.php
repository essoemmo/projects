
<div class="col-12">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php
            $languages = \App\Models\Language::all();
            $active = "active";
            foreach ($languages as $lang) {
                ?>
                <li  class="{{$active}}">
                    <a href="#tab_<?= $lang->id ?>" data-toggle="tab" >
                        <?= $lang->title ?>
                    </a>
                </li>
                <?php
                $active = "";
            }
            ?>
            <!--            <li>
                            <a href="#tab_1" class=" active" data-toggle="tab" >
                                {{_i('EN')}}
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2"  data-toggle="tab">
                                {{_i('AR')}}
                            </a>
                        </li>-->
        </ul>
        <div class="tab-content">
            <?php
            $active = "active";
            foreach ($languages as $lang) {
                ?>
                <div class="tab-pane {{$active}}" id="tab_<?= $lang->id ?>">
                    <div class="row">
                        <!-- ============================================= Title ============================= -->
                        <div class="col-xs-2">
                            <label for="name" class="control-label"> {{_i("Title")}} <span style="color: #ff3960;">*</span></label>
                        </div>

                        <div class="col-xs-10">
                            <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_{{$lang->code}}" value="{{old('title_en')}}" placeholder="English Title" required="" >
                            @if ($errors->has('title_'.$lang->code))
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong><?= $errors->first('title_' . $lang->code) ?></strong>
                            </span>
                            @endif
                        </div>

                        <!-- ============================================= description ============================= -->
                        <div class="col-xs-2">

                            <label for="name" class=" control-label"> {{_i("Description")}} </label>
                        </div>
                        <div class="col-xs-10">
                            <textarea id="editor1" class="textarea form-control{{ $errors->has('description_'.$lang->code) ? ' is-invalid' : '' }}" name="description_{{$lang->code}}"  style=""  placeholder="Place some text here">{{old('description'.$lang->code)}}</textarea>
                            @if($errors->has('description_'.$lang->code))
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description')}}</strong>
                            </span>
                            @endif
                        </div>


                        <!--========================================== upload tag english files =======================================-->

                        <div class="col-xs-2">
                            <label for="name" class=" control-label"> {{_i("Attachments")}} </label>
                        </div>
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-6" >
                                    <label s for="name" class="control-label"> {{_i("Tag")}} </label>

                                </div>
                                <div class="col-xs-6" >
                                    <label  class=""> {{_i("Sound")}} </label>

                                </div>
                                <div id="div_file_{{$lang->code}}" class="col-xs-10">
                                  
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="tag_{{$lang->code}}[]" placeholder="{{$lang->title}} Title" >
                                    </div>

                                    <div class="col-xs-5">
                                        <input type="file" name="tag_{{$lang->code}}_files[]" id="fileUploader" style="display: inline" class=" btn btn-default" accept="audio/*">
                                    </div>
                                  
                                </div>
                                <div class="col-2">                    
                                    <button class="btn btn-success btn-sm" type="button" id="add" title="Add {{$lang->title}} Sound files" onclick="Add('div_file_{{$lang->code}}','files_{{$lang->code}}')"><i class="glyphicon glyphicon-plus"></i> {{_i("Add new sound file")}}</button>
                                </div>

                                <div  id="files_{{$lang->code}}" >

                                </div>
                            </div></div>
                    </div>
                </div>

                <?php
                $active = "";
            }
            ?>
        </div>
    </div>
</div>

