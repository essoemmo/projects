<?php $__env->startSection('title', 'All Permission'); ?>

<?php $__env->startSection('page_header_name' , 'All Permissions'); ?>









<?php $__env->startSection('content'); ?>
    <div class="box box-info">

        <div class="box-header">
            
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo e(url('admin/permission/add')); ?>" data-toggle="modal" data-target="#create" class="btn btn-primary create add-permission"><i class="fa fa-plus"></i><?php echo e(_i('add')); ?></a>
                </div>
            </div>
                <div class="row">
                <div class="col-sm-12">
                    <table id="permission_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th  > <?php echo e(_i('ID')); ?></th>
                            <th  > <?php echo e(_i('Permission Name')); ?></th>
                            <th  > <?php echo e(_i('created_at')); ?></th>
                            <th  > <?php echo e(_i('updated_at')); ?></th>
                            <th  > <?php echo e(_i('Controll')); ?></th>
                        </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="<?php echo e(url('/admin/permission/add')); ?>" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                        <?php echo csrf_field(); ?>
                        <div class="form-group row">

                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <label for="" class="col-md-12 col-form-label"> <?php echo e(_i('Permission Name')); ?> </label>

                                <div class="col-md-12">
                                    <input type="text"  placeholder="Permission Name" name="name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" required="" >
                                    <?php if($errors->has('name')): ?>
                                        <span class="text-danger invalid-feedback" >
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                 </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!------ guard name ---------------->
                            
                            

                            
                            
                            
                            
                            
                            
                            
                            
                            


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="submit" class="btn btn-info" >
                                <?php echo e(_i('Add')); ?>

                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editmodel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editform">Save</button>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer'); ?>
    <script  type="text/javascript">

        $(function() {
            $('#permission_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(url('/admin/permission/get_datatable')); ?>',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: true, searchable: true}

                ]
            });
        });

        $(document).ready(function () {

            $('body').on('click','.add-permission',function (e) {
                e.preventDefault();
            });


            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');


                var html = `<form  action="<?php echo e(url('admin/permission/update')); ?>" method="post" class="form-horizontal"  id="formedit" data-parsley-validate="">

            <?php echo csrf_field(); ?>
                    <?php echo e(method_field('put')); ?>

                    <input type='hidden' name='id' value=${id}>
                    <div class="box-body">
                        <div class="form-group row">
                            <label for="" class="col-md-12 col-form-label text-md-right "> <?php echo e(_i('Permission Name')); ?> </label>

                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" value="${name}"  placeholder="Permission Name" required="" >
                        <?php if($errors->has('name')): ?>
                    <span class="text-danger invalid-feedback" >
                            <strong><?php echo e($errors->first('name')); ?></strong>
                                 </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

                    </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);


            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })

        });



    </script>


<?php $__env->stopSection(); ?>


























<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/security/permission/allPermissions.blade.php ENDPATH**/ ?>