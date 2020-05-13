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
                            <form action="<?php echo e(route('memberships-details.update',$membershipss->id)); ?>" method="post" id="editForm" enctype="multipart/form-data" data-parsley-validate>
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('member ship')); ?></label>
                                    <select name="memberShip" class="form-control selectpicker">
                                        <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($membership->id); ?>" <?php echo e($membershipss->id == $membership->id ?'selected':''); ?>><?php echo e($membership->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('type')); ?></label>
                                    <select name="type" class="form-control selectpicker">
                                        <option value=""><?php echo e(_i('choose...')); ?></option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type); ?>" <?php echo e($membership->type === $type ?'selected':''); ?>><?php echo e($type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('permissions')); ?></label>
                                    <select name="permission[]" class="form-control selectpicker" multiple>
                                        <option value=""><?php echo e(_i('choose...')); ?></option>
                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($permission->id); ?>" <?php echo e(in_array($permission->id,$permisiionId) ? 'selected' : ''); ?>><?php echo e($permission->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('price')); ?></label>
                                    <input type="number" name="price" value="<?php echo e($membershipss->price); ?>" class="form-control" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('expire date')); ?></label>
                                    <input type="date" name="end_date" class="form-control" value="<?php echo e($membershipss->expire_date); ?>" data-parsley-required="true">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('image')); ?></label>
                                    <input type="file" name="image" class="form-control" onchange="showImg(this)">
                                </div>

                                <div class="form-group" id="url_container">
                                    <img src="<?php echo e(asset('uploads/membership/'.$membershipss->image)); ?>" class="image" alt="Your Photo" width="100%" height="200px">
                                </div>


                                <div class="col-md-12">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>" data-toggle="pill" href="#<?php echo e($lang->code); ?>" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                                </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="tab-pane <?php echo e($index == 0 ? 'active' : ''); ?>" id="<?php echo e($lang->code); ?>" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                                    <div class="form-group">
                                                        <label><?php echo e(_i('descrption')); ?></label>

                                                        <?php if(in_array($lang->id,$membershipsss)): ?>

                                                                   <?php $__currentLoopData = $membershipssss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                       <?php if($ship->lang_id ==$lang->id ): ?>
                                                                    <textarea name="<?php echo e($lang->code); ?>_descrption" class="form-control ckeditor">

                                                            <?php echo $ship->description; ?>


                                                        </textarea>
                                                                <?php endif; ?>
                                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            <?php else: ?>

                                                        <?php endif; ?>
                                                        <input type="hidden" name="lang_id[]" value="<?php echo e($lang->id); ?>">
                                                    </div>


                                                </div>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>

                                            <div class="col-md-6">
                                                <button class="btn btn-info pull-left" id="newOption"><?php echo e(_i('new option')); ?></button>

                                            </div>

                                            <div class="optionmember">
                                                <?php if(!empty($options)): ?>
                                                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $langg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($langg->id == $option->lang_id): ?>
                                                        <div class="row options">

                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <label><?php echo e(_i('name').$langg->name); ?></label>
                                                                    <input type="text" name="options[<?php echo e($langg->id); ?>][]" class="form-control" value="<?php echo e($option->name); ?>">
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
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- /.card -->
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


        $('body').on('submit','#editForm',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
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
                        // $('#addForm')[0].reset();
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
             <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row options">
                                    <div class="col-md-6">
                                        <div class="">
                                           <label><?php echo e(_i('name ').$lang->name); ?></label>
                                           <input type="text" name="options[<?php echo e($lang->id); ?>][]" class="form-control">
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/memberShip/details/edit.blade.php ENDPATH**/ ?>