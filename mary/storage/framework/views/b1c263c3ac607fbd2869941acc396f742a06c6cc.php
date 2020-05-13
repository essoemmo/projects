<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        /* Clear floats */
        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        /* Style time text */
        .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: left;
            color: #999;
        }
    </style>

    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php
            $massege = \App\Models\Message::where('id',$id)->first();

            ?>

                <div class="container">
                    <p><?php echo e($massege->message); ?></p>

                </div>

            <?php $__currentLoopData = \App\Models\Message::where('massege_id',$massege->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="container darker pull-left">
                    <p style="text-align: left"><?php echo e($mass->message); ?></p>
                    
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <!-- /.box-body -->
    </div>




<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/massage/show.blade.php ENDPATH**/ ?>