
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>


  <script src="<?php echo e(asset('assets/front/js/plugin.min.js')); ?>"></script>
  <?php if(is_array($packagePermissions) && in_array('PWA Installability',$packagePermissions)): ?>

  <script src="<?php echo e(asset('assets/front/js/pwa.js')); ?>" defer></script>
  <?php endif; ?>

  <script src="<?php echo e(asset('assets/front/js/cart.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/front/js/misc.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/main.js')); ?>"></script>

<?php /**PATH /var/www/html/saas/resources/views/user-front/themes_js.blade.php ENDPATH**/ ?>