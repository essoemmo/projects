<div class="row">

            <?php if($stories->count() > 0): ?>
                <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','gender','resident_country_id'])->where('id', '=', $story->user_id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');


                    ?>

            <div class="col-md-6">
                <div class="single-member-box wide-box">
                    <div class="member-pic">
                <a href="<?php echo e(route('user-details',$story->user->id)); ?>">
                        <?php if(empty($story->user->phote) && $story->user->gender == 'female'): ?>
                            <img src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        <?php elseif(empty($story->user->phote) && $story->user->gender == 'male'): ?>
                            <img src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php else: ?>
                            <img src="<?php echo e(asset('uploads/users/'.$story->user->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$online->user->phote)); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php endif; ?>
                </a>





                    </div>

                    <div class="single-member-info">
                        <div class="name"><span><?php echo e(_i('name')); ?></span><?php echo e($story->user->username); ?></div>
                        <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($story->user->age); ?></div>
                        <div class="country"><span><?php echo e(_i('country')); ?></span><?php echo e($countyname); ?> </div>

                        <div class="member-story">
                            <?php echo $story->content; ?>

                        </div>
                    </div>

                </div>
            </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($stories->appends(request()->query())->links()); ?>

            <?php else: ?>

                <div class="alert alert-danger">
                    <h4><?php echo e(_i('Sorry dont Found Story')); ?></h4>
                </div>
            <?php endif; ?>


        </div>






<?php /**PATH /home/euzawaaj/public_html/mary/resources/views/web/storeis/ajax.blade.php ENDPATH**/ ?>