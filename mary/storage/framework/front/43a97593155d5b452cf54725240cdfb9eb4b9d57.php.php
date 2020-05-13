<?php $__env->startSection('content'); ?>


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Reset Password')); ?></li>
            </ol>
        </div>
    </nav>



    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">

                        <a href="<?php echo e(url('/register')); ?>" class="btn btn-green "> <?php echo e(_i('Don\'t have an account? Click here to register')); ?> </a>
                    </div>
                    <form class="shadow-lg" action="<?php echo e(url('/reset_password')); ?>" method="post" data-parsley-validate="">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="<?php echo e(_i('Email')); ?>"  data-parsley-maxlength="191">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>


                                <div class="">
                                    <div class="right" style="display:inline-block;">
                                        <button type="submit" class="btn btn-red"> <?php echo e(_i('Send a password reset code')); ?></button>
                                    </div>
                                    <div class="left" style="text-align: left; display:inline-block; float: left;" id="update_password">
                                        <a href="<?php echo e(url('/password/update')); ?>">
                                            <button type="button"  class="btn btn-green" >
                                                  <?php echo e(_i('Change Password')); ?>

                                            </button>
                                        </a>
                                    </div>
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

<?php $__env->startPush('js'); ?>

    <script>
        //        $(document).ready(function() {
        $("#update_password").hide();
        //        });
    </script>

    <?php if(session('success')): ?>

        <script>
            $(document).ready(function()
            {
                $("#update_password").show(1000);
            });
        </script>

    <?php endif; ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>