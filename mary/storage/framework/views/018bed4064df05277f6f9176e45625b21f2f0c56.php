<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>


    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e($title); ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form action="<?php echo e(route('Stories.update',$story->id)); ?>" method="post" >
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('male partner')); ?></label>
                                    <select name="user_id" class="form-control">
                    <option value="" selected disabled><?php echo e(_i('choose')); ?></option>
                                        <?php $__currentLoopData = \App\Models\User::where('guard','!=','admin')->where('gender','male')->pluck('username','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo e($story->user_id == $key ? 'selected' : ''); ?>><?php echo e($val); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('female partener')); ?></label>
                                    <select name="parent_id" class="form-control">
                                        <option value="" selected disabled><?php echo e(_i('choose')); ?></option>

                                        <?php $__currentLoopData = \App\Models\User::where('guard','!=','admin')->where('gender','female')->pluck('username','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"  <?php echo e($story->Partner_id == $key ? 'selected' : ''); ?>><?php echo e($val); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="card card-primary card-outline card-tabs">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link <?php echo e($index == 0 ? 'active': ''); ?>" id="custom-tabs-two-home-tab" data-toggle="pill" href="#<?php echo e($lang->code); ?>" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array($lang->id ,$storyLang)): ?>
                                                        <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $storyy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($storyy->lang_id == $lang->id): ?>
                                                            <input type="hidden" name="lang_id[]" value="<?php echo e($lang->id); ?>"  class="form-control">

                                                            <div class="tab-pane <?php echo e($index == 0 ? 'active': ''); ?>" id="<?php echo e($lang->code); ?>" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                            <div class="form-group">
                                                                <label><?php echo e(_i('title')); ?></label>
                                                                <input type="text" name="<?php echo e($lang->code); ?>_title" value="<?php echo e($storyy->title); ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label><?php echo e(_i('content')); ?></label>
                                                                <textarea name="<?php echo e($lang->code); ?>_conteent" class="form-control ckeditor"><?php echo e($storyy->content); ?></textarea>
                                                            </div>
                                                        </div>
                                                              <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label><?php echo e(_i('place')); ?></label>
                                    </div>
                                    <div class="col-md-6">

                                        <lablel><?php echo e(_i('inside')); ?></lablel>

                                        <input type="radio" name="type"  value="inside" <?php echo e($story->type == 'inside' ? 'checked' : ''); ?>>
                                    </div>
                                    <div class="col-md-6">
                                        <lablel><?php echo e(_i('outside')); ?></lablel>
                                        <input type="radio" name="type" value="outside" <?php echo e($story->type == 'outside' ? 'checked' : ''); ?>>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label><?php echo e(_i('published')); ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="publish" <?php echo e($story->published == 'true' ? 'checked' : ''); ?>>

                                    </div>


                                </div>

                                <input type="submit" class="btn btn-info btn-sm" value="<?php echo e(_i('save')); ?>">

                            </form>
                        </div>


                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>

































<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/stories/edit.blade.php ENDPATH**/ ?>