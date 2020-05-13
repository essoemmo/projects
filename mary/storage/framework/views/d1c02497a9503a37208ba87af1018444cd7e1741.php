
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php if(auth()->user()->can('member-Add')): ?>
            <a href="<?php echo e(route('members.create')); ?>" class="btn btn-primary "><i class="fa fa-plus"></i><?php echo e(_i('create Members')); ?></a>
            <?php endif; ?>
            <?php echo $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true); ?>

        </div>
        <!-- /.box-body -->
    </div>

    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

    <?php $__env->stopPush(); ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('send massege')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modeldata">











                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="save"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>

        $('body').on('click','#comment',function (e) {
            e.preventDefault();

            var to = $(this).data('to');
            var fro = $(this).data('from');
            var username = $(this).data('username');


                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
            var html = `
                <h3><?php echo e(_i('send massege to')); ?> ${username}</h3>
            <form action="<?php echo e(route('send-messageUser')); ?>" method="post" id="mass">
                                    <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('post')); ?>

                    <input type="hidden" name="from" value="${fro}">
            <input type="hidden" name="to" value="${to}">

                        <textarea rows="5"  name="messge" class="form-control"></textarea>

                            </form>`;

            <?php else: ?>
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "<?php echo e(_i('Sorry you should Login')); ?>",
                timeout: 2000,
                killer: true
            }).show();

            <?php endif; ?>

            $('#modeldata').empty();
            $('#modeldata').append(html);

        });

        $('body').on('click','#save',function () {
            $('#mass').submit();
        })
    </script>

    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/members/index.blade.php ENDPATH**/ ?>