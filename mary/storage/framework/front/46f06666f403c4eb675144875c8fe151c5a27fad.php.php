<?php $__env->startSection('content'); ?>


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Reset Password')); ?></li>
            </ol>
        </div>
    </nav>


    <?php $__currentLoopData = [ 'success', 'danger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has($key)): ?>

            <div class="container alert alert-<?php echo e($key); ?>">
                <strong> <p ><?php echo e(Session::get($key)); ?></p> </strong>
            </div>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="#" class="btn btn-green "> <?php echo e(_i('Reset Password')); ?> </a>
                    </div>
                    <form class="shadow-lg" action="<?php echo e(url('/password/update')); ?>" method="post" data-parsley-validate="">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="number" class="form-control<?php echo e($errors->has('pin_code') ? ' is-invalid' : ''); ?>"  id="pin_code"  required=""
                                       name="pin_code" data-parsley-maxlength="6" placeholder="<?php echo e(_i('Code Number')); ?>" value="<?php echo e(old('pin_code')); ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if($errors->has('pin_code')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('pin_code')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <input type="password" id="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('password')); ?>"
                                       name="password" required="" min="6" data-parsley-min="6" placeholder="<?php echo e(_i('Password')); ?>">

                                <?php if($errors->has('password')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <input type="password" id="password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('password_confirmation')); ?>"
                                       name="password_confirmation" required="" min="6" data-parsley-min="6" data-parsley-equalto="#password" placeholder="تأكيد الرقم السري">

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="center">
                                      <button type="submit" class="btn btn-red"><?php echo e(_i('Save')); ?></button>
                                </div>


                            </div>
                        </div>
                    </form>

                    <?php $__currentLoopData = [ 'success', 'danger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Session::has($key)): ?>

                            <br />

                            <div class=" alert alert-<?php echo e($key); ?>">
                                <span> <p ><?php echo e(Session::get($key)); ?></p> </span>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>