<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">


            <?php echo $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true); ?>

        </div>
        <!-- /.box-body -->
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>

        <?php echo $dataTable->scripts(); ?>>
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
                var name = $(this).data('name');
                var cost = $(this).data('cost');
                var years = $(this).data('years');
                var lang = $(this).data('lang');

                var html = `

                <form action="<?php echo e(route('edit-membership')); ?>"  method="post" id="formedit" data-parsley-validate="">
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
                          <input type="text" name="name" class="form-control" value="${name}" data-parsley-required="true">
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

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/memberShip/details/index.blade.php ENDPATH**/ ?>