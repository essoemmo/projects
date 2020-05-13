<?php if($onlineUser->count() > 0): ?>

    <div class="row">

        <?php $__currentLoopData = $onlineUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php

            $usernat = \App\Models\User::select(['id','username','nationalty_id','city_id','age','gender','photo','guard','resident_country_id'])
                        ->where('id', '=', $online->user_id)
                        ->first();

            $nation = \Illuminate\Support\Facades\DB::table('nationalies_data')
                ->where('nationalty_id', $usernat->nationalty_id)
                ->value('name');

            $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                ->where('id', $usernat->resident_country_id)
                ->value('county_name');

            $cityname = \Illuminate\Support\Facades\DB::table('cities_data')
                ->where('id', $usernat->city_id)
                ->value('name');

            $fav = \Illuminate\Support\Facades\DB::table('user_action')

                ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                ->Where('to_id',$usernat->id)
                ->first();
            ?>
            <?php if($usernat->guard != 'admin'): ?>

                    <div class="col-lg-2 col-md-3 filter <?php echo e($usernat->gender == 'male' ? 'male' : 'female'); ?>">
                        <div class="single-member-box">
                            <div class="member-pic">
                                <a href="<?php echo e(route('user-details',$usernat->id)); ?>">
                                    <?php if(empty($usernat->phote) && $usernat->gender == 'female'): ?>
                                        <img src='<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" alt=""
                                             class="img-fluid lazy rounded-circle loaded">

                                    <?php elseif(empty($usernat->phote) && $usernat->gender == 'male'): ?>
                                        <img src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$usernat->gender-avatar.png")); ?>" alt=""
                                             class="img-fluid lazy rounded-circle loaded">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('uploads/users/'.$usernat->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$usernat->phote)); ?>" alt=""
                                             class="img-fluid lazy rounded-circle loaded">
                                    <?php endif; ?>
                                </a>
                            </div>



                            <div class="single-member-info">
                            <div class="name"><span><?php echo e(_i('name')); ?></span><a href="<?php echo e(route('user-details',$usernat->id)); ?>"><?php echo e($usernat->username); ?></a></div>
                            <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($usernat->age); ?></div>
                            <div class="country"><span><?php echo e(_i('country')); ?></span>

                                  <?php echo e($countyname); ?><br>


                            </div>
                                <ul class="list-inline single-member-options">
                                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                                        <li><a href="" id="comment" data-to="<?php echo e($usernat->id); ?>" data-fro="<?php echo e(\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''); ?>" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                                    <?php else: ?>
                                        <li><a href="" id="comment" title="<?php echo e(_i('login first')); ?>" ><i class="fa fa-envelope-o"></i></a></li>
                                    <?php endif; ?>

                                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>

                                        <?php if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id ): ?>
                                            <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$usernat->id); ?>" data-id="<?php echo e($usernat->id); ?>"  data-to="<?php echo e($usernat->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                                        <?php else: ?>
                                            <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$usernat->id); ?>" data-id="<?php echo e($usernat->id); ?>" data-to="<?php echo e($usernat->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <?php if(!empty($fav) && $fav->action == 'like'): ?>
                                            <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$usernat->id); ?>" data-id="<?php echo e($usernat->id); ?>"  data-to="<?php echo e($usernat->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                                        <?php else: ?>
                                            <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$usernat->id); ?>" data-id="<?php echo e($usernat->id); ?>" data-to="<?php echo e($usernat->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <li><a href="<?php echo e(route('user-details',$usernat->id)); ?>" id="eye" data-id="<?php echo e($usernat->id); ?>" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                                </ul>

                            </div>

                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <?php echo e($onlineUser->appends(request()->query())->links()); ?>


            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-danger">
            <h4><?php echo e(_i('Sorry dont Found onlineuser')); ?></h4>
        </div>
    <?php endif; ?>

<?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/OnlineUser/ajax.blade.php ENDPATH**/ ?>