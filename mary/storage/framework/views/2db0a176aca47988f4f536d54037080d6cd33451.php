



<?php $__env->startSection('content'); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#Setting" role="tab" aria-controls="home"
               aria-selected="true"><?php echo e(_i('General Setting')); ?></a>
        </li>
        
        
        
        
        
        
        
        
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="home-tab">

            <form  action="<?php echo e(route('settings-update')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data" >
                <?php echo csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group row">
                    </div>
                    <input type="hidden" name="setting_id" value="<?php echo e(settings()->id); ?>">

                                <div class="form-group">
                                    <label><?php echo e(_i('language')); ?></label>
                                    <select name="language" class="form-control">

                                        <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                    <!-- ================================== title =================================== -->
                    <div class="form-group row" >
                        <div class="col-md-8">
                            <label class="col-md-8 col-form-label " for="title">
                                <?php echo e(_i('Title')); ?> <span style="color: #F00;">*</span>
                            </label>
                            <div class="body">
                                <input type="text" name="title" value="<?php echo e(settings()->title); ?>" id="title" required="" class="form-control" placeholder="<?php echo e(_i('Website Name')); ?>">
                                <?php if($errors->has('title')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('title')); ?></strong>
                                 </span>
                                <?php endif; ?>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('email')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="email" name="email" value="<?php echo e(settings()->email); ?>" id="title" required="" class="form-control" placeholder="<?php echo e(_i('Website email')); ?>">
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                 </span>
                                <?php endif; ?>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('logo')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="file" name="logo" class="form-control image">
                                <?php if($errors->has('logo')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('logo')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('Control website')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <select name="mantance" class="form-control">
                                    <option value="">------</option>
                                    <option value="1" <?php echo e(settings()->mantance == 1 ? 'selected' : ''); ?>><?php echo e(_i('open')); ?></option>
                                    <option value="0" <?php echo e(settings()->mantance == 0 ? 'selected' : ''); ?>><?php echo e(_i('close')); ?></option>
                                </select>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('facebook_url')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="facebook_url" class="form-control" value="<?php echo e(settings()->facebook_url); ?>">
                                <?php if($errors->has('facebook_url')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('facebook_url')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('instagram_url')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="instagram_url" class="form-control" value="<?php echo e(settings()->instagram_url); ?>">
                                <?php if($errors->has('instagram_url')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('instagram_url')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('twitter_url')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="twitter_url" class="form-control" value="<?php echo e(settings()->twitter_url); ?>">
                                <?php if($errors->has('twitter_url')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('twitter_url')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('phone')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="phone1" class="form-control" value="<?php echo e(settings()->phone1); ?>">
                                <?php if($errors->has('phone1')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('phone1')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('address')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="address" class="form-control" value="<?php echo e(settings()->address); ?>">
                                <?php if($errors->has('address')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('address')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>


                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('description')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="description" class="form-control ckeditor">
                                    <?php echo e(settings()->description); ?>

                                </textarea>
                                <?php if($errors->has('description')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('description')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>


                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('TitleTopSearch')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="TitleTopSearch" class="form-control" value="<?php echo e(settings()->TitleTopSearch); ?>">
                                <?php if($errors->has('TitleTopSearch')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('TitleTopSearch')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('descrption top the search')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descriptionOnSearch" class="form-control ckeditor">
                                    <?php echo e(settings()->descriptionOnSearch); ?>

                                </textarea>
                                <?php if($errors->has('description')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('descriptionOnSearch')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>



                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('Titleactivemember')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="Titleactivemember" class="form-control" value="<?php echo e(settings()->Titleactivemember); ?>">
                                <?php if($errors->has('Titleactivemember')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('Titleactivemember')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('descrption activemember')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descrptionactivemember" class="form-control ckeditor">
                                    <?php echo e(settings()->descrptionactivemember); ?>

                                </textarea>
                                <?php if($errors->has('descrptionactivemember')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('descrptionactivemember')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>



                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('Titleactivemember2')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <input type="text" name="Titleactivemember2" class="form-control" value="<?php echo e(settings()->Titleactivemember2); ?>">
                                <?php if($errors->has('Titleactivemember2')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('Titleactivemember2')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>
                            <div class="body">
                                <label class="col-md-8 col-form-label " for="title">
                                    <?php echo e(_i('descrption descrptionactivemember2')); ?> <span style="color: #F00;">*</span>
                                </label>
                                <textarea name="descrptionactivemember2" class="form-control ckeditor">
                                    <?php echo e(settings()->descrptionactivemember2); ?>

                                </textarea>
                                <?php if($errors->has('descrptionactivemember2')): ?>
                                    <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('descrptionactivemember2')); ?></strong>
                                 </span>
                                <?php endif; ?>
                                <br>
                            </div>

                            <div class="body">
                                                            <label class="col-md-8 col-form-label " for="title">
                                                                <?php echo e(_i('descrption descrptionactivemember2')); ?> <span style="color: #F00;">*</span>
                                                            </label>
                                                            <textarea name="descrptionactivemember2" class="form-control ckeditor">
                                                                <?php echo e(settings()->descrptionactivemember2); ?>

                                                            </textarea>
                                                            <?php if($errors->has('descrptionactivemember2')): ?>
                                                                <span class="text-danger invalid-feedback">
                                                                <strong><?php echo e($errors->first('descrptionactivemember2')); ?></strong>
                                                             </span>
                                                            <?php endif; ?>
                                                            <br>
                                                        </div>
                                                        <div class="body">
                                                                                        <label class="col-md-8 col-form-label " for="title">
                                                                                            <?php echo e(_i('register_msg')); ?> <span style="color: #F00;">*</span>
                                                                                        </label>
                                                                                        <textarea name="register_msg" class="form-control ckeditor">
                                                                                            <?php echo e(settings()->register_msg); ?>

                                                                                        </textarea>
                                                                                        <?php if($errors->has('register_msg	')): ?>
                                                                                            <span class="text-danger invalid-feedback">
                                                                                            <strong><?php echo e($errors->first('register_msg')); ?></strong>
                                                             </span>
                                                       <?php endif; ?>
                                                 <br>
                                              </div>


                        </div>

                        <div class="col-md-4">
                            <img src="<?php echo e(asset('uploads/setting/'.settings()->loge)); ?>" class="image-preview" style="width: 300px">
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <input type="submit" value="<?php echo e(_i('save')); ?>" class="btn btn-info btn-sm">
                </div>
                <!-- /.box-footer -->
            </form>


        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </div>


<?php $__env->stopSection(); ?>

























<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/setting/index.blade.php ENDPATH**/ ?>