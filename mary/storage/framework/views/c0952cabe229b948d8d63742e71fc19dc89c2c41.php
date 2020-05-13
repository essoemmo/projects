<?php $__env->startSection('title'); ?>
    <?php echo e(_i('All Roles')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header_name'); ?>
    <?php echo e(_i('All Roles')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_url'); ?>
    <li><a href="<?php echo e(url('/admin')); ?>" class="btn btn-default"><i class="fa fa-dashboard"></i> <?php echo e(_i('Home')); ?></a></li>
    <li><a href="<?php echo e(url('/admin/role/all')); ?>" class="btn btn-success"><?php echo e(_i('All')); ?></a></li>
    <li class="active"><a href="<?php echo e(url('/admin/role/add')); ?>" class="btn btn-primary"><?php echo e(_i('Add')); ?></a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="box box-info">

        <div class="box-header">

            
        </div>
        <!-- /.box-header -->
        <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <table id="role_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting"  > <?php echo e(_i('ID')); ?></th>
                                <th class="sorting_desc" > <?php echo e(_i('Role Name')); ?></th>
                                <th class="sorting" > <?php echo e(_i('Created At')); ?></th>
                                <th class="sorting" > <?php echo e(_i('Updated At')); ?></th>
                                <th class="sorting" > <?php echo e(_i('Controll')); ?></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>


        </div>
        <!-- /.box-body -->
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script  type="text/javascript">

        $(function() {
            $('#role_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(url('/admin/role/get_datatable')); ?>',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/security/role/allRoles.blade.php ENDPATH**/ ?>