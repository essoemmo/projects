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
    <?php
    $membership = \Illuminate\Support\Facades\DB::table('user_membership')
        ->where('user_id',$user->id)
        ->value('membership_id');

    $department = \Illuminate\Support\Facades\DB::table('user_category')
        ->where('user_id',$user->id)
        ->value('category_id');

    $optionValue = \Illuminate\Support\Facades\DB::table('user_options')
        ->where('user_id',$user->id)
        ->pluck('option_value_id')->toArray();
    ?>
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(_i('edit member')); ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <form method="post" action="<?php echo e(route('members.update',$user->id)); ?>" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('member ship')); ?></label>
                                    <select class="form-control select2" style="width: 100%;" name="memberShip">
                                        <option value=""><?php echo e(_i('All member ship')); ?></option>

                                        <?php $__currentLoopData = \App\Models\Membership::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($member->id); ?>" <?php echo e($membership == $member->id ? 'selected' :''); ?>><?php echo e($member->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label><?php echo e(_i('Department')); ?></label>
                                    <select class="form-control select2" style="width: 100%;" name="category">
                                        <option value=" "><?php echo e(_i('All Category')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Category::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php echo e($department == $category->id ? 'selected' :''); ?>><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group" style="display: inline-flex;position: relative; right: 487px;">
                                    <div class="male"  style="    position: relative;left: 80px;}">
                                        <input type="radio" class="gender" name="gendar" value="male" <?php echo e($user->gender == 'male' ? 'checked':''); ?>><label><?php echo e(_i('male')); ?></label>
                                    </div>
                                    <div class="female" style="    position: relative; right: 80px;}" >
                                        <input type="radio"  class="gender" name="gendar" value="female" <?php echo e($user->gender == 'female' ? 'checked':''); ?>><label><?php echo e(_i('female')); ?></label>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('material_status')); ?></label>
                                    <select class="form-control status" style="width: 100%;" name="material_status_id">
                                        <?php if($user->gender == 'male'): ?>
                                            <?php $__currentLoopData = \App\Models\Material_status::whereIN('id',[5,6,7,8])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matiral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($matiral->id); ?>" <?php echo e($user->material_status_id == $matiral->id ? 'selected': ''); ?> ><?php echo e($matiral->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php else: ?>
                                            <?php $__currentLoopData = \App\Models\Material_status::whereIN('id',[1,3,4])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matiral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($matiral->id); ?>" <?php echo e($user->material_status_id == $matiral->id ? 'selected': ''); ?> ><?php echo e($matiral->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="photo">
                                            <?php echo e(_i('photo')); ?> <span style="color: #F00;">*</span>
                                        </label>
                                        <input type="file" name="photo" class="form-control image">
                                        <?php if($errors->has('photo')): ?>
                                            <span class="text-danger invalid-feedback">
                                        <strong><?php echo e($errors->first('photo')); ?></strong>
                                     </span>
                                        <?php endif; ?>

                                        <img src="<?php echo e(asset('uploads/users/'.$user->photo)); ?>" style="width: 200px" class="image-preview">
                                    </div>
                                    <div class="col-sm-6">
                                        <label><?php echo e(_i('Age')); ?></label>
                                        <input type="text" name="age" class="form-control" value="<?php echo e($user->age); ?>">
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                <hr>
                                <div class="account_setting">
                                    <p><?php echo e(_i('account_setting')); ?></p>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('User name')); ?></label>
                                    <input type="text" name="username" class="form-control" value="<?php echo e($user->username); ?>">
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('email')); ?></label>
                                    <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>">
                                </div>












                                

                                <div class="clearfix"></div>
                                <hr>
                                <div class="account_setting">
                                    <p><?php echo e(_i('Address')); ?></p>
                                </div>


                                <div class="form-group">
                                    <label><?php echo e(_i('nationalty')); ?></label>
                                    <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                                        <?php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); ?>
                                        <?php $__currentLoopData = $nationName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namenat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($namenat->nationalty_id); ?>" <?php echo e($user->nationalty_id == $namenat->nationalty_id ? 'selected':''); ?>><?php echo e($namenat->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('Country')); ?></label>
                                    <select class="form-control country" name="country" style="width: 100%;">
                                        <?php $__currentLoopData = $nationName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namenat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($namenat->id); ?>" <?php echo e($namenat->id == $user->resident_country_id ?'selected'  : ''); ?>><?php echo e($namenat->county_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('City')); ?></label>
                                    <select class="form-control city" id="city" name="city" data-id="<?php echo e($user->city_id); ?>" style="width: 100%;">
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('Address')); ?></label>
                                    <textarea type="text" name="address" class="form-control"><?php echo e($user->address); ?></textarea>
                                </div>

                                <div class="clearfix"></div>
                                <hr>

                                <?php

                                    $group = \App\Models\Option_group::where('lang_id',session('language'))->get();
                                ?>
                                
                                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="account_setting">
                                        <p><?php echo e(_i($gro->title)); ?></p>
                                    </div>
                                    <div class="row">
                                        <?php if($gro->source_id == null): ?>
                                            <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <div class="col-md-6">
                                                    <label><?php echo e(_i($option->title)); ?></label>
                                                    <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                                        <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>" <?php echo e(in_array($val->id,$optionValue) ? 'selected' : ''); ?>><?php echo e($val->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php else: ?>

                                            <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6">
                                                    <label><?php echo e(_i($option->title)); ?></label>
                                                    <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                                        <?php if($option->source_id == null): ?>

                                                            <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>" <?php echo e(in_array($val->id,$optionValue) ? 'selected' : ''); ?>><?php echo e($val->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php else: ?>

                                                            <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($val->id); ?>" <?php echo e(in_array($val->id,$optionValue) ? 'selected' : ''); ?>><?php echo e($val->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        <?php endif; ?>

                                                    </select>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php endif; ?>

                                    </div>



                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                <div class="form-group">
                                    <label><?php echo e(_i('About the partener')); ?></label>
                                    <textarea type="text" name="partener" class="form-control ckeditor"><?php echo $user->partener_info; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(_i('About me')); ?></label>
                                    <textarea type="text" name="about_me" class="form-control ckeditor"><?php echo $user->about_me; ?></textarea>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-sm"><?php echo e((_i('edit Member'))); ?></button>
                                </div>
                            </form>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {



            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('getCity')); ?>',
                    method: "get",
                    
                    data: { id: id},
                    success: function (response) {
                        if (response.status){
                            $('.city').empty();
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "<?php echo e(_i('Sorry not found city to this country')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }

                        $('.city').empty();

                        for (var i = 0; i <= response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                            $('.city').val(<?php echo e($user->city_id); ?>);

                        }

                    }
                });

            });

            $('.country').trigger('change');

            // $('.gender').trigger('click');


            $('body').on('click','input[type=radio]',function (e) {
                // e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '<?php echo e(route('statue-user')); ?>',
                    method: "get",
                    
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        console.log(response.data);
                        $('.status').empty();
                        for (var i = 0; i <= response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });

            });



        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>