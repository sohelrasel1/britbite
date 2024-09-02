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

<!--========= common css ============--->
<?php if($activeTheme == 'fastfood' || !request()->routeIs('user.front.index')): ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/style.css')); ?>">
<?php endif; ?>

<!--========= rtl css ============--->
<?php if($activeTheme == 'fastfood' && $rtl == 1): ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/responsive.css')); ?>">
<?php endif; ?>

<!--========= common rtl css ============--->
<?php if($rtl == 1): ?>
 <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl.css')); ?>">
<?php endif; ?>

<?php if($activeTheme == 'fastfood' && ($userBs->is_tawkto == 1 || $userBs->is_whatsapp == 1)): ?>
<style>
    .go-top-area .go-top.active {
        right: auto;
        left: 20px;
    }
</style>
<?php endif; ?>
<?php /**PATH /var/www/html/saas/resources/views/user-front/themes_css.blade.php ENDPATH**/ ?>