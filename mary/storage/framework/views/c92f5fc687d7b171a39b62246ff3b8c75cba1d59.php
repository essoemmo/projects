<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    <?php echo $__env->make('admin.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.box-header -->


        <div class="card-body table-responsive">
            <a href="<?php echo e(route('sms.create')); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i><?php echo e(_i('create sms')); ?></a>
            <table id="sms_data" class="table table-bordered table-hover dataTable text-center" >
            </table>
        </div>
        <!-- /.box-body -->
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

            var table = $('#sms_data').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('sms.index')); ?>",
                    type: 'GET',
                },
                // select: true,
                columns: [
                    {data: 'id', name: 'id' ,title:'id'},
                    {data: 'message', name: 'message' ,title:'message'},
                    {data: 'status', name: 'status' ,title:'status'},
                    {data: 'action', name: 'action',title:'action' ,searchable: 'false'}
                ]
            });


            $('body').on('click','.delete',function (e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "<?php echo e(_i('Are you sure ?')); ?>",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("<?php echo e(_i('yes')); ?>", 'btn btn-success mr-2', function () {
                            that.closest('form').submit();
                        }),

                        Noty.button("<?php echo e(_i('no')); ?>", 'btn btn-primary mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            });//end of delete

            $('body').on('submit','.delform',function (e) {
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
                        if (response['0'] == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('deleted is Successfly')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();
                        }


                    },

                });

            })

            $('body').on('click','.change',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: '<?php echo e(route('change-status')); ?>',
                    method: "put",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                       },
                    success: function (response) {
                       // console.log(response);
                        if (response['0'] == 'SUCCESS'){

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('changed is Successfly')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();

                        }
                    }
                });

            })
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/setting/sms/index.blade.php ENDPATH**/ ?>