<?php $__env->startSection('css'); ?>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
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
                            <form action="<?php echo e(route('sms.update',$datasms->id)); ?>" method="post" id="addForm" enctype="multipart/form-data" data-parsley-validate>
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>



                                <div class="form-group">
                                    <label><?php echo e(_i('users')); ?></label>
                                    <select class="form-control" name="user">
                                        <option value=" " selected disabled><?php echo e(_i('choose user')); ?></option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>" <?php echo e($datasms->user_id == $user->id ? 'selected' : ''); ?>><?php echo e($user->username); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('created')); ?></label>
                                    <input type="text" id="datepicker"  name="created" class="form-control" required="" value="<?php echo e($datasms->created); ?>">
                                </div>

                                <div class="col-md-12">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>" id="lang-<?php echo e($lang->id); ?>" data-toggle="pill" href="#<?php echo e($lang->code); ?>" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <input type="hidden" name="lang_id[]" value="<?php echo e($lang->id); ?>">

                                                        <?php if(in_array($lang->id,$langs_id)): ?>
                                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $da): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($lang->id == $da->lang_id): ?>
                                                                <div class="tab-pane <?php echo e($index == 0 ? 'active' : ''); ?>" id="<?php echo e($lang->code); ?>" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                                                    <div class="form-group">
                                                                        <label><?php echo e(_i('message')); ?></label>
                                                                        <textarea name="<?php echo e($lang->code); ?>_message" class="form-control ckeditor"><?php echo e($da->message); ?></textarea>
                                                                    </div>
                                                                </div>

                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>


                                <input type="hidden"  name="status" class="form-control" value="pending">

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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('body').on('submit','#addForm',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            alert(url);
            $.ajax({
                url: url,
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
                        $('#addForm')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });






    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/setting/sms/edit.blade.php ENDPATH**/ ?>