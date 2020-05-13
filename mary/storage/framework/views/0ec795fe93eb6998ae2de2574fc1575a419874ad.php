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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo $dataTable->scripts(); ?>


    <script>
        $('body').on('submit','#delform',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var table = $('.dataTable').DataTable();
            // alert(url);

            $.ajax({
                url: url,
                method: "delete",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                success: function (response) {

                    table.ajax.reload();
                    if (response[0] === 'SUCCESS'){
                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "<?php echo e(_i('Successfly')); ?>",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                    }
                    // console.log(response);
                    // window.location.reload();
                }
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/banner/index.blade.php ENDPATH**/ ?>