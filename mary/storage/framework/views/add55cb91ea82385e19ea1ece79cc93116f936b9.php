<div class="table-responsive">
    <table class="table table-bordered table-striped dataTable text-center" id="massegs_table">
        <thead class=" text-center">
        <tr>

            <th scope="col"><?php echo e(_i('from')); ?></th>
            <th scope="col"><?php echo e(_i('my massege')); ?></th>

            <th scope="col"><?php echo e(_i('created_at')); ?></th>
            <th><?php echo e(_i('Controll')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $massege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($massege->user->username); ?></td>
            <td><?php echo e($massege->message); ?></td>


            <td><?php echo e($massege->created_at->diffForHumans()); ?></td>
            <td>
<?php

        $action = \Illuminate\Support\Facades\DB::table('user_action')
//                    ->where('to_id',$massege->user->id)
            ->Where('from_id',\Illuminate\Support\Facades\Auth::id())
            ->first();

        $fav = \Illuminate\Support\Facades\DB::table('user_action')
//                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
            ->Where('to_id',$massege->user->id)
            ->orWhere('status','pending')
            ->first();

        ?>

                    <a href="javascript:void(0)" class="btn-sm" id="deletemass" data-id="<?php echo e($massege->id); ?>" data-favid="<?php echo e($fav->id); ?>"><i class="fa fa-ban"></i></a>

            </td>
        </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
    </table>
</div>












<?php /**PATH C:\xampp\htdocs\mary\resources\views/web/user/accountsetting/myfavPartener.blade.php ENDPATH**/ ?>