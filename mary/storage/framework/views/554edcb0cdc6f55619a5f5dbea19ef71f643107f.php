
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>


    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e($title); ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">

                            <form action="<?php echo e(route('Stories.store')); ?>" method="post" id="addForm">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('post')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('language')); ?></label>
                                    <select name="language" class="form-control">

                                        <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('users')); ?></label>
                                    <select name="user_id" class="form-control">

                                        <?php $__currentLoopData = \App\Models\User::where('guard','!=','admin')->pluck('username','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($val); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('title')); ?></label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('content')); ?></label>
                                    <textarea name="conteent" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('published')); ?></label>
                                    <input type="checkbox" name="publish" class="form-control ckeditor">

                                </div>

                                <input type="submit" class="btn btn-info btn-sm" value="<?php echo e(_i('save')); ?>">

                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {


            $('body').on('change','#lang',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('getlangarticl')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#category').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#category').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');

                        }
                        // $('#group_ax').val(group);
                    }
                });
            });


            $('#lang').trigger('change');
        });


    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/stories/create.blade.php ENDPATH**/ ?>