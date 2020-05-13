<?php $__env->startSection('content'); ?>
    <?php if(\Session::has('success')): ?>
        <div class="text-center alert alert-success">
            <p><?php echo e(\Session::get('success')); ?></p>
        </div><br />
    <?php endif; ?>
    <?php if(\Session::has('failure')): ?>
        <div class="text-center alert alert-danger">
            <p><?php echo e(\Session::get('failure')); ?></p>
        </div><br />
    <?php endif; ?>


<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin: 36px;
    padding: 30px;">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">اخر الاعضاء دخولا</h5>
                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">age</th>
                            <th scope="col">الجنسية</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $lastLogin->where('user_id','!=',$user->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $last): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php if($last->user->gender == 'male'): ?> <i class="fa fa-heart-o"></i> <?php else: ?> <i class="fa fa-heart"></i>  <?php endif; ?>  </td>
                                <td><a href="<?php echo e(route('user-details',$last->user->id)); ?>"><?php echo e($last->user->username); ?></a> </td>
                                <td><?php echo e($last->user->age); ?></td>

                            <?php
        $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $last->user_id)->first();
        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
            ->where('nationalty_id', $usernat->nationalty_id)
            ->value('name');
                                        ?>
                                <td><?php echo e($countyname); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


        <div class="col-md-6" style="margin: 36px;
                  padding: 30px;">
            <div class="card" style="width: 18rem;">
                <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e(_i('profile').auth()->user()->username); ?></h5>
                       <ul>
                           <li><a href="<?php echo e(route('profile-user')); ?>"><?php echo e(_i('profile')); ?></a> </li>
                           <li><a href="<?php echo e(route('profile-value','like')); ?>"><?php echo e(_i('like')); ?></a></li>
                           <li><a href="<?php echo e(route('profile-value','block')); ?>"><?php echo e(_i('blocked')); ?></a></li>
                           <li><a href="<?php echo e(route('profile-value','dislike')); ?>"><?php echo e(_i('disliked')); ?></a></li>
                       </ul>
                    </div>
                    <?php else: ?>
                    <p style="text-align: center;     font-size: 25px;
" ><?php echo e(_i('login in web')); ?></p>
                    <form class="shadow-lg" action="<?php echo e(url('/login')); ?>" method="post" data-parsley-validate="">

                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-sm-12">
                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"  id="exampleInputEmail1" name="email" required=""
                                       data-parsley-type="email"  placeholder="<?php echo e(_i('Email')); ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" id="Password"  name="password" required=""
                                       placeholder="<?php echo e(_i('Password')); ?>">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <?php if($errors->has('password')): ?>
                                    <span class="text-danger invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" >
                                    <label class="custom-control-label" for="customCheck1"><?php echo e(_i('Remember Me')); ?></label>
                                </div>

                                
                                
                                


                                <div class="">
                                    <div class="right" style="display:inline-block;">
                                        <button type="submit" class="btn btn-red"><?php echo e(_i('Login')); ?></button>
                                    </div>
                                    <div class="left" style="text-align: left; display:inline-block; float: left;" >
                                        <a href="<?php echo e(url('/reset_password')); ?>">
                                            <button type="button"  class="btn btn-green" >
                                                <?php echo e(_i('Forgot your password')); ?>

                                            </button>
                                        </a>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </form>

                <?php endif; ?>

            </div>
        </div>

    </div>

</div>
    <?php
        $national = \Illuminate\Support\Facades\DB::table('nationalies_data')
            ->join('nationalties','nationalies_data.nationalty_id','=','nationalties.id')
            ->get();

    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin: 36px;
    padding: 30px;">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link stat" id="home-tab" data-toggle="tab" href="#zoug" role="tab" aria-controls="home"
                                   aria-selected="true" data-name="male">بحث عن زوج</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active stat" id="profile-tab" data-toggle="tab" href="#wife" role="tab" aria-controls="profile"
                                   aria-selected="false" data-name="female">بحث عن زوجة</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="zoug" role="tabpanel" aria-labelledby="home-tab">
                                <form action="<?php echo e(route('search')); ?>" method="get">
                                      <?php echo csrf_field(); ?>
                                    <input type="hidden" name="gendar" value="male">

                                    <label>جنسيته</label>
                                    <select name="nationalty" class="form-control nationalty">
                                        <option value="">كل الجنسيات</option>
                                      <?php $__currentLoopData = $national; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $natio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($natio->id); ?>"><?php echo e($natio->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                    <label>مقيم في</label>
                                    <select name="country" class="form-control country">
                                        <option value="">كل الدول</option>

                                    </select>


                                    <label>عمره</label>
                                    <select name="from" class="form-control">
                                        <option value="">لايهم</option>
                                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                                            <option><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label>الي </label>
                                    <select name="to" class="form-control">
                                        <option value="">الي</option>
                                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                                            <option><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>


                                    <label>الحالة الاجتماعية </label>
                                    <select name="status" class="form-control status">
                                        <option value=""></option>



                                    </select>


                                    <label>ترتيب النتائج</label>
                                    <select name="order" class="form-control">
                                        <option value="lastlogin desc">الآخر دخولا أولا</option>
                                        <option value="postdate desc">المشتركين الجدد أولا</option>
                                        <option value="age">الأصغر عمر أولا</option>
                                        <option value="country">حسب الإقامة</option>
                                    </select>

                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>بحث</button>

                                </form>

                            </div>


                            <div class="tab-pane fade" id="wife" role="tabpanel" aria-labelledby="profile-tab">


                                <form action="<?php echo e(route('search')); ?>" method="get">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="gendar" value="female">

                                    <label>جنسيتها</label>
                                    <select name="nationalty" class="form-control nationalty">
                                        <option value="">كل الجنسيات</option>
                                        <?php $__currentLoopData = $national; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $natio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($natio->id); ?>"><?php echo e($natio->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                    <label>مقيمة في</label>
                                    <select name="country" class="form-control country">
                                        <option value="">كل الدول</option>

                                    </select>


                                    <label>عمرها</label>
                                    <select name="from" class="form-control">
                                        <option value="">لايهم</option>
                                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                                            <option><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label>الي </label>
                                    <select name="to" class="form-control">
                                        <option value="">الي</option>
                                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                                            <option><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>


                                    <label>الحالة الاجتماعية </label>
                                    <select name="status" class="form-control status">
                                        <option value=""></option>



                                    </select>


                                    <label>ترتيب النتائج</label>
                                    <select name="order" class="form-control">
                                        <option value="lastlogin desc">الآخر دخولا أولا</option>
                                        <option value="postdate desc">المشتركين الجدد أولا</option>
                                        <option value="age">الأصغر عمر أولا</option>
                                        <option value="country">حسب الإقامة</option>
                                    </select>

                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>بحث</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {

            $('body').on('change','.nationalty',function () {

                var id = $(this).val();


                $.ajax({
                    url: '<?php echo e(route('get-searchCountry')); ?>',
                    method: "get",
                    
                    data: {id: id},
                    success: function (response) {

                        $('.country').empty();
                        $('.country').append('<option value="'+response.data.id+'">'+response.data.county_name+'</option>');

                    }

                });

            });

            $('body').on('change','.stat',function () {

                var val = $(this).data('name');

                $.ajax({
                    url: '<?php echo e(route('statue-user')); ?>',
                    method: "get",
                    
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        $('.status').empty();
                        for (var i = 0; i <= response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });
            })

            // $('.stat').trigger('click');


        });
    </script>

    <?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>