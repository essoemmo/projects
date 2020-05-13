
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
                    <form action="<?php echo e(route('memberships.store')); ?>" method="post" id="addForm">
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
                            <label><?php echo e(_i('title')); ?></label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label><?php echo e(_i('cost')); ?></label>
                            <input type="number" name="cost" class="form-control">
                        </div>

                        <div class="form-group">
                            <label><?php echo e(_i('Duration')); ?></label>
                            <input type="number" name="years" class="form-control"><?php echo e(_i('years')); ?>

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
                <div class="modal-body" id="editmodel">
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
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');
                var cost = $(this).data('cost');
                var years = $(this).data('years');
                var lang = $(this).data('lang');

                var html = `<form action="<?php echo e(route('edit-membership')); ?>"  method="post" id="formedit">
                    <?php echo csrf_field(); ?>
                        <?php echo e(method_field('put')); ?>

                    <input type="hidden" name="id" value="${id}" class="form-control">
                         <div class="form-group">
                            <label><?php echo e(_i('language')); ?></label>
                            <select name="language" id="lang_ax" class="form-control">
                                <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                      <div class="form-group">
                            <label><?php echo e(_i('title')); ?></label>
                          <input type="text" name="title" class="form-control" value="${name}">
                        </div>
                          <div class="form-group">
                            <label><?php echo e(_i('cost')); ?></label>
                          <input type="number" name="cost" class="form-control" value="${cost}">
                        </div>
                          <div class="form-group">
                            <label><?php echo e(_i('Duration')); ?></label>
                          <input type="number" name="years" class="form-control" value="${years}">
                        </div>
                </div>

                </form>`;
                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang).change();


            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/memberShip/index.blade.php ENDPATH**/ ?>