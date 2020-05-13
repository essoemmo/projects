<?php if($latestmember->count() > 0): ?>

    <div class="row">
        <?php $i = 0; ?>
        <?php $__currentLoopData = $latestmember; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $last): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <div class="col-lg-2 col-md-3 filter <?php echo e($last->gender == 'male' ? 'male' : 'female'); ?>">
            <div class="single-member-box">
                <div class="member-pic">
                    <a href="<?php echo e(route('user-details',$last->id)); ?>">
                        <?php if(empty($last->phote) && $last->gender == 'female'): ?>
                            <img src='<?php echo e(asset("web/images/$last->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$last->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        <?php elseif(empty($last->phote) && $last->gender == 'male'): ?>
                            <img src="<?php echo e(asset("web/images/$last->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$last->gender-avatar.png")); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php else: ?>
                            <img src="<?php echo e(asset('uploads/users/'.$last->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$last->phote)); ?>" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        <?php endif; ?>
                    </a>
                </div>
                <div class="single-member-info">
                    <div class="name"><span><?php echo e(_i('name')); ?></span><a href="<?php echo e(route('user-details',$last->id)); ?>"><?php echo e($last->username); ?></a></div>
                    <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($last->age); ?></div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $last->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    $fav = \Illuminate\Support\Facades\DB::table('user_action')
                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                        ->Where('to_id',$last->id)
                        ->first();
                    ?>

                    <div class="country"><span><?php echo e(_i('country')); ?></span><?php echo e($countyname); ?> </div>
                    <ul class="list-inline single-member-options">
                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                        <li><a href="" id="comment" data-to="<?php echo e($last->id); ?>" data-fro="<?php echo e(\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''); ?>" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                        <?php else: ?>
                            <li><a href="" id="comment" title="<?php echo e(_i('login first')); ?>" ><i class="fa fa-envelope-o"></i></a></li>
                        <?php endif; ?>

                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>

                            <?php if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id ): ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$last->id); ?>" data-id="<?php echo e($last->id); ?>"  data-to="<?php echo e($last->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                            <?php else: ?>
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$last->id); ?>" data-id="<?php echo e($last->id); ?>" data-to="<?php echo e($last->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                            <?php endif; ?>

                            <?php else: ?>
                                <?php if(!empty($fav) && $fav->action == 'like'): ?>
                                    <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$last->id); ?>" data-id="<?php echo e($last->id); ?>"  data-to="<?php echo e($last->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                                <?php else: ?>
                                    <li><a href="javascript:void(0)"  class="add-to-fav" id="<?php echo e('like-'.$last->id); ?>" data-id="<?php echo e($last->id); ?>" data-to="<?php echo e($last->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i></a></li>
                                <?php endif; ?>

                            <?php endif; ?>

                        <li><a href="<?php echo e(route('user-details',$last->id)); ?>" id="eye" data-id="<?php echo e($last->id); ?>" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
                <?php $i++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        <?php echo e($latestmember->appends(request()->query())->links()); ?>


       </ul>
</nav>

<?php else: ?>
<div class="alert alert-danger">
    <p><?php echo e(_i('Sorry not found!!!')); ?></p>
</div>
<?php endif; ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/latestUser/ajax.blade.php ENDPATH**/ ?>