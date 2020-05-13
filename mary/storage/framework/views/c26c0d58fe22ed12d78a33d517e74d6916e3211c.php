
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php if(auth()->user()->can('Article-Add')): ?>
            <a href="<?php echo e(route('articles.create')); ?>" class="btn btn-primary " ><i class="fa fa-plus"></i><?php echo e(_i('create new Articles')); ?></a>
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
                'use strict';
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        var categoryId;
        $(document).ready(function () {
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var img = $(this).data('img');
                var publish = $(this).data('published') === true ? 'checked': '';
              categoryId = $(this).data('category');
                // var created = $(this).data('created')?
                var title = $(this).data('title');
                var content = $(this).data('content');
                var lang = $(this).data('lang');

                var regex = /(<([^>]+)>)/ig
                    ,   body = content
                    ,   result = body.replace(regex, "");

                // alert(created);
                var html = `<form action="<?php echo e(route('edit-articles')); ?>"  method="post" id="formedit" enctype="multipart/form-data">
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
                            <input type="text" name="title" class="form-control" value="${title}">
                        </div>

                        

                        
                        
                        
                        

                        
                        

                    <div class="form-group">
                        <label><?php echo e(_i('published')); ?></label>
                            <input type="checkbox" name="published"  ${publish}>
                        </div>

                        <div class="form-group">
                            <label><?php echo e(_i('Category')); ?></label>
                            <select class="form-control Art_Country" style="width: 100%;" name="category" id="category">



                    </select>
                </div>

                <div class="form-group">
                    <label><?php echo e(_i('Image')); ?></label>
                        <input type="file" name="image" class="form-control image">
                        </div>

                        <img src="${img}" style="width: 100%; height: 200px" class="image-preview">

                        <div class="form-group">
                            <label><?php echo e(_i('content')); ?></label>
                            <textarea  name="conteent" class="form-control ckeditor">${result}</textarea>
                        </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);


                $('.Art_Country').val(categoryId).change();
                $('#lang_ax').val(lang);
                // $('#date').val(created);
                $('#lang_ax').trigger('change');

            });
            $('body').on('change','#lang_ax',function () {

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




            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/articles/index.blade.php ENDPATH**/ ?>