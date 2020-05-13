

<?php
$best = \App\Models\User_status::where('type','active')->where('user_id',$id)->first();
?>
<?php if(!$best): ?>

    <form action="<?php echo e(route('Activemember.store')); ?>" method="post">
        <?php echo e(method_field('post')); ?>

        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="User_id" value="<?php echo e($id); ?>">

        <button type="submit" class="btn btn-success "><?php echo e(_i('set active list')); ?></button>
    </form>


<?php else: ?>

    <form action="<?php echo e(route('Activemember.update',$id)); ?>" method="post">
        <?php echo e(method_field('put')); ?>

        <?php echo e(csrf_field()); ?>



        <button type="submit" class="btn btn-warning"><?php echo e(_i('Remove from active list')); ?></button>
    </form>


<?php endif; ?>
