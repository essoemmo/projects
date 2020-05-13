
<?php $__env->startPush('css'); ?>
<style>
    .single-member-box .member-pic img {
     width: 143px !important;
    }
</style>
    <?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">قصص نجاح</li>
            </ol>
        </div>
    </nav>

    <section class="successful-stories-page latest-members  common-wrapper ">
        <div class="container">

            <div class="text-center mb-5">
                <div class="black-head-title">
                    نهنئ جميع المشتركين الذين وفقهم الله بإيجاد نصفهم الآخر عبر هذا الموقع
                    ونتمنى لهم حياة سعيدة في طاعته ومرضاته , ونرجو من الله التوفيق لجميع الأعضاء
                    فيما يلي بعض من القصص الناجحة التي بشرنا بها
                </div>
            </div>

            <div id="story">
                <?php echo $__env->make('web.storeis.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>
    </section>
    <br>
    <br>




<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).on('click','.pagination a' ,function(e){
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            $.ajax({

               url:"/paginate/fetch?page="+page,
                success:function (data) {

                   console.log(data);
                    $('#story').html(data)
                }
            });

        });
    </script>

    <?php $__env->stopPush(); ?>

<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/storeis/index.blade.php ENDPATH**/ ?>