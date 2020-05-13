<?php $__env->startSection('content'); ?>
    <div class="slider ">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php if(\App\Models\Slider::where('lang_id',session('language'))->get()->count() > 0 ): ?>
                    <?php $__currentLoopData = \App\Models\Slider::where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-target="#carouselExampleFade" data-slide-to="<?php echo e($index); ?>" class="<?php echo e($index == 0 ? 'active' : ''); ?>"></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ol>
            <div class="carousel-inner">
                <?php if(\App\Models\Slider::where('lang_id',session('language'))->get()->count() > 0 ): ?>

                    <?php $__currentLoopData = \App\Models\Slider::where('lang_id',session('language'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('web/images/slider-img.png')); ?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <h2 class="main-title animated fadeInDown"><?php echo e($slider->title); ?></h2>
                                <p class="animated fadeInDown"><?php echo e($slider->desc); ?></p>
                                <a href="<?php echo e(url('login')); ?>" class="btn btn-grad animated fadeInDown"><?php echo e(_i('Subscribe')); ?></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>

        </div>

    </div>

    <section class="search-for-match pink-bg pink-shape common-wrapper text-center">
        <?php
        $national = \Illuminate\Support\Facades\DB::table('nationalies_data')
            ->join('nationalties','nationalies_data.nationalty_id','=','nationalties.id')
            ->select('nationalies_data.*')

            ->get();

        ?>

            <div class="container">
                <div class="section-title"><?php echo e(settings()->TitleTopSearch); ?></div>
                <div class="section-description">
                    <?php echo settings()->descriptionOnSearch; ?>

                </div>

                <form class="form-inline" action="<?php echo e(route('search')); ?>" method="get">
                    <?php echo csrf_field(); ?>
                    <label class="my-1 mr-2"><?php echo e(_i('search to')); ?></label>
                    <select class="nice-select my-1 mr-sm-2 stat" name="gendar">
                        <option value=""><?php echo e(_i('Chooose')); ?>...</option>
                        <option value="male"><?php echo e(_i('Husband')); ?></option>
                        <option value="female"><?php echo e(_i('wife')); ?></option>
                    </select>

                    <label class="my-1 mr-2"><?php echo e(_i('nationalty')); ?></label>
                    <select name="nationalty" class="form-control nationalty">
                        <option value=""><?php echo e(_i('all_Nationalty')); ?></option>
                        <?php $__currentLoopData = $national; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $natio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($natio->nationalty_id); ?>"><?php echo e($natio->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <label><?php echo e(_i('country')); ?></label>
                    <select name="country" class="form-control country">
                        <option value=""><?php echo e(_i('all Country')); ?></option>

                        <?php $__currentLoopData = $national; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $natio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($natio->id); ?>"><?php echo e($natio->county_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>


                    <label><?php echo e(_i('From')); ?> </label>
                    <select name="from" class="form-control">
                        <option value=""><?php echo e(_i('DontCare')); ?></option>
                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                            <option><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                    <label><?php echo e(_i('to')); ?> </label>
                    <select name="to" class="form-control">
                        <option value=""><?php echo e(_i('DontCare')); ?></option>
                        <?php for($i=18 ; $i<= 90 ;$i++): ?>
                            <option><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>

                    <label><?php echo e(_i('status')); ?> </label>
                    <select name="status" class="form-control status">
                        <option value=""><?php echo e(_i('status')); ?></option>
                    </select>

                    <label><?php echo e(_i('order result')); ?></label>
                    <select name="order" class="form-control">
                        <option value="lastlogin desc"><?php echo e(_i('lastlogin desc')); ?></option>
                        <option value="postdate desc"><?php echo e(_i('postdate desc')); ?>ا</option>
                        <option value="age"><?php echo e(_i('age')); ?></option>
                        <option value="country"><?php echo e(_i('country')); ?></option>
                    </select>

                    <a href="<?php echo e(route('advanced-search')); ?>" class="btn btn-grad my-1"><i class="fa fa-search"></i><?php echo e(_i('Advanced Search')); ?></a>
                    <button type="submit" class="btn btn-grad my-1"><?php echo e(_i('search')); ?></button>
                </form>
            </div>
    </section>

    <section class="active-members common-wrapper text-center extra-pb">
        <div class="container">
            <div class="section-title"><?php echo e(_i('Active Members')); ?></div>
            <div class="section-description"><?php echo settings()->descrptionactivemember; ?></div>


            <div class="six-members-carousel owl-carousel owl-theme">
                <?php if($activemember->count() > 0): ?>
                <?php $__currentLoopData = $activemember; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $user = \App\Models\User::where('id',$active->user_id)->first();

                    ?>
                <div class="single-member">

                    <div class="member-pic">
                        <a href="<?php echo e(route('user-details',$user->id)); ?>">
                            <?php if(empty($user->phote) && $user->gender == 'female'): ?>
                                <img src='<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">

                            <?php elseif(empty($user->phote) && $user->gender == 'male'): ?>
                                <img src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$user->gender-avatar.png")); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            <?php else: ?>
                                <img src="<?php echo e(asset('uploads/users/'.$user->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$user->phote)); ?>" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            <?php endif; ?>
                        </a>
                    </div>





                    <div class="name"><span><?php echo e(_i('name')); ?>:</span><a href="<?php echo e(route('user-details',$user->id)); ?>"><?php echo e($user->username); ?></a></div>
                    <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($user->age); ?></div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $user->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    ?>
                    <div class="country"><?php echo e($countyname); ?></div>
                </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="active-members white-bg-hearts white-shape common-wrapper text-center">
        <div class="container">

            <div class="section-title"><?php echo e(_i('BestMember')); ?></div>
            <div class="section-description"><?php echo settings()->descrptionactivemember2; ?></div>

            <div class="row">
            <?php if($bestmember->count() > 0): ?>
                <?php $__currentLoopData = $bestmember; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $best): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $userbest = \App\Models\User::where('id',$best->user_id)->first();
                    ?>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="single-member">
                        <div class="member-pic">
                            <a href="<?php echo e(route('user-details',$userbest->id)); ?>">
                                <?php if(empty($userbest->phote) && $userbest->gender == 'female'): ?>
                                    <img src='<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" alt=""
                                         class="img-fluid lazy rounded-circle loaded">

                                <?php elseif(empty($userbest->phote) && $userbest->gender == 'male'): ?>
                                    <img src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('uploads/users/'.$userbest->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$userbest->phote)); ?>" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                <?php endif; ?>
                            </a>
                        </div>




                        <div class="name"><span><?php echo e(_i('name')); ?>:</span><a href="<?php echo e(route('user-details',$userbest->id)); ?>"><?php echo e($userbest->username); ?></a></div>
                        <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($userbest->age); ?></div>
                        <?php
                        $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $userbest->id)->first();
                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('id', $usernat->resident_country_id)
                            ->value('county_name');
                        ?>
                        <div class="country"><?php echo e($countyname); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>


        </div>
    </section>

    <section class="successful-stories common-wrapper">
        <div class="container">
            <div class="section-title"><?php echo e(_i('successful Story')); ?></div>


            <div class="successful-stories-carousel owl-carousel owl-theme">

                <?php
                if (!session('language')){
                    $stories = \App\Models\Story::where('published','=','true')->where('source_id',null)->with('user')->latest()->get();
                }else{
                    $stories = \App\Models\Story::where('published','=','true')->where('lang_id',session('language'))->with('user')->latest()->get();
                }
                ?>
                <?php if($stories->count() > 0): ?>
                    <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <div class="single-story">
                    <div class="member-pic"><a href="" >
                            <?php if(empty($story->user->image) &&!isset($story->user->image)): ?>
                            <img data-src="<?php echo e(asset('uploads/default.jpg')); ?>" alt="" class="img-fluid owl-lazy">
                            <?php else: ?>
                                <img data-src="<?php echo e(asset('uploads/users/'.$story->image)); ?>" alt="" class="img-fluid owl-lazy">
                            <?php endif; ?>

                        </a>
                    </div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $story->user_id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('nationalty_id', $usernat->nationalty_id)
                        ->value('county_name');

                    ?>

                    <p class="story"><?php echo $story->content; ?>

                    </p>
                    <div class="name"><?php echo e($story->user->username); ?></div>
                </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>



            </div>
        </div>
    </section>
        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
            <section class="active-members white-bg-hearts white-shape common-wrapper text-center">
                <div class="container">
                    
                    <div class="section-title"><?php echo e(_i('Favoutite member')); ?></div>
                    <div class="section-description"></div>

                    <li class="row">
                        <?php
                        $fav=\Illuminate\Support\Facades\DB::table('user_favourite_options')
                            ->where('user_id',auth()->user()->id)->pluck('option_value_id')->toArray();
                        ?>

          
                            <?php
                        $search = \Illuminate\Support\Facades\DB::table('user_options')
                                    ->whereIn('option_value_id',$fav)
                                    ->where('user_id','!=',auth()->user()->id)
                                     ->select(['user_options.user_id'])
                                    ->groupBy('user_id')
                                    ->get();

                                ?>
                                <?php $__currentLoopData = $search; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $best): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $userbest = \App\Models\User::where('id',$best->user_id)->first()?>


                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="single-member">
                                                    <div class="member-pic">
                                                        <a href="<?php echo e(route('user-details',$userbest->id)); ?>">
                                                            <?php if(empty($userbest->phote) && $userbest->gender == 'female'): ?>
                                                                <img src='<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>' data-src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">

                                                            <?php elseif(empty($userbest->phote) && $userbest->gender == 'male'): ?>
                                                                <img src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" data-src="<?php echo e(asset("web/images/$userbest->gender-avatar.png")); ?>" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('uploads/users/'.$userbest->phote)); ?>" data-src="<?php echo e(asset('uploads/users/'.$userbest->phote)); ?>" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    <div class="name"><span><?php echo e(_i('name')); ?>:</span><a href="<?php echo e(route('user-details',$userbest->id)); ?>"><?php echo e($userbest->username); ?></a></div>
                                                    <div class="age"><span><?php echo e(_i('age')); ?></span><?php echo e($userbest->age); ?></div>
                                                    <?php
                                                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $userbest->id)->first();
                                                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                                                        ->where('id', $usernat->resident_country_id)
                                                        ->value('county_name');
                                                    ?>
                                                    <div class="country"><?php echo e($countyname); ?></div>
                                                </div>
                                            </div>


              
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>


                </div>
            </section>

        <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {

            $('body').on('change','.stat',function () {

                var val = $(this).val();
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
<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/index.blade.php ENDPATH**/ ?>