<!-- Here you see table with all tabels need to translate and count recourds need to translate for sbacific language


he selected from select on the table. -->

<?php $__env->startSection('box-title'); ?>

<h1 class="box-title">
    <?= _i("Translation") ?>
</h1>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
    <?php echo e(_i('Translation')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="box">
    <div class="box-body">
        <div class="form-group">
            <div class="header pull-left" id="type" style="    text-align: left; width: 78px;position: relative;
    right: 43%;">
                <h3></h3>
            </div>
            <!-- select for language -->
            <div class="col-md-3">
                <?php echo e(Form::label('language',_i('language'),['class'=>'form-label'])); ?>

            </div>
            <div class="col-md-5">
                <?php echo e(Form::select('language',[],null,['class'=>'form-control'])); ?>

            </div>
        </div>
        <div class="form-group">
            <!-- table has all tables selected from database need to translate -->
            <table id="base_table" class="cell-border text-center" style="width:100%">
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    var table = null;
    var default_lang = 1;
    var selected_language = 1;
    var url = "<?php echo e(route('translation.index')); ?>";
    const TRANSLATION_LABELS = {

    }

    function initPage() {
        initTable();
        initPageEvents();
        drawLanguageSelect();
    }

    function initTable() {
        this.table = $('#base_table').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX":true,
            columns: [{
                    title: "#"
                },
                {
                    title: "<?php echo e(_i('Name')); ?>"
                },
                {
                    title: "<?php echo e(_i('All Records')); ?>"
                },
                {
                    title: "<?php echo e(_i('Record Translated')); ?>",
                    "render": function(data, type, row, meta) {
                        if(data == 0){
                            return `<span class="text-red">${data}</span>`;
                        }
                        return `<span>${data}</span>`;
                    }
                },
                {
                    data: null,
                    title: "<?php echo e(_i('Translation')); ?>",
                    "render": function(data, type, row, meta) {
                        return `<a href="<?php echo e(url('admin/translation')); ?>/${row[0]}?lang=${selected_language}" class="btn btn-block btn-info"><?php echo e(_i('To Translate')); ?></a>`;
                    }
                }
            ]
        });
    }
    //resource handle
    function getSource(url, data, on_success, on_error) {

    //   if (data.lang == 1){
    //       $('#type h3').empty();
    //         $('#type h3').html('العربية');
    //   }else{
    //       if (data.lang == 2){
    //           $('#type h3').empty();
    //           $('#type h3').html('English');
    //       }
    //   }
            var fruits = data.lang;

        var text;
        var fruits = data.lang;


        switch(fruits) {
            case '1':
               $('#type h3').empty();
                $('#type h3').html('العربية');
                // text = "العربية";
                break;
            case '2':
                $('#type h3').empty();
                $('#type h3').html('English');
                break;
            case '5':
                $('#type h3').empty();
                $('#type h3').html('française');
                break;
            case '6':
                $('#type h3').empty();
                $('#type h3').html('bosanski');
                break;
            default:
                $('#type h3').empty();
                $('#type h3').html('no selected language');

        }
        $.ajax({
            "url": url,
            "data": data,


            success: function(trans_data) {
                if (trans_data != null) {
                    on_success(trans_data);
                }
            },
            error: function(error) {
                if (error != null) {
                    on_error(error);
                }
            }
        });
    }
    //draw elements
    function drawLanguageSelect() {
        let next = function(langs) {
            if (langs == null || langs.length == 0) {
                return false;
            }
            lang_select = $('#language').html('<option value>Choose</option>');
            $.each(langs, function(i, r) {
                $(lang_select).append(`<option value="${i}">${r}</option>`);
            });
        }
        getSource(url, {
            "resource": "langs"
        }, next, onError)

    }

    function drawDataInTable(language) {
        if (language == null) {
            default_lang = 1;
        } else {
            default_lang = language;
            selected_language = language;
        }
        let next = function(trans_data) {
            if (trans_data.length <= 0) {
                return false;
            } else {
                table.clear().draw();
                table.rows.add(trans_data);
                table.columns.adjust().draw();
            }
        }

        getSource(url, {
            "resource": "translation",
            'lang': default_lang
        }, next, onError)
    }
    //events
    function initPageEvents() {
        $('#language').on('change', function(e) {
            drawDataInTable($(this).val());
        });
    }

    function onError(error) {
        console.log(error);
    }

    function onSuccess(msg) {

    }

    $(function() {
        initPage();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/translation/index.blade.php ENDPATH**/ ?>