<?php if(auth()->user()->can('option-delete')): ?>
    <form action="<?php echo e(route('destroy-Option',$id)); ?>" method="post">
        <?php echo e(method_field('delete')); ?>

        <?php echo e(csrf_field()); ?>

        <button type="submit" class="btn btn-danger delete"><?php echo e(_i('delete')); ?></button>
    </form>
    <?php else: ?>
    <button class="btn btn-danger disabled"><?php echo e(_i('delete')); ?></button>
    <?php endif; ?>


<script>
    $('.delete').click(function (e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({
            text: "<?php echo e(_i(' Are you sure ?')); ?>",
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

<?php /**PATH /home/euzawaaj/public_html/beta/resources/views/admin/features/option/btn/delete.blade.php ENDPATH**/ ?>