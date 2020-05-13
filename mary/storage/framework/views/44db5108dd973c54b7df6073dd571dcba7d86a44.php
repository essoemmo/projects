










    <section class="latest-members  common-wrapper ">
        <div class="container">

            <div class="top-member-filter">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" class="users-country-selection form-inline">

                            <?php
                            $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                                ->get();
                            ?>

                            <select class="form-control my-1 mr-sm-2" id="country">
                                <option ><?php echo e(_i('Country')); ?></option>
                                <?php $__currentLoopData = $countyname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->county_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-6 align-self-md-center">
                        <div class="filter-btns text-left">
                            <button class="btn btn-default filter-button" id="filter" data-filter="all"><?php echo e(_i('all')); ?></button>
                            <button class="btn btn-default male-icon-img filter-button" id="filter" data-filter="male"></button>
                            <button class="btn btn-default female-icon-img filter-button" id="filter" data-filter="female"></button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="data">

                <?php echo $__env->make('web.user.OnlineUser.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>

            
            
            

        </div>
    </section>
    <br>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('Send massges')); ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modeldata">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                        <button type="button" class="btn btn-primary" id="submit"><?php echo e(_i('send massege')); ?></button>
                    <?php else: ?>
                        <a href="<?php echo e(url('login')); ?>" type="button" class="btn btn-pink"><?php echo e(_i('To login')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



















































































































































<?php /**PATH C:\xampp\htdocs\mary\resources\views/web/user/OnlineUser/index.blade.php ENDPATH**/ ?>