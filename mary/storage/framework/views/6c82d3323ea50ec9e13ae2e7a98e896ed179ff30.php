
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
                            <form action="<?php echo e(route('articles.store')); ?>" method="post" id="addForm" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('post')); ?>



                                <div class="form-group">
                                    <label><?php echo e(_i('language')); ?></label>
                                    <select name="language" class="form-control" id="lang">

                                        <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('title')); ?></label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group row" >

                                    <label class="col-xs-2 col-form-label " for="date">
                                        <?php echo e(_i('Date')); ?> </label>
                                    <div class="col-xs-6">
                                        <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="<?php echo e(old('created')); ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('published')); ?></label>
                                    <input type="checkbox" name="published">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('Category')); ?></label>
                                    <select class="form-control select2" style="width: 100%;" name="category" id="category">



                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('Image')); ?></label>
                                    <input type="file" name="image" class="form-control image">
                                </div>

                                <img src="" style="width: 100%; height: 200px" class="image-preview">

                                <div class="form-group">
                                    <label><?php echo e(_i('content')); ?></label>
                                    <textarea  name="conteent" class="form-control ckeditor"></textarea>
                                </div>
                    <input type="submit" class="btn btn-info btn-sm">
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

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/articles/create.blade.php ENDPATH**/ ?>