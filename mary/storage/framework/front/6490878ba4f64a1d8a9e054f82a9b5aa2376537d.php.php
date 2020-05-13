<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(_i('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo e(_i('Subscribed')); ?></li>
            </ol>
        </div>
    </nav>


    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">

                <div class="col-md-10 offset-md-1">

                    <form class="shadow-lg" action="<?php echo e(url('/user/notsubscribe')); ?>"  method="POST" >

                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <br />
                                <div class="alert alert-info " >
                                    <label> <?php echo e(_i('Thanks for subscribe')); ?> </label>
                                </div>
                                <div class="center">
                                    <button type="submit"  class="btn btn-blue-outlined mt-4 "> <?php echo e(_i('Click here to unsubscribe')); ?> </button>
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



<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>