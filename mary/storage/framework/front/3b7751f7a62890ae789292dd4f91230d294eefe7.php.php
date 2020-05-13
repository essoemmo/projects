<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(_i('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo e(_i('Replay massege')); ?></li>
            </ol>
        </div>
    </nav>
<?php
    $user = \App\Models\User::where('id',$massege->from_id)->first();
    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
    ->where('id', $user->resident_country_id)
    ->value('county_name');
    $useractive = \Illuminate\Support\Facades\DB::table('user_activity')
        ->where('user_id',$user->id)
        ->first();
?>

    <div class="my-messages-page common-wrapper">
        <div class="container">
            <div class="message-sent-by-user">
                <div class="single-member-box wide-box">
                    <div class="member-pic">
                        <a href="<?php echo e(route('user-details',$user->id)); ?>">
                            <?php if(empty($user->phote) && $user->gender == 'female'): ?>
                                <img src='<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">

                            <?php elseif(empty($user->phote) && $user->gender == 'male'): ?>
                                <img src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            <?php else: ?>
                                <img src="<?php echo e(asset('uploads/users/'.$user->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$user->phote)); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="single-member-info d-md-flex justify-content-md-between p-4">
                        <div class="personal-info">
                            <div class="name"><span><?php echo e(_i('name')); ?></span><a href="<?php echo e(route('user-details',$user->id)); ?>"><?php echo e($user->username); ?></a></div>
                            <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($user->age); ?></div>
                            <div class="country"><span><?php echo e(_i('country')); ?></span>
                                
                                <?php echo e($countyname); ?><br>
                                

                            </div>
                        </div>
                        <div class="account-info">
                            <div class="sent-time"><?php echo e(_i('massege befor')); ?>.<strong><?php echo e($massege->created_at->diffForHumans()); ?></strong></div>
                            <div class="join-date"><?php echo e(_i('dateOfRegister')); ?> : <strong><?php echo e($user->created_at->diffForHumans()); ?></strong></div>


                            <div class="online-status d-inline-block">
                                <?php if($useractive->status == 'online'): ?>
                                   <strong><?php echo e(_i('online')); ?></strong>
                                    <?php else: ?>
                                    <strong><?php echo e(_i('offline')); ?></strong>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            $masse = \App\Models\Message::where('id',$massege->id)
            ->orderBy('id','DESC')
                ->get();
            ?>
            <?php $__currentLoopData = $masse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                    <div class="received-message-context notice-box bg-light-pink text-right">
                        <strong><?php echo e($mass->user->username); ?> </strong>  :<?php echo e($mass->message); ?>

                    </div>
                    <br>
                <?php
                $replaymass = \App\Models\Message::
                where('massege_id',$mass->id)

                    ->orderBy('id','DESC')
                    ->get();
                ?>
                    <?php $__currentLoopData = $replaymass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="received-message-context notice-box bg-light text-left">
                            <strong><?php echo e($repl->user->username); ?> </strong> :<?php echo e($repl->message); ?>

                        </div>
                        <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <div class="black-head-title text-center"><?php echo e(_i('Do you want replay the massege')); ?></div>
            <form action="<?php echo e(route('replay-mass')); ?>" method="post" class="simple-theme">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('post')); ?>

                     <input type="hidden" name="mass_id" value="<?php echo e($massege->id); ?>">
                    <input type="hidden" name="to" value="<?php echo e($user->id); ?>">
                <textarea name="replay" id="" cols="30" rows="10" class="form-control" placeholder="<?php echo e(_i('message Subject')); ?>"></textarea>
                <div class="justify-content-md-end d-flex my-2">
                    <input type="submit" class="btn btn-pink" value="<?php echo e(_i('send')); ?>">
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>