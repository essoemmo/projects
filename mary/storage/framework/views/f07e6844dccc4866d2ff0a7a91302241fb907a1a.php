
<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Search Advanced')); ?></li>
            </ol>
        </div>
    </nav>


    <section class="latest-members  common-wrapper ">

            <div class="container">
                <form action="<?php echo e(route('advanced-search-post')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('post')); ?>

                    <?php

                        $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
                    ?>
                    
                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="account_setting">
                            <p><?php echo e(_i($gro->title)); ?></p>
                        </div>
                        <div class="row">
                            <?php if($gro->source_id == null): ?>
                                <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <div class="col-md-6">
                                        <label><?php echo e(_i($option->title)); ?></label>
                                        <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                            <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>

                                <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label><?php echo e(_i($option->title)); ?></label>
                                        <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                            <?php if($option->source_id == null): ?>

                                                <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php else: ?>

                                                <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        </select>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <?php endif; ?>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <input type="submit" class="btn btn-grad my-1" value="<?php echo e(_i('search')); ?>">
                </form>
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


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script>
        $('body').on('click','#comment',function (e) {
            e.preventDefault();

            var to = $(this).data('to');
            var fro = $(this).data('fro');


                    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
            var html = ` <form action="<?php echo e(route('send-messageUser')); ?>" method="post" id="mass">
                                    <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('post')); ?>

                    <input type="hidden" name="from" value="${fro}">
            <input type="hidden" name="to" value="${to}">

                        <textarea rows="5"  name="messge" class="form-control"></textarea>

                            </form>`;

            <?php else: ?>
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "<?php echo e(_i('Sorry you should Login')); ?>",
                timeout: 2000,
                killer: true
            }).show();

            <?php endif; ?>

            $('#modeldata').empty();
            $('#modeldata').append(html);



        });
        $('body').on('click','.add-to-fav',function (e) {
            e.preventDefault();

            var id = $(this).data('id');
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
                            $('#like-'+id+' i').attr('class','fa fa-heart');
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('done like !!')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }else{
                            $('#like-'+id+' i').attr('class','fa fa-heart-o');
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "<?php echo e(_i('done dislike !!')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();

                        }
                    }
                });
            }

        });

        $('body').on('click','#submit',function () {

            $('#mass').submit();
        })
    </script>
    
    
    

    
    

    
    

    
    
    
    

    
    

<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/web/search/advanced/advanced.blade.php ENDPATH**/ ?>