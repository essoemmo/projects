<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(_i($title)); ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="<?php echo e(route('type-member-store')); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('post')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('member ship')); ?></label>
                                    <select name="type" class="form-control selectpicker">
                                        <option value="" disabled selected><?php echo e(_i('Choose...')); ?></option>
                                        <option value="0"><?php echo e(_i('Normal user')); ?></option>
                                        <option value="1"><?php echo e(_i('The matchmaker')); ?></option>
                                    </select>
                                </div>

                                <div class="optionmember">

                                        <div class="row options">
                                        <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label><?php echo e($code); ?></label>
                                                        <input type="checkbox" name="options[]" value="<?php echo e($code); ?>">
                                                    </div>
                                                    <br>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>









                                        </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm"><?php echo e((_i('add'))); ?></button>


                                </div>
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

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/typeUser/create.blade.php ENDPATH**/ ?>