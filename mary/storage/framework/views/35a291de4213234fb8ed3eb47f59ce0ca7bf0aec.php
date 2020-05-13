<a href="<?php echo e(url('/')); ?>" class="navbar-brand">
    <img data-src="<?php echo e(asset('uploads/setting/'.settings()->loge)); ?>" alt="" class="img-fluid lazy">
</a>

# Reset Account Password
    Welcome <?php echo e($data['data']->username); ?>


    <?php $__env->startComponent('mail::button', ['url' => url('resetPassword/' . $data['token'])]); ?>
        Reset Your Password
    <?php echo $__env->renderComponent(); ?>



Or <br>
    Copy This Link <br>
    <a href="<?php echo e(url('resetPassword/' . $data['token'])); ?>"><?php echo e(url('resetPassword/' . $data['token'])); ?></a>

    Thanks,<br>
    <?php echo e(config('app.name')); ?>


<?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/user_reset_password.blade.php ENDPATH**/ ?>