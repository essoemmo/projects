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
                    <div class="center">

                        <a href="<?php echo e(url('/register')); ?>" class="btn btn-pink "><?php echo e(_i('Don\'t have an account? Click here to register')); ?></a>
                    </div>
                    <form class="shadow-lg" action="<?php echo e(url('/login')); ?>" method="post">
                        <?php echo e(method_field('post')); ?>

                        <?php echo e(csrf_field()); ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="<?php echo e(_i('Email')); ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" id="Password"  name="password" required=""
                                       placeholder="<?php echo e(_i('Password')); ?>">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <?php if($errors->has('password')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"><?php echo e(_i('Remember Me')); ?></label>
                                </div>

                                <div class="center">
                                    <button type="submit" class="btn btn-grad"><?php echo e(_i('Login')); ?></button>

                                    <a href="<?php echo e(url('/reset_password')); ?>" class="text-muted text-left d-block"><?php echo e(_i('forget the password')); ?></a>
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

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/web/user/login.blade.php ENDPATH**/ ?>