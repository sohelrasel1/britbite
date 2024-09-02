<?php if(count($langs) == 0): ?>
    <style media="screen">
        .support-bar-area ul.social-links li:last-child {
            margin-right: 0px;
        }

        .support-bar-area ul.social-links::after {
            display: none;
        }
    </style>
<?php endif; ?>

<?php if($userBs->feature_section == 0): ?>
    <style media="screen">
        .hero-txt {
            padding-bottom: 160px;
        }
    </style>
<?php endif; ?>



<?php if($activeTheme == 'bakery'): ?>

    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.bakery.include.bakery_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endif; ?>




<?php if($activeTheme == 'pizza'): ?>
    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.pizza.include.pizza_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php endif; ?>





<?php if($activeTheme == 'coffee'): ?>
    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.coffee.include.coffee_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php endif; ?>




<?php if($activeTheme == 'medicine'): ?>
    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.medicine.include.medicine_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php endif; ?>



<?php if($activeTheme == 'grocery'): ?>
    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.grocery.include.grocery_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php endif; ?>



<?php if($activeTheme == 'beverage'): ?>
    <?php if(!request()->routeIs('user.front.index')): ?>
        <?php echo $__env->make('user-front.beverage.include.beverage_header_footer_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php endif; ?>

<?php /**PATH /var/www/html/saas/resources/views/user-front/themes_header_footer_css.blade.php ENDPATH**/ ?>