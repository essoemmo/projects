<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul <?php if(LaravelGettext::getLocale() == "ar"): ?> class="navbar-nav mr-auto" <?php else: ?> class="navbar-nav ml-auto" <?php endif; ?>>

        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo e(url('/')); ?>/adminPanel/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="<?php echo e(auth()->user()->username); ?>">
                <span class="hidden-xs"><?php echo e(auth()->user()->username); ?></span>
            </a>
            <ul <?php if(LaravelGettext::getLocale() == "ar"): ?> class="dropdown-menu dropdown-menu-lg dropdown-menu-left" <?php else: ?> class="dropdown-menu dropdown-menu-lg dropdown-menu-right" <?php endif; ?>>
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?php echo e(url('/')); ?>/adminPanel/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                    <p>
                        <?php echo e(auth()->user()->username); ?>

                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat"><?php echo e(_('Profile')); ?></a>
                        <a href="<?php echo e(url('admin/logout')); ?>" class="btn btn-default btn-flat float-right"><?php echo e(_i('Sign out')); ?></a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-globe-africa"></i>
            </a>
            <ul <?php if(LaravelGettext::getLocale() == "ar"): ?> class="dropdown-menu dropdown-menu-lg dropdown-menu-left" <?php else: ?> class="dropdown-menu dropdown-menu-lg dropdown-menu-right" <?php endif; ?>>
                    <li class="nav-item">
                        <ul class="list-unstyled" id="langs">

                        </ul>
                    </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('adminHome')); ?>" class="brand-link">
        <?php if(settings()->loge != null): ?>

                <img src="<?php echo e(asset('uploads/setting/' . settings()->loge)); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        <?php endif; ?>
        <span class="brand-text font-weight-light">
            <?php if(settings()->title != null): ?>
                <?php echo e(settings()->title); ?>

            <?php else: ?>
                Zawag
            <?php endif; ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(url('/')); ?>/adminPanel/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo e(auth()->user()->username); ?></a>
            </div>
        </div>

        <?php echo $__env->make('admin.layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /.sidebar -->
</aside>

<?php $__env->startPush('js'); ?>
<script>
    $(function(){
        $.ajax({
            url:"<?php echo e(route('admin.languages')); ?>",
            success:(res)=>{
                console.log(res);
                if(res == null) return false;
                $('#langs').html('');
                res.forEach(lang => {
                    $('#langs').append(`<li><form action="<?php echo e(aUrl('change_language')); ?>" method="get">
                    <input type="hidden" name="selLanguage" value="${lang.name}"/>
                    <button type="submit" class="btn btn-default btn-block">${lang['name']}</button></form></li>`);
                });
            },
            error:(err)=>{
                console.log(err);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
