<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
 <?php echo e($keywords['Gallery'] ?? __('Gallery')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->gallery_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->gallery_meta_description : ''); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user-front.breadcrum',['title' => $upageHeading?->gallery_page_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="gallery-area pt-120 pb-90">
        <div class="container">
            <?php if($galleries->count() > 0): ?>

            <div class="grid row">
                <div class="grid-sizer"></div>

                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-gallery mb-30 col-lg-4 col-md-6">
                        <div class="item">
                            <img class="wow fadeIn" src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_GALLERY_IMAGES,$gallery->image,$userBs)); ?>" alt="gallery" data-wow-delay=".5s">
                            <div class="gallery-overlay">
                                <a class="image-popup"
                                   href="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_GALLERY_IMAGES,$gallery->image,$userBs)); ?>"
                                   title="<?php echo e(convertUtf8($gallery->title)); ?>">
                                    <i class="flaticon-add"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
             <?php else: ?>
             <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center text-center bg-light py-5">
                        <h3><?php echo e($keywords['NO GALLERY IMAGE FOUND!'] ?? __('NO GALLERY IMAGE FOUND!')); ?></h3>
                    </div>
                </div>
             </div>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/user-front/fastfood/gallery.blade.php ENDPATH**/ ?>