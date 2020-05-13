<?php $__env->startSection('content'); ?>

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">


                <div class="col-md-10 offset-md-1">

                    <form class="shadow-lg" action="<?php echo e(url('/user/notsubscribe')); ?>"  method="POST" >

                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <br />
                                <div class="alert alert-danger">
                                    <label> <?php echo e(_i('You are already subscribed')); ?> </label>
                                </div>
                                <div class="center">
                                    <button type="submit" class="btn btn-blue-outlined mt-4">  <?php echo e(_i('Click here to unsubscribe')); ?> </button>
                                </div>
                                <br />

                            </div>


                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/web/newletter/subscribe-before.blade.php ENDPATH**/ ?>