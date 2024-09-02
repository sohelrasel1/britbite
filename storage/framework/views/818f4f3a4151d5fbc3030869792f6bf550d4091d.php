    <!--====== jquery js ======-->
    <script src="<?php echo e(asset('assets/front/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/vendor/jquery.3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/whatsapp.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/pusher.js')); ?>"></script>
    <?php if(!empty($packagePermissions) && in_array('Live Orders', $packagePermissions)): ?>
        <script src="<?php echo e(asset('assets/front/js/realtime.js')); ?>"></script>
    <?php elseif(in_array('Call Waiter', $packagePermissions)): ?>
        <script src="<?php echo e(asset('assets/front/js/realtime.js')); ?>"></script>
    <?php endif; ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/plugin_js.blade.php ENDPATH**/ ?>