<?php $__env->startComponent('mail::message'); ?>
# Reset Account Password
Welcome <?php echo e($data['data']->name); ?>


<?php $__env->startComponent('mail::button', ['url' => aUrl('resetPassword/' . $data['token'])]); ?>
Reset Your Password
<?php echo $__env->renderComponent(); ?>

Or <br>
Copy This Link <br>
<a href="<?php echo e(aUrl('resetPassword/' . $data['token'])); ?>"><?php echo e(aUrl('resetPassword/' . $data['token'])); ?></a>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
