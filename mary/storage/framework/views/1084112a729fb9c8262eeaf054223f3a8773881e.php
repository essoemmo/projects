<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(trans('admin.forget_password')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(url('/')); ?>/adminPanel/index2.html"><b>Admin</b>LTE</a>

    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?php echo e(trans('admin.forget_password')); ?></p>
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <h1><?php echo e(session('success')); ?></h1>
                </div>
            <?php endif; ?>
            <form method="post">
                <?php echo csrf_field(); ?>

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="<?php echo e(trans('admin.email')); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(trans('admin.reset_password')); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo e(url('/')); ?>/adminPanel/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(url('/')); ?>/adminPanel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/forget_password.blade.php ENDPATH**/ ?>