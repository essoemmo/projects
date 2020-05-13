<!-- Sidebar Menu -->

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php if(auth()->user()->can('show-security')): ?>
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
       <?php endif; ?>
        <?php if(auth()->user()->can('show-generalsetting')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Setting')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

            <?php if(auth()->user()->can('slider-show')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(url('admin/slider')); ?>" style="<?php echo e(request()->is('admin/slider') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <p><?php echo e(_i('Slider')); ?></p>

                        <i class="fa fa-ice-cream "></i>
                    </a>
                </li>
                <?php endif; ?>

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

                <li class="nav-item">
                    <a href="<?php echo e(route('sms.index')); ?>" style="<?php echo e(request()->is('admin/translate') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('sms management')); ?></p>
                    </a>
                </li>

            </ul>
        </li>
        <?php endif; ?>



        <?php if(auth()->user()->can('show-content_management')): ?>
            <li class="nav-item has-treeview <?php echo e(request()->is('admin/contentManagementt') ? 'menu-open' : ''); ?>">
                <a href="#" class="nav-link <?php echo e(request()->is('admin/contentManagement') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        <?php echo e(_i('content management')); ?>

                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo e(route('contentManagement.index')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p><?php echo e(_i('content management')); ?></p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('contentManagement.create')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p><?php echo e(_i('create management')); ?></p>
                        </a>
                    </li>
                </ul>

            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('show-banner')): ?>
            <li class="nav-item has-treeview <?php echo e(request()->is('admin/banner') ||request()->is('admin/banner/create')  ? 'menu-open' : ''); ?>">
                <a href="#" class="nav-link <?php echo e(request()->is('admin/banner') || request()->is('admin/banner/create')  ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        <?php echo e(_i('banner management')); ?>

                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo e(route('banner.index')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p><?php echo e(_i('banner management')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('banner.create')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p><?php echo e(_i('create banner')); ?></p>
                        </a>
                    </li>
                </ul>

            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('show-memberships')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/memberships') || request()->is('admin/memberships/details') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/memberships') || request()->is('admin/memberships/details')? 'active' : ''); ?>">
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

                <li class="nav-item">
                    <a href="<?php echo e(route('memberships-details.index')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('membership details')); ?></p>
                    </a>
                </li>
            </ul>

        </li>
         <?php endif; ?>

        <?php if(auth()->user()->can('show-banks')): ?>
            <li class="nav-item has-treeview <?php echo e(request()->is('admin/banks') || request()->is('admin/banks/create') ? 'menu-open' : ''); ?>">
                <a href="#" class="nav-link <?php echo e(request()->is('admin/banks') || request()->is('admin/banks/create')? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        <?php echo e(_i('ادارة الدفع')); ?>

                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo e(route('banks.index')); ?>"  class="nav-link" style="<?php echo e(request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p><?php echo e(_i('البنوك')); ?></p>
                        </a>
                    </li>







                </ul>

            </li>
        <?php endif; ?>


        <?php if(auth()->user()->can('show-categories')): ?>
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
        <?php endif; ?>
        <?php if(auth()->user()->can('show-material_status')): ?>
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
        <?php endif; ?>

        <?php if(auth()->user()->can('show-Features')): ?>
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
        <?php endif; ?>
        <?php if(auth()->user()->can('show-members')): ?>
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
                    <?php if(auth()->user()->can('member-Add')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('members.create')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/members/create') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('create Members')); ?></p>
                    </a>
                </li>
                        <?php endif; ?>

                <li class="nav-item">
                    <a href="<?php echo e(route('block-member')); ?>" style="<?php echo e(request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('block user')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('type-member')); ?>" style="<?php echo e(request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('user type')); ?></p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('setting-member')); ?>" style="<?php echo e(request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('setting user')); ?></p>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->can('show-message-member')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/message/member')  ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/message/member')  ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('converstions')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="<?php echo e(route('converstions.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/members') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('All converstions')); ?></p>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->can('show-stories')): ?>
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
        <?php endif; ?>
        <?php if(auth()->user()->can('show-categoryArticle')): ?>
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
        <?php endif; ?>
        <?php if(auth()->user()->can('show-Bestmember')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/Bestmember')  ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/Bestmember')  ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('Bestmember')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('Bestmember.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('Bestmember')); ?></p>
                    </a>
                </li>

            </ul>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->can('show-ActiveMember')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/ActiveMember')  ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/Activemember')  ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('ActiveMember')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(route('Activemember.index')); ?>" class="nav-link" style="<?php echo e(request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><?php echo e(_i('ActiveMember')); ?></p>
                    </a>
                </li>

            </ul>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->can('show-massege-user')): ?>
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
        <?php endif; ?>
        <?php if(auth()->user()->can('show-subscriped')): ?>
        <li class="nav-item has-treeview <?php echo e(request()->is('admin/subscriped') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->is('admin/subscriped') ? 'active' : ''); ?>">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    <?php echo e(_i('subscriped')); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo e(url('admin/new/letter')); ?>" style="<?php echo e(request()->is('admin/massege/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''); ?>" class="nav-link">
                        <p><?php echo e(_i('subscriped')); ?></p>
                        <i class="fa fa-user "></i>
                    </a>
                </li>
            </ul>

        </li>
        <?php endif; ?>

    </ul>
</nav>
<!-- /.sidebar-menu -->
<?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/layouts/menu.blade.php ENDPATH**/ ?>