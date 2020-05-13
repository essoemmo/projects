<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .account_setting {
            width: 100%;
            background: #ddd;
            text-align: left;
        }
        .account_setting p {
            font-size: 30px;
            font-style: oblique;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e($title); ?></h3>
        </div>
    
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <button class="btn btn-primary create" data-toggle="modal" data-target="#create" id="opt"><i class="fa fa-plus"></i><?php echo e(_i('create_options')); ?></button>
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
                    <form action="<?php echo e(route('store-Option')); ?>" method="post" id="addForm">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('post')); ?>


                        <div class="form-group">
                            <label><?php echo e((_i('language'))); ?></label>
                            <select name="language" class="form-control" id="lang">

                                <?php $__currentLoopData = \App\Models\Language::pluck('name','id')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($lang); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label><?php echo e((_i('group'))); ?></label>
                            <select name="group" class="form-control group" id="group">

                                
                                
                                
                            </select>

                        </div>

                        <div class="form-group">
                            <label><?php echo e(_i('title')); ?></label>
                            <input type="text" name="title" class="form-control" value="">
                            

                            
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="required" class="form-control" value="bool"><?php echo e(_i('Required')); ?>

                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        <div class="account_setting">
                            <p><?php echo e(_i('options')); ?></p>
                        </div>
                        <button class="btn btn-success btn-sm" id="addinput"><i class="fa fa-plus"></i></button>
                        <div class="groupOption">
                            <div class="form-group">
                                <label><?php echo e((_i('option'))); ?></label>
                                <input type="text" name="option[]" class="form-control ">
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
        var group;
        $(document).ready(function () {
            $('body').on('change','#lang',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('getlang')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#group').empty();
                        for (var i=0 ; i<= response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#group').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');
                        }
                    }
                });

            });

            $('body').on('click','#opt',function () {
                $('#lang').trigger('change');
            });

            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();


                var id = $(this).data('id');
                var name = $(this).data('name');
                var lang = $(this).data('lang');
                group = $(this).data('group');

                var reuired = $(this).data('reuired') != null ? 'checked' : '' ;
                var option = $(this).data('option');

                var reuired = $(this).data('reuired') == 'bool' ? 'checked' : '' ;
                var optionValue = $(this).data('value');

                $.ajax({
                    url: '<?php echo e(route('edit-Option')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        for (var i=0 ; i< response.data.length ; i++){
                            $('.optionVal').append(
                                '<div class="form-group newoption">'+
                                '<span class="close del" data-id="'+response.data[i].id+'">x</span>'+
                                '<input type="text" name="option['+response.data[i].id+']" class="form-control newoption" value="'+response.data[i].title+'">'+
                                '</div>')
                        }

                    }
                });

                var html = `<form action="<?php echo e(route('update-Option')); ?>"  method="post" id="formedit">
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
                    <label><?php echo e((_i('group'))); ?></label>
                    <select name="group" id="group_ax" class="form-control gr">

                        
                        
                    </select>

                    </div>
                     <div class="form-group">
                            <label><?php echo e(_i('title')); ?></label>
                            <input type="text" name="title" class="form-control" value="${name}">

                    </select>
                </div>


            </div>
            <div class="form-group">
            <input type="checkbox" name="required" class="form-control" value="bool" ${reuired}><?php echo e(_i('Required')); ?>

                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="account_setting">
                    <p><?php echo e(_i('options')); ?></p>
                    </div>
                    <button class="btn btn-success btn-sm" id="addinput"><i class="fa fa-plus"></i></button>
                <div class="groupOption">
                    <div class="form-group optionVal">
                    <label><?php echo e((_i('option'))); ?></label>

                </div>
                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);

                $('#lang_ax').val(lang).change();
                $('#group_ax').val(group);

                setTimeout(function() {
                    $('.optionsnew').val(id);

                }, 1500);



            });

            $('body').on('change','#lang_ax',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('getlang')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#group_ax').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#group_ax').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');

                        }
                        console.log(group);
                        $('#group_ax').val(group);
                    }
                });
            });


            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            });

            $('body').on('click','#addinput',function (e) {
                e.preventDefault();
                $('.groupOption').append(`
                   <div class="form-group newoption">
                        <label><?php echo e((_i('option'))); ?></label><span class="close">X</span>
                        <input type="text" name="option[]" class="form-control ">
                    </div>`);
                // $('#newinput').submit();
            });

            $('body').on('click','.close',function (e) {
                e.preventDefault();
                $(this).closest('.newoption').remove();

            });

            // delete close int the option

            $('body').on('click','.del',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '<?php echo e(route('remove-from-model')); ?>',
                        method: "DELETE",
                        data: {_token: '<?php echo e(csrf_token()); ?>', id: id},
                        success: function (response) {
                            // window.location.reload();
                        }
                    });
                }
            });
            $('body').on('change','.group',function (e) {
                e.preventDefault();

                var id = $(this).val();
                $.ajax({
                    url: '<?php echo e(route('get-Option')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#options').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            $('#options').append(`<option value="${response.data[i].id}">${response.data[i].title}</option>`)
                        }
                    }
                });

            });

            $('.group').trigger('change');
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>