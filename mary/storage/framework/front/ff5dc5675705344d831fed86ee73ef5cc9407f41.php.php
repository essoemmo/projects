<div class="contact-admin">
    <div class="container">
        <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <form action="<?php echo e(route('contact-manger')); ?>" method="post" class="simple-theme">
            <?php echo e(csrf_field()); ?>

            <?php echo e(method_field('post')); ?>


            <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" placeholder="البريد الالكتروني">
            <input type="text" class="form-control" name="title" placeholder="عنوان الرسالة">
            <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="موضوع الرسالة"></textarea>
            <div class="justify-content-md-end d-flex my-2">
                <input type="submit" class="btn btn-pink" value="ارسال">
            </div>
        </form>
    </div>
</div>
<br>
<br>