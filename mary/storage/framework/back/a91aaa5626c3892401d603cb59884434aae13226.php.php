<form action="<?php echo e(route('contact-destroy',$id)); ?>" method="post">
    <?php echo e(method_field('delete')); ?>

    <?php echo e(csrf_field()); ?>

    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
</form>

<script>
    $('.delete').click(function (e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({
            text: "<?php echo e(_i('Are you sure ?')); ?>",
            type: "warning",
            killer: true,
            buttons: [
                Noty.button("<?php echo e(_i('yes')); ?>", 'btn btn-success mr-2', function () {
                    that.closest('form').submit();
                }),

                Noty.button("<?php echo e(_i('no')); ?>", 'btn btn-primary mr-2', function () {
                    n.close();
                })
            ]
        });

        n.show();

    });//end of delete
</script>

