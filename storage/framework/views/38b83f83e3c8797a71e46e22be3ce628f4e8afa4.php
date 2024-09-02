<?php if($activeTheme == 'fastfood'): ?>
    <?php if ($__env->exists('user-front.fastfood.partials.footer')) echo $__env->make('user-front.fastfood.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'bakery'): ?>
    <?php if ($__env->exists('user-front.bakery.partials.footer')) echo $__env->make('user-front.bakery.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'pizza'): ?>
    <?php if ($__env->exists('user-front.pizza.partials.footer')) echo $__env->make('user-front.pizza.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'coffee'): ?>
    <?php if ($__env->exists('user-front.coffee.partials.footer')) echo $__env->make('user-front.coffee.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'medicine'): ?>
    <?php if ($__env->exists('user-front.medicine.partials.footer')) echo $__env->make('user-front.medicine.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'grocery'): ?>
    <?php if ($__env->exists('user-front.grocery.partials.footer')) echo $__env->make('user-front.grocery.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'beverage'): ?>
    <?php if ($__env->exists('user-front.beverage.partials.footer')) echo $__env->make('user-front.beverage.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/themes_footer.blade.php ENDPATH**/ ?>