
<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Login')); ?></li>
            </ol>
        </div>
    </nav>



    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">




                    <form method="post">
                        <?php echo e(method_field('post')); ?>

                        <?php echo e(csrf_field()); ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" name="email" value="<?php echo e($check_token->email); ?>" class="form-control" placeholder="<?php echo e(trans('admin.email')); ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <input type="password" name="password" class="form-control" placeholder="<?php echo e(trans('admin.password')); ?>">

                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <?php if($errors->has('password')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>


                                    <input type="password" name="password_confirmation" class="form-control" placeholder="<?php echo e(trans('admin.password_confirm')); ?>">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>



                                <div class="center">
                                    <button type="submit" class="btn btn-grad"><?php echo e(trans('admin.reset_password')); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br> <br><br><br><br><br>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/reset_password.blade.php ENDPATH**/ ?>