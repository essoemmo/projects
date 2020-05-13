<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo e($title); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <form role="form" action="<?php echo e(route('users.update',$user->id)); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('put')); ?>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الاسم</label>
                                    <input type="user_name" class="form-control" id="" placeholder="Enter User name" name="username" value="<?php echo e($user->username); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الاسم بالكامل</label>
                                    <input type="full_name" class="form-control" id="" placeholder="Enter full name" name="fullname" value="<?php echo e($user->fullname); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo e($user->email); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم الجوال</label>
                                    <input type="number" class="form-control" id="mobile" placeholder="Enter mobile phone" name="mobile" value="<?php echo e($user->mobile); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">النوع</label>
                                    <select name="gender" class="form-control">
                                        <option value="male" <?php echo e($user->gender == 'male' ? 'selected' : ''); ?>>ذكر </option>
                                        <option value="female" <?php echo e($user->gender == 'female' ? 'selected' : ''); ?>>انثي</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">تاكيد كلمة المرور</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password confirmation">
                                </div>

                                <div class="form-group">
                                    <label>الصلاحيات</label>

                                    <select class="form-control" name="roles" required="">
                                        
                                        <?php $__currentLoopData = \Spatie\Permission\Models\Role::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php echo e(($user->hasRole($role->name)) ? 'selected':''); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>