<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h5><?php echo e(_i('create new content')); ?></h5>
        </div>

        <div class=" card-block">
            <form action="<?php echo e(route('contentManagement.store')); ?>"  method="post"  class="j-forms" id="j-forms" enctype="multipart/form-data" data-parsley-validate="" >
                <?= csrf_field() ?>
                <div class="content">
                    <div class="row">
                        <!-- First Row -->
                        <div class="col-md-4">
                            <label><?=_i('Language')?> </label>
                            <select  class="form-control" name="lang_id">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?=$lang->id?>" <?=old('lang_id') == $lang->id ? 'selected' : ''?> ><?=_i($lang->name)?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <div class="col-md-4  <?php echo e($errors->has('order') ? ' has-error' : ''); ?>">
                            <label><?=_i(' Order ')?> <span style="color: #F00;">*</span></label>
                            <select  class="form-control" name="order" required="">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                <?php for($i = 1 ; $i <= 10 ; $i++): ?>
                                    <option value="<?=$i?>" <?=old('order') == $i ? 'selected' : ''?> ><?=$i?></option>
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

                        <?php
                        $arr = ["main"=>'main',
                            "single" => 'single',
                        ]
                        ?>
                        <div class="col-md-2  <?php echo e($errors->has('system_type') ? ' has-error' : ''); ?>">
                            <label><?=_i('Website')?> <span class=" text-red">*</span></label>
                            <select  class="form-control" name="system_type" required="">
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                <?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?=$k?>" <?=old('system_type') == $k ? 'selected' : ''?> ><?php echo e($val); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('system_type')): ?>
                                <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('system_type') ?></strong>
                    </span>
                            <?php endif; ?>
                        </div>
                        <!-- Second Row -->
                        <div class="col-md-6 <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                            <label><?=_i('Title')?> <span style="color: #F00;">*</span></label>
                            <input id="title"  class="form-control " name="title" required="" data-parsley-maxlength="191" value="<?=old('title')?>">
                            <?php if($errors->has('title')): ?>
                                <span class="text-danger invalid-feedback">
                         <strong><?= $errors->first('title') ?></strong>
                    </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label><?=_i('Columns Number')?> <span style="color: #F00;">*</span></label>
                            <select  class="form-control" name="columns" required=""  id="column_select" >
                                <option selected disabled><?=_i('CHOOSE')?></option>
                                <?php for($i = 1 ; $i <= 4 ; $i++): ?>
                                    <option value="<?=$i?>" <?=old('columns') == $i ? 'selected' : ''?> ><?=$i?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row"></div>
                    <!--========================================= Content =======================================-->
                    <div class="row">
                        <div class="col-md-6" >
                            <label for="editor1" ><?php echo e(_i('Column1')); ?> <span style="color: #F00;">*</span></label>
                            <textarea id="editor1" class="textarea form-control ckeditor" name="content[]" required="" data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?php echo e(old('content[0]')); ?></textarea>
                        </div>

                        <div class="col-md-6" style="display:none" id="column2">
                            <label for="editor2"><?php echo e(_i('Column2')); ?> <span style="color: #F00;">*</span></label>
                            <textarea id="editor2" class="textarea form-control ckeditor" name="content[]" required="" data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?php echo e(old('content[1]')); ?></textarea>
                        </div>

                        <div class="col-md-6" style="display:none" id="column3">
                            <label for="editor3" ><?php echo e(_i('Column3')); ?> <span style="color: #F00;">*</span></label>
                            <textarea id="editor3" class="textarea form-control ckeditor" name="content[]" required="" data-parsley-minlength="10" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?php echo e(old('content[2]')); ?></textarea>
                        </div>

                        <div class="col-md-6" style="display:none" id="column4">
                            <label for="editor4"><?php echo e(_i('Column4')); ?> <span style="color: #F00;">*</span></label>
                            <textarea id="editor4" class="textarea form-control ckeditor" name="content[]" required="" data-parsley-minlength="10"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Place write content here..."><?php echo e(old('content[3]')); ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-outline-primary m-b-0"><?php echo e(_i('Save')); ?></button>
                        </div>
                    </div>
                </div>

            </form>
        </div>


    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script> //columnNumber
        $('#column_select').click(function(){
            var selected_no = $(this).val();
            //console.log(selected_no);
            if(selected_no == 1){
                $('#column2').hide();
                $('#column3').hide();
                $('#column4').hide();
            }else if(selected_no == 2){
                $('#column2').show();
                $('#column3').hide();
                $('#column4').hide();
            }else if(selected_no == 3){
                $('#column2').show();
                $('#column3').show();
                $('#column4').hide();
            }
            else if(selected_no == 4){
                $('#column2').show();
                $('#column3').show();
                $('#column4').show();
            }
        });
        CKEDITOR.colorButton_colors = '00923E,F8C100,28166F';
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/contentSection/create.blade.php ENDPATH**/ ?>