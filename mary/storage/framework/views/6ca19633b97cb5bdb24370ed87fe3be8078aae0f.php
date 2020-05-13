<div class="fields-wrapper bg-light-pink  py-4">

    <div class="container">

        <form action="<?php echo e(route('favourite-post')); ?>" method="post" id="favform">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('post')); ?>

        <?php

            $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
        ?>
        
        <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <label for="" class="col-sm-2 col-form-label" style="    margin-bottom: 23px;
    font-size: 20px;
    background: #e0d5d5;"><?php echo e(_i($gro->title)); ?></label>
            <br>
            <?php if($gro->source_id == null): ?>
                <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label"><?php echo e(_i($option->title)); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>

                <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label"><?php echo e(_i($option->title)); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                <?php if($option->source_id == null): ?>

                                    <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>

                                    <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button type="submit" class="btn btn-warning" style="" id="saveform"><?php echo e(_i('save')); ?></button>

        </form>
    </div>































































</div>
<?php /**PATH /home/euzawaaj/public_html/mary/resources/views/web/user/accountsetting/myfavPartener.blade.php ENDPATH**/ ?>