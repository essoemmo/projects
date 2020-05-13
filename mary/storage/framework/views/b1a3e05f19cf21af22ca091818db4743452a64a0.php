<!DOCTYPE html>
<html lang="<?php echo e(LaravelGettext::getLocale()); ?>" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>zwag</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/bootstrap-rtl.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/nice-select.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('web/css/style.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('adminPanel/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('adminPanel/plugins/noty/noty.min.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminPanel/plugins/datatables/dataTables.bootstrap4.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header>
    <div class="top-header">
        <div class="top-orange-bar ">
            <div class="container">
                <div class="justify-content-between align-items-center d-flex">

                    <ul class="nav lang">

                        <li class="user-profile list-inline-item dropdown nav-item">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <?php
                                $language = \App\Models\Language::where('id',session('language'))->first();
                                   ?>
                                <img src='<?php echo e(asset("web/images/$language->name.png")); ?>' alt="">
                                <?php echo e(_i('Language')); ?>

                            </a>
                            <div class="dropdown-menu animated" id="langs" aria-labelledby="userDropdown">
                                <ul class="list-unstyled">

                                </ul>
                                
                                
                                
                                
                                
                                

                            </div>
                        </li>

                    </ul>


                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href=""><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">

                <a href="" class="navbar-brand"><img data-src="<?php echo e(asset('uploads/setting/'.settings()->loge)); ?>" alt="" class="img-fluid lazy"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(_i('Home')); ?> <span class="sr-only">(current)</span></a>
                        </li>
                        <?php if(auth()->check()): ?>
                            <li class="user-profile list-inline-item dropdown nav-item">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(_i('Members area')); ?>

                                </a>
                                <div class="dropdown-menu animated" aria-labelledby="userDropdown">
                                    <?php if(auth()->guard('web')->check() && !auth()->guard('web')->guest() ): ?>

                                        <a class="dropdown-item" href="<?php echo e(route('profile-user')); ?>"><?php echo e(_i('Profile')); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <?php echo e(_i('Logout')); ?>

                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>  
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?php echo e(url('/register')); ?>"> <?php echo e(_i('Register')); ?> </a>
                                        <a class="dropdown-item" href="<?php echo e(url('/login')); ?>"> <?php echo e(_i('Log In')); ?> </a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a href="<?php echo e(url('/login')); ?>" class="nav-link"> <?php echo e(_i('Login')); ?> </a></li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('get-latestUser')); ?>"><?php echo e(_i('Latest Members')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo e(_i('BestMember')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('get-onlineUser')); ?>"><?php echo e(_i('Active Members')); ?></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('get-story')); ?>"><?php echo e(_i('successful Story')); ?></a>
                        </li>

                    </ul>

                </div>
            </nav>
        </div>
    </div>

</header>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('admin.layouts.session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<footer class="pink-bg pink-shape">
    <div class="links text-center">
        <div class="container">

            <ul class="footer-list list-inline ">
                <li class="list-inline-item">
                    <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(_i('Home')); ?> <span class="sr-only">(current)</span></a>
                </li>

                <li class="list-inline-item">
                    <a class="nav-link" href="<?php echo e(route('get-latestUser')); ?>"><?php echo e(_i('Latest Members')); ?></a>
                </li>
                <li class="list-inline-item">
                    <a class="nav-link" href="#"><?php echo e(_i('BestMember')); ?></a>
                </li>
                <li class="list-inline-item">
                    <a class="nav-link" href="<?php echo e(route('get-onlineUser')); ?>"><?php echo e(_i('Active Members')); ?></a>
                </li>

                <li class="list-inline-item">
                    <a class="nav-link" href="<?php echo e(route('get-story')); ?>"><?php echo e(_i('successful Story')); ?></a>
                </li>
            </ul>
            <div class="row justify-content-center">
                <a href=""><img src="<?php echo e(asset('web/images/andriod.png')); ?>" alt="" class="img-fluid"></a>
                <a href=""><img src="<?php echo e(asset('web/images/ios.png')); ?>" alt="" class="img-fluid"></a>
            </div>
        </div>
    </div>


    <div class="copyrights text-md-center ">
        <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div>Copyright © 2018 .com™. All rights reserved.</div>

                <div>design and development by <span><a href="serv5.com" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="<?php echo e(asset('web/js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/bootstrap-rtl.js')); ?>"></script>
<script src="<?php echo e(url('/')); ?>/adminPanel/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo e(url('/')); ?>/adminPanel/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo e(url('/')); ?>/adminPanel/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('web/js/lazyload.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('web/js/custom.js')); ?>"></script>



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
    $(function(){
        $.ajax({
            url:"<?php echo e(route('web.languages')); ?>",
            success:(res)=>{
                console.log(res);
                if(res == null) return false;
                $('#langs').html('');

                for (var i =0 ; i<=res.length ; i++){
                    $('#langs').append(`<form action="<?php echo e(url('change_language')); ?>" id="getLang-${res[i].id}" method="get">
                    <input type="hidden" name="setLanguage" value="${res[i].name}"/>
                    <a href="javascript:{}" onclick="document.getElementById('getLang-${res[i].id}').submit();" class="dropdown-item">${res[i].name}</a></form>`);
                }

                
                
                
                
                
            },
            error:(err)=>{
                console.log(err);
            }
        });
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



    });
</script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\beta\resources\views/web/layout/master.blade.php ENDPATH**/ ?>