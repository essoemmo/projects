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
        <div class="alert alert-danger" id="masages_model" style="display: none">

        </div>
                            <form method="post" id="addForm" enctype="multipart/form-data" data-parsley-validate>
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
                                    <label><?php echo e(_i('sections')); ?></label>
                                    <select name="section_id" class="form-control">

                                        <?php $__currentLoopData = $contentSectios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('start date')); ?></label>
                                    <input type="date" name="start_date" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('end date')); ?></label>
                                    <input type="date" name="end_date" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('main banner')); ?></label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>

                                <div class="form-group" id="url_container">
                                    <img src="<?php echo e(asset('uploads/default-image.png')); ?>" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('title')); ?></label>
                                    <input type="text" name="title" class="form-control" data-parsley-required="true">
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('content')); ?></label>
                                    <textarea name="conteent" class="form-control ckeditor"></textarea>
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
    <script type="text/javascript">


        $('body').on('submit','#addForm',function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo e(route('banner.store')); ?>',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {

                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response['0'] == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "<?php echo e(_i('Added is Successfly')); ?>",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                        $('#masages_model').hide();
                        window.location.href = "<?php echo e(url('admin/banner/')); ?>"+'/'+response['id']+'/edit';

                        // $modal = $('#addForm');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });





        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('.image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/banner/create.blade.php ENDPATH**/ ?>