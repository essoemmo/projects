

<?php
$best = \App\Models\User_status::where('type','best')->where('user_id',$id)->first();
?>
<?php if(!$best): ?>

    <form action="<?php echo e(route('Bestmember.store')); ?>" method="post">
        <?php echo e(method_field('post')); ?>

        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="User_id" value="<?php echo e($id); ?>">

        <button type="submit" class="btn btn-success "><?php echo e(_i('set best list')); ?></button>
    </form>


<?php else: ?>

    <form action="<?php echo e(route('Bestmember.update',$id)); ?>" method="post">
        <?php echo e(method_field('put')); ?>

        <?php echo e(csrf_field()); ?>



        <button type="submit" class="btn btn-warning"><?php echo e(_i('Remove from best list')); ?></button>
    </form>


<?php endif; ?>
<?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/status/best/btn/best.blade.php ENDPATH**/ ?>