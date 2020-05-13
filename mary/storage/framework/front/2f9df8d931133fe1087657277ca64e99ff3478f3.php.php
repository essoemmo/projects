<div class="droopmenu-navbar">
    <div class="droopmenu-inner">
        <div class="droopmenu-header">
            <a href="#" class="droopmenu-toggle"></a>
        </div><!-- droopmenu-header -->
        <div class="droopmenu-nav">
            <ul class="droopmenu">
                <li><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li>
                    <a href="#"> <?php echo e(_i('Categories')); ?> </a>
                    <ul class="droopmenu-megamenu droopmenu-grid">
                        <li class="droopmenu-tabs tabs-justify">


                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"> <?php echo e(_i('Contents')); ?> </a>
                    <ul class="droopmenu-megamenu droopmenu-grid">
                        <li class="droopmenu-grid-container">
                            <div class="droopmenu-row dm-equalize">

                                <div class="droopmenu-col droopmenu-col4">
                                    <div class="droopmenu-content dm-border-right">
                                        <h4><?php echo e(_i('Latest News')); ?></h4>



                                    </div><!-- droopmenu-content -->
                                </div><!-- col5 -->


                                <div class="droopmenu-col droopmenu-col4">
                                    <div class="droopmenu-content dm-border-right">



                                        <hr class="dm-border-bottom">
                                        <h4><?php echo e(_i('Social Media')); ?></h4>
                                        <div class="droopmenu-social-icons">
                                            <a href="<?php echo e(settings()['facebook_url']); ?>" class="dms-icon dm-facebook"> <i
                                                    class="ion-social-facebook"></i> </a>
                                            <a href="<?php echo e(settings()['twitter_url']); ?>" class="dms-icon dm-twitter"> <i
                                                    class="ion-social-twitter"></i> </a>
                                            <a href="<?php echo e(settings()['instagram_url']); ?>" class="dms-icon dm-instagram"><i
                                                    class="ion-social-instagram"></i> </a>

                                        </div><!-- social-icons -->
                                    </div><!-- droopmenu-content -->
                                </div>

                                <div class="droopmenu-col droopmenu-col4">
                                    <div class="droopmenu-content">
                                        <h4><?php echo e(_i('Social Media')); ?></h4>
                                        <ul class="droopmenu-icon-links">
                                            <li>
                                                <a href="<?php echo e(settings()['facebook_url']); ?>">Security</a>
                                                <div class="dm-details">
                                                    <span>Facebook</span>

                                                </div>
                                                <div class="dm-icon-holder">
                                                    <i class="ion-social-facebook"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(settings()['twitter_url']); ?>">Twitter</a>
                                                <div class="dm-details">
                                                    <span>Twitter </span>
                                                </div>
                                                <div class="dm-icon-holder">
                                                    <i class="ion-social-twitter"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo e(settings()['instagram_url']); ?>"> Instagram</a>
                                                <div class="dm-details">
                                                    <span> Instagram</span>

                                                </div>
                                                <div class="dm-icon-holder">
                                                    <i class="ion-social-instagram"></i>
                                                </div>
                                            </li>

                                        </ul>
                                    </div><!-- droopmenu-content -->
                                </div>

                                <!-- col4 -->
                            </div><!-- droopmenu-row -->
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo e(url('/contact')); ?>"> <?php echo e(_i('Contact Us')); ?> </a>
                </li>
            </ul>
        </div><!-- droopmenu-nav -->

    </div><!-- droopmenu-inner -->
</div><!-- droopmenu-navbar  -->
