

<?php $__env->startSection('content'); ?>


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(_i('/')); ?>"><?php echo e(_i('Home')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo e(_i('Account settings')); ?></li>
            </ol>
        </div>
    </nav>

    <div class="my-account-top-panel pt-5">
        <div class="container">
            <div class="text-center">

                <div class="black-head-title">أهلا وسهلا بك في الصفحة الخاصة بإدارة حسابك</div>
                <?php if($errors->all()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <ul class="my-account-top-panel-nav list-inline">
                    <li><a href="" id="notifcation"><?php echo e(_i('notifaction')); ?><span class="badge badge-pill badge-danger"><?php echo e($user->notifications->count()); ?></span></a></li>
                    <li><a href="#" id="massege"><?php echo e(_i('message')); ?></a></li>
                    <li><a href="#" id="like"><?php echo e(_i('likeList')); ?></a></li>
                    <li><a href="#" id="blocklist"><?php echo e(_i('dislikeList')); ?></a></li>
                    <li><a href="#" id="like_me"><?php echo e(_i('who like me')); ?></a></li>

                    <li><a href=""><?php echo e(_i('online now')); ?></a></li>

                    <li><a href=""><?php echo e(_i('settings')); ?></a></li>
                    <li><a href="#" id="editProfile"><?php echo e(_i('edit details')); ?></a></li>
                    <li><a href="#" id="contactAdmin"><?php echo e(_i('contact mangment')); ?></a></li>
                    <li class="" id="logout"><a href=""><?php echo e(_i('logout')); ?></a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="my_account_massege  common-wrapper" style="display: none" id="tables">
        <div class="container" id="show">

            <div class="table-responsive" id="notifactions">
                <table class="table table-bordered table-striped dataTable text-center" id="notifaction_table">
                </table>
            </div>

            <div class="table-responsive" id="massegeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="massegs_table">
                </table>
            </div>

            <div class="table-responsive" id="likeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="like_table">
                </table>
            </div>

            <div class="table-responsive" id="blockTable">
                <table class="table table-bordered table-striped dataTable text-center" id="block_table">
                </table>
            </div>

            <div class="table-responsive" id="likeMeTable">
                <table class="table table-bordered table-striped dataTable text-center" id="likeMe_table">
                </table>
            </div>
        </div>
    </section    >

    <section class="register-form common-wrapper" id="formEdit">
        <section class="my_account_home  common-wrapper my-3">

            <div class="bg-light-pink p-5">
                <div class="container">
                    <div class="my_account_links white-notice-box notice-box">
                        <ul class="list-unstyled">
                            <li> أنت مشترك معنا منذ قبل<?php echo e($user->created_at->diffForHumans()); ?> , ورقم عضويتك هو : " <?php echo e($user->id); ?> "</li>
                            <li>صفحة بياناتك موجودة على العنوان التالي : <a href="<?php echo e(url('details/user/'.$user->id)); ?>"><?php echo e(url('details/user/'.$user->id)); ?></a> </li>
                            <li> الوقت في الموقع هو بتوقيت جرينتش : GMT</li>
                            <li> يمكنك التحكم بخصائص حسابك من خلال الإعدادات الخاصة , <a href="">إضغطي هنا لضبط هذه
                                    الإعدادات</a>
                            </li>
                            <li> لتغيير حالة ظهورك في الموقع من متصل الى خفي أو العكس <a href="">إضغطي هنا</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="pink-box  my-4 text-center">

                    <h5>تنبيه هام لكل العضوات في الموقع</h5>
                    <p>عند إضافة اي عضو الى قائمة التجاهل , فإنه لن يستطيع مراسلتك بعد الآن , كيف أفعل ذلك
                        نرجو منك عدم نسيان مساعدتنا وتنبيهنا على أي عضو يسيئ استخدام الموقع , لنقوم بإتخاذ الإجراء الازم بحقه
                    </p>
                    <p>نرجو منك ونطلب اليك ونترجـــــاااااك أن لا تقومي بإعطاء البريد الإلكتروني الخاص بك لأي شاب مهما الح في الطلب
                        ومهما كانت الأسباب .
                        إعطاء البريد الإلكتروني للشاب بغرض التفاهم بشكل اسرع وبغرض المحادثة على الماسنجر يعتبر مخالفة لشروط المراسلة
                        , ويعرضك للحظر من الموقع .الطريقة الوحيدة في للتواصل مع الشاب الراغب بالزواج هي المراسلة الداخليه فقط عبر
                        الموقع
                        , وهي أأمن طريقة وتحت مظلة إدارة الموقع .
                    </p>

                    <h5>سبب المنع</h5>
                    <p>

                        من خلال البحث والتدقيق والمتابعة فإن 85% من الأعضاء الذين يطلبون المحادثة خارج الموقع لايريدون الزواج وإنما التعارف والصداقة فقط .
                        اغلب من يطلب الايميل والماسنجر لايريد أن يكون تحت غطاء الموقع خوفا من الحظر , لذلك يطلب أن تتم المحادثة خارج الموقع .
                        عندما يسئ العضو للفتاة خارج الموقع (عبر الإيميل أو الماسنجر) , فنحن لانراه وليس لدينا دليل ملموس على حظره .
                        لذلك ممنوع يا أختي المسجلة بالموقع أعطاء معلومات الإيميل للعضو
                        هناك المئات من الذين وفقهم الله عبر الموقع لم يستخدمو الا الرسائل الداخليه .</p>

                    <h5>سيناريو السيئين في الموقع</h5>
                    <p>يقوم الشاب بالتسجيل بالموقع ببيانات جيدة (كاذبة) , ويقوم بمراسلة الفتاة عبر الرسائل الداخلية, ويطلب منها البريد الإلكتروني للتعرف
                        بشكل أفضل على الماسنجر وعبر الإيميل, فتصدقه الفتاة المسكينة وتعطيه الايميل والماسنجر
                        , وبعدها ينكشف الشاب على حقيقته ويطلب التحدث بأمور خارج موضوع الزواج ويطلب اشياء غير شرعية .ستقوم الفتاة بعدها بإخبار الإدارة
                        انها اكتشفت شاب سيئ وتطلب حظره من الموقع .يدخل المشرف ويبحث عن الشاب ويشاهد بياناته فيجدها جيدة فيشاهد رسائلة
                        الداخلية المرسلة فلا يجد بها سوء !!!! , ولا يوجد أي دليل داخل الموقع , والدليل فقط على الماسنجر الذي هو خارج عين وصلاحيات الموقع .
                        أي عندما خالفت الفتاة شروط المراسلة والطريقة الآمنه التي وضعها الموقع  وخرجت تحادث الشاب خارج الموقع
                        تعرضت لهذه الإهانة من الشاب السيئ .</p>
                </div>
            </div>

        </section>
    </section>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {

            $('body').on('change','.country',function () {

                var id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('get_City_profile')); ?>',
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

                    /*action massege [like-block-delete]*/
            $('body').on('click','.add-to-fav',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "<?php echo e(_i('You should login in the web to send the like')); ?>",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '<?php echo e(route('add-heart')); ?>',
                        method: "post",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            f:f,
                            t:t,
                            id:id,

                        },
                        success: function (response) {
                            if (response === "true"){

                                $('.add-'+id+' i').attr('class','fa fa-heart');
                            }else{
                                $('.add-'+id+' i').attr('class','fa fa-heart-o');

                            }
                        }
                    });
                }


            });

            $('body').on('click','#block',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "<?php echo e(_i('You should login in the web to send the blocked')); ?>",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '<?php echo e(route('add-block')); ?>',
                        method: "post",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            f:f,
                            t:t,
                            id:id,

                        },
                        success: function (response) {
                            if (response === "true"){
                                $('.add-'+id+' i').attr('class','fa fa-heart-o');
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "<?php echo e(_i('Done the user is blocked')); ?>",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }else{
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "<?php echo e(_i('Done the user is disliked')); ?>",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        }
                    });
                }
            })

            $('body').on('click','#delete',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var fav = $(this).data('favid');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '<?php echo e(route('remove-massege')); ?>',
                        method: "DELETE",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            fav: fav,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })
                 /*end action massege [like-block-delete]*/

                   /*notfaction tabels*/

            $('body').on('click','#notifcation',function (e) {
                e.preventDefault();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#massegeTable').hide();
                $('#tables').show();
                $('#notifactions').show();

                $(this).parent().addClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#massege" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                // $('#show').load('massege/all');
                if($.fn.DataTable.isDataTable( '#notifaction_table' ))
                    tableNotify.destroy();
                 tableNotify=  $('#notifaction_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo e(url('notifaction/get_datatable')); ?>',
                    columns: [
                        
                        {data: 'massege', title: '<?php echo e(_i('message')); ?>'},
                        {data: 'created_at', title: 'created_at'},
                        // {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });

                // var table = $('#notifaction_table').DataTable();
                // table.destroy();



            });



            /*get datatable massge*/
            $('body').on('click','#massege',function (e) {
                e.preventDefault();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#massegeTable').show();
                $('#notifactions').hide();

                $(this).parent().addClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                // $('#show').load('massege/all');
                if($.fn.DataTable.isDataTable( '#massegs_table' ))
                tableMass.destroy();
                tableMass = $('#massegs_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo e(url('massege/get_datatable')); ?>',
                    columns: [
                        {data: 'from_id', title: '<?php echo e(_i('form')); ?>'},
                        {data: 'message', title: '<?php echo e(_i('message')); ?>'},
                        {data: 'created_at', title: 'created_at'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });

                // var table = $('#massegs_table').DataTable();
                // table.destroy();



            });
                        /*like list*/
            $('body').on('click','#like',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#blockTable').hide();
                $('#likeMeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#likeTable').show();
                $('#notifactions').hide();


                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');

                if($.fn.DataTable.isDataTable( '#like_table' ))
                    tablelike.destroy();
                tablelike = $('#like_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo e(url('like/get_datatable')); ?>',
                    columns: [
                        {data: 'to_id', title: '<?php echo e(_i('numberId')); ?>'},
                        {data: 'username', title: '<?php echo e(_i('name')); ?>'},
                        {data: 'age', title: '<?php echo e(_i('age')); ?>'},
                        {data: 'nationalty_id', title: '<?php echo e(_i('nationalty')); ?>'},
                        {data: 'resident_country_id', title: '<?php echo e(_i('country')); ?>'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });
                // var table = $('#like_table').DataTable();
                // table.destroy();

            });
            $('body').on('click','#deleteLike',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '<?php echo e(route('remove-like')); ?>',
                        method: "DELETE",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })
                        /*end like list*/

                        /*block list*/
            $('body').on('click','#blocklist',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#likeTable').hide();
                $('#likeMeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#blockTable').show();
                $('#notifactions').hide();


                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#like_me').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifactions" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                if($.fn.DataTable.isDataTable( '#block_table' ))
                tableblock.destroy();
                tableblock = $('#block_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo e(url('block/get_datatable')); ?>',
                    columns: [
                        {data: 'to_id', title: '<?php echo e(_i('numberId')); ?>'},
                        {data: 'username', title: '<?php echo e(_i('name')); ?>'},
                        {data: 'age', title: '<?php echo e(_i('age')); ?>'},
                        {data: 'nationalty_id', title: '<?php echo e(_i('nationalty')); ?>'},
                        {data: 'resident_country_id', title: '<?php echo e(_i('country')); ?>'},
                        {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });


                // var table = $('#block_table').DataTable();
                // table.destroy();
            });
            $('body').on('click','#deleteblock',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '<?php echo e(route('remove-like')); ?>',
                        method: "DELETE",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }

            })

                        /*like me*/
            $('body').on('click','#like_me',function (e) {
                e.preventDefault();
                $('#massegeTable').hide();
                $('#blockTable').hide();
                $('#likeTable').hide();
                $( "#formEdit" ).hide();
                $('#tables').show();
                $('#likeMeTable').show();
                $('#notifactions').hide();



                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                if($.fn.DataTable.isDataTable( '#likeMe_table' ))
                    tableLikeMe.destroy();
               tableLikeMe = $('#likeMe_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo e(url('likeMe/get_datatable')); ?>',
                    columns: [
                        {data: 'from_id', title: '<?php echo e(_i('numberId')); ?>'},
                        {data: 'username', title: '<?php echo e(_i('name')); ?>'},
                        {data: 'age', title: '<?php echo e(_i('age')); ?>'},
                        {data: 'nationalty_id', title: '<?php echo e(_i('nationalty')); ?>'},
                        {data: 'resident_country_id', title: '<?php echo e(_i('country')); ?>'},
                        {data: 'created', title: '<?php echo e(_i('created')); ?>'},
                        // {data: 'action', title: 'action', orderable: true, searchable: true}

                    ]
                });
                // var table = $('#likeMe_table').DataTable();
                // table.destroy();
            });
                        /*likeme*/

                    /*getEdit profiel*/

            $('body').on('click','#editProfile',function (e) {
                e.preventDefault();
                  $('#tables').hide();
                  $('#formEdit').show();

                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#contactAdmin" ).parent().removeClass('active');


                $( "#formEdit" ).load( "new/profile" );
                setTimeout(
                            function()
                            {
                                $('.country').trigger('change');
                            }, 500);



            })

                    //edit password
            $('body').on('click','#editPassword',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var password = $('#password').val();
                var passwordcon = $('#password_confirmation').val();


                if (password.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "<?php echo e(_i('password is null please write new password')); ?>",
                        timeout: 2000,
                        killer: true
                    }).show();
                } else{
                    $.ajax({
                        url: '<?php echo e(route('update-password')); ?>',
                        method: "patch",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            pass:password,
                            passCon:passwordcon,
                        },
                        success: function (response) {
                            // window.location.reload();
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('password changed')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    });
                }


            })
                    //edit email
            $('body').on('click','#editemail',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var email = $('#email').val();
                    $.ajax({
                        url: '<?php echo e(route('update-email')); ?>',
                        method: "patch",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            email:email,
                        },
                        success: function (response) {
                            // window.location.reload();
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "<?php echo e(_i('email changed')); ?>",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    });

            })
                    //delete member
            $('body').on('click','#deleteMember',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                    $.ajax({
                        url: '<?php echo e(route('delete-member')); ?>',
                        method: "delete",
                        data: {_token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                        },
                        success: function (response) {
                            window.location.replace("<?php echo e(route('home')); ?>");
                        }
                    });

            });

            $('body').on('click','#contactAdmin',function (e) {
                e.preventDefault();
                // $('#formEdit').empty();
                $('#tables').hide();
                $('#formEdit').show();

                $(this).parent().addClass('active');
                $('#massege').parent().removeClass('active');
                $('#like').parent().removeClass('active');
                $('#blocklist').parent().removeClass('active');
                $( "#like_me" ).parent().removeClass('active');
                $( "#notifcation" ).parent().removeClass('active');
                $( "#editProfile" ).parent().removeClass('active');

                $( "#formEdit" ).load( "contact/Adminstator" );

            })

            $('body').on('click','#logout',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(route('logout')); ?>',
                    method: "post",
                    data: {_token: '<?php echo e(csrf_token()); ?>',
                    },
                    success: function (response) {
                        window.location.replace("<?php echo e(route('home')); ?>");
                    }
                });
            })


        });
    </script>



<?php $__env->stopPush(); ?>


<?php echo $__env->make('web.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euzawaaj/public_html/beta/resources/views/web/user/profile.blade.php ENDPATH**/ ?>