<?php
    use Illuminate\Support\Carbon;
?>


<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Blog')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->blogs_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->blogs_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('Blog')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Blog')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
    <section class="blog-area pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-center">

                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card mb-30" data-aos="fade-up" data-aos-delay="100">
                            <div class="card-image">
                                <a href="<?php echo e(route('front.blog.details',['id' => $blog->id,'slug' => $blog->slug])); ?>"
                                   class="lazy-container aspect-ratio-16-9">
                                    <img class="lazyload lazy-image"
                                         src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>"
                                         data-src="<?php echo e(asset('assets/front/img/blogs/'.$blog->main_image)); ?>"
                                         alt="Blog Image">
                                </a>
                                <ul class="info-list">
                                    <li><i class="fal fa-user"></i><?php echo e(__('Admin')); ?></li>
                                    <li>
                                        <i class="fal fa-calendar"></i><?php echo e(Carbon::parse($blog->created_at)->format("F j, Y")); ?>

                                    </li>
                                    <li><i class="fal fa-tag"></i><?php echo e($blog->bcategory->name); ?></li>
                                </ul>
                            </div>
                            <div class="content">
                                <h4 class="card-title">
                                    <a href="<?php echo e(route('front.blog.details',['id' => $blog->id,'slug' => $blog->slug])); ?>">
                                       <?php echo e(strlen($blog->title) > 120 ? mb_substr($blog->title, 0, 120, 'UTF-8') . '...' : $blog->title); ?>

                                    </a>
                                </h4>
                                <p class="card-text"><?php echo strlen($blog->content) > 120 ? mb_substr($blog->content, 0, 120, 'UTF-8') . '...' : $blog->content; ?></p>
                                <a href="<?php echo e(route('front.blog.details',['id' => $blog->id,'slug' => $blog->slug])); ?>"
                                   class="card-btn"><?php echo e(__('Read More')); ?></a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="pagination mb-30 justify-content-center">
                <?php echo e($blogs->appends(['category' => request()->input('category')])->links()); ?>

            </div>
        </div>
    </section>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/saas/resources/views/front/blogs.blade.php ENDPATH**/ ?>