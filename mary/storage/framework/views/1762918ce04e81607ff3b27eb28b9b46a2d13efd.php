

<?php $__env->startSection('title'); ?>
    <?php echo e(_i('Edit Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header_name'); ?>
    <?php echo e(_i('Edit Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_url'); ?>
    <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(_i('Home')); ?></a></li>
    <li><a href="<?php echo e(url('/admin/role/all')); ?>"><?php echo e(_i('All')); ?></a></li>
    <li ><a href="<?php echo e(url('/admin/role/add')); ?>"><?php echo e(_i('Add')); ?></a></li>
    <li class="active"><a href="<?php echo e(url('/admin/role/'.$role->id.'/edit')); ?>"><?php echo e(_i('Edit')); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="flash-message">
        <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Session::has($msg)): ?>
                <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get($msg)); ?></p>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="box box-info" style="padding-top:2%">
        <div class="box-header">
            
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="post" action="<?php echo e(url('/admin/role/'.$role->id.'/edit')); ?>" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                <?php echo csrf_field(); ?>

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label"><?php echo e(_i('Role Name')); ?></label>

                    <div class="col-xs-6">
                        <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($role->name); ?>" required="">

                        <?php if($errors->has('name')): ?>
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ========================= guard name ============================= -->
                

                    
                        
                    
                        
                            
                            
                            
                            
                        
                    
                




                <div class="form-group row" >
                    <label class="col-md-12 btn btn-success"><?php echo e(_i('Permissions')); ?> </label>
                    <br>
                    <br>
                    <?php $__currentLoopData = $permissionNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-md-4" style="padding: 10px">

                            <div class="checkbox checkbox-custom">

                                <label for="<?php echo e($permission->id); ?>">
                                    <input class="control-label" id="<?php echo e($permission->id); ?>" type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>" <?php echo e($role->hasPermissionTo($permission->name) ? 'checked' : ''); ?>  data-parsley-multiple="groups">
                                    <?php echo e($permission->name); ?></label>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> <?php echo e(_i('Save ')); ?></button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
   <!-- <script  type="text/javascript">

        function get_permissions(){

            var guard = $('#guard_select').val();

            $.ajax({

                url: "<?php echo e(url('/admin/permission/')); ?>/"+guard+"",
                type: "get",
                success: function (result) {
                    var data = result;
                    console.log(data.length);
                    var html = "";
                    for (var i = 0; i < data.length; i++)
                    {
                        html += '<div class="col-xs-3"> <div class="checkbox checkbox-custom"> '+
                                '<label for="check'+i+'"> '+
                                ' <input class="control-label" id="check'+i+'" type="checkbox" name="groups[]" value="'+data[i].id+'" data-parsley-multiple="groups" required="">'+data[i].desc+
                                '</label> </div> </div>';
                    }
                    $("#permissions").html(html);

                }
            });
        }
    </script> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/security/role/edit.blade.php ENDPATH**/ ?>