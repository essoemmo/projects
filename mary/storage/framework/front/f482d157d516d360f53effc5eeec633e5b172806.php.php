<footer>
    <div class="links">
        <div class="container">
            <div class="row">


                <div class="col-lg-3 col-md-12 align-self-center mt-md- text-md-center">
                    <form class="form-inline mb-2" action="<?php echo e(url('newsletter')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="email" name="email" class="form-control mb-2" id="inlineFormInputName2"
                               placeholder="<?php echo e(_i('Your E-mail')); ?>">

                        <button type="submit" class="btn btn-primary mb-2 "><?php echo e(_i('Subscribe')); ?></button>
                    </form>
                    <div class="row text-center">
                        <div class="col-6 ">
                            <a href=""><img src="<?php echo e(url('/')); ?>/web/images/andriod.png" alt="" class="img-fluid"></a>
                        </div>
                        <div class="col-6 ">
                            <a href=""><img src="<?php echo e(url('/')); ?>/web/images/ios.png" alt="" class="img-fluid"></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <hr>

    <div class="copyrights text-md-center ">
        <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div><?php echo e(_i('Copyright © 2018 .com™. All rights reserved.')); ?></div>
                <div class="social">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href=" <?php if(!empty(settings())): ?> <?php echo e(settings()->facebook_url); ?> <?php else: ?> # <?php endif; ?>"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href=" <?php if(!empty(settings())): ?> <?php echo e(settings()->twitter_url); ?> <?php else: ?> # <?php endif; ?>"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href=" <?php if(!empty(settings())): ?> <?php echo e(settings()->instagram_url); ?> <?php else: ?> # <?php endif; ?>"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div><?php echo e(_i('design and development by')); ?> <span><a href="https://serv5.com/" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="<?php echo e(asset('web/js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/popper.min.js')); ?>"></script>

<script src="<?php echo e(asset('web/js/bootstrap-rtl.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/lazyload.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/jquery.flexslider-min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/droopmenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/bootstrap-input-spinner.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/wow.min.js')); ?>"></script>

<?php echo $__env->yieldPushContent('css'); ?>
<?php echo $__env->yieldPushContent('js'); ?>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {

        // image preview
        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });

        CKEDITOR.config.language =  "<?php echo e(app()->getLocale()); ?>";

    });
</script>









</body>
</html>
