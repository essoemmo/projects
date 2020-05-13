<?php $__env->startSection('content'); ?>

    <div class="box-body" >
        <form action="<?php echo e(route('contentManagement.update',$content_section->id)); ?>" method="POST" enctype="multipart/form-data" data-parsley-validate="" >
            <?php echo method_field('PUT'); ?>
            <?= csrf_field() ?>
            <div class="row">
                <!-- First Row -->
                <div class="col-md-4">
                    <label><?=_i('Language')?> </label>
                    <select  class="form-control" name="lang_id">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?=$lang['id']?>" <?=$content_data[0]['lang_id'] == $lang['id'] ? 'selected' : ''?> ><?=$lang['name']?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                <div class="col-md-4  <?php echo e($errors->has('order') ? ' has-error' : ''); ?>">
                    <label><?=_i('Order')?> <span class=" text-red">*</span></label>
                    <select  class="form-control" name="order" required="">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        <?php for($i = 1 ; $i <= 10 ; $i++): ?>
                            <option value="<?=$i?>" <?=$content_section['order'] == $i ? 'selected' : ''?> ><?=$i?></option>
                        <?php endfor; ?>
                    </select>
                    <?php if($errors->has('order')): ?>
                        <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('order') ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row"></div>
            <div class="row">
                <!-- Second Row -->
                <div class="col-md-4 <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                    <label><?=_i('Title')?> <span class=" text-red">*</span></label>
                    <input id="title"  class="form-control " name="title" required="" data-parsley-maxlength="191" value="<?=$content_section['title']?>">
                    <?php if($errors->has('title')): ?>
                        <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('title') ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="col-md-3">
                    <label><?=_i('Columns Number')?> <span class=" text-red">*</span></label>
                    <select  class="form-control" name="columns" required=""  id="column_select" >
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        <?php for($i = 1 ; $i <= 4 ; $i++): ?>
                            <option value="<?=$i?>" <?=$content_section['columns'] == $i ? 'selected' : ''?> ><?=$i?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-1"></div>
                <?php
                $arr = ["main"=>'main',
                    "single" => 'single',
                ]
                ?>
                <div class="col-md-4  <?php echo e($errors->has('system_type') ? ' has-error' : ''); ?>">
                    <label><?=_i('system_type')?> <span class=" text-red">*</span></label>
                    <select  class="form-control" name="system_type" required="">
                        <option selected disabled><?=_i('CHOOSE')?></option>
                        <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?=$k?>" <?=$content_section->system_type == $k ? 'selected' : ''?> ><?php echo e($val); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('system_type')): ?>
                        <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('system_type') ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row"></div>
            <!--========================================= Content =======================================-->
            <div class="row">

                <?php $__currentLoopData = $content_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6" id="column<?php echo e($key+1); ?>">
                        <label for="editor<?php echo e($key+1); ?>" ><?php echo e(_i('Column')); ?><?php echo e($key+1); ?> <span class=" text-red">*</span></label>
                        <textarea id="editor<?php echo e($key+1); ?>" class="textarea form-control ckeditor" name="content[]" required="" data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?=$single['content']?></textarea>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6"  id="column_additional2" style="display:none">
                    <label for="editor2"><?php echo e(_i('Column2')); ?> <span class=" text-red">*</span></label>
                    <textarea id="editor2" class="textarea form-control ckeditor" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                </div>
                <div class="col-md-6"  id="column_additional3" style="display:none">
                    <label for="editor3"><?php echo e(_i('Column3')); ?> <span class=" text-red">*</span></label>
                    <textarea id="editor3" class="textarea form-control ckeditor" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                </div>
                <div class="col-md-6"  id="column_additional4" style="display:none">
                    <label for="editor4"><?php echo e(_i('Column4')); ?> <span class=" text-red">*</span></label>
                    <textarea id="editor4" class="textarea form-control ckeditor" name="content[]"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."></textarea>
                </div>
            </div>

            <br>
            <!-- Filter Button -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-block"><?=_i('Save')?></button>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= route('contentManagement.index') ?>" class="btn btn-danger btn-block"><?=_i('Back')?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="count_content_data" value="<?=count($content_data)?>" >


    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('js'); ?>

        <script> //columnNumber
            $(function () {
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
            });

        </script>

        <?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/contentSection/edit.blade.php ENDPATH**/ ?>