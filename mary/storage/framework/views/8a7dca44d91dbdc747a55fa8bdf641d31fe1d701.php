<?php $user = \App\Models\User::FindOrFail($id); ?>

<?php if($user->userlog == 1): ?>
    <form action="<?php echo e(route('active-user')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('put')); ?>

<input type="hidden" name="userid" value="<?php echo e($id); ?>">
<input type="hidden" name="userlog" value="0">
        <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-lock-open"></i></button>
    </form>

    <?php else: ?>

    <form action="<?php echo e(route('active-user')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('put')); ?>

        <input type="hidden" name="userid" value="<?php echo e($id); ?>">
        <input type="hidden" name="userlog" value="1">
        <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-lock"></i></button>
    </form>


<?php endif; ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/members/btn/memberactivation.blade.php ENDPATH**/ ?>