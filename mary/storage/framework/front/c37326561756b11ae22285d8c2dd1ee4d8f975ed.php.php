<?php $__env->startSection('content'); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .nowrap{
            width: 100% !important;
        }
    </style>

<?php $__env->stopPush(); ?>
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(_i('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo e(_i('Account settings')); ?></li>
            </ol>
        </div>
    </nav>


    <div class="flash-message">
        <?php $__currentLoopData = ['danger', 'warning', 'success', 'info' ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Session::has($msg)): ?>
                <br />
                <h6 class="alert alert-<?php echo e($msg); ?>" > <b>   <?php echo e(Session::get($msg)); ?> </b></h6>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has('flash_message')): ?>
            <br />
            <h6 class="alert alert-success" > <b>   <?php echo e(Session::get('flash_message')); ?> </b></h6>
        <?php endif; ?>
    </div>

    <div class="user-page common-wrapper">
        <div class="container">
            <div class="row profile">

                <?php echo $__env->make('web.user.showprofile',$user, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-md-9">
                    <div class="card">
                    <div class="card-header">طلباتي</div>
                        <div class="card-body">
                            <?php echo $dataTable->table([
                                'class'=> 'table table-striped table-bordered display responsive nowrap dataTable dtr-inline'
                            ],true); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>