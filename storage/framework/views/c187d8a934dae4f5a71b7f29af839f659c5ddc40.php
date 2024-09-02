
<?php if($activeTheme == 'fastfood'): ?>
    <?php if ($__env->exists('user-front.fastfood.partials.header')) echo $__env->make('user-front.fastfood.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'bakery'): ?>
    <?php if ($__env->exists('user-front.bakery.partials.header')) echo $__env->make('user-front.bakery.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'pizza'): ?>
    <?php if ($__env->exists('user-front.pizza.partials.header')) echo $__env->make('user-front.pizza.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'coffee'): ?>
    <?php if ($__env->exists('user-front.coffee.partials.header')) echo $__env->make('user-front.coffee.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'medicine'): ?>
    <?php if ($__env->exists('user-front.medicine.partials.header')) echo $__env->make('user-front.medicine.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'grocery'): ?>
    <?php if ($__env->exists('user-front.grocery.partials.header')) echo $__env->make('user-front.grocery.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($activeTheme == 'beverage'): ?>
    <?php if ($__env->exists('user-front.beverage.partials.header')) echo $__env->make('user-front.beverage.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/themes_header.blade.php ENDPATH**/ ?>