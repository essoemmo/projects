<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(_i($title)); ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="<?php echo e(route('setting-member-store')); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('post')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('member ship')); ?></label>
                                    <select name="user_id" class="form-control selectpicker">
                                        <?php $__currentLoopData = \App\Models\User::where('guard','!=','admin')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($membership->id); ?>" ><?php echo e($membership->username); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="optionmember">

                                                    <div class="row options">
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($dat->type == 0 ): ?>
                                                <div class="col-md-12">
                                                        <label style="background: #ddd;padding: 11px;width: 200px;"><?php echo e(_i('Normal user')); ?></label>
                                                </div>
                                             <?php elseif($dat->type == 1): ?>
                                                <div class="col-md-12">
                                                    <label style="background: #ddd;padding: 11px;width: 200px;"><?php echo e(_i('The matchmaker')); ?></label>
                                                </div>
                                            <?php endif; ?>

                                              <?php $__currentLoopData = json_decode($dat->json_data); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $da): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <div class="col-md-4">
                                                     <div class="">
                                                     <label><?php echo e(_i($da)); ?></label>
                                                            <input type="checkbox" name="options[]" class="" value="<?php echo e($da); ?>">
                                                      </div>
                                                      <br>
                                              </div>

                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm"><?php echo e((_i('add'))); ?></button>


                                </div>
                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    
    
    
    

    
    
    
    
    
    
    
    

    
    
    
    
    
    

    


    

    

    
    
    
    

    
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/userSetting/create.blade.php ENDPATH**/ ?>