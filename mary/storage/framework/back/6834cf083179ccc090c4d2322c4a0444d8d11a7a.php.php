






















<a class="btn btn-danger btn-sm" data-toggle="modal" href="<?php echo e(route('users.destroy', $id)); ?>" data-id="<?php echo e($id); ?>" data-target="#custom-width-modal"><i class="fa fa-trash"></i> <?php echo e(_i('delete')); ?></a>


<form action="<?php echo e(route('users.destroy', $id)); ?>" method="post" class="remove-record-model">
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('delete')); ?>

    <?php echo csrf_field(); ?>
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel"><?php echo e(_i('Delete Record')); ?></h4>
                </div>
                <div class="modal-body">
                    <h4><?php echo e(_i('You Want You Sure Delete This Record')); ?></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light"><?php echo e(_i('delete')); ?></button>
                </div>
            </div>
        </div>
    </div>
</form>

