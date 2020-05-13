
<div class="col-md-3">
    <div class="profile-sidebar border rounded shadow-sm">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic center">
            <img src="<?php echo e($user->image != null ? asset('uploads/profiles/'.$user->id.'/'.$user->image) : asset('web/images/user-avatar.png')); ?> "
                 class="img-fluid" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php echo e($user->name .' '. $user->last_name); ?>

            </div>
            <div class="profile-usertitle-job">
                <?php echo e(_i('Normal Member')); ?>

            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->

        <!-- SIDEBAR BUTTONS -->
    
    
    
    <!-- END SIDEBAR BUTTONS -->

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="<?php echo e(request()->is('myorders') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('myorders')); ?>">
                        <i class="fa fa-home"></i>
                        <?php echo e(_i('Home')); ?>

                    </a>
                </li>
                <li class="<?php echo e(request()->is('profile') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('profile')); ?>">
                        <i class="fa fa-user"></i>
                        <?php echo e(_i('Account Settings')); ?> </a>
                </li>


            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>