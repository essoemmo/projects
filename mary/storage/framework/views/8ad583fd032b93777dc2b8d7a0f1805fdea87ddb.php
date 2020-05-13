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

                   <?php
                        $art = \App\Models\Article::where('id',$artic->article_id)->first();
//                    dd($cat);
                    ?>

                <?php if(!session('language')): ?>
                              <?php   $cat = DB::table('artcl_categories')->where('source_id',null)->first();?>
                     <?php else: ?>
                    <?php if(session('language')): ?>
                               <?php   $catt = DB::table('artcl_categories')->where('source_id','!=',null)->first();?>
                    <?php if($catt->lang_id == session('language')): ?>
                                <?php   $cat = DB::table('artcl_categories')->where('source_id',$art->category_id)->where('lang_id',session('language'))->first();?>
                     <?php endif; ?>
                                  <?php   $cattt = DB::table('artcl_categories')->where('source_id','=',null)->first();?>

                     <?php if($cattt->lang_id == session('language')): ?>
                                     <?php   $cat = DB::table('artcl_categories')->where('id',$art->category_id)->where('lang_id',session('language'))->first();?>
                     <?php endif; ?>

                    <?php endif; ?>
                <?php endif; ?>

                       <div class="col-md-6">
                         <h2 style="text-align: center"><?php echo e($cat->title); ?></h2>
                           <div class="image">
                               <img src="<?php echo e(asset('uploads/articles/'.$cat->img_url)); ?>" width=500px;>
                           </div>


                        <div class="col-md-6">
                            <?php $data = DB::table('article_datas')
                                ->where('article_id',$artic->article_id)
                                ->where('lang_id',session('language'))
                                ->get()
                            ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $da): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="content">
                                    <?php echo $da->title; ?>

                                    <div class="descrption">
                                        <?php echo $da->content; ?>

                                    </div>
                                    <span ><?php echo e(date('d/m/Y', strtotime($da->created))); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/web/article/index.blade.php ENDPATH**/ ?>