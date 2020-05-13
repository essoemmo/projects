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
<form method="post" action="<?php echo e(route('users-update',$user->id)); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('put')); ?>

        <div class="fields-wrapper  py-4">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 ">

                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label"><?php echo e(_i('member ship')); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" name="memberShip">
                                    <option value=""><?php echo e(_i('All member ship')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Membership::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($member->id); ?>" <?php echo e($membership == $member->id ? 'selected' :''); ?>><?php echo e($member->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label"><?php echo e(_i('user name')); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo e($user->username); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"><?php echo e(_i('password')); ?></label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control " id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label"><?php echo e(_i('password_confirmation')); ?></label>
                            <div class="col-sm-9">
                                <input type="password"  name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo e(_i('email')); ?></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control " name="email" id="email" value="<?php echo e($user->email); ?>">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 align-content-md-stretch d-flex ">
                        <div class="notice-box ">
                            <p>تاريخ التسجيل
                                <?php echo e($user->created_at->diffForHumans()); ?></p>
                            <div class="notice-title"><a href="#" id="editPassword" data-id="<?php echo e($user->id); ?>">تعديل كلمة المرور</a></div>
                            <div class="notice-title"><a href="#" id="editemail" data-id="<?php echo e($user->id); ?>">تعديل الإيميل</a></div>
                            <div class="notice-title"><a href="" id="deleteMember" data-id="<?php echo e($user->id); ?>">حذف العضويه</a></div>
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
                                <option value="<?php echo e($namenat->id); ?>" <?php echo e($user->resident_country_id == $namenat->id ? 'selected' : ''); ?>><?php echo e($namenat->county_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label"><?php echo e(_i('city')); ?></label>
                    <div class="col-sm-10">
                        <select class="form-control city" id="city" name="city" data-id="<?php echo e($user->city_id); ?>" style="width: 100%;">


                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Address" class="col-sm-2 col-form-label"><?php echo e(_i('Address')); ?></label>
                    <div class="col-sm-10">
                        <textarea type="text" name="address" class="form-control">
                            <?php echo $user->address; ?>

                        </textarea>
                    </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="fields-wrapper  py-4">
            <div class="container">


                <div class="form-group row">
                    <label for="nationality" class="col-sm-2 col-form-label"><?php echo e(_i('nationalty')); ?></label>
                    <div class="col-sm-10">
                        <select class="form-control nationalty" name="nationalty" style="width: 100%;">

                            <?php    $nationName = \Illuminate\Support\Facades\DB::table('nationalies_data')->get(); ?>
                            <?php $__currentLoopData = $nationName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namenat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($namenat->nationalty_id); ?>" <?php echo e($user->nationalty_id == $namenat->nationalty_id ? 'selected':''); ?>><?php echo e($namenat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"><?php echo e(_i('material_status')); ?></label>
                    <div class="col-sm-10">
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

                        </select>                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"><?php echo e(_i('age')); ?></label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control " id="" name="age" value="<?php echo e($user->age); ?>">
                    </div>
                </div>

            </div>
        </div>

    <div class="fields-wrapper  py-4">
        <div class="container">
            <?php
                $group = \App\Models\Option_group::get();
            ?>
            <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="account_setting">
                    <p><?php echo e(_i($gro->title)); ?></p>
                </div>

                <div class="row">
                    <?php $__currentLoopData = \App\Models\Option::where('group_id',$gro->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><?php echo e(_i($option->title)); ?></label>
                                <div class="col-sm-8">

                                    <select class="form-control select2" style="width: 100%;" name="option_value[]">
                                        <?php $__currentLoopData = \App\Models\Option_value::where('option_id',$option->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val->id); ?>" <?php echo e(in_array($val->id,$optionValue) ? 'selected' : ''); ?>><?php echo e($val->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>



        <div class="fields-wrapper bg-light-pink  py-4">
            <div class="container">
             <p><?php echo e(_i('About the partener')); ?></p>
                <textarea type="text" rows="10" name="partener" class="form-control"><?php echo $user->partener_info; ?></textarea>
                <p class="text-muted text-left my-2 small">( يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم
                    الجوال في هذا المكان)</p>
            </div>
        </div>

        <div class="fields-wrapper   py-4">
            <div class="container">

                <p><?php echo e(_i('about_me')); ?></p>
                <textarea type="text" name="about_me" class="form-control" rows="10"><?php echo $user->about_me; ?></textarea>
                <p class="text-muted text-left my-2 small">( يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم
                    الجوال في هذا المكان)</p>
            </div>
        </div>

        <div class="fields-wrapper  py-4">
            <div class="container">

                <div class="pink-box text-center">
                    <h4>معلومات سريه جداً</h4>
                    <p>الاسم الكامل ورقم الجوال : معلومات خاصة بالإدارة ولن تظهر لأحد أبدا .</p>
                    <p>كتابتك لهذه المعلومات بالشكل الصحيح هو تأكيد منك على جديتك في الزواج .</p>
                    <p>إدخالك لرقم جوالك , سيمكنك من استخدام خدمة "زواج جوال (قيد الإنشاء)" التي تتيح لك استقبال وارسال رسائل الجوال </p>

                    <div class="row">
                        <div class="col-md-4 offset-md-2">
                            <input type="text" class="form-control" name="fullname" placeholder="<?php echo e(_i('fullname')); ?>" value="<?php echo e($user->fullname); ?>">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="mobile" placeholder="<?php echo e(_i('mobile')); ?>" value="<?php echo e($user->mobile); ?>">
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    <input type="submit" value="<?php echo e(_i('Edit Details')); ?>" class="btn btn-pink mt-4 ">
                </div>
            </div>
        </div>


    </form>

</section>


<br><br><br><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/accountsetting/editProfile.blade.php ENDPATH**/ ?>