
<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Search result')); ?></li>
            </ol>
        </div>
    </nav>


    <section class="latest-members  common-wrapper ">
        <div class="container">


                    <div id="data">
                        <?php echo $__env->make('web.search.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/web/search/index.blade.php ENDPATH**/ ?>