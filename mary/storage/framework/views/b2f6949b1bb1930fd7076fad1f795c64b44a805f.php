<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped dataTable text-center" id="message_table">
            </table>
        </div>
        <!-- /.box-body -->
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(function() {


            // $('#show').load('massege/all');

            $('#message_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(url('admin/message/member/get_datatable/'.$id)); ?>',
                columns: [
                        {data: 'to_id', title: '<?php echo e(_i('to')); ?>'},
                    {data: 'message', title: '<?php echo e(_i('message')); ?>'},
                    {data: 'created_at', title: 'created_at'},
                    {data: 'action', title: 'action', orderable: true, searchable: true}

                ]
            });

            // var table = $('#notifaction_table').DataTable();
            // table.destroy();
        });


        $('body').on('click','#del',function (e) {
            e.preventDefault();

           var id= $(this).data('id');

            if(confirm("Are you sure ?")) {
                $.ajax({
                    url: '<?php echo e(route('remove-massege-member')); ?>',
                    method: "patch",
                    data: {_token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        })
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/messageMemeber.blade.php ENDPATH**/ ?>