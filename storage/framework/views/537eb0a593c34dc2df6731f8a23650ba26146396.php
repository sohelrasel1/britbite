<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>


<?php $__env->startSection('pageHeading'); ?>
    <?php echo e(convertUtf8($page->title)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagename'); ?>
    - <?php echo e(convertUtf8($page->title)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-keywords', "$page->meta_keywords"); ?>
<?php $__env->startSection('meta-description', "$page->meta_description"); ?>

<?php $__env->startSection('content'); ?>
   
     <section class="page-title-area d-flex align-items-center"
    style="background-image: url('<?php echo e($userBs->breadcrumb ? Uploader::getImageUrl(Constant::WEBSITE_BREADCRUMB, $userBs->breadcrumb, $userBs) : asset('assets/restaurant/images/breadcrum.jpg')); ?>');background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e(convertUtf8($page->title)); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('user.front.index', getParam())); ?>"><i
                                            class="flaticon-home"></i><?php echo e($keywords['Home'] ?? __('Home')); ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e(convertUtf8($page->title)); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="experience-area-3 pt-100 pb-90">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="tinymce-content">
                    <?php echo $page->content; ?>

                </div>
            </div>
        </div>
    </section>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/dynamic.blade.php ENDPATH**/ ?>