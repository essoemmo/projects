<button   data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success edit"><i class="fa fa-edit"></i> <?php echo e(_i('edit')); ?> </button>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('edit')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('memberships.update',$id)); ?>" method="post" id="editform">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('put')); ?>

                    <?php $membership = \App\Models\Membership::findOrFail($id); ?>
                    <div class="form-group">
                        <label><?php echo e(_i('language')); ?></label>
                        <select name="language" class="form-control">

                            <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label><?php echo e(_i('title')); ?></label>
                        <input type="text" name="title" class="form-control" value="<?php echo e($membership->name); ?>">
                    </div>

                    <div class="form-group">
                        <label><?php echo e(_i('cost')); ?></label>
                        <input type="number" name="cost" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><?php echo e(_i('Duration')); ?></label>
                        <input type="number" name="years" class="form-control"><?php echo e(_i('years')); ?>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                <button type="button" class="btn btn-primary" id="edit"><?php echo e(_i('save')); ?></button>
            </div>
        </div>
    </div>
</div>
