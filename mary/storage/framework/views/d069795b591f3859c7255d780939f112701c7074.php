<?php if(auth()->user()->can('member-Delete')): ?>
<form action="<?php echo e(route('members.destroy',$id)); ?>" method="post">
    <?php echo e(method_field('delete')); ?>

    <?php echo e(csrf_field()); ?>

    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
</form>
<?php else: ?>
    <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></button>

<?php endif; ?>

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

<?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/members/btn/delete.blade.php ENDPATH**/ ?>