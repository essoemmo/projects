<div class="row">


<?php if($search->count() > 0): ?>
    <?php $__currentLoopData = $search; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php //$sear = \App\Models\User::where('id',$searc->user_id)->first() ?>
        <div class="col-lg-2 col-md-3 ">
            <div class="single-member-box">
                <div class="member-pic">
                    <a href="<?php echo e(route('user-details',$sear->id)); ?>">
                        <?php if(empty($sear->phote) && $sear->gender == 'female'): ?>
                            <img src='<?php echo e(asset("web/images/$sear->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$sear->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        <?php elseif(empty($sear->phote) && $sear->gender == 'male'): ?>
                            <img src="<?php echo e(asset("web/images/$sear->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$sear->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php else: ?>
                            <img src="<?php echo e(asset('uploads/users/'.$sear->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$sear->phote)); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php endif; ?>
                    </a>                        </div>
                <div class="single-member-info">
                    <div class="name"><span><?php echo e(_i('name')); ?></span><a href="<?php echo e(route('user-details',$sear->id)); ?>"><?php echo e($sear->username); ?></a></div>
                    <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($sear->age); ?></div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $sear->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    $fav = \Illuminate\Support\Facades\DB::table('user_action')
                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                        ->Where('to_id',$sear->id)
                        ->first();
//                    dd($fav);

                    ?>
                    <div class="country"><span><?php echo e(_i('country')); ?></span>
                        
                        <?php echo e($countyname); ?><br>
                        

                    </div>
                    <ul class="list-inline single-member-options">
                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                            <li><a href="" id="comment" data-to="<?php echo e($sear->id); ?>" data-fro="<?php echo e(\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''); ?>" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                        <?php else: ?>
                            <li><a href="" id="comment" title="<?php echo e(_i('login first')); ?>" ><i class="fa fa-envelope-o"></i></a></li>
                        <?php endif; ?>

                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>

                            <?php if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id ): ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$sear->id); ?>" data-id="<?php echo e($sear->id); ?>"  data-to="<?php echo e($sear->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                            <?php else: ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$sear->id); ?>" data-id="<?php echo e($sear->id); ?>" data-to="<?php echo e($sear->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php if(!empty($fav) && $fav->action == 'like'): ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$sear->id); ?>" data-id="<?php echo e($sear->id); ?>"  data-to="<?php echo e($sear->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                            <?php else: ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$sear->id); ?>" data-id="<?php echo e($sear->id); ?>" data-to="<?php echo e($sear->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                            <?php endif; ?>

                        <?php endif; ?>

                        <li><a href="<?php echo e(route('user-details',$sear->id)); ?>" id="eye" data-id="<?php echo e($sear->id); ?>" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <?php echo e($search->appends(request()->query())->links()); ?>


            </ul>
        </nav>

<?php else: ?>
    <div class="alert alert-danger">
        <h4><?php echo e(_i('Sorry dont Found search')); ?></h4>
    </div>
    <?php endif; ?>

