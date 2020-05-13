

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
                    <form class="shadow-lg" action="<?php echo e(route('rest-password-post')); ?>" method="post">
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

                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-grad"><?php echo e(_i('Send')); ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <br><br><br> <br><br><br><br><br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/forget.blade.php ENDPATH**/ ?>