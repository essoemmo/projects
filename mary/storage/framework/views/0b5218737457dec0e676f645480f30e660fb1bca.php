
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <a href="<?php echo e(route('Stories.create')); ?>" class="btn btn-primary" ><i class="fa fa-plus"></i><?php echo e(_i('create new Stories')); ?></a>
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
    



























































    
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('edit')); ?></h5>
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
    
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('show')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewmodel">

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


            //Edit model
            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var published = $(this).data('publish') === true? 'checked' : '';
                var content = $(this).data('content');
                var user = $(this).data('user');
                var lang = $(this).data('lang');




                var html = `<form action="<?php echo e(url('admin/Stories/update')); ?>"  method="post" id="formedit">
                    <?php echo csrf_field(); ?>
                        <?php echo e(method_field('put')); ?>

                    <input type="hidden" name="id" value="${id}" class="form-control">
                         <div class="form-group">
                            <label><?php echo e(_i('language')); ?></label>
                            <select name="language" id="lang_ax" class="form-control">
                                <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($key); ?>" ><?php echo e($lang); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                         <div class="form-group">
                            <label><?php echo e(_i('users')); ?></label>
                            <select name="user_id" id="user_ax" class="form-control">

                                <?php $__currentLoopData = \App\Models\User::where('guard','!=','admin')->pluck('username','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($val); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                  <div class="form-group">
                    <label><?php echo e(_i('title')); ?></label>
                  <input type="text" name="title" class="form-control" value="${title}">
                        </div>

             <div class="form-group">
                            <label><?php echo e(_i('content')); ?></label>
                      <textarea name="conteent" class="form-control ckeditor">${content}</textarea>

                        </div>


                        <div class="form-group">
                            <label><?php echo e(_i('published')); ?></label>
                            <input type="checkbox" name="publish" class="form-control" ${published}>

                        </div>
                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang).change();
                $('#user_ax').val(user).change();

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            });


            // view model
            $('body').on('click','.view',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var published = $(this).data('publish') === true ? 'published' : 'unpublished';
                var content = $(this).data('content');
                var user = $(this).data('user');
                var lang = $(this).data('lang');
                var create = $(this).data('create');




                var html = `
      <div class="card-body header">

                          <div class="pull-left" style="float: left;">
<h3 style="float: left">View Store : ${title}</h3>

                              <h5>${title}</h5>
                              <span>${create}</span>
                              <h4>${user}</h4>
                          </div>
                        <span class=>${published}</span>
                    </div>
                    <div class="content">
                        <textarea class="form-control">${content}</textarea>
                    </div>`;

                $('#viewmodel').empty();
                $('#viewmodel').append(html);
            });

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/stories/index.blade.php ENDPATH**/ ?>