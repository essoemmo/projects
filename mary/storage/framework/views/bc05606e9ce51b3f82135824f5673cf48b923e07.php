


<?php $__env->startSection('content'); ?>

    <?php if(auth()->user()->can('slider-add')): ?>
        <button class="btn btn-info btn-sm pull-left" id="add-slider" data-toggle="modal" data-target="#exampleModal"><?php echo e(_i('add slider')); ?></button>

    <?php endif; ?>

    <div class="table-responsive" id="SliderTable">
        <table class="table table-bordered table-striped dataTable text-center" id="slider_table">

        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('add-Slider')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('slider-store')); ?>" method="post" id="form" enctype="multipart/form-data">
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

                        <div class="from-group">
                            <label><?php echo e(_i('title')); ?></label>
                            <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>">
                        </div>


                        <div class="from-group">
                            <label><?php echo e(_i('Descrption')); ?></label>
                            <textarea type="text" name="desc" class="form-control"><?php echo e(old('desc')); ?></textarea>
                        </div>

                        <div class="from-group">
                            <label><?php echo e(_i('Image')); ?></label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="from-group">
                            <img src="" class="image-preview" style="width: 300px">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="submit"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('edit-Slider')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edited">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="submitedit"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function () {
            $('#slider_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(url('admin/slider/get_datatable')); ?>',
                columns: [
                    {data: 'title', title: '<?php echo e(_i('title')); ?>'},
                    {data: 'image', title: '<?php echo e(_i('image')); ?>'},
                    // {data: 'created_at', title: 'created_at'},
                    {data: 'action', title: 'edit', orderable: true, searchable: true},
                    {data: 'delete', title: 'delete', orderable: true, searchable: true}

                ]
            });
            $('body').on('click','#submit',function () {
                $('#form').submit();
            });

            $('body').on('click','#edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var desc = $(this).data('desc');
                var image = $(this).data('image');
                var lang = $(this).data('lang');


                var html = `<form action="<?php echo e(route('slider-update')); ?>" method="post" id="formEdit" enctype="multipart/form-data">
                       <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('put')); ?>

                    <input type="hidden" name="id" value=${id}>
                         <div class="form-group">
                            <label><?php echo e(_i('language')); ?></label>
                            <select name="language" class="form-control" id="lang_ax">

                                <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>
               <div class="from-group">
                   <label><?php echo e(_i('title')); ?></label>
                           <input type="text" name="title" class="form-control" value="${title}">
                       </div>


                       <div class="from-group">
                           <label><?php echo e(_i('Descrption')); ?></label>
                           <textarea type="text" name="desc" class="form-control">${desc}</textarea>
                       </div>

                       <div class="from-group">
                           <label><?php echo e(_i('Image')); ?></label>
                           <input type="file" name="image" class="form-control image">
                       </div>
                       <div class="from-group">
                           <img src="${image}" class="image-preview" style="width: 300px">
                       </div>

                   </form>`;
                $('#edited').empty();

                $('#edited').append(html);
                $('#lang_ax').val(lang);

            })

            $('body').on('click','#submitedit',function () {
                $('#formEdit').submit();
            });

        })
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/setting/slider/index.blade.php ENDPATH**/ ?>