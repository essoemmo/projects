<?php if(session('success')): ?>

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "<?php echo e(session('success')); ?>",
            timeout: 2000,
            killer: true
        }).show();
    </script>

<?php endif; ?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/layouts/session.blade.php ENDPATH**/ ?>