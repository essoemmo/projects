
<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(_i('Zawage Article')); ?></li>
            </ol>
        </div>
    </nav>


    <section class="article-page  common-wrapper ">
        <div class="container">

            <div class=row>

            <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                       <div class="col-md-6">
                           <?php
                            $cat = \Illuminate\Support\Facades\DB::table('artcl_categories')
                               ->where('id',$artic->category_id)->where('lang_id',session('language'))
                               ->first();
                           ?>
                        <?php if($cat == null): ?>
                                   <?php
                                   $cat = \Illuminate\Support\Facades\DB::table('artcl_categories')
                                       ->where('source_id',$artic->category_id)->where('lang_id',session('language'))
                                       ->first();
                                   ?>
                                   <h2 style="text-align: center"><?php echo e($cat->title); ?></h2>
                                     <?php else: ?>
                                   <h2 style="text-align: center"><?php echo e($cat->title); ?></h2>

                               <?php endif; ?>
                           <div class="image">
                               <img src="<?php echo e(asset('uploads/articles/'.$artic->img_url)); ?>" width=500px;>
                           </div>


                        <div class="col-md-6">

                                <div class="content">
                                    <?php echo $artic->title; ?>

                                    <div class="descrption">
                                        <?php echo $artic->content; ?>

                                    </div>
                                    <span ><?php echo e(date('d/m/Y', strtotime($artic->created))); ?></span>
                                </div>

                        </div>




            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <?php echo e($article->appends(request()->query())->links()); ?>

            </div>



    </section>
    <br>
    <br>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/article/index.blade.php ENDPATH**/ ?>