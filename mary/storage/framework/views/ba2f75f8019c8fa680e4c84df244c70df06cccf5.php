

<?php $__env->startSection('title'); ?>
    <?php echo e(_i('Add Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header_name'); ?>
    <?php echo e(_i('Add Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_url'); ?>
    <li><a href="<?php echo e(url('/admin')); ?>" class="btn btn-default"><i class="fa fa-dashboard"></i> <?php echo e(_i('Home')); ?></a></li>
    <li><a href="<?php echo e(url('/admin/role/all')); ?>" class="btn btn-success"><?php echo e(_i('All')); ?></a></li>
    <li class="active"><a href="<?php echo e(url('/admin/role/add')); ?>" class="btn btn-primary"><?php echo e(_i('Add')); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="box box-info">

        <div class="box-body">
            <form  action="<?php echo e(url('/admin/role/add')); ?>" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                <?php echo csrf_field(); ?>
                <div class="box-body">
                <div class="form-group row">
                </div>

                <div class="form-group row" >

                    <label class="col-xs-2 col-form-label" for="txtUser">
                        <?php echo e(_i('Role Name')); ?> </label>
                    <div class="col-xs-6">
                        <input type="text" name="name" id="txtUser" required="" class="form-control">
                        <?php if($errors->has('name')): ?>
                            <span class="text-danger invalid-feedback">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>


                    <!--- ===================== permissions ==========================--->
                <div class="form-group row ">
                    <label class="col-xs-2 col-form-label">
                        <?php echo e(_i('Permissions')); ?> </label>
                </div>
                <div class="form-group row" >

                    <?php $__currentLoopData = $permissionNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-md-4" style="padding: 10px">

                            <div class="checkbox checkbox-custom">

                                <label for="<?php echo e($permission->id); ?>">
                                    <input class="control-label" id="<?php echo e($permission->id); ?>" type="checkbox" name="groups[]" value="<?php echo e($permission->id); ?>" data-parsley-multiple="groups">
                                    <?php echo e($permission->name); ?>

                                </label>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <div class="form-group row " >
                    <div class="col-sm-offset-2 col-sm-2">
                        
                        <button type="submit" class="btn btn-info pull-leftt"> <?php echo e(_i('Add Role')); ?></button>
                    </div>
                </div>
                </div>
            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>




























<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/security/role/addRole.blade.php ENDPATH**/ ?>