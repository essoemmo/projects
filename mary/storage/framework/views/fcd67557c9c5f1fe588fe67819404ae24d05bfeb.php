<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <table id="block_data" class="table table-bordered table-hover dataTable text-center" >
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('add the date of expire')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('block-member-store')); ?>" method="post" id="form" data-parsley-validate="">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('post')); ?>


                    <div class="form-group row">
                        <div class="col-md-3">
                            <label><?php echo e(_i('date of expire')); ?></label>
                        </div>
                        <input type="hidden" name="user_id" value="" id="user_id">
                        <div class="col-md-9">
                            <input type="date" name="date" class="form-control" data-parsley-required="true"/>
                        </div>

                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                    <button type="button" class="btn btn-primary" id="submitdata"><?php echo e(_i('save')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(_i('date of expire')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                        <div class="form-group row">
                            <div class="col-md-3">
                                <label><?php echo e(_i('date of expire')); ?></label>
                            </div>
                            <input type="hidden" name="user_id" value="" id="user_id">
                            <div class="col-md-9">
                                <input type="date" id="dataId" class="form-control">
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(_i('close')); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript">
        // $('.datepicker').datepicker();
        // var allEditors = document.querySelectorAll('.ckeditor');
        //
        // for (var i = 0; i < allEditors.length; ++i) {
        //     ClassicEditor.create(allEditors[i]);
        // }
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#block_data').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('block-member')); ?>",
                    type: 'GET',
                },
                // select: true,
                columns: [
                    {data: 'id', name: 'id' ,title:'id'},
                    {data: 'username', name: 'username',title:'username'},
                    {data: 'status', name: 'status',title:'status'},
                    {data: 'action', name: 'action',title:'action' ,searchable: 'false'}
                ]
            });

            $('body').on('click','.add-data',function (e) {
                // e.preventDefault();

                var id = $(this).data('id');
                $('#user_id').val(id);
                });


            $('body').on('click','#submitdata',function (e) {
                e.preventDefault();
                $('#form').submit();
            });

            $('body').on('click','.show',function (e) {
                // e.preventDefault();

                var id = $(this).data('id');
                $.ajax({
                    type:'get',
                    url:"<?php echo e(route('get-date')); ?>",
                    data:{
                        id:id
                    },
                    success:function(response) {
                        $('#dataId').val(response);
                    }
                });
            });

        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/blockUser/index.blade.php ENDPATH**/ ?>