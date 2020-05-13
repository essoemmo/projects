<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Register')); ?></li>
            </ol>
        </div>
    </nav>

    <section class="register-form common-wrapper ">
                    <?php if($errors->all()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>


        <form  action="<?php echo e(route('store-member')); ?>" method="post" data-parsley-validate="" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="container">

            <div class="row" id="first">
                <section class="register-form common-wrapper ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="sign-up-note center">
                                    <div>

                                        <?php echo settings()->register_msg; ?>

                                    </div>


                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"> <?php echo e(_i('I have taken the oath, and I will stick to it')); ?></label>
                                        </div>

                                        <div class="img-radio-btns">
                                            <label><?php echo e(_i('Department')); ?></label>
                                            <select class="form-control select2" style="width: 100%;" name="category">
                                                <?php $__currentLoopData = \App\Models\Category::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>


                                            <input id="female" type="radio" class="gender" name="gendar" value="female" />
                                            <label for="female" class="female-icon-img"><?php echo e(_i('female')); ?></label>

                                            <input id="male" type="radio" class="gender" name="gendar" value="male" />
                                            <label for="male" class="male-icon-img"><?php echo e(_i('male')); ?></label>

                                            <div class="text-center my-4">
                                                <button type="submit"  class="btn btn-pink" id="clicknext"><?php echo e(_i('Register now')); ?></button>
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </section>


                <br><br><br>





















            </div>
            </div>



            <div id="finish" style="display: none">
            <div class="fields-wrapper  py-4">
                <div class="container">
                    <p class="font-weight-bold text-center mb-5"><?php echo e(_i('In the name of God I trusted in God God bless me good wife')); ?> </p>

                    <div class="row">
                        <div class="col-md-8 ">

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label"><?php echo e(_i('memberShip')); ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" name="memberShip">
                                        <option value=""><?php echo e(_i(' All member ship')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Membership::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($member->id); ?>"><?php echo e($member->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label"><?php echo e(_i('username')); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" value="<?php echo e(old('username')); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label"><?php echo e(_i('password')); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repassword" class="col-sm-3 col-form-label"><?php echo e(_i('password_confirmation')); ?></label>
                                <div class="col-sm-9">
                         <input type="password" id="password_con" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label"><?php echo e(_i('email')); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 align-content-md-stretch d-flex ">
                            <div class="notice-box ">
                                <div class="notice-title"><?php echo e(_i('username')); ?></div>
                                <p>
                                   <?php echo e(_i('The nickname that appears to all members must be decent and respectable must not exceed 15 characters')); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fields-wrapper bg-light-pink  py-4">
                <div class="container">

                    <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-label"><?php echo e(_i('country')); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control country" name="country" style="width: 100%;">
                                <?php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); ?>
                                <?php $__currentLoopData = $nationName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namenat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($namenat->id); ?>"><?php echo e($namenat->county_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label"><?php echo e(_i('city')); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control city" name="city" style="width: 100%;">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label"><?php echo e(_i('Address')); ?></label>
                        <div class="col-sm-10">

                            <textarea type="text" name="address" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fields-wrapper  py-4">
                <div class="container">


                    <div class="form-group row">
                        <label for="marriage-type" class="col-sm-2 col-form-label"><?php echo e(_i('nationalty')); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                                <?php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); ?>
                                <?php $__currentLoopData = $nationName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namenat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($namenat->nationalty_id); ?>"><?php echo e($namenat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><?php echo e(_i('material_status')); ?></label>
                        <div class="col-sm-10">
                            <select class="form-control status" style="width: 100%;" name="material_status_id">
                                <?php $__currentLoopData = \App\Models\Material_status::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matiral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($matiral->id); ?>"><?php echo e($matiral->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>                        </div>
                    </div>








                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><?php echo e(_i('age')); ?></label>
                        <div class="col-sm-10">
                   <input type="text" name="age" class="form-control" data-parsley-type="number" data-parsley-maxlength="10">
                        </div>
                    </div>

                </div>
            </div>


            <div class="fields-wrapper bg-light-pink  py-4">
                <div class="container">
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
                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
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
                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php else: ?>

                                                <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->source_id)->where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>

                                        </select>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <?php endif; ?>

                        </div>



                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>

            <div class="fields-wrapper py-4">
                <div class="container">

                    <p> <?php echo e(_i('about the partener')); ?></p>
                 <textarea type="text" name="partener" class="form-control" rows="10"></textarea>
                    <p class="text-muted text-left my-2 small"><?php echo e(_i('(Please write in a serious manner and it is forbidden to write email or mobile number in this place)')); ?></p>
                </div>
            </div>

            <div class="fields-wrapper bg-light-pink py-4">
                <div class="container">

                    <p><?php echo e(_i('about_me')); ?></p>
                 <textarea type="text" name="about_me" class="form-control" rows="10"></textarea>
                    <p class="text-muted text-left my-2 small"><?php echo e(_i('(Please write in a serious manner and it is forbidden to write email or mobile number in this place)')); ?></p>
                </div>
            </div>

            <div class="fields-wrapper  py-4">
                <div class="container">

                    <div class="pink-box text-center">
                        <h4><?php echo e(_i('Very confidential information')); ?></h4>
                        <p><?php echo e(_i('Full name and mobile number: Management information that will never appear to anyone')); ?> .</p>
                        <p><?php echo e(_i('Writing this information correctly is a confirmation of your seriousness in marriage')); ?>.</p>
                        <p><?php echo e(_i('By entering your mobile number, you will be able to use the Jawwal Jawal under construction service that allows you to receive and send mobile messages')); ?> </p>

                        <div class="row">
                            <div class="col-md-4 offset-md-2">
                            <input type="text" name="fullname" class="form-control" placeholder="<?php echo e(_i('fullname')); ?>">

                            </div>
                            <div class="col-md-4">
                                <input type="text" name="mobile" class="form-control" placeholder="<?php echo e(_i('mobile')); ?>">

                            </div>
                        </div>
                    </div>








                    <div class="custom-control custom-checkbox">

                        <label class="" for="customCheck1"><input type="checkbox" class="custom-control" id="customCheck1" required> <?php echo e(_i('I have taken the oath and I will stick to it')); ?></label>
                    </div>


                    <div class="text-center">
                        <input type="submit" value="<?php echo e(_i('save')); ?>" class="btn btn-pink mt-4 ">
                    </div>
                </div>
            </div>
            </div>


        </form>

    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script>
        $(document).ready(function () {

            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('get_City')); ?>',
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
                        console.log(response);
                        for (var i = 0; i <= response.data.length; i++){
                            $('.city').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');
                        }
                    }

                });

            });


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

            $('body').on('click','#clicknext',function (e) {
                    e.preventDefault();
                var gender = $('#first input[type=radio]:checked').val();
                var checked = $('#first input[type=checkbox]:checked').val();

                if (checked != null && gender != null ){
                    $('#first').hide(500);
                    $('#finish').show(500);
                }else{
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "<?php echo e(_i('You must determine your commitment to the department and determine your nationality')); ?>",
                        timeout: 2000,
                        killer: true
                    }).show();
                }


            });



        });
</script>

    <?php $__env->stopPush(); ?>

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/web/user/register.blade.php ENDPATH**/ ?>