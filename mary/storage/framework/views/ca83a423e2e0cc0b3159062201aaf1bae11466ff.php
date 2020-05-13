
<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(_i('online User')); ?></span>
                        <span class="info-box-number">
                  <?php  $onlineUser = \App\Models\User_activity::with('user')
                                ->where('status','=','online')
                                ->count() ?>
                  <small><?php echo e($onlineUser); ?></small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <canvas id="myChart" width="200" height="200"></canvas>

            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(_i('registered user')); ?></span>
                        <?php   $latestmember = \App\Models\User::count(); ?>
                        <span class="info-box-number"><?php echo e($latestmember); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <canvas id="myChart2" width="200" height="200"></canvas>

            </div>
            </div>
            <!-- /.col -->
    </div><!--/. container-fluid -->


    <?php

    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
        ->get();
    $users = \Illuminate\Support\Facades\DB::table('users')
        ->get();

    ?>


    <!-- STACKED BAR CHART -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['male', 'Female'],
                datasets: [{
                    label: '',
                    data: [<?php echo e($male); ?>,<?php echo e($female); ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>


        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:  [



















                            <?php $__currentLoopData = $countyname->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e(str_replace(' ',',',$count->county_name)); ?>',
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                ],
                datasets: [{
                    label: '',
                    data: [

                        <?php
                        $country = \Illuminate\Support\Facades\DB::table('nationalies_data')->get();
                        ?>

                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $user = \App\Models\User::where('resident_country_id',$us->id)->count();
                            ?>
                        <?php echo e($user); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    ],
                    backgroundColor: [
                        <?php $__currentLoopData = $countyname->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    ],
                    borderColor: [
                        <?php $__currentLoopData = $countyname->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/home.blade.php ENDPATH**/ ?>