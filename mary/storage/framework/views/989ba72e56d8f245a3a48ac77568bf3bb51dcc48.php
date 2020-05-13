<!-- Sidebar Menu -->

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/permission/all') || request()->is('admin/role/all') || request()->is('admin/users') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/permission/all') || request()->is('admin/role/all') || request()->is('admin/users') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('security')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(url('/admin/permission/all')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('permissions')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(url('admin/role/all')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/role/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('role')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(aUrl('users')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('users')); ?></p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Setting')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">


                <li class="nav-item">
                    <a href="<?php echo e(url('admin/slider')); ?>" style="<?php echo e(request()->is('admin/slider') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <p><?php echo e(_i('Slider')); ?></p>

                        <i class="fa fa-ice-cream "></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('settings-index')); ?>" style="<?php echo e(request()->is('admin/settings') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('GeneralSetting')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('translation.index')); ?>" style="<?php echo e(request()->is('admin/translate') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('Translation')); ?></p>
                    </a>
                </li>

            </ul>
        </li>



        <li class="nav-item has-treeview <?php echo e(request()->is('admin/memberships') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/memberships') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                        <?php echo e(_i('membership')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('memberships.index')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('membership')); ?></p>
                    </a>
                </li>
            </ul>

        </li>

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/categories') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/categories') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('categories')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('categories.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/categories') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('categories')); ?></p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/material_status')  ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/material_status') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('material_status')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('material_status.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/material_status') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('material_status')); ?></p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/Features') || request()->is('admin/Features/option') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/Features') || request()->is('admin/Features/option') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Features')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="<?php echo e(route('Features.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/Features') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('featureGroup')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('index-Option')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/Features/option') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('options')); ?></p>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-treeview <?php echo e(request()->is('admin/members') || request()->is('admin/members/create') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/members') || request()->is('admin/members/create') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('All Members')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="<?php echo e(route('members.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/members') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('All Members')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('members.create')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/members/create') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('create Members')); ?></p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview <?php echo e(request()->is('admin/Stories') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/Stories') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Stories')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="<?php echo e(route('Stories.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/Stories') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('All Stories')); ?></p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview <?php echo e(request()->is('admin/categoryArticle') || request()->is('admin/articles') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/categoryArticle') || request()->is('admin/articles') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Article')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('categoryArticle.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('CategoryArticle')); ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('articles.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/articles') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('Article Mangement')); ?></p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview <?php echo e(request()->is('admin/massege/users') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/massege/users') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('UserMassege')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                                    <a href="<?php echo e(url('admin/massege/users')); ?>" style="<?php echo e(request()->is('admin/massege/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                                    <p><?php echo e(_i('UserMassege')); ?></p>
                       <i class="fa fa-user "></i>
                  </a>
               </li>
            </ul>

        </li>


    </ul>
</nav>
<!-- /.sidebar-menu -->
<?php /**PATH C:\xampp\htdocs\beta\resources\views/admin/layouts/menu.blade.php ENDPATH**/ ?>