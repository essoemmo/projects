<?php $__env->startSection('content'); ?>

    <?php if($wishlistandBlocked->count() > 0): ?>


        <?php $__currentLoopData = $wishlistandBlocked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userlk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php

         $users = \App\Models\User::where('id',$userlk->to_id)->get();

         ?>
         <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


            <div class="card" style="padding: 10px; margin: 33px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="image">
                                <?php if(empty($user->user->image) &&!isset($user->user->image)): ?>
                                    <img src="<?php echo e(asset('uploads/default.jpg')); ?>" style="width: 100px"><br>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('uploads/users/'.$user->image)); ?>" style="width: 100px"><br>

                                <?php endif; ?>


                                <?php if(date('d-m-Y', strtotime($user->created_at)) === date('d-m-Y')): ?>
                                    <span class="date">قبل<?php echo e(date('h:i', strtotime($user->created_at))); ?>ساعة</span>

                                <?php else: ?>
                                    <span class="date"><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('Y/ m/d')); ?></span>

                                <?php endif; ?>


                            </div>
                        </div>
                        <?php

//                        $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $user->id)->first();

                        $usernat = \App\Models\User::select(['nationalty_id','city_id','age','photo'])->where('id', '=', $user->id)->first();
                        $nation = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('name');

                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('county_name');

                        $cityname = \Illuminate\Support\Facades\DB::table('cities_data')
                            ->where('id', $usernat->city_id)
                            ->value('name');
                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('county_name');

                        ?>
                        <div class="col-md-3">
                            <a href="<?php echo e(route('user-details',$user->id)); ?>">الاسم:<?php echo e($user->username); ?></a><br>

                            العمر:<?php echo e($usernat->age); ?><br>
                            من:  <?php echo e($nation); ?><br>
                            مقيم:  <?php echo e($countyname); ?><br>
                            <span><?php echo e($cityname); ?></span>
                        </div>

                        <div class="col-md-8">
                            <?php echo $user->content; ?>

                        </div>
                    </div>
                </div>
            </div>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php else: ?>

        <div class="alert alert-danger">
            <h4><?php echo e(_i('Sorry dont Found')); ?></h4>
        </div>
    <?php endif; ?>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>