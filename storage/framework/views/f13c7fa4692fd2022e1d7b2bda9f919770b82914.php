<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Blog Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($blog) ? $blog->meta_keywords : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($blog) ? $blog->meta_description : ''); ?>

<?php $__env->startSection('og-meta'); ?>
    <meta property="og:image" content="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(strlen($blog->title) > 30 ? mb_substr($blog->title, 0, 30) . '...' : $blog->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Blog Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
    <div class="blog-details-area pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-center gx-xl-5">
                <div class="col-lg-8">
                    <div class="blog-description mb-50">
                        <article class="item-single">
                            <div class="image">
                                <div class="lazy-container aspect-ratio-16-9">
                                    <img class="lazyload lazy-image" src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>"
                                         data-src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>" alt="Blog Image">
                                </div>
                            </div>
                            <div class="content">
                                <ul class="info-list">
                                    <li><i class="fal fa-user"></i><?php echo e(__('Admin')); ?></li>
                                    <li><i class="fal fa-calendar"></i><?php echo e(\Carbon\Carbon::parse($blog->created_at)->format("F j, Y")); ?></li>
                                    <li><i class="fal fa-tag"></i><?php echo e($blog->bcategory->name); ?></li>
                                </ul>
                                <h3 class="title">
                                    <?php echo e($blog->title); ?>

                                </h3>
                                <p><?php echo replaceBaseUrl($blog->content); ?></p>

                            </div>
                        </article>
                    </div>
                    <div class="comments mb-30">
                        <div class="comment-lists">
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php if ($__env->exists('front.partials.blog-sidebar')) echo $__env->make('front.partials.blog-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>

<?php if($bs->is_disqus == 1): ?>
    <?php $__env->startSection('scripts'); ?>
     <script>
        var disqus_shortname = '<?php echo e($bs->disqus_shortname); ?>'
    </script>
     <script src="<?php echo e(asset('assets/front/js/custom.js')); ?>"></script>
   
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/front/blog-details.blade.php ENDPATH**/ ?>