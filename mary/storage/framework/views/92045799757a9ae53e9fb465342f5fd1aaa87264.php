<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php if(auth()->user()->can('Membership-Add')): ?>
            <button class="btn btn-primary create" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i><?php echo e(_i('create new memberShip')); ?></button>
            <?php endif; ?>
            <?php echo $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true); ?>

        </div>
        <!-- /.box-body -->
    </div>

    <?php $__env->startPush('js'); ?>
        <?php echo $dataTable->scripts(); ?>

        <script>
            $(function () {
                'use strict'
                $('.create').attr('data-toggle', 'modal').attr('data-target','#create');
            })
        </script>
    <?php $__env->stopPush(); ?>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('create')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert aler-danger" id="masages_model1" style="display: none;" >
                    </div>
                    <form method="post" id="addForm" data-parsley-validate="">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('post')); ?>


                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <?php $__currentLoopData = \App\Models\Language::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>" data-toggle="pill" href="#<?php echo e($lang->code); ?>" role="tab" aria-controls="<?php echo e($lang->code); ?>" aria-selected="true"><?php echo e($lang->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <?php $__currentLoopData = \App\Models\Language::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tab-pane <?php echo e($index == 0 ?'active':''); ?>" id="<?php echo e($lang->code); ?>" role="tabpanel" aria-labelledby="<?php echo e($lang->code); ?>">
                                            <div class="form-group">
                                                <label><?php echo e(_i('name')); ?></label>
                                                <input type="text" name="<?php echo e($lang->code); ?>_name" class="form-control" data-parsley-required="true">
                                            </div>
                                        </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="add"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_('edit')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-danger" style="display:none" id="masages_model"></div>
                <div class="modal-body" id="editmodel">
                    <form action="<?php echo e(route('edit-membership')); ?>"  method="post" id="formedit" data-parsley-validate="">
                        <?php echo csrf_field(); ?>
                        <?php echo e(method_field('put')); ?>

                        <input type="hidden" name="id" id="member_id" value="" class="form-control">

                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <?php $__currentLoopData = \App\Models\Language::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>" data-toggle="pill" href="#<?php echo e($lang->code); ?>_edit" role="tab" aria-selected="true"><?php echo e($lang->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <?php $__currentLoopData = \App\Models\Language::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane <?php echo e($index == 0 ?'active':''); ?>" id="<?php echo e($lang->code); ?>_edit" role="tabpanel">
                                                <div class="form-group">
                                                    <label><?php echo e(_i('name')); ?></label>
                                                    <input type="text" name="<?php echo e($lang->code); ?>_name" id="lang_<?php echo e($lang->id); ?>" class="form-control <?php echo e($lang->code); ?>-name" data-parsley-required="true">
                                                    <input type="hidden" name="lang_id[]" id="lang_id_<?php echo e($lang->id); ?>" class="form-control <?php echo e($lang->code); ?>-name" data-parsley-required="true">
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="editform"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            var table = $('.dataTable').DataTable();
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });

            $('body').on('submit','#addForm',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(route('memberships.store')); ?>',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        if (response.errors){
                            $('#masages_model1').empty();
                            $.each(response.errors, function( index, value ) {
                                $('#masages_model1').show();
                                $('#masages_model1').append(value + "<br>");
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
                            table.ajax.reload();
                            $('#masages_model1').hide();
                            $modal = $('#create');
                            $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

            $('body').on('click','.edit',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#member_id').val(id);
                    // alert(id);
                $.ajax({
                    url: "<?php echo e(url('admin/memberships/')); ?>"+'/'+id+'/edit',
                    method: "get",
                    data: id,
                    success: function (response) {
                        $.each( response.data, function( key, value ) {
                         $('#lang_'+key).val(value);
                         $('#lang_id_'+key).val(key);
                        });

                    }

                });

                    var name = $(this).data('name');
                    var cost = $(this).data('cost');
                    var years = $(this).data('years');
                    var lang = $(this).data('lang');
                    //
                    // $('#editmodel').empty();
                    // $('#editmodel').append(html);
                    // $('#lang_ax').val(lang).change();

                    // $('.name').val(name);

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })

            $('body').on('submit','#formedit',function (e) {
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
                            table.ajax.reload();
                            $('#masages_model').hide();
                            // $modal = $('#create');
                            // $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

            $('body').on('submit','#delform',function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                // alert(url);

                $.ajax({
                    url: url,
                    method: "delete",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                    success: function (response) {

                        table.ajax.reload();
                        if (response[0] === 'SUCCESS'){
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('Successfly')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                            // table.ajax.reload();
                        }
                        // console.log(response);
                        // window.location.reload();
                    }
                });
            })

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/memberShip/index.blade.php ENDPATH**/ ?>