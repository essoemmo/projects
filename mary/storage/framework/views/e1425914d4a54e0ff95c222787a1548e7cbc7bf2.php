<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo e(_i($title)); ?>

                            - <?php echo e($editSetting->type == 0 ? _i('Normal user'):_i('The matchmaker')); ?>

                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="<?php echo e(route('type-member-update',$editSetting->id)); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>












                                <div class="optionmember">

                                        <div class="row options">

                                            <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexx =>$code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="col-md-6">
                                                    <div class="">
                                                        <label><?php echo e($code); ?></label>
                                                        <input type="checkbox" name="options[]" <?php echo e(in_array($code,$options) ? "checked": ''); ?> value="<?php echo e($code); ?>">
                                                    </div>
                                                    <br>
                                                </div>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm"><?php echo e((_i('edit'))); ?></button>


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
    <script>
        $(function () {
            $('#newOption').on('click',function (e) {
                e.preventDefault();
                $('.optionmember').append(`

                <div class="row options">
                                <div class="col-md-6">
                                    <div class="">
                                       <label><?php echo e(_i('name ')); ?></label>
                                           <input type="text" name="options[]" class="form-control">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <button class="btn btn-danger del" style="margin-top: 31px;"><?php echo e(_i('delete')); ?></button>
                                        </div>
                                        <br>
                                    </div>

                                </div>


                `);

            });

            $('body').on('click','.del',function (e) {
                e.preventDefault();
                $(this).closest('.row').remove();
            })

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/typeUser/edit.blade.php ENDPATH**/ ?>