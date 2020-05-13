<?php $__env->startSection('content'); ?>
    <?php
//    $usernat = \App\Models\User::select(['nationalty_id','city_id','age','photo'])->where('id', '=', $user->id)->first();
    $usernat = \App\Models\User::select(['id','username','nationalty_id','city_id','age','gender','photo','guard','resident_country_id'])
        ->where('id', '=', $user->id)
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

    $option = \App\Models\Option::get();

    $val = \Illuminate\Support\Facades\DB::table('user_options')
        ->where('user_id',$user->id)
        ->join('users','user_options.user_id','=','users.id')
        ->join('option_values','user_options.option_value_id','=','option_values.id')
        ->get();

    $status = \Illuminate\Support\Facades\DB::table('material_status')
        ->where('id',$user->material_status_id)->value('name');

    $fav = \Illuminate\Support\Facades\DB::table('user_action')
//                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
        ->orWhere('to_id',$user->id)
        ->first();

    ?>
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="#">الاعضاء</a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo e($user->username); ?></li>
            </ol>
        </div>
    </nav>

    <div class="single-user-profile-page common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-1 order-md-0">
                    <div class="user-info">
                        <ul class="list-unstyled">
                            <?php if(date('d-m-Y', strtotime($user->created_at)) === date('d-m-Y')): ?>

                                <p class="date">مسجل منذ<?php echo e(date('h:i', strtotime($user->created_at))); ?>

                                    واحدث تواجد لة   <?php echo e(\Carbon\Carbon::parse($user->useractiv[0]->created)->diffForHumans()); ?>


                                </p>

                            <?php else: ?>
                                <p class="date">مسجل منذ<?php echo e(\Carbon\Carbon::parse($user->created_at)->format('Y/ m/d')); ?>


                                    واحدث تواجد لة   <?php echo e(\Carbon\Carbon::parse($user->useractiv[0]->created)->diffForHumans()); ?>


                                </p>

                            <?php endif; ?>
                            <li><strong><?php echo e(_i('ID')); ?></strong><?php echo e($user->id); ?></li>
                            <li><strong><?php echo e(_i('username')); ?></strong><?php echo e($user->username); ?></li>
                            <li><strong><?php echo e(_i('nationalty')); ?></strong> <?php echo e($nation); ?> </li>
                            <li><strong><?php echo e(_i('country')); ?></strong> <?php echo e($countyname); ?> </li>
                            <li><strong><?php echo e(_i('city')); ?></strong><?php echo e($cityname); ?> </li>
                            <li><strong><?php echo e(_i('age')); ?></strong> <?php echo e($user->age); ?></li>

                            <li><strong><?php echo e(_i('state')); ?></strong><?php echo e($status); ?></li>
                                <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $va): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $option = \App\Models\Option::where('id',$va->option_id)->get() ?>
                                    <?php $__currentLoopData = $option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><strong><?php echo e($op->title); ?></strong><?php echo e($va->title); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <li><strong><?php echo e(_i('About the partener')); ?></strong><?php echo $user->partener_info; ?></li>
                                <li><strong><?php echo e(_i('About me')); ?></strong><?php echo $user->about_me; ?></li>

                        </ul>
                    </div>
                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>

                        <?php if(request()->id == auth()->user()->id): ?>

                        <?php else: ?>

                            <?php if(!empty($fav) && $fav->action == 'like'): ?>
                                <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="<?php echo e($user->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart"></i>اضف الى قائمة المعجب بهم</a>
                            <?php else: ?>
                                <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="<?php echo e($user->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"><i class="fa fa-heart-o"></i>اضف الى قائمة غير معجب بهم</a>
                            <?php endif; ?>

                                <a href="" class="btn btn-pink" id="showmass"> <?php echo e($user->username); ?>ارسل رسالة للعضو</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="block" data-to="<?php echo e($user->id); ?>" data-from="<?php echo e(\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''); ?>"> اضف الى قائمة التجاهل الي <?php echo e($user->username); ?></a>

                                <form action="<?php echo e(route('send-messageUser')); ?>" method="post" style="display: none;margin-top: 27px;" id="mass">
                                    <?php echo e(csrf_field()); ?>

                                    <?php echo e(method_field('post')); ?>

                                    <input type="hidden" name="to" value="<?php echo e($user->id); ?>">
                                    <input type="hidden" name="from" value="<?php echo e(auth()->user()->id); ?>">
                                    <div class="massege">
                                        <textarea class="form-control" name="messge"></textarea>
                                    </div>

                                    <input type="submit" class="btn btn-info btn-sm" value="send">
                                </form>
                            <?php endif; ?>

                        <?php else: ?>
                        <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="" data-from=""><i class="fa fa-heart-o"></i>اضف الى قائمة غير معجب بهم</a>
                        <a href="" class="btn btn-pink disabled"> <?php echo e($user->username); ?>ارسل رسالة للعضو</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="block" data-to="" data-from=""> اضف الى قائمة التجاهل الي <?php echo e($user->username); ?></a>
                        <form action="<?php echo e(route('send-messageUser')); ?>" method="post" style="margin-top: 27px;" id="mass">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('post')); ?>

                            <input type="hidden" name="to" value="">
                            <input type="hidden" name="from" value="">
                            <div class="massege">
                                <textarea class="form-control" name="messge" disabled></textarea>
                            </div>

                            <input type="submit" class="btn btn-info btn-sm" value="send" disabled>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="col-md-4 order-0 order-md-1 mb-2">
                    <div class="user-profile">
                        <?php if(empty($user->phote) && $user->gender == 'female'): ?>
                            <img src="<?php echo e(asset('uploads/default.jpg')); ?>" data-src="<?php echo e(asset('uploads/default.jpg')); ?>" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">

                        <?php elseif(empty($user->phote) && $user->gender == 'male'): ?>
                            <img src="<?php echo e(asset('uploads/images.jpg')); ?>" data-src="<?php echo e(asset('uploads/images.jpg')); ?>" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">
                        <?php else: ?>
                            <img src="<?php echo e(asset('uploads/users/'.$user->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$last->user->phote)); ?>" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">
                        <?php endif; ?>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <br>
    <br>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            $('body').on('click','.add-to-fav',function (e) {
                e.preventDefault();


                var f = $(this).data('from');
                var t = $(this).data('to');

            if (f.length <= 0){
                new Noty({
                    type: 'warning',
                    layout: 'topRight',
                    text: "<?php echo e(_i('You should login in the web to send the like')); ?>",
                    timeout: 2000,
                    killer: true
                }).show();

            }else{
                $.ajax({
                    url: '<?php echo e(route('add-heart')); ?>',
                    method: "post",
                    data: {_token: '<?php echo e(csrf_token()); ?>',
                        f:f,
                        t:t,


                    },
                    success: function (response) {
                        if (response === "true"){
                           $('.add-to-fav i').attr('class','fa fa-heart');
                        }else{
                            $('.add-to-fav i').attr('class','fa fa-heart-o');

                        }
                    }
                });
            }


            });


            $('body').on('click','#block',function (e) {
                e.preventDefault();

                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "<?php echo e(_i('You should login in the web to send the blocked')); ?>",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '<?php echo e(route('add-block')); ?>',
                        method: "post",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            f:f,
                            t:t,

                        },
                        success: function (response) {
                            if (response === "true"){
                                $('.add-to-fav i').attr('class','fa fa-heart-o');
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "<?php echo e(_i('Done the user is blocked')); ?>",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }else{
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "<?php echo e(_i('Done the user is disliked')); ?>",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        }
                    });
                }
            })

            $('body').on('click','#showmass',function (e) {
                e.preventDefault();

                $('#mass').fadeToggle(500);
            })
        })
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/web/user/userDetails.blade.php ENDPATH**/ ?>