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
                                    <label><?php echo e(_i('member ship')); ?></label>
                                    <select name="memberShip" class="form-control selectpicker">
                                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('type')); ?></label>
                                    <select name="type" class="form-control selectpicker">
                                        <option value=""><?php echo e(_i('choose...')); ?></option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('permissions')); ?></label>
                                    <select name="permission[]" class="form-control selectpicker" multiple>
                                        <option value=""><?php echo e(_i('choose...')); ?></option>
                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('price')); ?></label>
                                    <input type="number" name="price" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('expire date')); ?></label>
                                    <input type="date" name="end_date" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('image')); ?></label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>

                                <div class="form-group" id="url_container">
                                    <img src="<?php echo e(asset('uploads/default-image.png')); ?>" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('descrption')); ?></label>
                                    <textarea name="descrption" class="form-control ckeditor"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-info pull-left" id="newOption"><?php echo e(_i('new option')); ?></button>

                                </div>

                            <div class="optionmember">
                                <div class="row options">

                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="options[]" class="form-control">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <button class="btn btn-danger del"><?php echo e(_i('delete')); ?></button>
                                        </div>
                                        <br>
                                    </div>

                                </div>
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
                url: '<?php echo e(route('memberships-details.store')); ?>',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    console.log(response);
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "<?php echo e(_i('Added is Successfly')); ?>",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                        $('#masages_model').hide();
                        $('#addForm')[0].reset();
                        // $modal = $('#addForm');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });
        $('#newOption').on('click',function (e) {
            e.preventDefault();
                $('.optionmember').append(`
                    <div class="row options">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="text" name="options[]" class="form-control">
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <button class="btn btn-danger del"><?php echo e(_i('delete')); ?></button>
                                        </div>
                                        <br>
                                    </div>

                                </div>

               `);

        });


        $('body').on('click','.del',function (e) {
            e.preventDefault();
            $(this).closest('.row').remove();
        })

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
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/memberShip/details/create.blade.php ENDPATH**/ ?>