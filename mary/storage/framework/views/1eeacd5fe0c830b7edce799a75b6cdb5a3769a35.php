
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php echo $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true); ?>

        </div>
        <!-- /.box-body -->
    </div>

    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/admins/index.blade.php ENDPATH**/ ?>