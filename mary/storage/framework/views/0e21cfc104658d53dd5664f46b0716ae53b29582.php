<!DOCTYPE html>
<html lang="<?php echo e(LaravelGettext::getLocale()); ?>" <?php if(LaravelGettext::getLocale() == "ar"): ?> dir="rtl" <?php else: ?> dir="ltr" <?php endif; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo e(!empty($title)?$title:trans('admin.title')); ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/dist/css/adminlte.min.css">

    <?php if(LaravelGettext::getLocale() == "ar"): ?>
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/dist/css/rtl/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/dist/css/rtl/custom-style.css">
        <style>
            .nav-icon {
                float: right;
            }
        </style>
    <?php endif; ?>
    <?php echo $__env->yieldContent('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('adminPanel/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('adminPanel/plugins/noty/noty.min.js')); ?>"></script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/layouts/header.blade.php ENDPATH**/ ?>